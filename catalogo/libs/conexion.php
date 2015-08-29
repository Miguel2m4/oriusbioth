<?php
$conexion=mysql_connect("localhost","oriuspan_Sig2014","Sigapp14")or die ("No hay Conexion");
$conectDB=mysql_select_db("oriuspan_sigapp2",$conexion) or die ("no existe BD");
mysql_query ("SET NAMES 'utf8'");
?>
