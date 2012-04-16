require 'spec_helper'

describe "PointAwardings" do
  context "when points are earned" do
    it "updates users last_point_awarded_at" do
      login_user

      recipe = Factory(:recipe, name: "Apple Pie", user: @user)

      visit dashboard_path

      #  find attrs in layout
      time_in_layout = find('a[data-last-points-awarded-at]')['data-last-points-awarded-at']
      current_time = Proc.new { Time.now }.call.to_i.to_s

      time_in_layout.should eql(current_time)
    end
  end
end
