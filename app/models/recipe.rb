 class Recipe
  include Mongoid::Document
  include Mongoid::Timestamps
  include Mongoid::Slug
  include Mongoid::FullTextSearch

  # Fields
  field :name
  field :description

  # Relationships
  belongs_to :user
  embeds_many :images, as: :imageable, cascade_callbacks: true
  has_many :ingredients, autosave: true, dependent: :delete
  embeds_many :steps, cascade_callbacks: true
  has_many :comments, as: :commentable
  has_many :actions, as: :resource
  include Vote::Voteable

  # class vars
  attr_accessor :initiator_points_for_creation

  def initiator_points_for_creation
    @initiator_points_for_creation ||= 10
  end

  # Nested attrributes
  accepts_nested_attributes_for :images
  accepts_nested_attributes_for :ingredients, :steps, reject_if: lambda { |a| a[:content].blank? }, allow_destroy: true

  # Validations
  validates_associated :images, :ingredients, :steps
  validates_presence_of :name

  slug :name
  fulltext_search_in :name

  # Kaminari
  paginates_per 25

  def self.search(keywords)
    fulltext_search(keywords)
  end

  after_create do |recipe|
    # Only create actions and award points if a user creates the recipe
    if recipe.user.present?

      # Create action for stream
      action = Action.create({
        action_performed: "created",
        initiator_points: 10,
        initiator: recipe.user,
        recipient: recipe.user,
        resource: recipe
      })

      # Award user points for creating recipe
      action.initiator.point_awardings.create(value: action.initiator_points)
    end
  end
end
