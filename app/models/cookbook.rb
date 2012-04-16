class Cookbook
  include Mongoid::Document
  include Mongoid::Timestamps

  # fields
  field :name
  
  # relationships
  belongs_to :user
  has_and_belongs_to_many :recipes, inverse_of: nil
end
