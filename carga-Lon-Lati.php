<?php
    require 'funciones.php';
    include 'conexion.php';
    
    $ClaseClientes = new Funciones;

    // foreach($ClaseClientes->nitsUsuarios() as $CL){
	// 	$jsonResponse = $ClaseClientes->traerLongYlati($CL['NIT']); 
	// 	$Resultado = json_decode($jsonResponse, true);
	// 	$ClaseClientes->getJsonData($Resultado['code'],$Resultado['latitude'],$Resultado['longitude']);
	// 	echo '<pre>';
	// 	print_r($Resultado['latitude'].'--'.$Resultado['longitude']);
	// }

?>