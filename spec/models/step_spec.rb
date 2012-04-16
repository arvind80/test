require 'spec_helper'

describe Step do

  describe "#recipe"

  recipe = Factory(:recipe)

  it "can be created" do
    5.times do
      recipe.steps.build(Factory.attributes_for(:step))
    end

    recipe.save

    recipe.steps.count.should == 5
  end
end
