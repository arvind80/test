class RecipesController < ApplicationController
  respond_to :html, :js

  # auth
  load_and_authorize_resource :only => [:edit, :update], :find_by => :slug
  before_filter :authenticate_user!, except: [:index, :show, :vote]

  def index
    @recipes = Recipe.all.page(params[:page])
  end

  def show
    @recipe = Recipe.find_by_slug(params[:id])
  end

  def new
    @recipe = Recipe.new
    @recipe.images.build
    3.times do
      @recipe.ingredients.build
      @recipe.steps.build
    end
  end

  def create
    @recipe = Recipe.new(params[:recipe])
    @recipe.user = current_user
    flash[:notice] = "You&rsquo;ve created a recipe!" if @recipe.save
    respond_with @recipe
  end

  def edit
    @recipe = current_user.recipes.find_by_slug(params[:id])
  end

  def update
    @recipe = Recipe.find_by_slug(params[:id])
    flash[:notice] = "Recipe updated" if @recipe.update_attributes(params[:recipe])
    respond_with @recipe
  end

  def destroy
    @recipe = current_user.recipes.find_by_slug(params[:id])
    @recipe.destroy
    flash[:notice] = "Recipe deleted"
    redirect_to recipes_url
  end
end
