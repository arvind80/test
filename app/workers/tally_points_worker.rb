class TallyPointsWorker
  @queue = :tally_points_queue
  def self.perform(user_id, points)
    user = User.find user_id
    # user.
  end
end
