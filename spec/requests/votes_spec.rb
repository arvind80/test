require 'spec_helper'

describe "Votes" do
  before :each do
    @recipe = Factory :recipe
  end

  describe "posted by a signed in user" do
    before :each do
      login_user
    end

    it "can be cast up", :js => true do
      visit recipe_path @recipe

      click_on "vote up"

      page.has_selector? "div.alert-message p", :text => "You voted #{@recipe.name} up."
    end

    it "can be cast down", :js =>true do
      visit recipe_path @recipe

      click_on "vote down"

      page.has_selector? "div.alert-message p", :text => "You voted #{@recipe.name} down."
    end
  end

  describe "posted by a user that is not signed in" do
    it "should be allowed to vote", :js => true do
      visit recipe_path @recipe

      click_on "vote up"

      page.has_content? "An anonymous user"
      page.has_selector? "div.alert-message p", :text => "You voted #{@recipe.name} up."
    end
  end

  describe "list" do
    it "should show total people voting up, down and the list of voters" do
      10.times do
        login_user
        @recipe.votes.create(Factory.attributes_for(:vote, :voter => @user))
        click_on "Sign out"
      end

      visit recipe_path @recipe

      within("#main_container") do
        page.should have_content "#{@recipe.votes_up} people liked this."
        page.should have_content "#{@recipe.votes_down} people didn't like this."
      end
    end
  end
end
