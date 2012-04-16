module RecipesHelper

  def link_to_add_fields(name, f, association)
    new_object = f.object.class.reflect_on_association(association).klass.new
    field = f.simple_fields_for(association, new_object, :child_index => "new_#{association}") do |builder|
      render("nested_fields", :f => builder)
    end
    link_to name, "#", :class => "add_field", "data-association" => "#{h(association.to_s)}", "data-field" => "#{h(field)}"
  end
end
