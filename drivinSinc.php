<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();
error_reporting(0);

require 'funciones.php';
include 'conexion.php';

$ClaseClientes = new Funciones;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="sistema sincronizacion drivin" />
	<meta name="author" content="Santiago Guillen Ramirez" />
	<title>Drivin Sincronizacion</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
	<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" /> 
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
	<style>
		.table-containter {
			margin: 40px;
			padding: 40px;
			max-width: 140%;
			max-height: 700px;
			overflow-x: scroll;
			overflow-y: auto;
			border: 1px solid #aeaeae56;
			box-shadow: 0px 0px 2px #6d6d6d;
			text-align: center;
		}

		.table-containter table tr th{
			font-size: 0.800rem;
			text-align: center;
		}

		.table-containter table tr td{
			font-size: 0.800rem;
			text-align: center;
		}
	</style>
</head>

<div class="container">
	<div class="text-right mt-4">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group list-group-horizontal">
					<li class="list-group-item list-group-item"><strong>Drivin Sincronizacion</strong></li>
				</ul>
			</div>
		</div>
	</div>

	<form action="" method="POST">
		<div class="text-right mt-5">
			<div class="row">
				<div class="col-md-6">
					<input type="date" class="form-control" name="fechaConsulta" min="" required>
				</div>

				<div class="form-group col-md-6">
					<center><input name="buscarPedidos" style="width: 100%; height: 40px;" class="btn btn-danger" type="submit" value="Buscar" /></center>
				</div>
			</div>
		</div>
	</form>
</div>

<?php if (isset($_POST['buscarPedidos'])) {
	$fechaBusqueda = $_POST['fechaConsulta'];
?>
<section class="table-containter">
	<table id="example" class="table table-striped table-bordered" style="width:10%">
			<thead>
				<tr>
					<th><strong>TIPO DOCUMENTO</strong></font></th>
					<th><strong>N° DOCUMENTO</strong></font></th>
					<th><strong>NIT</strong></font></th>
					<th><strong>NOMBRE CLIENTE</strong></font></th>
					<th><strong>DIRECCION</strong></font></th>
					<th><strong>BARRIO</strong></font></th>
					<th><strong>LOCALIDAD</strong></font></th>
					<th><strong>PRODUCTO</strong></font></th>
					<th><strong>CANTIDAD</strong></font></th>
					<th><strong>KLS</strong></font></th>
					<th><strong>UNDBASE</strong></font></th>
					<th><strong>COMENTARIO</strong></font></th>
					<th><strong>NOTA CLIENTE</strong></font></th>
					<th><strong>CANAL</strong></font></th>
					<th><strong>CORREO CLIENTE</strong></font></th>
					<th><strong>LATITUDE</strong></font></th>
					<th><strong>LONGITUDE</strong></font></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($ClaseClientes->mostrarDatos($fechaBusqueda) as $CL) {
					echo "<tr>
							<td>" . utf8_encode($CL['TIPODCTO']) . "</td>
							<td>" . utf8_encode($CL['NRODCTO']) . "</td>
							<td>" . utf8_encode($CL['NITENTREGA']) . "</td>
							<td>" . utf8_encode($CL['NOMBRECLIENTE']) . "</td>
							<td>" . utf8_encode($CL['DIRECCION']) . "</td>
							<td>" . utf8_encode($CL['BARRIO']) . "</td>
							<td>" . utf8_encode($CL['RUTALOCALIDAD']) . "</td>	
							<td>" . utf8_encode($CL['NOMBREPROD']) . "</td>
							<td>" . utf8_encode(number_format($CL['CANTIDAD'])) . "</td>
							<td>" . utf8_encode(number_format($CL['KLS'])) . "</td>
							<td>" . utf8_encode($CL['UNDBASE']) . "</td>
							<td>" . utf8_encode($CL['COMENTARIO']) . "</td>
							<td>" . utf8_encode($CL['Nota']) . "</td>
							<td>" . utf8_encode($CL['CANAL']) . "</td>
							<td>" . utf8_encode($CL['CORREO']) . "</td>
							<td>" . utf8_encode($CL['LATITUDE']) . "</td>
							<td>" . utf8_encode($CL['LONGITUDE']) . "</td>
						</tr>";
				} ?>
			</tbody>
		</table>
</section>

	<?php } else { ?>

<div class="container">
	<div class="text-right mt-4">
		<div class="row">
			<nav class="navbar navbar-expand-lg navbar-dark bg-danger" style="margin-top: 50px;">
				<div class="container">
					<center><a class="navbar-brand">Consulta los pedidos por dia</a> </center>
				</div>
			</nav>
		</div>
	</div>
</div>

<?php } ?>

<script>
	$(document).ready(function () {
    	$('#example').DataTable();
	});
</script>
