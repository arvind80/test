require 'spec_helper'

describe "Users" do
  describe "signed in" do
    before :each do
      login_user
    end

    it "can follow other user", :js => true do
      friend = Factory(:user)
      visit username_path(friend.slug)

      within("#main_container") do
        click_link_or_button "Follow"
        page.should have_content('Unfollow')
      end

      # page.should have_content("You are now following #{friend.username}")
    end

    it "can't follow other user if already follows the user" do
      friend = Factory(:user)
      @user.follow friend

      visit username_path(friend)

      within("#main_container") do
        page.should_not have_content("Follow")
        page.should have_content("Unfollow")
      end
    end

    it "can unfollow other user", :js => true do
      friend = Factory(:user)
      @user.follow friend

      visit username_path(friend.slug)

      within("#main_container") do
        page.should have_content(friend.username)
        click_link_or_button "Unfollow"
        page.should have_content('Follow')
      end

      # page.should have_content("You stopped following #{friend.username}")
    end

    it "can't unfollow a user if did not previously follow the user" do
      @friend = Factory(:user)

      visit username_path(@friend)

      within("#main_container") do
        page.should_not have_content("Unfollow")
        page.should have_content(@friend.username)
        page.should have_content("Follow")
      end
    end

    it "can edit registration" do
      click_on "Settings"

      email = Faker::Internet.email

      within("#main_container") do
        fill_in "user[email]", :with => email
        fill_in "user[current_password]", :with => @user.password

        click_on "Update"
      end

      page.should have_content I18n.t "devise.registrations.updated"
    end

    it "cancel account", :js => true do
      visit edit_user_registration_path

      within("#main_container") do
        click_on "Cancel my account"
      end

      dialog = page.driver.browser.switch_to.alert
      dialog.text.should eq("Are you sure?")
      dialog.accept

      page.should have_content I18n.t "devise.registrations.destroyed"
    end
  end

  describe "not signed in" do
    before :each do
      reset_email
    end

    it "can sign in" do
      login_user

      page.should have_content I18n.t "devise.sessions.signed_in"
      page.current_path.should eq(dashboard_path)
    end

    it "can sign up" do
      visit root_path

      click_on "Sign up"

      within("#main_container") do
        fill_in "user[username]", :with => "myself"
        fill_in "user[email]", :with => "myself@email.com"
        fill_in "user[password]", :with => "123456"
        fill_in "user[password_confirmation]", :with => "123456"

        click_button "Sign up"
      end

      page.should have_content I18n.t "devise.registrations.signed_up"
    end

   it "cannot sign up with a blacklisted username" do
    User.blacklisted_usernames.each do |username|
      visit new_user_registration_path

      fill_in "user[username]", :with => username
      fill_in "user[email]", :with => "#{username}9999999@gmail.com"
      fill_in "user[password]", :with => "123456"
      fill_in "user[password_confirmation]", :with => "123456"

      click_button "Sign up"
      page.should have_content "sorry, we can't let you use the name \"#{username}\""
    end
  end

    it "can get an email to recover forgotten password" do
      user = Factory :user

      visit new_user_session_path
      click_on "Forgot your password?"

      fill_in "user[email]", :with => user.email
      click_button "Send me reset password instructions"
      current_path.should eq(new_user_session_path)
      page.should have_content I18n.t "devise.passwords.send_instructions"
      last_email.to.should include(user.email)
    end

    it "does not email invalid user when requesting password reset" do
      visit new_user_session_path
      click_on "Forgot your password?"
      fill_in "Email", :with => "nobody@example.com"
      click_button "Send me reset password instructions"
      current_path.should eq(user_password_path)
      page.should have_content("Some errors were found, please take a look:")
      page.should have_content("not found")
      last_email.should be_nil
    end

    it "updates the user password when confirmation matches" do
      user = Factory(:user, :reset_password_token => "something", :reset_password_sent_at => 1.hour.ago)
      visit edit_user_password_path(:reset_password_token => user.reset_password_token)
      fill_in "user[password]", :with => "foobar"
      click_button "Change my password"
      page.should have_content("Some errors were found, please take a look:")
      page.should have_content("doesn't match confirmation")
      fill_in "user[password]", :with => "foobar"
      fill_in "user[password_confirmation]", :with => "foobar"
      click_button "Change my password"
      page.should have_content I18n.t "devise.passwords.updated"
    end

    # it "reports when password token has expired" do
    #   user = Factory(:user, :reset_password_token => "something", :reset_password_sent_at => 5.hour.ago)
    #   visit edit_user_password_path(:reset_password_token => user.reset_password_token)
    #   fill_in "user[password]", :with => "foobar"
    #   fill_in "user[password_confirmation]", :with => "foobar"
    #   click_button "Change my password"
    #   page.should have_content("Some errors were found, please take a look:")
    #   page.should have_content I18n.t "errors.messages.expired"
    # end

    it "reports when password token is invalid" do
      visit edit_user_password_path(:reset_password_token => 'invalid')
      fill_in "user[password]", :with => "foobar"
      fill_in "user[password_confirmation]", :with => "foobar"
      click_button "Change my password"
      page.should have_content("Some errors were found, please take a look:")
      page.should have_content("Reset password token is invalid")
    end

    it "can't follow other user" do
      @friend = Factory(:user)
      visit username_path(@friend)

      within("#main_container") do
        page.should have_content("Follow")
        click_on "Follow"
      end

      page.should have_content I18n.t "devise.failure.unauthenticated"
    end

    it "can't unfollow other user" do
      @friend = Factory(:user)

      visit username_path(@friend)

      within("#main_container") do
        page.should have_content("Follow")
        page.should have_content(@friend.username)
        page.should_not have_content("Unfollow")

        click_on "Follow"
      end

      page.should have_content I18n.t "devise.failure.unauthenticated"
    end
  end

  pending "with * role can..."
end
