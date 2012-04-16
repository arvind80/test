module ActionHelper
  def action_for(action)

    if action.resource.class === Vote
      return "#{link_to action.initiator.username, username_path(action.initiator)} voted #{action.resource.direction} #{link_to action.resource.voteable.name, action.resource.voteable}".html_safe
    end

    if action.resource.class === Recipe
      return "#{link_to action.initiator.username, username_path(action.initiator)} created the recipe #{link_to action.resource.name, action.resource}".html_safe
    end

  end
end
