$(document).ready(function(){

	if(ingr!=0)
	{
		$('.container').find('li').eq(1).html('<a href="cataingreso">Mis Pedidos</a>');
		$('.container').find('li').eq(3).after('<li><a href="libs/logout"> Salir</a></li>');
	}

		// comprobar pass
	$('.contra1').live('blur',function(){
		if($(this).val()!='')
		{
			$.post('libs/acc_catalogo',{opc:'comprobar',pass:$(this).val()}).done(function(data){
				if(data=='error')
				{
					$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='rp' style='display: none; text-align: center; background: rgb(238, 92, 92)' id='rp'><span>La contraseña anterior es incorrecta</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2000);
			        $('.contra1').css('background','rgba(253, 0, 0, 0.22)');
			        pas= 0;
				}
				else
				{
					$('.contra1').removeAttr('style');
					pas = 1;
				}
			});
		}
		else
			$('.contra1').removeAttr('style');
	});

	// guardar pass
	$('#edita-pass').live('submit',function(e){
		e.preventDefault();
		if(pas==1)
		{
			data=$(this).serializeArray();
			$('#fondo').remove();
			$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
			$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='../images/esperar.gif'></div>");
			setTimeout(function() {
	        	$('#fondo').fadeIn('fast',function(){
	            $('#rp').fadeIn();
	         	});
		    }, 400);
		    data.push({name:'opc',value:'editpass'});
			$.post('libs/acc_catalogo',data).done(function(data){
				if(data == 'correcto')
				{
					$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Contraseña editada</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2000);
			        $('#edita-pass input').val('');
				}
			});
		}
	});

});