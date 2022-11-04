<?php
require 'funciones.php';
include 'conexion.php';

$ClaseClientes = new Funciones;

// Crear escenarios en base a el esquema, con datos de los clientes
foreach($ClaseClientes->crearEscenario('3090956') as $CL) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://external.driv.in/api/external/v2/scenarios',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{ "description": "Sincronizacion drivin",
        "date": "2022-11-04",
        "fleet_name": null,
        "schema_name": "PRUEBAS",
        "schema_code": "1909",
        "clients":[
            {
            "code": "'.$CL['NRODCTO'].'",
            "address":"'.$CL['DIRECCION'].'",
            "reference":"'.$CL['BARRIO'].'",
            "city":"Bogota",
            "country":"Colombia",
            "lat":"'.$CL['LATITUDE'].'",
            "lng":"'.$CL['LONGITUDE'].'",
            "name":"'.$CL['NOMBRECLIENTE'].'",
            "client_name":"'.$CL['NOMBRECLIENTE'].'",
            "client_code":"'.$CL['NITENTREGA'].'",
            "address_type":"Localidad",
            "contact_name":"'.$CL['Nota'].'",
            "contact_phone":"'.$CL['NUMTELEFONO'].'",
            "contact_email":"'.$CL['CORREO'].'",
            "service_time":null,
            "time_windows":[
                {
                    "start":"09:00",
                    "end":"11:00"
                }
            ],
            "tags":[
            ],
            "orders":[
                {
                    "code":"'.$CL['NRODCTO'].'",
                    "alt_code":null,
                    "description":"Compra lista de precio PAP",
                    "units_1":"'. number_format($CL['CANTIDAD']).'",
                    "units_2":null,
                    "units_3":null,
                    "position":null,
                    "vehicle_code":"NICO01",
                    "delivery_date":"2022-11-04",
                    "custom_1":null,
                    "custom_2":null,
                    "custom_3":null,
                    "supplier_code":null,
                        "items":[]
                }
            ]
            }
        ]
    }',
    CURLOPT_HTTPHEADER => array(
        'X-API-Key: aa3e4c9d-027c-4761-878c-0d8d191b4cd9',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response; 
}

// Consulta para revisar las ordener por medio de el token generado por el api al momento de crear el escenario
// $jsonResponse = $ClaseClientes->verOrdenes('463501f1-b300-4f74-9cca-5011d6025e9b');
// $jsonResponse = $ClaseClientes->verOrdenes('58e00112-0f72-43f7-9537-36a59a9a4c5e');

// $Resultado = json_decode($jsonResponse, true);
// echo '<pre>';

// print_r($Resultado);