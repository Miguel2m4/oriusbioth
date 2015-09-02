<?php
session_start();
if (!isset($_SESSION['usulog'])) {
  header('Location: adminorius');
}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Administrador Orius Biotech</title>
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" href="css/msj.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
		    tinymce.init({
		        selector: "textarea",
		        language: "es_MX",
		        menubar : false,
		        // menubar: "edit insert format",
		        plugins: "link image",
		        plugins: [
				    "advlist autolink lists link image charmap print preview anchor",
				    "searchreplace visualblocks code fullscreen",
				    "insertdatetime media table contextmenu paste jbimages"
				  ],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
				relative_urls: false,
		        init_instance_callback : function() { tinyMCE.activeEditor.setContent('');}

		    });
		</script>
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

			<div class="contenido-admin">

			<div class="invest">
				<h2>Escritos Técnicos</h2>

				<div class="item-inves">
					<a href="javascript:void(0)">
						<p><span id="m-crea" >Crear Nuevo Escrito</span></p>
					</a>
				</div>
				<div id="lista">
					<form id="crea">
						<input type="text" placeholder="Titulo del Articulo" name="nombre" maxlength="63" required><br><br>
						<textarea id="elm1" name="elm1" style="width:50%" ></textarea><br>
						<input id="inicia" class="btninicio" type="submit" value="Guardar">
					</form>
				</div>

				<div class="listar-inves administrar">
					<h2>Administrar Escritos</h2>

					<div class="mostrar-inves">
						<table id="listado">
							<thead>
								<tr>
								<td>Nombre del escrito</td>
								<td>Fecha de creación</td>
								<td>Acción</td>
								<td>Acción</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			</div>

		</div>

		<script src="js/classie.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script src="js/script_escritos.js"></script>
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
				if($(this).html()=='Menu')
					$(this).html('Ocultar');
				else
					$(this).html('Menu');
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
