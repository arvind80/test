require 'spec_helper'

describe "Dashboard" do
  describe "index" do
    it "shows user recipes and cookbooks" do
      login_user

      recipe = Factory(:recipe, name: "Apple Pie", user: @user)
      cookbook = Factory(:cookbook, user: @user)

      visit dashboard_path

      # check page content
      page.should have_content('Apple Pie')
    end

    it "shows the current user stats" do
      login_user

      20.times do
        Factory(:recipe, user: @user)
        @user.follow(Factory(:user))
        Factory(:user).follow(@user)
      end

      visit dashboard_path

      page.should have_content("20 recipes")
      page.should have_content("20 following")
      page.should have_content("20 followers")
    end
  end

end
