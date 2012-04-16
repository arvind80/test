require 'spec_helper'

describe PointAwarding do
  describe "points issued to a user" do
    it "after creating a recipes" do
      user = Factory :user

      user_points_before_action = user.points

      recipe = user.recipes.create(Factory.attributes_for(:recipe))
      user.points.should eql(user_points_before_action + recipe.initiator_points_for_creation)
    end

    it "are revoked if the user deletes a recipe previously created" do
      user = Factory :user

      user_points_before_action = user.points

      new_recipe = user.recipes.create(Factory.attributes_for(:recipe))
      new_recipe.delete

      user.points.should eql(user_points_before_action)
    end

    it "updates last_points_awarded_at if points are awarded and positive" do
      user = Factory :user
      user.recipes.create(Factory.attributes_for(:recipe))

      # convert to int per: http://www.ruby-forum.com/topic/154149
      user.last_points_awarded_at.to_i.should eql(Time.now.to_i)
    end
  end

  pending "points are removed from a user for deleting a recipe"

end
