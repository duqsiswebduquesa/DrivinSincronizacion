<?php

class Funciones {

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
				INNER JOIN DUQUESA..MVTRADE MVT ON MVT.NRODCTO = TR.NRODCTO
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

}


