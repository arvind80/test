class Vote
  include Mongoid::Document
  include Mongoid::Timestamps

  # fields
  field :mark, type: Boolean # true => "thumbs up", false => "thumbs down"

  # relationships
  belongs_to :voteable, polymorphic: true
  belongs_to :voter, polymorphic: true
  has_many :actions, as: :resource

  #custom validations
  validate :voteable_once, :voteable_belongs_to_another_voter, :within_daily_limit

  def voteable_once
    #TODO consider unsigned voters
    if voter.present? && voteable.voted_by?(voter)
      errors.add(:user, "can't vote again here")
    end
  end

  def voteable_belongs_to_another_voter
    #TODO consider unsigned voters
    if voter.present? && voteable.user == voter
      errors.add(:user, "you own this")
    end
  end 
  
  def direction
     self.mark ? "up" : "down"
  end
  
  DAILY_LIMIT = 10
  def within_daily_limit
    #TODO consider unsigned voters
    if voter.present? && voter.today_votes.size >= DAILY_LIMIT
      errors.add(:user, "voting daily limit exceeded")
    end
  end

  after_create do |vote|
    # Only create actions and award points if a user votes
    if vote.voter.present?

      # Create action for stream
      action = Action.create({
        action_performed: "created",
        initiator_points: 5,
        initiator: vote.voter,
        recipient: vote.voteable.user,
        resource: vote
      })

      # Award user points for creating vote
      action.initiator.point_awardings.create(value: action.initiator_points)
    end
  end

  module Voter
    def self.included(base)
      base.class_eval do
        has_many :votes, as: :voter

        include ClassMethods
      end
    end

    module ClassMethods
      def votes_in(voteable)
        self.votes.where(voteable_type: voteable._type)
      end

      def today_votes
        self.votes.where(:created_at => {'$gte' => Time.now.midnight, '$lt' => Time.now.midnight + 1.day})
      end
    end
  end

  module Voteable
    def self.included(base)
      base.class_eval do
        has_many :votes, as: :voteable

        include ClassMethods

        # same as singleton method voted_by(voter)
        #scope :voted_by, lambda { |voter| where('votes.voter_id' => voter.id) }
      end

      def base.voted_by(voter)
        # FIXME do it the other way around
        #self.where('votes.voter_id' => voter.id)
        voter.votes.where(:voteable_type => self).collect {|v| v.voteable}
      end

      def base.highest_voted
        # FIXME optimize by using counter cache
        includes(:votes).sort_by { |voteable| voteable.votes_score }.reverse
      end

      def base.most_voted
        # FIXME optimize by using counter cache
        # order_by([:votes.size, :desc])
        includes(:votes).sort_by { |voteable| voteable.votes.size }.reverse
      end
    end

    module ClassMethods
      def votes_count
        self.votes.size
      end

      def votes_up
        self.votes.where(:mark => true)
      end

      def votes_down
        self.votes.where(:mark => false)
      end

      def votes_score
        votes_up.size - votes_down.size
      end

      def voted?
        self.votes.size > 0
      end

      def voted_by?(voter)
        !self.votes.where(voter_id: voter.id).empty?
      end
    end
  end
end
