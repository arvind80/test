require 'spec_helper'

describe Comment do

  recipe = Factory(:recipe)

  it "can be created" do
    5.times { recipe.comments.create({content: Faker::Lorem.paragraph }) }

    recipe.comments.count.should == 5
  end
end
