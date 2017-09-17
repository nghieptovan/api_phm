#before Run
  duplicate .env.example and change name to .env
  edit
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=phongmach            
    DB_USERNAME=root
    DB_PASSWORD=
#click terminal from laragon dashboard
#run:
  composer install
#it could be that you're missing the OpenSSL extension. Also, do you have the key set in .env file?
#Try running:
  php artisan key:generate

##create database
CREATE DATABASE `phongmach`;
php artisan migrate:refresh --seed


###Back End ###
#Run the following artisan command:
# create a controller for our REST API.
  php artisan make:controller Employees
# create an Eloquent ORM model for our REST API
  php artisan make:model Employee
  php artisan migrate:refresh --seed`
#add new migrate
  php artisan make:migration create_users_table --create=users
#edit migrate
  php artisan make:migration add_fields_to_employees_table --table=employees
  php artisan make:seeder UsersTableSeeder
  php artisan db:seed --class=UsersTableSeeder
###Back End ###

##
##POSTMAN
##

################################### employees ##################################
#get employees
method: GET
http://phongmach.dev/api/v1/employee/{id}
#create/update employee
method: POST
http://phongmach.dev/api/v1/employee/{id}
###click BODY chọn RAW -> json(application/json)
###data:
{
	 "username": "nghiep",
    "password": "123456",
    "position": "employee",
    "created_at": null,
    "updated_at": null,
    "madangnhap": "",
    "fullname": "",
    "image": "",
    "role_id": 2
}
#delete employee
method: POST
http://phongmach.dev/api/v1/employee/delete/{id}
################################### employees ##################################

################################### patients ###################################
#get patients
method: GET
http://phongmach.dev/api/v1/patient/{id}

#create/update patients
method: POST
http://phongmach.dev/api/v1/patient/{id}
{
    "hoten": "Trần Văn A",
    "gioitinh": 1,
    "cannang": "80",
    "ngaysinh": "1980-08-16 10:16:01",
    "diachi": "1 CMT8",
    "sodienthoai": "0908848602",
    "tiencan": "Không có tiền căn",
    "employee_id": 2
}

#delete patient
method: POST
http://phongmach.dev/api/v1/patient/delete/{id}
################################### patients ###################################





#get medicine
http://localhost:8000/api/v1/medicine/{id}
method: GET

#create medicine
http://localhost:8000/api/v1/medicine/
method: POST
{
	"mathuoc": "mathuoc1",
	"tenthuoc": "tenthuoc1",
	"tenthuoc_toa": "tenthuoc_toa1",
	"quicachsudung": "1",
	"phanloai": "2",
	"soluong": "1000",
	"dongia": "2500",
	"nhandang": "nhandang1"
}


#prescription
http://phongmach.dev/api/v1/prescription
method: GET
{
    "message": "Prescriptions was found",
    "data": [
        {
            "id": 1,
            "name": "Toa thuốc mẫu 1",
            "code": "toamau1",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 2,
            "name": "Toa thuốc mẫu 2",
            "code": "toamau2",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 3,
            "name": "Toa thuốc mẫu 2",
            "code": "toamau2",
            "created_at": null,
            "updated_at": null
        }
    ],
    "code": 200
}