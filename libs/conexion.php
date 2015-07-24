<?php
$conexion=mysql_connect("localhost","oriuspan_orbioth","PvTPW44wO-Dm")or die ("No hay Conexion");
$conectDB=mysql_select_db("oriuspan_oriusth",$conexion) or die ("no existe BD");
mysql_query ("SET NAMES 'utf8'");
?>
