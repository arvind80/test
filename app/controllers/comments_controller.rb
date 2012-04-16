class CommentsController < ApplicationController
  respond_to :html, :js

  def create
    @comentable = find_polymorphic
    @comment = @comentable.comments.create(params[:comment])
    if user_signed_in?
      @comment.commenter = current_user
      @comment.save
    end
    flash[:notice] = "Successfully posted comment."
    redirect_to recipe_path(@comentable)
  end
end
