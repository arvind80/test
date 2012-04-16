class ActionsController < ApplicationController
  respond_to :html, :js

  def index
    @actions = Action.all.page(params[:page])
  end
end
