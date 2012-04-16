class ApplicationController < ActionController::Base
  protect_from_forgery

  def after_sign_out_path_for(resource_or_scope)
    root_path
  end

  def after_sign_in_path_for(resource_or_scope)
    dashboard_path
  end

  # cancan rescue
  rescue_from CanCan::AccessDenied do |exception|
    puts "Cancan exception ==================================="
    # flash.now[:notice] = exception.message
    redirect_to root_url, alert: exception.message
  end

  def find_polymorphic
    params.each do |name, value|
      if name =~ /(.+)_id$/
        return $1.classify.constantize.find_by_slug(value)
      end
    end
    nil
  end
end
