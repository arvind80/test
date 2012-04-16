$(".follow-link[data-user='<%= @user.slug %>']").button('reset');
$('#notifications').append($('<%= render "notifications" if (notice || alert) %>'))

$(".follow-link[data-user='<%= @user.slug %>']").replaceWith("<%= escape_javascript(follow_link @user) %>")

false