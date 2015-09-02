$(document).ready(function(){
	cargartd();

	// $('#nuevo').on('click',function(){
	// 	$('#crear-articulo').fadeIn();
	// })


	function cargartd()
	{
		$.getJSON('libs/acc_escritos',{opc:'cargart'}).done(function(data){
			$('#listado tbody').empty();
			$.each(data.escrito,function(i,dat){
				$('#listado tbody').append('<tr id="'+dat.id+'">'+
													'<td class="mayus">'+dat.titulo+'</td>'+
													'<td>'+dat.creado+'</td>'+
													'<td><a href="javascript:void(0)" class="edita">Editar</a></td>'+
													'<td><a href="javascript:void(0)" class="borra">Borrar</a></td>'+
												'</tr>');
			})
		})
	}

	$('body').on('click','.borra',function(){
		id =$(this).parent().parent();
		$.post('libs/acc_escritos',{opc:'borrar',id:id.prop('id')});
		id.fadeOut();
	})

	// $('.edita').live('click',function(){
	// 	id =$(this).parent().parent().prop('id');
	// 	$.getJSON('libs/acc_articulos',{opc:'cargaru',id:id}).done(function(data){
	// 		$.each(data.articulo,function(i,dat){
	// 			$('input[name=id]','#edita').val(dat.id);
	// 			$('input[name=nombre]','#edita').val(dat.titulo);
	// 			$('input[name=encabeza]','#edita').val(dat.encabezado);
	// 			$('select[name=tipo]','#edita').val(dat.tipo);
	// 			$('#nx').after($('<textarea id="elm2" name="elm1" style="width:50%"></textarea><br>'));
	// 			$('#elm2').html(dat.contenido)
	// 			tinyMCE.execCommand('mceAddControl', false, 'elm2');
	// 			$('input[name=creador]','#edita').val(dat.autor);
	// 		})
	// 		$('.1').fadeIn();
	// 	})
	// })

	$('#crea').on('submit',function(e){
		e.preventDefault();
		tinyMCE.triggerSave();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);
		// var inputFileImage = document.getElementById('imgart');
		// var file = inputFileImage.files[0];
		var data = new FormData();
		// data.append('archivo',file);
		data.append('opc','crear');
		var otradata = $('#crea').serializeArray();
		$.each(otradata,function(key,input){
       	 	data.append(input.name,input.value);
       	 });
        var url = 'libs/acc_escritos';
        $.ajax({
			url:url,
			type:'POST',
			contentType:false,
			data: data,
			processData:false,
			cache:false,
			dataType: 'json',
			success: function(data){
				if(data=='correcto')
				{
					$('#editar').click();
					$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Escrito Creado</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2000);
			        $(':input', '#crea').not('input[type=submit]').val('');
			         tinyMCE.activeEditor.setContent('');
			        cargartd();
				}
			}
		});
	});

	// $('#edita').on('submit',function(e){
	// 	e.preventDefault();
	// 	tinyMCE.triggerSave();
	// 	$('#fondo').remove();
	// 	$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
	// 	$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
	// 	setTimeout(function() {
 //        	$('#fondo').fadeIn('fast',function(){
 //            $('#rp').fadeIn();
 //         	});
 //        }, 400);
	// 	var inputFileImage = document.getElementById('imgart2');
	// 	var file = inputFileImage.files[0];
	// 	var data = new FormData();
	// 	data.append('archivo',file);
	// 	data.append('opc','editar');
	// 	var otradata = $('#edita').serializeArray();
	// 	$.each(otradata,function(key,input){
 //       	 	data.append(input.name,input.value);
 //       	 });
 //        var url = 'libs/acc_articulos';
 //        $.ajax({
	// 		url:url,
	// 		type:'POST',
	// 		contentType:false,
	// 		data: data,
	// 		processData:false,
	// 		cache:false,
	// 		dataType: 'json',
	// 		success: function(data){
	// 			if(data=='correcto')
	// 			{
	// 				$('#editar').click();
	// 				$('#fondo').remove();
	// 				$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
	// 				$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Articulo Editado</span></div>");
	// 				setTimeout(function() {
	// 		        	$('#fondo').fadeIn('fast',function(){
	// 		            $('#rp').animate({'top':'350px'},50).fadeIn();
	// 		         	});
	// 		        }, 400);
	// 		        setTimeout(function() {
	// 		            $("#rp").fadeOut();
	// 		            $('#fondo').fadeOut('fast');
	// 		        }, 2000);
	// 		        $(':input', '#edita').not('input[type=submit]').val('');
	// 		        $('.1').fadeOut(0);
	// 		        tinyMCE.execCommand('mceRemoveControl', true, 'elm2');
	// 		        $('#elm2').remove();
	// 		        cargartd();
	// 			}
	// 		}
	// 	});
	// });


})