class Ability
  include CanCan::Ability

  def initialize(user)
    user ||= User.new # guest user (not logged in)

    # all users can manage thier own recipes
    can :manage, Recipe, user_id: user.id

    if user.is? 'admin'
      can :manage, :all
    end
  end
end
