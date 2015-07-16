<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Administrador Orius Biotech</title>
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body class="cbp-spmenu-push">
	<?php include("menu-vertical.php"); ?>
			<div class="main">
			<section class="">
					<button id="showLeftPush">Menu</button>
			</section>
				<section class="oculto">
					<h2>Slide Menus</h2>
					<!-- Class "cbp-spmenu-open" gets applied to menu -->
					<button id="showLeft">Show/Hide Left Slide Menu</button>
					<button id="showRight">Show/Hide Right Slide Menu</button>
					<button id="showTop">Show/Hide Top Slide Menu</button>
					<button id="showBottom">Show/Hide Bottom Slide Menu</button>
				</section>				
			</div>

		<div class="container">

			<!-- <header class="clearfix">
				<span>Administrador</span>
				<h1>ORIUS BIOTECH</h1>
			
			</header> -->
			<div class="contenido-admin">
			
			<div class="invest">
			<h2>Resultados de Investigación Aplicada</h2>

			<div class="item-inves">			
			<h2>Nueva Investigación</h2>
			<a href="#">
			<p><span>Crear</span></p>
			</a>
			<div id="gurdar-oculto">
			<form>
				<input type="text" placeholder="Nombre del Cultivo" required>
				<input type="submit" value="Guardar">
			</form>	
			</div>		
			</div>

			<div class="item-inves">
			<a href="">
			<h2>Abono organico <a href ="#" class="tooltip" title="Editar"><span class="icon-pencil"></span></a></h2>
			<p>Archivos: 2</p>
			</a>				
			</div>

			<div class="item-inves">
			<a href="">
			<h2>Abono organico <a href ="#" class="tooltip" title="Editar"><span class="icon-pencil"></span></a></h2>
			<p>Archivos: 2</p>
			</a>				
			</div>

			<div class="item-inves">
			<a href="">
			<h2>Abono organico <a href ="#" class="tooltip" title="Editar"><span class="icon-pencil"></span></a></h2>
			<p>Archivos: 2</p>
			</a>				
			</div>

			<div class="item-inves">
			<a href="">
			<h2>Abono organico <a href ="#" class="tooltip" title="Editar"><span class="icon-pencil"></span></a></h2>
			<p>Archivos: 2</p>
			</a>				
			</div>

				

			<div class="listar-inves">
			<h2>Administrar investigaciones</h2>

			<div class="guardar-inves">
			<h2>Abono Organico</h2>
				<form>
					<input type="text" placeholder="Nombre" required>
					<input type="file" required>
					<input type="submit" value="Guardar">
				</form>
			</div>	

			<div class="mostrar-inves">
			<table>
				<tbody>
					<tr>
						<td><p>Eficacia de DIGESTOR en Raquis de Palma para producir Abono Orgánico en Hda La Cabaña, Meta,Colombia</p></td>
						<td><a href="">Borrar</a></td>
					</tr>
					<tr>
						<td><p>Eficacia de DIGESTOR en Raquis de Palma para producir Abono Orgánico en Hda La Cabaña, Meta,Colombia</p></td>
						<td><a href="">Borrar</a></td>
					</tr>
					<tr>
						<td><p>Eficacia de DIGESTOR en Raquis de Palma para producir Abono Orgánico en Hda La Cabaña, Meta,Colombia</p></td>
						<td><a href="">Borrar</a></td>
					</tr>
				</tbody>
			</table>




				
			</div>

			

			</div>
			</div>

			</div>

		</div>
		<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				menuTop = document.getElementById( 'cbp-spmenu-s3' ),
				menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
				showLeft = document.getElementById( 'showLeft' ),
				showRight = document.getElementById( 'showRight' ),
				showTop = document.getElementById( 'showTop' ),
				showBottom = document.getElementById( 'showBottom' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeft' );
			};
			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			};
			showTop.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuTop, 'cbp-spmenu-open' );
				disableOther( 'showTop' );
			};
			showBottom.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuBottom, 'cbp-spmenu-open' );
				disableOther( 'showBottom' );
			};
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			showRightPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toleft' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRightPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
				if( button !== 'showTop' ) {
					classie.toggle( showTop, 'disabled' );
				}
				if( button !== 'showBottom' ) {
					classie.toggle( showBottom, 'disabled' );
				}
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
				if( button !== 'showRightPush' ) {
					classie.toggle( showRightPush, 'disabled' );
				}
			}
		</script>
	</body>
</html>
