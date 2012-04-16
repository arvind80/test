require 'bundler/capistrano'

load 'deploy/assets'

# Application
set :application, "recipes"
set :deploy_to, "~/apps/#{application}"

# Git
set :scm, :git
set :branch, "master"
set :repository, "git@github.com:jpsilvashy/recipes.git"
set :deploy_via, :remote_cache
set :keep_releases, 4 # keep 4 releases

# Server
set :user, "deploy"
set :domain, "50.56.225.177"
server domain, :app, :web
role :db, domain, :primary => true

# Settings
default_run_options[:pty] = true
ssh_options[:forward_agent] = true
set :use_sudo, false
set :scm_verbose, true

# Unicorn
set :unicorn_config, "#{current_path}/config/unicorn/#{rails_env}.rb"
set :unicorn_pid, "#{current_path}/tmp/pids/unicorn.pid"

# Deploy
namespace :deploy do
  task :start, :roles => :app, :except => { :no_release => true } do
    run "/etc/init.d/unicorn start"
  end

  task :stop, :roles => :app, :except => { :no_release => true } do
    run "/etc/init.d/unicorn force-stop"
  end

  task :graceful_stop, :roles => :app, :except => { :no_release => true } do
    run "/etc/init.d/unicorn stop"
  end

  task :reload, :roles => :app, :except => { :no_release => true } do
    run "/etc/init.d/unicorn reload"
  end

  task :restart, :roles => :app, :except => { :no_release => true } do
    # reload
    stop
    start
  end
end

namespace :web do
  task :disable, :roles => :web do
    require 'erb'
    template = File.read('app/views/layouts/maintenance.html.erb')
    page = ERB.new(template).result(binding)

    put page, "#{shared_path}/system/maintenance.html", :mode => 0777
  end

  task :enable, :roles => :web do
    run "rm #{shared_path}/system/maintenance.html"
  end

  desc "precompile the assets"
  task :precompile_assets, :roles => :web, :except => { :no_release => true } do
    # run "cd #{release_path} && rm -rf public/assets/*"
    run "cd #{release_path} && RAILS_ENV=production bundle exec rake assets:precompile"
  end
end

before "deploy:restart", 'web:precompile_assets'
