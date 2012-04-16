require 'spec_helper'
require 'carrierwave/test/matchers'

describe "ImageUploads" do
  include CarrierWave::Test::Matchers

  context 'on user' do
    before :each do
      @user = Factory :user
      user_image = @user.images.new

      @uploader = ImageUploader.new(user_image, :filename)
      @uploader.store!(File.open('spec/support/jpsilvashy.jpeg'))
    end

    after :each do
      @uploader.remove!
    end

    it "should make tinys that are exactly 24 by 24 pixels" do
      @uploader.tiny.should have_dimensions(24, 24)
    end

    it "should make thumbs that are exactly 48 by 48 pixels" do
      @uploader.thumb.should have_dimensions(48, 48)
    end
  end

  context 'on recipe' do
    before :each do
      @recipe = Factory :recipe
      @uploader = ImageUploader.new(@recipe, :image)
      @uploader.store!(File.open('spec/support/gourmet-chicken.jpeg'))
    end

    after :each do
      @uploader.remove!
    end

    it "should make tinys that are exactly 24 by 24 pixels" do
      @uploader.tiny.should have_dimensions(24, 24)
    end

    it "should make thumbs that are exactly 48 by 48 pixels" do
      @uploader.thumb.should have_dimensions(48, 48)
    end
  end

end
