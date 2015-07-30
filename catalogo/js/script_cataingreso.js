$(document).ready(function(){

	if(ingr!=0)
	{
		$('.container').find('li').eq(1).html('<a href="index">Catalogo</a>');
		$('.container').find('li').eq(3).after('<li><a href="libs/logout"> Salir</a></li>');
	}

	var nuevo = location.search.substr(1);
	if(nuevo=='new')
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
           location.replace("cataingreso");
        }, 2000);

	}

	compcarga = setInterval(function(){
					if($('#pedidos tbody tr').length>0)
					{
						var tped=0;
						$.each($('#pedidos tbody tr'),function(i,dat){
							tped = tped+1;
						})
						clearInterval(compcarga);
						$('#superior-catalogo a').html(' Pedidos: '+tped);
					}
				},100);

	$.getJSON('libs/acc_catalogo',{opc:'lpedidos'}).done(function(data){
		$('#pedidos tbody').empty();
		cont=data.pedidos.length;
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
			if(dat.transp_ped!=undefined)
				transp = dat.transp_ped;
			else
				transp = '';
			if(dat.ticket_trans!=undefined)
				ticket = dat.ticket_trans;
			else
				ticket = '';
			$('#pedidos tbody').append('<tr>'+
										'<td>'+cont+'</td>'+
										'<td>'+dat.Id_ped+'</td>'+
										'<td>'+transp+'</td>'+
										'<td>'+ticket+'</td>'+
										'<td><strong>'+dat.Fecha_ped+'</strong></td>'+
										'<td>'+dat.Estado_ped+'</td>'+
										'<td><a href="verpedidos?'+dat.Id_ped+'"> Ver </a></td>'+
									'</tr>');
			cont--;
		})
	})

	$('#filtrar').on('submit',function(e){
		e.preventDefault();
		data = $(this).serializeArray();
		data.push({name:'opc',value:'filtrar'});
		$.getJSON('libs/acc_catalogo',data).done(function(data){
			$('#pedidos tbody').empty();
			cont=data.pedidos.length;
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
				if(dat.transp_ped!=undefined)
				transp = dat.transp_ped;
				else
					transp = '';
				if(dat.ticket_trans!=undefined)
					ticket = dat.ticket_trans;
				else
					ticket = '';
				$('#pedidos tbody').append('<tr>'+
											'<td>'+cont+'</td>'+
											'<td>'+dat.Id_ped+'</td>'+
											'<td>'+transp+'</td>'+
											'<td>'+ticket+'</td>'+
											'<td><strong>'+dat.Fecha_ped+'</strong></td>'+
											'<td>'+dat.Estado_ped+'</td>'+
											'<td><a href="verpedidos?'+dat.Id_ped+'"> Ver </a></td>'+
										'</tr>');
				cont--;
			})
		})
	})

});