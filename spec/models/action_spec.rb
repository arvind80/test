require 'spec_helper'

describe Action do

  context "derived from user creating a recipe" do
    user = Factory :user
    recipe = Factory :recipe, user: user

    action = recipe.actions.last

    it "sets the action performed to 'created'" do
      action.action_performed.should eq "created"
    end

    it "awards 10 points to the initiator" do
      action.initiator_points.should eq 10
    end

    it "sets recipe's creator as the initiator" do
      action.initiator.should eq recipe.user
    end

    it "sets recipe's creator as the recipient" do
      action.recipient.should eq recipe.user
    end

    it "sets resource as the recipe" do
      action.resource.should eq recipe
    end
  end

  context "derived from user voting on a recipe" do
    recipe = Factory :recipe, user: Factory.create(:user)
    vote = recipe.votes.create(Factory.attributes_for(:vote, voter: Factory.create(:user)))

    action = vote.actions.last

    it "sets the action performed to 'created'" do
      action.action_performed.should eq "created"
    end

    it "awards 5 points to the initiator" do
      action.initiator_points.should eq 5
    end

    it "sets voter creator as the initiator" do
      action.initiator.should eq vote.voter
    end

    it "sets voteable creator as the recipient" do
      action.recipient.should eq vote.voteable.user
    end

    it "sets resource as the vote" do
      action.resource.should eq vote
    end
  end
end
