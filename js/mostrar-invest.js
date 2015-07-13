var $contacto = $("#investiga-oculta"),
	$contenido = $("#investiga-mos"),
	$cerrar = $("#ocultarinves"),
	$button = $("#mostrar-con").first();


	function mostrarinvestigacion(){
	$contacto.slideToggle();
	$contenido.slideToggle();

	return false;
}

	function ocultarinvestigacion(){
	mostrarinvestigacion();
}

//Eventos
$button.click( mostrarinvestigacion);
$cerrar.click(mostrarinvestigacion);