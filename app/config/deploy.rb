set :application, "Cartouche"
set :domain,      "estcequejedoischangermacartouche.fr"
set :deploy_to,   "/var/www/#{domain}"
set :app_path,    "app"

set :repository,  "https://github.com/Gregoire-M/cartouche.git"
set :scm,         :git

set :user,        "gregoire"
set :use_sudo,    false

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

set  :keep_releases,  5
after "deploy", "deploy:cleanup"

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs"]
set :use_composer, true
set :update_vendors, true
set :dump_assetic_assets, true

set :writable_dirs,       ["app/cache"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

before 'symfony:composer:update', 'composer:copy_vendors'

namespace :composer do
  task :copy_vendors, :except => { :no_release => true } do
    capifony_pretty_print "--> Copy vendor file from previous release"

    run "vendorDir=#{current_path}/vendor; if [ -d $vendorDir ] || [ -h $vendorDir ]; then cp -a $vendorDir #{latest_release}/vendor; fi;"
    capifony_puts_ok
  end
end

# Be more verbose by uncommenting the following line
#logger.level = Logger::MAX_LEVEL
