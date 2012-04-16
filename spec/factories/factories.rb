FactoryGirl.define do
  factory :user do
    username { Faker::Internet.user_name }
    email { Faker::Internet.email }
    fullname { Faker::Name.name }
    password "secret"
    password_confirmation { |u| u.password }
  end

  factory :recipe do
    name { Faker::Lorem.sentence }
    description { Faker::Lorem.paragraph }
    user
  end

  factory :ingredient do
    content { Faker::Lorem.sentence }
  end

  factory :step do
    content { Faker::Lorem.sentence }
  end

  factory :comment do
    content { Faker::Lorem.paragraph }
  end

  factory :vote do
    mark { Random.rand(2) == 1 }
  end

  factory :cookbook do
    name { Faker::Lorem.sentence }
    user
  end
end
