$(document).ready(function(){

	$('.Preguntas-item').on('click',function(){
		mos = $(this).next('.Preguntas-respuesta');
		$.each($('.Preguntas-respuesta'),function(){
			if($(this).hasClass('activ_preg'))
				{
					$(this).removeClass('activ_preg').slideUp();
				}
		})
		if(!mos.is(':visible'))
			mos.addClass('activ_preg').slideToggle();

	})
})