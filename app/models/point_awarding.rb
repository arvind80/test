class PointAwarding
  include Mongoid::Document
  include Mongoid::Timestamps

  # Fields
  field :value, type: Integer, default: 0

  # Relationships
  #has_and_belongs_to_many :actions # Can relate to an action, needs setter
  embedded_in :user

  after_create :update_user_points

  def update_user_points
    self.user.tally_points self.value
  end
end
