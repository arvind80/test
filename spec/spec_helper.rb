# Dir[File.expand_path(File.join(File.dirname(__FILE__),'support','**','*.rb'))].each {|f| require f}
require 'rubygems'
require 'spork'

Spork.prefork do
  # Loading more in this block will cause your tests to run faster. However,
  # if you change any configuration or code from libraries loaded here, you'll
  # need to restart spork for it take effect.

  # Mongoid likes to preload all of your models in rails, making Spork a near
  # worthless experience. It can be defeated with this code
  require "rails/mongoid"
  Spork.trap_class_method(Rails::Mongoid, :load_models)

  # Devise likes to load the User model. We want to avoid this. It does so in
  # the routes file, when calling devise_for :users, :path => "my_account".
  # The solution? Delay route loading.
  require "rails/application"
  Spork.trap_method(Rails::Application, :reload_routes!)

  # Routes reloading changed in Rails 3.1 (rc5 as of this writing). Therefore
  # we need the following instead of the previous Spork.trap_method:
  Spork.trap_method(Rails::Application::RoutesReloader, :reload!)

  # This file is copied to spec/ when you run 'rails generate rspec:install'
  ENV["RAILS_ENV"] ||= 'test'
  require File.expand_path("../../config/environment", __FILE__)
  require 'rspec/rails'
  require 'capybara/rspec'

  # Requires supporting ruby files with custom matchers and macros, etc,
  # in spec/support/ and its subdirectories.
  Dir[Rails.root.join("spec/support/**/*.rb")].each {|f| require f}

  RSpec.configure do |config|
    # == Mock Framework
    #
    # If you prefer to use mocha, flexmock or RR, uncomment the appropriate line:
    #
    # config.mock_with :mocha
    # config.mock_with :flexmock
    # config.mock_with :rr
    config.mock_with :rspec

    # If you're not using ActiveRecord, or you'd prefer not to run each of your
    # examples within a transaction, remove the following line or assign false
    # instead of true.
    # config.use_transactional_fixtures = true
    config.before :each do
      Mongoid.master.collections.select {|c| c.name !~ /system/ }.each(&:drop)
    end

    config.include Factory::Syntax::Methods

    # run only the specs with the :focus tag
    config.treat_symbols_as_metadata_keys_with_true_values = true
    config.filter_run :focus => true
    config.run_all_when_everything_filtered = true
  end
end

Spork.each_run do
  # This code will be run each time you run your specs.

  FactoryGirl.reload
  I18n.backend.reload!
end
