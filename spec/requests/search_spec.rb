require 'spec_helper'

describe "Search" do
  it "returns results for keywords searched" do
    Factory :recipe, name: "Apple Pie"
    Factory :recipe, name: "Pumpkin Pie"
    Factory :recipe, name: "Pecan Pie"

    visit recipes_path

    fill_in "search", with: "pECAN pIE"
    click_on "Search"

    page.should have_content("Apple Pie")
    page.should have_content("Pumpkin Pie")
    page.should have_content("Pecan Pie")
  end

  it "do not return results for keywords not searched for" do
    Factory :recipe, name: "Apple Pie"

    visit recipes_path

    fill_in "search", with: "Cheese Cake"
    click_on "Search"

    within("#main_container") do
      page.should_not have_content("Apple Pie")
    end
  end
end
