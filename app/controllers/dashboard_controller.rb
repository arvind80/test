class DashboardController < ApplicationController
  respond_to :html, :js
  before_filter :authenticate_user!

  def index

  end
end
