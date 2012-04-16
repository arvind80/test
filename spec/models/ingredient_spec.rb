require 'spec_helper'

describe Ingredient do

  recipe = Factory(:recipe)

  it "can be created" do
    recipe.ingredients.create({content: 'first lets do this.'})
    recipe.ingredients.create({content: 'then do this.'})
    recipe.ingredients.count.should == 2
  end
end
