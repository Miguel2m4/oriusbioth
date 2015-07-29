$(document).ready(function(){

	$("#logueo").submit(function(e){
		e.preventDefault();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='../images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);

		data = $(this).serializeArray();
		$.ajax({
			data: data,
			type: 'POST',
			dataType: 'json',
			url: 'libs/logueo.php',
			success: function(data)
			{
				if(data == 'error')
					{
		    			$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='caja' style='display: none; text-align: center; background: rgb(238, 92, 92)' id='rp'><span>El usuario y/o contraseña no son correctos</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2000);
					}
				else
					{
		    			$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='caja' style='display: none; text-align: center;' id='rp'><span>Ingresando. . . </span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2000);
				        if(($('#tempped').is(':empty'))==false)
				        {
					        ndata = $('#tempped').serializeArray();
					        ndata.push({name:'opc',value:'npedido'});
						    $.post('libs/acc_catalogo',ndata);
							setTimeout(function() {
							window.location.href = data['redirec']+'?new';
							}, 2500);
						}
						else
							setTimeout(function() {
							window.location.href = data['redirec'];
							}, 2500);
					}
			}
		});
	});

});