
var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})

	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".nav").toggle();
	});

	$("body").on('click','.subprod1',function(e){
		e.preventDefault();
		$(".productos").slideToggle();
		$('.minprods1, .minprods2, .minprods3').fadeOut(0);
	})

	$("body").on('click','.subprod2',function(e){
		e.preventDefault();
		$(".productos2").slideToggle();
		$('.Sub-menu-agricola, .Sub-menu-acuicola, .Sub-menu-ambiental').fadeOut(0);
	})

	$("body").on('click','.pr1',function(e){
		e.preventDefault();
		$(".productos").slideToggle();
		tipoprod = $(this).html();
		if(tipoprod == 'Agrícola')
		{
			$('.minprods1').slideToggle();
			$('.minprods2, .minprods3').fadeOut(0);
		}
		if(tipoprod == 'Acuícola')
		{
			$('.minprods2').slideToggle();
			$('.minprods1, .minprods3').fadeOut(0);
		}
		if(tipoprod == 'Ambiental')
		{
			$('.minprods3').slideToggle();
			$('.minprods1, .minprods2').fadeOut(0);
		}
	})

	$("body").on('click','.pr2',function(e){
		e.preventDefault();
		$(".productos2").slideToggle();
		tipoprod2 = $(this).html();
		if(tipoprod2 == 'Agrícola')
		{
			$('.Sub-menu-agricola').slideToggle();
			$('.Sub-menu-acuicola, .Sub-menu-ambiental').fadeOut(0);
		}
		if(tipoprod2 == 'Acuícola')
		{
			$('.Sub-menu-acuicola').slideToggle();
			$('.Sub-menu-agricola, .Sub-menu-ambiental').fadeOut(0);
		}
		if(tipoprod2 == 'Ambiental')
		{
			$('.Sub-menu-ambiental').slideToggle();
			$('.Sub-menu-agricola, .Sub-menu-acuicola').fadeOut(0);
		}
	})


	$('.owl-carousel').owlCarousel({
		margin : 5,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:2
	        },
	        480:{
	            items:3
	        },
	        600:{
         	    items:4
 	        },
 	        800:{
         	    items:6
 	        },
 	        1024:{
         	    items:10
 	        }
	    }
	})


	adjustMenu();

})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 960) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".nav").hide();
		} else {
			$(".nav").show();
		}
		$(".nav li").unbind('mouseenter mouseleave');
		$(".nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
		$(".nav").find('li').eq(0).removeClass('subprod2');
		$('.productos2').fadeOut(0);
		$(".nav").find('li').eq(0).addClass('subprod1');
		$('.Sub-menu-agricola, .Sub-menu-acuicola, .Sub-menu-ambiental').fadeOut(0);
	}
	else if (ww >= 960) {
		$(".toggleMenu").css("display", "none");
		$(".nav").show();
		$(".nav li").removeClass("hover");
		$(".nav li a").unbind('click');
		$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
		$(".nav").find('li').eq(0).removeClass('subprod1');
		$('.productos, .minprods1, .minprods2, .minprods3').fadeOut(0);
		$(".nav").find('li').eq(0).addClass('subprod2');
		$('.productos2').remove();
		$('.top').after('<div class="top productos2" style="display:none">'+
							'<div class="top-der">'+
								'<nav>'+
									'<ul class="nav productos">'+
										'<li><a href="#" class="pr2">Agrícola</a></li>'+
										'<li><a href="#" class="pr2">Acuícola</a></li>'+
										'<li><a href="#" class="pr2">Ambiental</a></li>'+
									'</ul>'+
								'</nav>'+
							'</div>'+
						'</div>');

		if (ww >= 1050) {
			$('.Sub-menu-agricola').removeClass('owl-carousel2')
		}
		else
		{
			$('.Sub-menu-agricola').addClass('owl-carousel2');
			$('.owl-carousel2').owlCarousel({
			    responsiveClass:true,
			    responsive:{
			    	900:{
		         	    items:5
		 	        },
		 	        1024:{
		         	    items:10
		 	        }
			    }
			})
		}
	}

}

