class SearchImportWorker
  @queue = :search_import_queue
  def self.perform(model_name, per_page)
    model_name.constantize.import :per_page => per_page  
  end
end
