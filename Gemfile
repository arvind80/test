source 'http://rubygems.org'

gem 'rails', '3.2.2'

# MongoDB
gem 'mongoid'
gem 'bson_ext'
gem 'mongoid_slug'
gem 'mongoid_fulltext'
gem 'mongoid_followable'

# pagination
gem 'kaminari'

# Auth
gem 'devise'
gem 'devise_invitable'
gem 'cancan'

# forms
gem 'client_side_validations'
gem 'simple_form'

gem 'carrierwave', :git => 'git://github.com/jnicklas/carrierwave.git', :branch => "0.5-stable"
gem 'carrierwave-mongoid', :require => 'carrierwave/mongoid'

gem 'mini_magick'

# for background jobs and cache server
gem 'rack-cache', :require => 'rack/cache'
gem 'redis'
gem 'resque', :require => 'resque/server'
gem 'redis-store'

# deployment
gem 'unicorn'
gem 'capistrano'

group :development do
  gem 'capistrano-unicorn'
end

# ruby library Google V8 javascript runtime
gem "therubyracer"

# assets
group :assets do
  gem 'sass-rails', '~> 3.2.3'
  gem 'coffee-rails', '~> 3.2.1'
  gem 'uglifier', '>= 1.0.3'
end

# gem "asset_sync" # https://github.com/rumblelabs/asset_sync

gem 'jquery-rails'

# testing
gem 'rspec-rails', :group => [:test, :development]

group :test do

  # Pretty printed test output
  gem 'turn', :require => false

  gem 'factory_girl_rails'
  gem 'faker'
  gem 'capybara'
  gem 'launchy'
  gem 'guard-rspec'
  gem 'mongoid-rspec'
  gem 'spork', '~> 0.9.0.rc'
  gem 'guard-spork'

  # # on ubuntu
  # gem 'libnotify' if /linux/ =~ RUBY_PLATFORM

  # # on mac
  # if /darwin/ =~ RUBY_PLATFORM
  #   gem 'rb-inotify', :require => false
  #   gem 'rb-fsevent', :require => false
  #   gem 'rb-fchange', :require => false
  # end
end
