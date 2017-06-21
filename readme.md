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
