# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rake db:seed (or created alongside the db with db:setup).
#
# Examples:
#
#   cities = City.create([{ name: 'Chicago' }, { name: 'Copenhagen' }])
#   Mayor.create(name: 'Emanuel', city: cities.first)

require 'faker'
require 'factory_girl_rails'

100.times do
  Factory.create :user
end

users = User.all
count = users.size

100.times do
  recipe = Factory.create :recipe, user: users[Random.rand(count)]

  Random.new.rand(2...30).times do
    Factory.create :ingredient, :recipe => recipe
  end

  Random.new.rand(1...10).times do
    Factory.create :step, :recipe => recipe
  end

  Random.new.rand(0...30).times do
    recipe.comments.create(Factory.attributes_for(:comment, commenter: users[Random.rand(count)]))
  end

  Random.new.rand(0...30).times do
    recipe.votes.create(Factory.attributes_for(:vote, voter: users[Random.rand(count)]))
  end
end
