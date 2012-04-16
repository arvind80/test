class Ingredient
  include Mongoid::Document
  include Mongoid::FullTextSearch
  
  # Fields
  field :content
  
  # Relationships
  belongs_to :recipe
  has_many :comments, as: :commentable

  fulltext_search_in :content
end
