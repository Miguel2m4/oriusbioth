var $investiga = $("#investiga-oculta"),
	$contenido = $("#investiga-mos"),
	$cerrar = $("#ocultarinves"),
	$button = $(".mostrar-con");

	function mostrarinvestigacion(){
		$investiga.slideToggle();
		$contenido.slideToggle();
		$('#listado').empty();
		if(!$('#carga').is(':visible'))
			$('#carga').fadeIn();
		return false;
	}

	function ocultarinvestigacion(){
		mostrarinvestigacion();
	}

//Eventos
$button.on('click',function(){
	mostrarinvestigacion();
	$("html, body").animate({ scrollTop: $('#scrinfo').offset({top:$('header').height()})}, 500);
	nomcult = $(this).find('p').eq(0).text();
	cult = $(this).attr('id');
	$('#cultivo').html(nomcult);
	$.getJSON('libs/acc_investigacion',{opc:'cinvestiga',cultivo:cult}).done(function(data){
		$('#carga').fadeOut();
		if(data.investigaciones != '')
		{
			$.each(data.investigaciones,function(i,dat){
				$('#listado').append('<div class="item-investiga">'+
										'<p>'+dat.Nombre_in+'</p>'+
										'<p><a href="'+dat.Archivo_in.replace('.','')+'" target="_blank"><span class="icon-file-pdf"></span>  Descargar</a></p>'+
									'</div>')
			})
		}
		else
		{
			$('#listado').append('<div class="item-investiga">'+
										'<p>No se han encontrado investigaciones relacionadas</p>'+
									'</div>')
		}
		setTimeout(function(){
			$('#listado').fadeIn('slow');
		},500)

	})
});

$cerrar.click(mostrarinvestigacion);

