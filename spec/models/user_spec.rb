require 'spec_helper'

describe User do
  user_1 = Factory(:user)
  user_2 = Factory(:user)

  it "follow another user" do
    user_1.follow(user_2)
    user_1.follower_of?(user_2).should == true
  end

  it "can create a recipe" do
    # create recipe itself
    recipe = user_1.recipes.new(Factory.attributes_for(:recipe))

    # create ingredients
    2.times { recipe.ingredients.build(Factory.attributes_for(:ingredient)) }

    # create steps
    recipe.steps.build(Factory.attributes_for(:step))

    recipe.save

    recipe.ingredients.count.should == 2
    recipe.steps.count.should == 1
  end

  it "can edit their own recipe" do
    recipe = user_1.recipes.new(Factory.attributes_for(:recipe))
    recipe.update_attributes(Factory.attributes_for(:recipe))

    user_1.recipes.count == 1
  end

  it "can manage cookbook" do
    user_1.cookbooks.should be_empty
    cookbook = user_1.cookbooks.new(Factory.attributes_for(:cookbook))
    user_1.save
    user_1.cookbooks.should eq([cookbook])

    new_cookbook_name = 'Thai 101'

    user_1.cookbooks.last.name.should_not eq(new_cookbook_name)
    user_1.cookbooks.last.update_attributes(Factory.attributes_for(:cookbook, :name => new_cookbook_name))
    user_1.cookbooks.last.name.should eq(new_cookbook_name)
  end
end
