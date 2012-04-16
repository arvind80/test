class SearchesController < ApplicationController
  respond_to :html, :js

  def new
    @search = Search.new
  end

  def create
    @search = Search.create!(params[:search])
    redirect_to @search
  end

  def show
    @search = Search.find(params[:id])
  end
end