var $contacto = $("#investiga-oculta"),
	$contenido = $("#investiga-mos"),
	$cerrar = $("#cerrar-contacto"),
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
$('#cerrar-contacto').click( ocultarinvestigacion);