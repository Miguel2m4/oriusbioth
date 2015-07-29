$(document).ready(function(){

	cargar();

	if(ingr!=0)
	{

		$('.container').find('li').eq(1).html('<a href="cataingreso">Mis Pedidos</a>');
		// $('.container').find('li').eq(2).html('<a href="libs/logout"> Salir</a>');
	}

	function cargar()
	{
		$.getJSON('libs/acc_catalogo',{opc:'cargar'}).done(function(data){
			$.each(data.producto,function(i,dat){
				if(dat.nombre_item!=undefined)
				{
					$('#product-catalogo').append('<table class="producto-pedido" cellspacing="0">'+
														'<tr>'+
															'<th id="titulo-producto" colspan="2"><h4>'+dat.nombre_item+'</h4></th>'+
														'</tr>'+
														'<tr>'+
															'<td id="producto-imagen" class="'+dat.Id_item+'"></td>'+
															'<td id="'+dat.Id_item+'">'+
															'</td>'+
														'</tr>'+
													'</table>');
				}
				else if(dat.nombre_pr!=undefined)
				{
					$('#'+dat.Id_item).append('<div class="item-sub" >'+
												'<div class="item-producto"><strong>'+dat.nombre_pr+'</strong>'+
													'<p>'+dat.detalle_pr+'</p></div>'+
												'<div class="cant-producto">'+
													'<input type="number"  placeholder="Cant"><a href="javascript:void(0)" class="boton-pedir">Pedir</a>'+
												'</div>'+
											'<hr class="divi1">'+
											'</div>');
				}
				else if(dat.imagen_pr!=undefined)
				{
					$('#'+dat.Id_img).prev().append('<img src="'+dat.imagen_pr+'">');
				}
			});
		})
	}
	var productos = new Array(),cantidades = new Array();

	$('.boton-pedir').live('click',function(){
		cant = $(this).prev().val();
		exist=0;
		if(cant!='' && cant!=0)
		{
			prod = $(this).closest('div').prev().find('strong').text();
			// productos.push(prod);
			// cantidades.push(cant);
			$.each($('.pedido tbody tr'),function(){
				if($(this).find('td').eq(0).text()==prod)
				{
					antval = $(this).find('td').eq(1).text().split(' ');
					ncant = parseInt(antval[0])+parseInt(cant);
					$(this).find('td').eq(1).html('<h3>'+ncant+' Und(s)</h3>');
					exist=1;
				}
			})
			if(exist!=1)
			{
				$('.pedido').append('<tr>'+
							'<td><h3>'+prod+'</h3></td>'+
							'<td><h3>'+cant+' Und(s)</h3></td>'+
							'<td><a href="javascript:void(0)" class="retirar"><img src="images/papelera.png" ></a></td>'+
							'</tr>');
				exist=0;
			}

			$(this).prev().val('');
		}
	});

	$('.retirar').live('click',function(){
		$(this).closest('tr').fadeOut(10);
		$(this).closest('tr').remove();
	})

	$('#enviar').on('click',function(){
		if(ingr!=0)
		{
			if($('.pedido tbody').length>0)
			{
				$.each($('.pedido tbody tr'),function(i,dat){
					prod = $(this).find('td').eq(0).text();
					cant = $(this).find('td').eq(1).text();
					productos.push(prod);
					cantidades.push(cant);
				})

				$form=$('<form id="pedir" style="display:none"></form>');
				for(i=0;i<productos.length;i++)
				{
					$form.append('<input type=text name="producto[]" value="'+productos[i]+'">'+
									'<input type=text name="cantidad[]" value="'+cantidades[i]+'">');
				}
				$form.append('<input type=text name="comentario" value="'+$('#comentarios').val()+'">');
				$('body').append($form);
				setTimeout(function(){
					$('#pedir').submit();
				},200);
			}
		}
		else
		{
	    	$('#fondo').remove();
			$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
			$('#fondo').append("<div class='rp' style='display: none; text-align: center; background: rgb(238, 92, 92)' id='rp'><span>Debes iniciar sesión para realizar un pedido</span></div>");
			setTimeout(function() {
	        	$('#fondo').fadeIn('fast',function(){
	            $('#rp').animate({'top':'350px'},50).fadeIn();
	         	});
	        }, 400);
	        setTimeout(function() {
	            $("#rp").fadeOut();
	            $('#fondo').fadeOut('fast');
	            $.each($('.pedido tbody tr'),function(i,dat){
					prod = $(this).find('td').eq(0).text();
					cant = $(this).find('td').eq(1).text();
					productos.push(prod);
					cantidades.push(cant);
				})
	            $form=$('<form action="login.php" method="POST"></form>');
	            for(i=0;i<productos.length;i++)
	            {
	            	$form.append('<input type="hidden" name="produc[]" value="'+productos[i]+'">'+
	            		'<input type="hidden" name="cantidad[]" value="'+cantidades[i]+'">');
	            	if($('#comentarios').val()!='')
	            		$form.append('<input type=text name="comentario" value="'+$('#comentarios').val()+'">');
	            	$form.appendTo('body').submit();
	            }
	            // location.href ='login.php';
	        }, 3000);

		}
	});

	$('#pedir').live('submit',function(e){
		e.preventDefault();
		data = $(this).serializeArray();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='../images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
    	}, 400);
		data.push({name:'opc',value:'npedido'});
		$.post('libs/acc_catalogo',data).done(function(data){
			if(data=='correcto')
			{
				$('#fondo').remove();
				$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
				$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><b>Pedido Realizado</b></div>");
				setTimeout(function() {
		        	$('#fondo').fadeIn('fast',function(){
		            $('#rp').animate({'top':'350px'},50).fadeIn();
		         	});
		        }, 400);
		        setTimeout(function() {
		            $("#rp").fadeOut();
		            $('#fondo').fadeOut('fast');
		        }, 2000);
		        $('#pedir').remove();
		        $('.pedido tbody').empty();
		        $('input, textarea').val('');
		        productos = [],cantidades = [];
		    }
		})
	});
});