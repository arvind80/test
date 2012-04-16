module VotesHelper
  def voting_widget(voteable)
    link_up = link_to "vote up", "#", :class => 'vote btn', nofollow: true,
          'data-voteable' => voteable.class.to_s.parameterize.pluralize,
          'data-voteable-id' => voteable.slug,
          'data-mark' => 'true'

    link_down = link_to "vote down", "#", :class => 'vote btn', nofollow: true,
          'data-voteable' => voteable.class.to_s.parameterize.pluralize,
          'data-voteable-id' => voteable.slug,
          'data-mark' => 'false'

    score_div = content_tag :div, voteable.votes_score,
          :class => "voteable-score",
          'data-voteable' => voteable.class.to_s.parameterize.pluralize,
          'data-voteable-id' => voteable.slug

    link_up + score_div + link_down
  end
end
