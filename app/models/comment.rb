class Comment
  include Mongoid::Document
  include Mongoid::Timestamps

  # fields
  field :content

  # relationships
  belongs_to :commentable, polymorphic: true
  belongs_to :commenter, polymorphic: true
end
