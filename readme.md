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
http://phongmach.dev/api/v1/prescription/{id?}
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
#update prescription
http://phongmach.dev/api/v1/prescription/{id}
method: POST
{
  "name": "Toa thuốc mẫu 1edit",
  "code": "toamau1"
}

#delete prescription
http://phongmach.dev/api/v1/prescription/delete/{id}
method: POST
returndata
{
    "message": "Prescription deleted success.",
    "data": "true",
    "code": 200
}


### prescriptiondetail
#get list detail
http://phongmach.dev/api/v1/getPrescriptionDetail/{prescription_id}
METHOD GET
#delete prescriptiondetail
http://phongmach.dev/api/v1/prescriptiondetail/delete/{id}
METHOD: POST
datareturn
{
    "message": "PrescriptionDetail deleted success.",
    "data": "true",
    "code": 200
}
#save
#update && create
http://phongmach.dev/api/v1/savePrescriptionDetail   update
http://phongmach.dev/api/v1/prescriptiondetail  create

METHOD:POST

{
  "prescription_id": 3,
  "prescription_detail": [
    {
      "prescription_id": 3,
      "medicine_id": 1,
      "daydrink": "10 vien",
      "timesperday": 3,
      "daycount": 20,
      "number": 60
    },
    {
      "prescription_id": 3,
      "medicine_id": 2,
      "daydrink": "1vien",
      "timesperday": 3,
      "daycount": 10,
      "number": 30
    }
  ]
}


