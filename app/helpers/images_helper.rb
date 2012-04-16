module ImagesHelper
  def display_image_for(resource, size)

    # show the cache column for the most popular image
    if resource.respond_to?(:display_image)
      return resource.display_image
    end

    # just use the first image since the cache column has not yet be implemented,
    # if there are no images for the resource, just show a placeholder for now.
    if resource.images.count == nil
      image = resource.images.first
      return image_tag image.filename_url(:size)
    else
      return image_tag "http://placehold.it/220x140"
    end

  end
end

