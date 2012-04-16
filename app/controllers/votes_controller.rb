class VotesController < ApplicationController
  respond_to :html, :js

  def create
    @voteable =  find_polymorphic
    @voteable.votes.create!({ mark: params[:mark], voter: user_signed_in? ? current_user : nil })
    flash.now[:notice] = "You voted #{@voteable.name} #{params[:mark] == 'true' ? "up" : "down"}."
  rescue Exception => e
    logger.error e.message
    flash.now[:alert] = "Problem: #{e.message}"
  end
end
