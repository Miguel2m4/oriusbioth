<?php
session_start();
if (!isset($_SESSION['catusu']))
 {
 	  echo'<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  	<script type="text/javascript" src="js/script_catalogo.js"></script>
  	<script>ingr=0</script>';
}
  else
  {
  	echo'<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  	<script type="text/javascript" src="js/script_catalogo.js"></script>
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
	</header>
	<section>
		<div class="tooper"></div>
		<div id="product-catalogo">
			<h2>Productos</h2>
		</div>

		<div id="invent-catalogo">
			<h2><img src="images/carrito.png"> Catalogo de Productos</h2>
			<table id="tabla-centrado">
			<tr>
				<td>
					<table class="pedido" cellspacing="0">
						<thead>
							<tr><th colspan="3"><strong>Pedido</strong></th>
							</tr>
						</thead>
					</table>
					<h3>Comentarios</h3>
					<textarea id="comentarios" placeholder="Ingrese aqui los comentarios de su orden" cols="30" rows="3" required=""></textarea>
				</td>
			</tr>
			<tr>
				<td style="text-align:left">
					<button class="submit" type="button" id="enviar">Terminar Pedido</button>
				</td>
			</tr>
			</table>
		</div>
	</section>
</body>
</html>