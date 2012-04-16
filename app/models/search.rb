class Search
  include Mongoid::Document
  include Mongoid::Timestamps

  # fields
  field :keywords

  def results
    @results ||= find_results
  end

  private

  def find_results
    Recipe.search(self.keywords)
  end

end
