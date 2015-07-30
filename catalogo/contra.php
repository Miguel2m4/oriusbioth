<?php
session_start();
if (!isset($_SESSION['catusu']))
	 header('Location: index');
else
  {
  	echo'<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  	<script type="text/javascript" src="js/script_catacontra.js"></script>
  	<script>ingr=1</script>';
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width , initial-scale=1 ,maximum-scale=1 user-scalable=no" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<title>Catalogo de Productos | Orius Biotech</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="../css/style-menu.css">
<link rel="stylesheet" href="../css/msj.css" />
</head>
<body >
	<header>
		<div class="distribuidores">
			<div class="distri-bandera">
				<img src="../images/bdcolombia.png">
				<a href="#">Colombia</a>
			</div>
			<div class="distri-bandera">
				<img src="../images/bdchile.png">
				<a href="#">Chile</a>
			</div>
			<div class="distri-bandera">
				<img src="../images/bdcosta.png">
				<a href="#">Costa Rica</a>
			</div>
			<div class="distri-bandera">
				<img src="../images/bdecuador.png">
				<a href="#">Ecuador</a>
			</div>
			<div class="distri-bandera">
				<img src="../images/bdpanama.png">
				<a href="#">Panamá</a>
			</div>
			<div class="distri-bandera">
				<img src="../images/bdperu.png">
				<a href="#">Perú</a>
			</div>
		</div>
		<div class="distribuidores2">
			<ul>
				<li><a href="">Colombia</a></li>
				<li><a href="">Chile</a></li>
				<li><a href="">Costa Rica</a></li>
				<li><a href="">Ecuador</a></li>
				<li><a href="">Perú</a></li>
			</ul>
		</div>
		<div class="top">
			<div class="top-izq">
			<a href="/"><img src="images/logo.png"></a>
			</div>
			<div class="top-der">
			<?php include("menu.php"); ?>
			<script type="text/javascript" src="../js/script-menu.js"></script>
			</div>

		</div>
	</div>
	</header>
	<section>
		<div class="tooper"></div>
		<div id="catalogo-centrado">
			<div id="usuaior-catalogo-nombre">
				<h2>Nombre: <?php echo$_SESSION['catusu'];?></h2>
			</div>
			<div id="superior-catalogo">
				<img src="images/camion.png"><a href=""></a>
		</div>
			<div class="tabla-catalogo-usuarios">
				<div id="contener-contra">
					<form id="edita-pass">
						<p>Ingrese la contraseña anterior y luego por la que desea modificar</p>
						<input type="text" class="contra1"  placeholder="Antigua Contraseña"><br>
						<input type="text" class="contra2" name="pass" placeholder="Nueva Contraseña" ><br>
						<button class="submit" type="submit">Modificar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>