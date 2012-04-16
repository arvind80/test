require 'spec_helper'

describe Recipe do

  describe "#create" do
    context "when valid data" do
      it "creates a new record in database" do
        recipe = Recipe.create(Factory.attributes_for(:recipe))

        Recipe.all.include?(recipe).should be_true
        Recipe.all.should have(1).recipe
      end
    end

    context "when invalid data"
  end

  describe "#update" do
    context "when valid data" do
      it "updates the new record in the database" do
        recipe = Factory :recipe

        new_recipe = Factory.attributes_for :recipe

        recipe.update_attributes(new_recipe)

        recipe.attributes.should_not eql(new_recipe)
        Recipe.all.should have(1).recipe
      end
    end

    context "when the record does not exist"
    context "when invalid data"
  end

  describe "#destroy" do
    context "when valid data" do
      it "deletes the record from the database" do
        recipe = Factory :recipe

        recipe.destroy

        Recipe.all.should be_empty
        Recipe.all.include?(recipe).should be_false
      end
    end

    context "when the record does not exist"
  end
end
