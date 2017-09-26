#Drug (dược chất)
#### getlist
http://phongmach.dev/api/v1/drug/{id?}
METHOD: GET
datareturn
{
    "message": "Drugs was found",
    "data": [
        {
            "id": 2,
            "code": "par2",
            "name": "Paracetamol2",
            "created_at": "2017-09-26 22:19:26",
            "updated_at": "2017-09-26 22:19:26"
        }
    ],
    "code": 200
}
#### create/update
http://phongmach.dev/api/v1/drug
METHOD: POST
datajson 
{
"name":	"paracetamol",
"code": "pars"
}
#### delete
http://phongmach.dev/api/v1/drug/delete/{id}
datareturn
{
    "message": "Drug deleted success.",
    "data": "true",
    "code": 200
}


#PatentMedicine (biệt dược)
#### getlist
http://phongmach.dev/api/v1/patentmedicine/{id?}
METHOD: GET
datareturn
{
    "message": "PatentMedicine was found",
    "data": [
        {
            "id": 1,
            "name": "Seduxen ",
            "code": "se",
            "created_at": "2017-09-26 22:34:05",
            "updated_at": "2017-09-26 22:34:05"
        }
    ],
    "code": 200
}
#### create/update
http://phongmach.dev/api/v1/patentmedicine
METHOD: POST
datajson 
{
"name": "Seduxen ",
"code": "se",
}
#### delete
http://phongmach.dev/api/v1/patentmedicine/delete/{id}
datareturn
{
    "message": "patentmedicine deleted success.",
    "data": "true",
    "code": 200
}


#Unit To Medicine (đơn vị dược dược)
#### getlist
http://phongmach.dev/api/v1/unittomedicine/{id?}
METHOD: GET
datareturn
{
    "message": "unittomedicine was found",
    "data": [
        {
            "id": 1,
            "name": "Seduxen ",
            "code": "se",
            "created_at": "2017-09-26 22:34:05",
            "updated_at": "2017-09-26 22:34:05"
        }
    ],
    "code": 200
}
#### create/update
http://phongmach.dev/api/v1/unittomedicine
METHOD: POST
datajson 
{
"name": "Seduxen ",
"code": "se",
}
#### delete
http://phongmach.dev/api/v1/unittomedicine/delete/{id}
datareturn
{
    "message": "unittomedicine deleted success.",
    "data": "true",
    "code": 200
}