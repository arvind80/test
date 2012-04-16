class Step
  include Mongoid::Document

  # fields
  field :content
  
  # relationships
  embedded_in :recipe
end
