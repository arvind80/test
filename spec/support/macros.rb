module Macros
  def login_user
    @user = Factory(:user)
    visit new_user_session_path

    # fill in sign in form
    within("#main_container") do
      fill_in "user[email]", with: @user.email
      fill_in "user[password]", with: @user.password
      click_button "Sign in"
    end
  end

  def last_email
    ActionMailer::Base.deliveries.last
  end

  def reset_email
    ActionMailer::Base.deliveries = []
  end
end

RSpec.configure do |config|
  config.include Macros
end
