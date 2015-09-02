$(document).ready(function(){

	$('.enlaces a').on('click',function(){
		enlace = $(this);
		$.ajax({
	        url:'libs/acc_escritos.php',
	        data: {opc:'visitas',id:enlace.attr('id')},
	        type: 'POST',
	        dataType:'json',
	        success: function(data){
	        	enlace.next('span').find('strong').html(data.total);
	  		}
	    });
	})


})