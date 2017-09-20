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


#search
http://phongmach.dev/api/v1/patient/searchPatient
method: POST

{
  "name": "Lê" hoac "phone": "0908" hoac "code": "BN0"
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

#enclitic
http://phongmach.dev/api/v1/enclitic/getList
POST
{
  "status_id": 1,
  "date": "18/09/2017"
}
 #CREATE 
 http://phongmach.dev/api/v1/enclitic
 POST
{
  "patient_id": 2,
    "employee_id": 1,
    "status_id": 1
    "date": "21/09/2017 04:27:20" (co thi get date, khong co thi lay theo date hien tai)
}



#bill

#get list bill
http://phongmach.dev/api/v1/bill
METHOD: GET


#create bill
http://phongmach.dev/api/v1/bill
METHOD: {POST}
{
  "patient_id": 3,
    "billdate": "17/09/2017 11:11:51",
    "symptom": "Ngay 2109",
    "diagnosis_id": 1,
    "subdiagnosis": "Ngay 2109",
    "introduction": "tai kham lai Ngay 2209",
    "nextdate": "30/10/2017",
    "index": 2,
    "doctor_id": 1,
    "dispenser_id": 0,
    "dispensedatetime": "",
    "enclitic_id": 1,
    "bill_detail": [
      {
        "medicine_id": 1,
        "price": 3400,
        "timesperday": 2,
        "daydrink": "nua vien",
        "number": 5,
        "daycount": 5,
          "description": "chống chỉ định cho trẻ em22222222222222222"
      },
      {
        "medicine_id": 2,
        "price": 3400,
        "timesperday": 2,
        "daydrink": "1 vien",
        "number": 5,
        "daycount": 5,
        "description": "chống chỉ định cho trẻ em"
        }
######note: bill detail gom array prescription co san + thuoc them moi
      ]
    
}


######update bill
http://phongmach.dev/api/v1/bill/{id}
METHOD: POST
{
    "symptom": "Ngay 2109",
    "diagnosis_id": 1,
    "subdiagnosis": "Ngay 2109",
    "introduction": "tai kham lai Ngay 2209",
    "nextdate": "30/10/2017",
    "index": 2,
    "dispenser_id": 0,
    "dispensedatetime": "",
    "bill_detail": [
      {
        "medicine_id": 1,
            "price": 3400,
            "timesperday": 2,
            "daydrink": "nua vien",
            "number": 5,
            "daycount": 5,
          "description": "chống chỉ định cho trẻ emupdate"
      },
      {
            "medicine_id": 2,
            "price": 3400,
            "timesperday": 2,
            "daydrink": "1 vien",
            "number": 5,
            "daycount": 5,
            "description": "chống chỉ định cho trẻ emupdate"
        }
      ]
######note: bill detail gom array prescription co san + thuoc them moi

######param nao can update thi truyen len, khong can thi thoi
}

#delete bill 
http://phongmach.dev/api/v1/bill/delete/2
METHOD: POST

Return {
    "message": "Bill deleted success.",
    "code": 200
}