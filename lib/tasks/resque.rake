require "resque/tasks"

task "resque:setup" => :environment

# rake resque:work QUEUE='*'
