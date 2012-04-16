class Achievement
  include Mongoid::Document
  include Mongoid::Timestamps

  # Fields
  field :name
  field :type

  # Relationships
  embedded_in :user
end
