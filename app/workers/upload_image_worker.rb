class UploadImageWorker
  @queue = :image_upload_queue
  def self.perform(imageable_type, imageable_id, image_url)
    @object = imageable_type.constantize.find(imageable_id.to_s)        
    image = Image.new
    image.remote_image_url = image_url
    @object.images = [image]
    @object.save!
  end
end

