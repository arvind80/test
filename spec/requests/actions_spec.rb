require 'spec_helper'

describe "Actions" do
  describe "index" do
    it "shows list of all actions that occured" do
      visit activity_path

      # page.should have_content('Activity')
    end
  end
end