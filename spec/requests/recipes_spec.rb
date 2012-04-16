require 'spec_helper'

describe "Recipes" do
  describe "list viewed by a user that is signed in" do
    it "shows all recipes" do
      login_user

      Factory :recipe, name: "Apple Pie"
      Factory :recipe, name: "Lemon Pie"

      visit recipes_path

      # check page content
      page.should have_content('Apple Pie')
      page.should have_content('Lemon Pie')
    end
  end

  describe "list viewed by a user that is not signed in" do
    it "shows all recipes" do
      Factory :recipe, name: "Apple Pie"
      Factory :recipe, name: "Lemon Pie"

      visit recipes_path

      # check page content
      page.should have_content('Apple Pie')
      page.should have_content('Lemon Pie')
    end
  end

  describe "listing 50 recipes" do
    it "paginates the recipes showing 25 on each page" do
      50.times { Factory :recipe }
      visit root_path
      page.should match_exactly(25, "li.recipe")

      # after clicking the "load more" link, there should be 25 more recipes
      # click_link "Load More"
      # page.should match_exactly(50, "li.recipe")
    end
  end

  describe "created by a user that is signed in" do
    it "succeeds" do
      login_user

      visit new_recipe_path

      # fill in form
      fill_in "recipe[name]", with: "Apple Pie"
      fill_in "recipe[description]", with: "Lorem ipsum dolor sit amet, consectetur adipisicing elit"

      fill_in "recipe[ingredients_attributes][0][content]", with: "cheese"
      fill_in "recipe[ingredients_attributes][1][content]", with: "potatoes"
      fill_in "recipe[ingredients_attributes][2][content]", with: "corn"

      fill_in "recipe[steps_attributes][0][content]", with: "first do this"
      fill_in "recipe[steps_attributes][1][content]", with: "second do this"
      fill_in "recipe[steps_attributes][2][content]", with: "lastly do this"

      click_link_or_button "Create Recipe"

      # check page content
      page.should have_content('Apple Pie')
      page.should have_content('cheese')
      page.should have_content('potatoes')
      page.should have_content('corn')
      page.should have_content("first do this")
      page.should have_content("second do this")
      page.should have_content("lastly do this")
    end
  end

  describe "created by a user that is not signed in" do
    it "is not allowed and redirects to sign in page" do
      visit new_recipe_path

      page.should have_content("You need to sign in or sign up before continuing.")
    end
  end

  describe "updated by a user that is signed in" do
    before :each do
      login_user
    end

    it "succeeds" do
      recipe = Factory(:recipe, :user => @user)
      visit edit_recipe_path(recipe)

      fill_in "recipe[name]", with: "Apple Pie"

      click_on "Update Recipe"

      page.should have_content('Apple Pie')
      page.should have_content("Recipe updated")
    end

    it "succeeds adding/removing ingredients/steps", :js => true do
      recipe = Factory(:recipe, :user => @user,
        :ingredients => [ Factory(:ingredient, :content => "Sugar") ])

      visit recipe_path(recipe)

      page.should have_content("Sugar")

      visit edit_recipe_path(recipe)

      click_on "remove"
      click_on "Update Recipe"

      # page.should_not have_content("Sugar")
      page.should have_content("Recipe updated")
    end
  end

  describe "updated by a user that is not signed in" do
    it "shows warning message (not allowed)" do
      recipe = Factory(:recipe, :user => Factory(:user),
        :ingredients => [ Factory(:ingredient, :content => "Sugar") ])

      recipe.steps << Factory.build(:step, :content => "Mix")
      recipe.save

      visit edit_recipe_path(recipe)

      page.should have_content("You are not authorized to access this page.")
    end
  end

  describe "deleted by a user that is signed in" do
    it "succeeds if the user is the owner", :js => true do
      login_user

      recipe = Factory(:recipe, :user => @user)

      visit recipe_path(recipe.slug)

      page.should have_content(recipe.name)
      page.should have_content("Destroy")

      click_on "Destroy"

      dialog = page.driver.browser.switch_to.alert
      dialog.text.should eq("Are you sure?")
      dialog.accept

      page.should_not have_content(recipe.name)
      page.should have_content("Recipe deleted")
    end

    it "is not allowed if the user is not the owner" do
      recipe = Factory(:recipe)

      visit recipe_path(recipe.slug)

      page.should have_content(recipe.name)
      page.should_not have_content("Destroy")
    end
  end

  describe "deleted by a user that is not signed in" do
    it "is not allowed" do
      recipe = Factory(:recipe)

      visit recipe_path(recipe.slug)

      page.should have_content(recipe.name)
      page.should_not have_content("Destroy")
    end
  end

end
