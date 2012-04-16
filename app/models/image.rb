class Image
  include Mongoid::Document
  include Mongoid::Timestamps
  include Vote::Voteable

  mount_uploader :filename, ImageUploader

  embedded_in :imageable, polymorphic: true
end
