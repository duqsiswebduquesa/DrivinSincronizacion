<?php
$conmysql = new mysqli("localhost","root","","control_handy");
if ($conmysql -> connect_errno)
{
	die("Fallo conexion:(".$conmysql -> mysqli_connect_errno().")".$conmysql -> mysqli_connect_errno());
}
?>