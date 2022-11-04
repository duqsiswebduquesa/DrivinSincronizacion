<?php

class Funciones {

	// Carga de datos - longitud - latitud

	// public function nitsUsuarios(){
	// 	include "conexion.php"; 
	// 	$Data = "SELECT NIT, FECHAING FROM DUQUESA..MTPROCLI 
	// 	WHERE CODPRECIO = 'BPAP' AND FECHAING BETWEEN '2022-09-01' AND '2022-10-31'";

	// 	$Datresp = odbc_exec($conexion, $Data);
	// 	while ($Dos = odbc_fetch_array($Datresp)) { $arr[] = $Dos; }
	// 	return $arr;	
    // }

	// public function getJsonData($code,$latitude,$longitude){

	// 	include "conexion.php"; 
	// 	$Data = "IF NOT EXISTS(SELECT * FROM DUQUESA..MTPROCLI_LONG_LATI WHERE NIT = '$code') BEGIN
	// 	INSERT INTO DUQUESA..MTPROCLI_LONG_LATI (NIT,LONGITUDE,LATITUDE) VALUES ('$code','$longitude','$latitude') END";

	// 	$Datresp = odbc_exec($conexion, $Data);
	// }

    // public function traerLongYlati($init){

    //     $token = "8eh6dv9evk8kv12v453dkm6jajv0ki0t"; 
    //     $url = curl_init('https://app.handy.la/api/v2/customer/'.$init); 
	// 	curl_setopt($url, CURLOPT_RETURNTRANSFER, true); 
	// 		curl_setopt($url, CURLOPT_HTTPHEADER, array(
	// 		'Content-Type: application/json',
	// 		'Authorization: Bearer ' . $token
	// 		)); 
	// 	$data = curl_exec($url);  

	// 	return json_decode(json_encode($data),true);
	// 	curl_close($url);
    // }

	public function mostrarDatos($fechaBusqueda){
		include "conexion.php"; 
				$Data = "SELECT
				TR.TIPODCTO,TR.NRODCTO,RTRIM(MT.NIT) AS NITENTREGA,RTRIM(MT.NOMBRE) AS NOMBRECLIENTE,
				RTRIM(MT.DIRECCION) AS DIRECCION, 
				RTRIM(IIF(MT.ESP_NOMBREBARRIO = '' OR MT.ESP_NOMBREBARRIO IS NULL, MT.PAGINAWEB, MT.ESP_NOMBREBARRIO)) AS BARRIO, 
				CONCAT(RTA.CODRUTA,'- ',RTA.NOMBRE) AS RUTALOCALIDAD, 
				RTRIM(MVT.NOMBRE) AS NOMBREPROD, MVT.CANTIDAD, MVT.CANTIDAD*TAB.FACTOR KLS,
				RTRIM(MVT.UNDBASE) UNDBASE, RTRIM(MT.COMENTARIO) COMENTARIO, IIF(TR.NOTA IS NULL OR TR.NOTA = '', 'SIN NOTA', TR.NOTA) Nota,
				MT.CANAL, RTRIM(MT.EMAIL) AS CORREO,MTLOLA.LATITUDE,MTLOLA.LONGITUDE
			FROM DUQUESA..TRADE TR 
				INNER JOIN DUQUESA..MTPROCLI MT ON TR.NIT = MT.NIT
				INNER JOIN DUQUESA..MTRUTAS RTA ON RTA.CODRUTA = MT.CODRUTA
				INNER JOIN DUQUESA..MTPROCLI_LONG_LATI MTLOLA ON MTLOLA.NIT = MT.NIT
				INNER JOIN DUQUESA..MVTRADE MVT ON MVT.NRODCTO = TR.NRODCTO AND MVT.TIPODCTO = TR.TIPODCTO
				INNER JOIN DUQUESA..TIPODCTO TD ON TD.TIPODCTO = TR.TIPODCTO
				INNER JOIN DUQUESA..TABLACNV TAB ON TAB.BASE = MVT.UNDBASE AND TAB.DESTINO = 'KLS'
			WHERE 
				TR.FECHA = '$fechaBusqueda'
				AND TD.DCTOMAE = 'FA' AND MVT.CANTIDAD > 0
				AND MT.CODPRECIO = 'BPAP'";
		
				$Datresp = odbc_exec($conexion, $Data);
				while ($Dos = odbc_fetch_array($Datresp)) { $arr[] = $Dos; }
				return $arr;
    } 

	public function crearEscenario($NIT){
		include "conexion.php"; 
				$Data = "SELECT
				TR.TIPODCTO,TR.NRODCTO,RTRIM(MT.NIT) AS NITENTREGA,RTRIM(MT.NOMBRE) AS NOMBRECLIENTE,
				RTRIM(MT.DIRECCION) AS DIRECCION,RTRIM(MT.TEL1) AS NUMTELEFONO,
				RTRIM(IIF(MT.ESP_NOMBREBARRIO = '' OR MT.ESP_NOMBREBARRIO IS NULL, MT.PAGINAWEB, MT.ESP_NOMBREBARRIO)) AS BARRIO, 
				CONCAT(RTA.CODRUTA,'- ',RTA.NOMBRE) AS RUTALOCALIDAD, 
				RTRIM(MVT.NOMBRE) AS NOMBREPROD, MVT.CANTIDAD, MVT.CANTIDAD*TAB.FACTOR KLS,
				RTRIM(MVT.UNDBASE) UNDBASE, RTRIM(MT.COMENTARIO) COMENTARIO, IIF(TR.NOTA IS NULL OR TR.NOTA = '', 'SIN NOTA', TR.NOTA) Nota,
				MT.CANAL, RTRIM(MT.EMAIL) AS CORREO,MTLOLA.LATITUDE,MTLOLA.LONGITUDE
			FROM DUQUESA..TRADE TR 
				INNER JOIN DUQUESA..MTPROCLI MT ON TR.NIT = MT.NIT
				INNER JOIN DUQUESA..MTRUTAS RTA ON RTA.CODRUTA = MT.CODRUTA
				INNER JOIN DUQUESA..MTPROCLI_LONG_LATI MTLOLA ON MTLOLA.NIT = MT.NIT
				INNER JOIN DUQUESA..MVTRADE MVT ON MVT.NRODCTO = TR.NRODCTO AND MVT.TIPODCTO = TR.TIPODCTO
				INNER JOIN DUQUESA..TIPODCTO TD ON TD.TIPODCTO = TR.TIPODCTO
				INNER JOIN DUQUESA..TABLACNV TAB ON TAB.BASE = MVT.UNDBASE AND TAB.DESTINO = 'KLS'
			WHERE 
				TR.FECHA = '2022-10-28' AND TR.NIT = '$NIT'
				AND TD.DCTOMAE = 'FA' AND MVT.CANTIDAD > 0
				AND MT.CODPRECIO = 'BPAP'";
		
				$Datresp = odbc_exec($conexion, $Data);
				while ($Dos = odbc_fetch_array($Datresp)) { $arr[] = $Dos; }
				return $arr;
    }



	public function verOrdenes($token){

		    $url = curl_init('https://external.driv.in/api/external/v2/orders?token='.$token); 
			curl_setopt($url, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($url, CURLOPT_HTTPHEADER, array(
				'X-API-Key: aa3e4c9d-027c-4761-878c-0d8d191b4cd9',
				'Content-Type: application/json'
				)); 

			$data = curl_exec($url);  
	
			return json_decode(json_encode($data),true);
			curl_close($url);
	}
}


