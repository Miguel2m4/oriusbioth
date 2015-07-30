<?php

@$prod = $_POST['produc'];
@$cantidad = $_POST['cantidad'];
@$comentario = $_POST['comentario'];

echo'<form id="tempped" style="display:none">';
	for($i=0;$i<count($prod);$i++)
	{
		echo'<input type="text" name="producto[]" value="'.$prod[$i].'">';
		echo'<input type="text" name="cantidad[]" value="'.$cantidad[$i].'">';
	}
	if($comentario!='')
		echo'<input type="text" name="comentario" value="'.$comentario.'">';
echo'</form>';

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width , initial-scale=1 ,maximum-scale=1 user-scalable=no" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<title>Catalogo de Productos | Orius Biotech</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/login.css" />
<link rel="stylesheet" href="../css/msj.css" />
</head>
<body >
	<header>
		<div id="titsesion"><h1>Catalogo de Productos</h1>
		<h2>Inicia sesión para comenzar</h2>
		</div>
	</header>
	<div class="sesioncontenido">
	<div id="sesioin">
	<img src="images/logo.png">
	<form id="logueo">
		<input type="text" name="nombre"  placeholder="Nombre del usuario" required autofocus/>
		<input type="password" name="password"  placeholder="Contraseña" required />
		<input id="inicia" name="iniciarsesion" class="btninicio" type="submit" value="Iniciar sesión">
	</form>
	<!-- <p>
	<label id="olvidaste"><a href="#">Olvidaste tu contraseña?</a></label>
	</p> -->
	<br>
	</div>
	<div id="cpy">
	<p>Copyright © Diseñado, Desarrollado por Inngeniate.com, 2014.Todos los derechos reservados. ORBIOTEC SAS</p>
	</div>
	</div>
<script src ='js/jquery-1.7.2.min.js'></script>
<script src="js/script_login.js"></script>
</body>
</html>