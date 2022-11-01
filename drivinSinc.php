<?php 

    require 'funciones.php';
	include 'conexion.php';

	$ClaseClientes = new Funciones; 

	foreach($ClaseClientes->nitsUsuarios() as $CL){
		$jsonResponse = $ClaseClientes->traerLongYlati($CL['NITENTREGA']); 
		$Resultado = json_decode($jsonResponse, true);
		$data = $ClaseClientes->getJsonData($Resultado['code'],$Resultado['latitude'],$Resultado['longitude']);
	}
?>