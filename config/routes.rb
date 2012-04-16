Recipes::Application.routes.draw do
  devise_for :users

  get '/dashboard' => 'dashboard#index'
  resources :users do
    # resources :actions, :as => :activity
    get '/activity' => 'users#actions', :as => :activity

    member do
      get :followees, :followers
      post :follow, :unfollow
    end
  end

  resources :recipes do
    resources :comments, :votes
  end

  resources :cookbooks
  resources :searches
  resources :actions, :as => :activity
  match "/activity" => "actions#index"

  root :to => 'recipes#index'

  get '/search' => 'searches#new', :as => :new_search

  # this should be the last route
  get '/:username' => 'users#show', as: 'username'
end
