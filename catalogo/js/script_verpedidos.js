$(document).ready(function(){
cargar();

	if(ingr!=0)
	{
		$('.container').find('li').eq(1).html('<a href="cataingreso">Mis Pedidos</a>');
		$('.container').find('li').eq(3).after('<li><a href="libs/logout"> Salir</a></li>');
	}

	var ver = location.search.substr(1);

	function cargar()
	{
		var ver = location.search.substr(1);
		$('#numero-pedido-catalogo h3').html('Pedido N° ('+ver+')')
		$.getJSON('libs/acc_catalogo',{opc:'verpedido',pedido:ver}).done(function(data){
			$('#detalles tbody').empty();
			$.each(data.pedidos,function(i,dat){
				switch (dat.Estado_ped)
				{
					case 'PEN':
					 dat.Estado_ped ='Pendiente';
					break;
					case 'APR':
					 dat.Estado_ped ='Aprobado';
					break;
					case 'APRD':
					 dat.Estado_ped ='Aprobado producción';
					break;
					case 'GE':
					 dat.Estado_ped ='Gestionando Envio';
					break;
					case 'EN':
					 dat.Estado_ped ='Entregado';
					break;
					case 'NE':
					 dat.Estado_ped ='No Entregado';
					break;
					case 'CAN':
					 dat.Estado_ped ='Cancelado';
					break;
					case 'REC':
					 dat.Estado_ped ='Rechazado';
					break;
				}
				if(dat.producto_ped==undefined && dat.factura==undefined && dat.comentario==undefined)
				{
					$('#detalles tbody').append('<tr>'+
													'<td>'+dat.Id_ped+'</td>'+
													'<td>'+
														'<ul id="productos">'+
														'</ul>'+
													'</td>'+
													'<td>'+dat.Estado_ped+'</td>'+
													'<td id="factura-catalogo-verpedido"></td>'+
												'</tr>');
				}
				else if(dat.factura==undefined && dat.comentario==undefined)
				{
					$('#productos').append('<li><strong>'+dat.cantidad_ped+'</strong>'+dat.producto_ped+'</li>');
					$('#factura-catalogo-verpedido').html('<a href="javascript:void(0)">Sin Factura</a>');
				}
				else if(dat.comentario==undefined)
				{
					if(dat.factura!='')
						$('#factura-catalogo-verpedido').html('<a href="'+dat.factura+'" target="_blank" style="background:#335567;">Ver Factura</a>');

				}
				else
				{
					$('#comentarios tbody').append('<tr>'+
												'<td class="caja-tamano-avatar">'+dat.usuario+'</td>'+
												'<td><p>'+dat.comentario+'</p></td>'+
												'<td><p>'+dat.fecha+'</p></td>'+
											'</tr>');
				}
			})
		})
	}


	compcarga = setInterval(function(){
					if($('#detalles tbody tr').length>0)
					{
						var tped=0;
						$.each($('#detalles tbody tr'),function(i,dat){
							tped = tped+1;
						})
						clearInterval(compcarga);
						$('#superior-catalogo a').html(' Pedidos: '+tped);
					}
				},100);

	$('#enviar').on('click',function(){
		if($('#coment').val()!='')
		{
			$.post('libs/acc_catalogo',{comentario:$('#coment').val(),opc:'comentario',pedido:ver}).done(function(data){
				$('#coment').val('');
				cargar();
			})
		}
	})


});