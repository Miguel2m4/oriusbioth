$(document).ready(function(){
	cultivos();

	$('#m-crea').on('click',function(){
		$('#gurdar-oculto').fadeToggle(400);
	})

	$('#crear').on('submit',function(e){
		e.preventDefault();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);
        data = $(this).serializeArray();
        data.push({'name':'opc','value':'ncultivo'});
        $.post('libs/acc_investigacion.php',data).done(function(data){
        	if(data == 'correcto')
        	{
        		$('#fondo').remove();
				$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
				$('#fondo').append("<div class='caja' style='display: none; text-align: center' id='rp'><span>Correcto!</span></div>");
				setTimeout(function() {
		        	$('#fondo').fadeIn('fast',function(){
		            $('#rp').animate({'top':'350px'},50).fadeIn();
		         	});
		        }, 400);
		        setTimeout(function() {
		            $("#rp").fadeOut();
		            $('#fondo').fadeOut('fast');
		        }, 2500);
		        $('[name=nombre]').val('');
		        $('#gurdar-oculto').fadeToggle(400);
		        cultivos();
        	}
        })
	})

	function cultivos()
	{
		$.getJSON('libs/acc_investigacion',{opc:'listar'}).done(function(data){
			$('#lista').empty();
			$.each(data.investigaciones,function(i,dat){
				$('#lista').append('<div class="item-inves ver">'+
										'<h2><span id="'+dat.Id_cu+'">'+dat.Nombre_cu+'</span>  <a href ="javascript:void(0)" class="tooltip edita" title="Editar"><span class="icon-pencil"></span></a></h2>'+
										'<p>Archivos: '+dat.total+'</p>'+
									'</div>');
			})
		})
	}

	$('body').on('click','.ver',function(){
		cult = $(this).find('span').eq(0).text();
		idcult = $(this).find('span').eq(0).attr('id');
		$('.administrar').fadeIn();
		$('#cultivo').html(cult);
		$('#listado tbody').empty();
		investigaciones();
	})

	function investigaciones()
	{
		$.getJSON('libs/acc_investigacion',{opc:'cargar',cultivo:idcult}).done(function(data){
			$('#listado tbody').empty();
			$.each(data.investigaciones,function(i,dat){
				$('#listado tbody').append('<tr>'+
											'<td><p>'+dat.Nombre_in+'</p></td>'+
											'<td><a href="javascript:void(0)" class="borrar" id="'+dat.Id_in+'">Borrar</a></td>'+
										'</tr>');
			})
		})
	}

	$('body').on('click','.borrar',function(){
		$(this).closest('tr').fadeOut();
		$.post('libs/acc_investigacion',{opc:'binvestiga',cultivo:$(this).attr('id')});
	})

	$('#crear2').on('submit',function(e){
		e.preventDefault();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);
		var data = new FormData();
		data.append( 'action','libs/acc_investigacion.php');
		adjunto = document.getElementById('adjunto');
		adjunto = adjunto.files[0];
		data.append('archivo',adjunto);
        otradata = $("#crear2").serializeArray();
        otradata.push({'name':'cultivo','value':idcult});
        $.each(otradata,function(key,input){
    	    data.append(input.name,input.value);
    	});
    	data.append('opc','ninvestiga');
    	$.ajax({
	        url:'libs/acc_investigacion.php',
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        type: 'POST',
	        dataType:'json',
	        success: function(data){
		        if(data.status == 'correcto')
		        {
		        	$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='caja' style='display: none; text-align: center' id='rp'><span>Correcto!</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2500);
			        $('input','#crear2').not('[type=submit]').val('');
			        cultivos();
			        investigaciones();
			    }
			    else
			    	if(data.status == 'error')
			    	{
			    		$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='caja' style='display: none; text-align: center' id='rp'><span>Error!</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
			    	}
	  		}
	    });
	})

})