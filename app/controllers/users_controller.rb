class UsersController < ApplicationController
  respond_to :html, :js

  before_filter :authenticate_user!, only: [:follow, :unfollow]

  def index
    @users = User.active
  end

  def show
    @user = User.find_by_slug(params[:username])
  end

  def followees
    @users = User.followees_of User.find_by_slug(params[:id])
    render :index
  end

  def followers
    @users = User.followers_of User.find_by_slug(params[:id])
    render :index
  end

  def follow
    @user = User.find_by_slug(params[:id])

    # following user!
    current_user.follow(@user)
    flash.now[:notice] = "You are now following #{@user.username}"
  end

  def unfollow
    @user = User.find_by_slug(params[:id])

    # unfollowing user!
    current_user.unfollow(@user)
    flash.now[:notice] = "You stoped following #{@user.username}"
    render :follow
  end

  def actions
    @user = User.find_by_slug(params[:id])
    @actions = @user.activity
  end
end
