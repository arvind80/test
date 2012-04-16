module UsersHelper

  # show username unless user has supplied a full name and allowed for it to be shown
  def display_name(user)
    if user.try(:show_fullname) && user.fullname.nil?
      return user.fullname
    else
      return user.username
    end
  end

  # show a link to the opposite option as to toggle following and unfollowing
  def follow_link(user, *options)
    if user_signed_in? && current_user.follower_of?(user)
      return link_to 'Unfollow', unfollow_user_path(user.slug), :class => 'btn follow-link', :remote => true, :method => :post, :data => { :user => user.slug, "loading-text" => "Unfollowing..." }
    elsif user_signed_in? && current_user == user
      return ''
    else
      return link_to 'Follow', follow_user_path(user), :class => 'btn follow-link', :remote => true, :method => :post, :data => { :user => user.slug, "loading-text" => "Following..." }
    end
  end
end
