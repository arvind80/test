module ApplicationHelper
  def link_to_user(user)
    link_to user.username, username_path(user.slug)
  end

  def modal_for(title, partial, locals)
    header = content_tag :div, class: "modal-header" do
      link_to("x", "#", class: "close") + content_tag(:h3, title)
    end
    body = content_tag :div, class: "modal-body" do
      render partial, locals
    end
    footer = content_tag :div, class: "modal-footer" do
      link_to("Primary", "#", class: "btn primary") + link_to("Secondary", "#", class: "btn secondary")
    end
    content_tag :div, id: title.parameterize, class: "modal hide fade" do
      header + body + footer
    end
  end

  def timeago(time, options = {})
    options[:class] ||= "timeago"
    content_tag(:abbr, time.to_s, options.merge(:title => time.iso8601)) if time
  end
end