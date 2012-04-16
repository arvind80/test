# get flash messages
$('#notifications').append($('<%= render "notifications" if (notice || alert) %>'))

# update score
$('.voteable-score[data-voteable-id=<%= @voteable.slug %>]').html '<%= @voteable.votes_score %>'

# update votes
$('#votes-up').html '<%= pluralize(@voteable.votes_up.count, "person") %>'
$('#votes-down').html '<%= pluralize(@voteable.votes_down.count, "person") %>'

# update modals
$('#liking-users .modal-body').html '<%= render "votes/voters", votes: @voteable.votes.where(:mark => true) %>'
$('#not-liking-users .modal-body').html '<%= render "votes/voters", votes: @voteable.votes.where(:mark => false) %>'
