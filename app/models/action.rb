class Action
  include Mongoid::Document
  include Mongoid::Timestamps

  # Relationships
  belongs_to :initiator, polymorphic: true
  belongs_to :recipient, polymorphic: true
  belongs_to :resource, polymorphic: true
  # has_and_belongs_to_many :point_awardings

  # Fields
  field :action_performed # created, voted up, voted down, started following
  field :initiator_points, type: Integer
  field :recipient_points, type: Integer

  # Scopes
  scope :recent, limit(10)
  default_scope order_by([:created_at, :desc])

  # Kaminari
  paginates_per 50

  # Scope by user involved in action, returns all actions where user is either a recipient or initiator
  def self.by_user(user)
    any_of({ recipient_id: user.id }, { initiator_id: user.id })
  end
end
