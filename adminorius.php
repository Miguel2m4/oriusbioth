<?php
session_start();
if (isset($_SESSION['usulog'])) {
  header('Location: adminhome');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width , initial-scale=1 ,maximum-scale=1 user-scalable=no" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
<meta name="keywords" lang="es" content="">
<meta name="robots" content="All">
<meta name="description" lang="es" content="">
<title>Administrador | Orius Biotech | Soluciones para la producción agropecuaria sostenible</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/stylesheet.css" />
<link rel="stylesheet" href="css/owl.carousel.css" />
<link rel="stylesheet" href="css/msj.css" />
<link rel="stylesheet" type="text/css" href="css/style-menu.css">
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
</head>
<body>
<header>
<div class="top">
	<div class="top-izq">
	<a href="/"><img src="images/logo.png"></a>
	</div>
	<div class="top-der">
	<?php include("menu.php"); ?>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/script-menu.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
</div>
</header>
<section>
	<div class="tooper"></div>
	<div class="mashead">
		<h2>Bienvenido Administrador</h2>
	</div>
	<div class="contenido">
		<div class="login1">
			<div class="login">
				<h2>Iniciar Sesión</h2>
				<form id="logueo">
					<input type="text" placeholder="Usuario" name="usuario" required>
					<input type="password" placeholder="Contraseña" name="password" required>
					<input type="submit" value="Iniciar">
				</form>
			</div>
		</div>
	</div>

	<div class="seccion-contacto">
		<p>Tienen alguna duda acerca de nuestras soluciones?</p><a href="">Contáctenos</a>
	</div>
</section>
<footer>
	<?php include("footer.php"); ?>
</footer>
<script src="js/mostrar-invest.js"></script>
<script src="js/script_login.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</body>
</html>