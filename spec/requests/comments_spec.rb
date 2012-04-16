require 'spec_helper'

describe "Comments" do
  describe "posted by a signed in user" do
    before :each do
      login_user
    end

    it "should be allowed" do
      recipe = Factory :recipe
      visit recipe_path recipe

      fill_in "comment[content]", with: "I like this recipe!"
      click_on "Create Comment"

      page.should have_content "#{@user.username} wrote"
      page.should have_content "I like this recipe!"
      page.should have_content "Successfully posted comment."
    end
  end

  describe "posted by a user that is not signed in" do
    it "should be allowed" do
      recipe = Factory :recipe
      visit recipe_path recipe

      fill_in "comment[content]", with: "I like this recipe!"
      click_on "Create Comment"

      page.should have_content "An anonymous user wrote"
      page.should have_content "I like this recipe!"
      page.should have_content "Successfully posted comment."
    end
  end

  describe "list" do
    it "should show commenter and comment" do
      login_user
      comment = Factory :comment, :commenter => @user
      recipe = Factory :recipe
      recipe.comments << comment
      recipe.save

      visit recipe_path recipe

      page.should have_content comment.content
    end
  end
end
