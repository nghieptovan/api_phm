#before Run
  duplicate .env.example and change name to .env
  edit
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=api_phm            
    DB_USERNAME=root
    DB_PASSWORD=
#run:
  composer install
#it could be that you're missing the OpenSSL extension. Also, do you have the key set in .env file?
#Try running:
  php artisan key:generate

##create database
CREATE DATABASE `api_phm`;
php artisan migrate

Help:
#Run the following artisan command:
# create a controller for our REST API.
  php artisan make:controller Employees
# create an Eloquent ORM model for our REST API
  php artisan make:model Employee
  php artisan migrate:refresh --seed
#add new migrate
  php artisan make:migration create_users_table --create=users
#edit migrate
  php artisan make:migration add_fields_to_employees_table --table=employees
