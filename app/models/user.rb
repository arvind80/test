class User
  include Mongoid::Document
  include Mongoid::Timestamps
  include Mongoid::Slug
  include Mongoid::FullTextSearch
  include Mongoid::Followable
  include Mongoid::Follower

  # roles for authorization
  ROLES = %w[admin guest limited banned]

  devise :database_authenticatable, :token_authenticatable, :registerable, :recoverable, :rememberable, :trackable, :validatable

  ## Database authenticatable
  field :email,              :type => String, :null => false, :default => ""
  field :encrypted_password, :type => String, :null => false, :default => ""

  ## Recoverable
  field :reset_password_token,   :type => String
  field :reset_password_sent_at, :type => Time

  ## Rememberable
  field :remember_created_at, :type => Time

  ## Trackable
  field :sign_in_count,      :type => Integer, :default => 0
  field :current_sign_in_at, :type => Time
  field :last_sign_in_at,    :type => Time
  field :current_sign_in_ip, :type => String
  field :last_sign_in_ip,    :type => String

  # Fields
  field :username
  field :fullname, type: String, default: ""
  field :show_fullname, type: Boolean, default: true
  field :active, type: Boolean, default: true
  field :points, type: Integer, default: 0
  field :roles_mask, type: Integer, default: 0
  field :last_points_awarded_at, :type => Time

  # Relationships
  has_many :recipes, dependent: :nullify
  has_many :cookbooks, dependent: :destroy
  has_many :comments, as: :commenter

  include Vote::Voter

  has_many :actions, as: :initiator
  has_many :actions, as: :recipient
  embeds_many :achievements
  embeds_many :point_awardings
  embeds_many :images, as: :imageable, cascade_callbacks: true

  # Validations
  validates_presence_of :username, :email

  slug :username
  fulltext_search_in :username, :fullname

  # Scopes
  scope :active, where(:active => true)
  scope :recently_created, where(:created_at => { '$gte' => 1.month.ago })
  scope :recently_updated, where(:updated_at => { '$gte' => 1.month.ago })
  default_scope order_by([:created_at, :desc])

  before_validation :check_if_username_blacklisted

  def check_if_username_blacklisted
    if User.blacklisted_usernames.include? username
      errors.add :username, "sorry, we can't let you use the name \"#{username}\""
    end
  end

  # Manage roles
  def roles=(roles)
    self.roles_mask = (roles & ROLES).map { |r| 2 ** ROLES.index(r) }.sum
  end

  def roles
    ROLES.reject do |r|
      ((roles_mask || 0) & 2 ** ROLES.index(r)).zero?
    end
  end

  def is?(role)
    roles.include?(role.to_s)
  end

  # Awards and achievements
  def award(achievement)
    achievements << Achievement.new(achievement)
  end

  def awarded?(achievement)
    achievements.where({name: achievement }).count > 0
  end

  def tally_points(points_to_tally)
    self.update_attributes(points: (self.points += points_to_tally))

    if points_to_tally > 0
      self.update_attributes(last_points_awarded_at: Proc.new { Time.now }.call)
    end
  end

  def activity
    Action.any_of({ initiator_id: self.id }, { recipient_id: self.id })
  end

  protected

  def self.blacklisted_usernames
    app_models = Dir['**/models/**/*.rb'].map { |f| File.basename(f, '.*') }
    app_models + app_models.map { |f| f.pluralize }
  end
end


