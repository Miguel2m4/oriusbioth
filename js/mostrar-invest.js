var $contacto = $("#investiga-oculta"),
	$contenido = $("#investiga-mos"),
	$cerrar = $("#ocultarinves"),
	$button = $("#mostrar-con"),
	$button2 = $("#mostrar-con2").first();


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
$button2.click( mostrarinvestigacion);
$('#ocultarinves').click( ocultarinvestigacion);