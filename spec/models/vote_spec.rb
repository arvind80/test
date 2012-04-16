require 'spec_helper'

describe Vote do
  before :each do
    @voteable = Factory :recipe, user: Factory.create(:user)
    @voter = Factory :user
  end

  context "created" do
    it "validates" do
      5.times { @voteable.votes.create(Factory.attributes_for(:vote, voter: Factory.create(:user))) }

      @voteable.votes.should have(5).items
    end
  end

  context "::Voter" do
    it "#votes_in(voteable)" do
      @voter.votes_in(@voteable).should be_empty

      @voteable.votes.create(Factory.attributes_for(:vote, voter: @voter))

      @voter.votes_in(@voteable).should have(1).vote
    end

    it "#today_votes" do
      @voter.today_votes.should be_empty

      @voteable.votes.create(Factory.attributes_for(:vote, voter: @voter))

      5.times do
        @voteable.votes.create(Factory.attributes_for(:vote, :created_at => Time.now - 2.days, voter: @voter))
      end

      @voter.today_votes.should have(1).item
    end
  end

  context "::Voteable" do
    it "#votes_count" do
      5.times { @voteable.votes.create(Factory.attributes_for(:vote, voter: Factory.create(:user))) }

      @voteable.votes_count.should eql(5)
    end

    it "#votes_up" do
      5.times { @voteable.votes.create(Factory.attributes_for(:vote, :mark => true, voter: Factory.create(:user))) }

      @voteable.votes_up.should have(5).items
    end

    it "#votes_down" do
      5.times {@voteable.votes.create(Factory.attributes_for(:vote, :mark => false, voter: Factory.create(:user)))}

      @voteable.votes_down.should have(5).items
    end

    it "#votes_score" do
      5.times {@voteable.votes.create(Factory.attributes_for(:vote, :mark => true, voter: Factory.create(:user)))}
      3.times {@voteable.votes.create(Factory.attributes_for(:vote, :mark => false, voter: Factory.create(:user)))}

      @voteable.votes_score.should eql(2)
    end

    it "#voted?" do
      @voteable.voted?.should be_false

      5.times {@voteable.votes.create(Factory.attributes_for(:vote, voter: Factory.create(:user)))}

      @voteable.voted?.should be_true
    end

    it "#voted_by?(voter)" do
      @voteable.voted_by?(@voter).should be_false

      @voteable.votes.create(Factory.attributes_for(:vote, voter: @voter))

      @voteable.voted_by?(@voter).should be_true
    end

    it ".voted_by(voter)" do
      Recipe.voted_by(@voter).should be_empty

      @voteable.votes.create(Factory.attributes_for(:vote, voter: @voter))

      Recipe.voted_by(@voter).should have(1).recipe
    end

    it ".most_voted" do
      Recipe.most_voted.should have(1).recipe

      voteables = []
      (1..5).map do |n|
        voteables << Factory(:recipe)
        n.times { voteables.last.votes.create(Factory.attributes_for(:vote, voter: Factory.create(:user))) }
      end

      Recipe.most_voted.should have(6).recipes
      Recipe.most_voted.last.should eql(@voteable)
      Recipe.most_voted.first.should eql(voteables.last)
    end

    it ".highest_voted" do
      Recipe.highest_voted.should have(1).recipe

      voteables = []
      (1..5).map do |n|
        voteables << Factory(:recipe)
        n.times { voteables.last.votes.create(Factory.attributes_for(:vote, mark: true, voter: Factory.create(:user))) }
      end

      Recipe.highest_voted.should have(6).recipes
      Recipe.highest_voted.last.should eql(@voteable)
      Recipe.highest_voted.first.should eql(voteables.last)
    end
  end
end