#enclitic
http://phongmach.dev/api/v1/enclitic/getList
POST
{
  "status_id": 1,
  "date": "22/09/2017"
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
#TAKEMEDICINE
 http://phongmach.dev/api/v1/enclitic/takeMedicine/{id}
{
	"dispenser_id": "1"
}
 METHOD: POST: doi status_id cua enclitic 3->4
 tru amount trong medicine id,
 create exportmedicine
 {
    "message": "Enclitic was updated.",
    "data": {
        "id": 5,
        "patient_id": 1,
        "employee_id": 1,
        "status_id": 4,
        "date": "21/09/2017 04:27:20",
        "created_at": "2017-09-21 18:40:31",
        "updated_at": "2017-09-21 18:46:17"
    },
    "code": 200
}




#bill

#get list bill
http://phongmach.dev/api/v1/bill
METHOD: GET

#getByPatient
http://phongmach.dev/api/v1/bill/getByPatient/{patient_id}
METHOD: GET

#create bill
http://phongmach.dev/api/v1/bill
METHOD: {POST}
{
    "patient_id": 2,
    "billdate": "22/09/2017 11:11:51",
    "symptom": "Ngay 2209",
    "diagnosis_id": 1,
    "subdiagnosis": "Ngay 2209",
    "introduction": "tai kham lai Ngay 2209",
    "nextdate": "30/10/2017",
    "index": 3,
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
##http://phongmach.dev/api/v1/bill/getByPatient/2
http://phongmach.dev/api/v1/bill/getByPatient/{patient_id}
METHOD: GET
{
    "message": "Bills was found",
    "data": [
        {
            "id": 1,
            "patient_id": 2,
            "enclitic_id": 1,
            "billdate": "21/09/2017 05:33:49",
            "symptom": "Ngay 2109",
            "diagnosis_id": 1,
            "subdiagnosis": "Ngay 2109",
            "introduction": "tai kham lai Ngay 2209",
            "nextdate": "30/10/2017",
            "index": 2,
            "doctor_id": 1,
            "dispenser_id": 0,
            "dispensedatetime": "",
            "created_at": "2017-09-21 05:33:49",
            "updated_at": "2017-09-21 05:33:49",
            "details": [
                {
                    "id": 1,
                    "bill_id": 1,
                    "medicine_id": 1,
                    "price": 3400,
                    "timesperday": 2,
                    "daydrink": "nua vien",
                    "number": 5,
                    "daycount": 5,
                    "description": "chống chỉ định cho trẻ em22222222222222222",
                    "isDelete": 0,
                    "created_at": "2017-09-21 05:33:49",
                    "updated_at": "2017-09-21 05:33:49"
                },
                {
                    "id": 2,
                    "bill_id": 1,
                    "medicine_id": 2,
                    "price": 3400,
                    "timesperday": 2,
                    "daydrink": "1 vien",
                    "number": 5,
                    "daycount": 5,
                    "description": "chống chỉ định cho trẻ em",
                    "isDelete": 0,
                    "created_at": "2017-09-21 05:33:49",
                    "updated_at": "2017-09-21 05:33:49"
                }
            ],
            "doctor": {
                "id": 1,
                "username": "admin",
                "password": "123456",
                "fullname": "",
                "stringlogin": "",
                "role_id": 1,
                "image": "",
                "created_at": null,
                "updated_at": null
            },
            "patient": {
                "id": 2,
                "created_at": null,
                "updated_at": null,
                "name": "Trần Văn",
                "code": "BN2017081615522",
                "sex": 2,
                "weight": 70,
                "birthday": "02/07/1995 12:16:01",
                "phone": "0122321254",
                "address": "Quang trung",
                "diagnosis": "Nhức đầu",
                "employee_id": "1",
                "status_id": 1
            }
        },
        {
            "id": 2,
            "patient_id": 2,
            "enclitic_id": 1,
            "billdate": "21/09/2017 05:33:49",
            "symptom": "Ngay 2209",
            "diagnosis_id": 1,
            "subdiagnosis": "Ngay 2109",
            "introduction": "tai kham lai Ngay 2209",
            "nextdate": "30/10/2017",
            "index": 2,
            "doctor_id": 1,
            "dispenser_id": 2,
            "dispensedatetime": "2",
            "created_at": "2017-09-21 05:33:49",
            "updated_at": "2017-09-21 05:33:49",
            "details": [],
            "doctor": {
                "id": 1,
                "username": "admin",
                "password": "123456",
                "fullname": "",
                "stringlogin": "",
                "role_id": 1,
                "image": "",
                "created_at": null,
                "updated_at": null
            },
            "patient": {
                "id": 2,
                "created_at": null,
                "updated_at": null,
                "name": "Trần Văn",
                "code": "BN2017081615522",
                "sex": 2,
                "weight": 70,
                "birthday": "02/07/1995 12:16:01",
                "phone": "0122321254",
                "address": "Quang trung",
                "diagnosis": "Nhức đầu",
                "employee_id": "1",
                "status_id": 1
            }
        }
    ],
    "code": 200
}

######param nao can update thi truyen len, khong can thi thoi
}

#delete bill 
http://phongmach.dev/api/v1/bill/delete/2
METHOD: POST

Return {
    "message": "Bill deleted success.",
    "code": 200
}


#### importmedicine
#create
    http://phongmach.dev/api/v1/import/importMedicine
    METHOD: POST
    {
    "medicine_id": 1,
    "amount": 56,
    "importedprice": 50000
    }
    data return {
        "message": "ImportMedicine was created",
        "data": {
            "medicine_id": 1,
            "amount": 56,
            "importedprice": 50000,
            "importeddatetime": "21/09/2017 07:46:31",
            "updated_at": "2017-09-21 07:46:31",
            "created_at": "2017-09-21 07:46:31",
            "id": 2
        },
        "code": 200
    }
#getImported
    http://phongmach.dev/api/v1/import/getImported
    METHOD: POST
    {
      "fromDate": "20/09/2017",
      "toDate": "30/09/2017"
    }
#deleteImported
    http://phongmach.dev/api/v1/import/delete/{id}  
    METHOD: POST
    datareturn
    {
    "message": "ImportMedicine deleted success.",
    "data": "true",
    "code": 200
    }   

####export Medicine
#create
    http://phongmach.dev/api/v1/export/exportMedicine
    METHOD: POST
    {
    "medicine_id": 1,
    "amount": 56,
    "exportedprice": 50000
    }
    data return {
        {
            "message": "ExportMedicine was created",
            "data": {
                "medicine_id": 1,
                "amount": 5,
                "exportedprice": 50000,
                "exporteddatetime": "21/09/2017 06:34:28",
                "updated_at": "2017-09-21 18:34:28",
                "created_at": "2017-09-21 18:34:28",
                "id": 1
            },
            "code": 200
        }
    }
#getExported
    http://phongmach.dev/api/v1/export/getExported
    METHOD: POST
    {
      "fromDate": "20/09/2017",
      "toDate": "30/09/2017"
    }
#deleteExported
    http://phongmach.dev/api/v1/export/delete/{id}  
    METHOD: POST
    datareturn
    {
    "message": "ImportMedicine deleted success.",
    "data": "true",
    "code": 200
    }   



#Get report medicine
http://phongmach.dev/api/v1/medicine/getReport
Method: POST

{
    "fromDate": "20/09/2017",
    "toDate": "30/09/2017"
}
