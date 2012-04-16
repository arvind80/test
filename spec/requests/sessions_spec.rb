require 'spec_helper'

describe "Sessions", :type => :request do
  it "signs in" do
    @user = Factory(:user)

    visit new_user_session_path

    fill_in 'user[email]', :with => @user.email
    fill_in 'user[password]', :with => @user.password
    click_button 'Sign in'

    page.should have_content('Signed in successfully.')
  end

  it "signs out" do
    login_user

    click_on "Sign out"

    page.should have_content "Signed out successfully."
  end

  it "sends instructions to reset forgotten password" do
    user = Factory :user

    visit new_user_session_path

    click_on "Forgot your password?"
    fill_in "user[email]", :with => user.email
    click_button "Send me reset password instructions"

    page.should have_content "You will receive an email with instructions about how to reset your password in a few minutes."
  end
end
