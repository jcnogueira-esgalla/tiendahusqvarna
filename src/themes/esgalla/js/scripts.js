jQuery(document).ready(function() {


	// Nav classes on scroll
	jQuery(window).scroll(function () {
		var topbarHeight = jQuery('.topbar').outerHeight();
		if (jQuery(this).scrollTop() > topbarHeight) {
			jQuery('body').addClass('scrolled');
		} else {
			jQuery('body').removeClass('scrolled');
		}
	});


	jQuery('.dropdown-header.h6, .dropdown-header.h6 span').click(function(e) {
		e.preventDefault();
	});


	// jQuery(document).on('facetwp-loaded', function() {
	// 	// jQuery('html, body').animate({ scrollTop: 0 }, 500);
	// 	jQuery('html, body').animate({
	// 		scrollTop: jQuery(".products").offset().top - 120
	// 	}, 500);
	// });

	jQuery(document).on('facetwp-loaded', function() {
		jQuery('.navigation.pagination a').each(function() {
			let href = jQuery(this).attr('href');
			jQuery(this).attr('href', href.split('?')[0]);
		});
		
    if ('' == FWP.build_query_string()) {
      //La primera vez que carga
			//No hacemos nada
			// console.log('restart filters');
			// FWP.reset();
			
    } else {
			//Cuando aplicamos algún filtro ya hacemos el scroll
			jQuery('html, body').animate({
				scrollTop: jQuery(".products").offset().top - 120
			}, 500);


		}
  });



	/** Transparencia en el body al desplegar menú */

	 jQuery('#navbarSupportedContent').on('show.bs.collapse', function () {

      // do something…

      jQuery('html').addClass('overlayed');

    });

    jQuery('#navbarSupportedContent').on('hide.bs.collapse', function () {

      // do something…

      jQuery('html').removeClass('overlayed');

    });

    jQuery('.menu-overlay').click(function() {

      jQuery('.navbar.mobile .navbar-toggler').click();

    });





	/***

	*

	* Carrusel de productos

	*

	*/

	if(jQuery('.slick-productos')) {



	    jQuery('.slick-productos').slick({

		    slidesToShow: 4,

		    slidesToScroll: 4,

		    arrows: true,

		    dots: true,

		    prevArrow: "<i class=\"fas fa-angle-left prev\"></i>",

		    nextArrow: "<i class=\"fas fa-angle-right next\"></i>",

		    responsive: [

		        {

		          breakpoint: 1200,

		          settings: {

		            slidesToShow: 3

		          }

		        },

		        {

		          breakpoint: 992,

		          settings: {

		            slidesToShow: 2

		          }

		        },

		        {

		          breakpoint: 576,

		          settings: {

		            slidesToShow: 1,

		            slidesToScroll: 1,

		            dots: false

		          }

		        }

		      ]

		});

	 }

	 /***

	*

	* Carrusel vertical de accesorios

	*

	*/

	if(jQuery('.slick-accesorios')) {



	    jQuery('.slick-accesorios').slick({

		    slidesToShow: 3,

		    slidesToScroll: 2,

		    vertical: true,

		    arrows: true,

		    infinite: false,

		    dots: false,

		    prevArrow: "<i class=\"fas fa-angle-up prev\"></i>",

		    nextArrow: "<i class=\"fas fa-angle-down next\"></i>",

		    verticalSwiping: true,

		    responsive: [

		        {

		          breakpoint: 1200,

		          settings: {

		            slidesToShow: 3

		          }

		        },

		        {

		          breakpoint: 992,

		          settings: {

		            slidesToShow: 2

		          }

		        },

		        {

		          breakpoint: 576,

		          settings: {

		            slidesToShow: 1,

		            slidesToScroll: 1,

		            vertical: false,

		          }

		        }

		      ]

		});

	 }



	 const sliderAccesorios = jQuery(".slick-accesorios");

	 //Implementing navigation of slides using mouse scroll

	sliderAccesorios.on('wheel', (function(e) {



	  e.preventDefault();

	  if (e.originalEvent.deltaY > 0) {

	    jQuery(this).slick('slickNext');

	  } else {

	    jQuery(this).slick('slickPrev');

	  }

	}));

	  /***

	*

	* Carrusel vertical de accesorios mobile

	*

	*/

	if(jQuery('.slick-accesorios-mov')) {



	    jQuery('.slick-accesorios-mov').slick({

		    slidesToShow: 1,

		    slidesToScroll: 21,

		    vertical: false,

		    arrows: true,

		    infinite: false,

		    dots: false,

		    prevArrow: "<i class=\"fas fa-angle-left prev\"></i>",

		    nextArrow: "<i class=\"fas fa-angle-right next\"></i>",

		    responsive: [

		        {

		          breakpoint: 992,

		          settings: {

		            slidesToShow: 1,

		            slidesToScroll: 1

		          }

		        },

		        {

		          breakpoint: 576,

		          settings: {

		            slidesToShow: 1,

		            slidesToScroll: 1,

		            vertical: false,

		          }

		        }

		      ]

		});

	 }

 	//slider de categorías

	if(jQuery('.slick-categorias')) {



	    jQuery('.slick-categorias').slick({

		    slidesToShow: 3,

		    slidesToScroll: 3,

		    arrows: true,

		    dots: true,

		    prevArrow: "<i class=\"fas fa-angle-left prev\"></i>",

		    nextArrow: "<i class=\"fas fa-angle-right next\"></i>",

		    responsive: [

		        {

		          breakpoint: 1200,

		          settings: {

		            slidesToShow: 2

		          }

		        },

		        {

		          breakpoint: 768,

		          settings: {

		            slidesToShow: 1
,
						dots: false,
						slidesToScroll: 1,
		          }

		        }

		      ]

		});

	 }

	 jQuery(".fake-a").bind('click', function(e) {
        if (e.ctrlKey){
          window.open(jQuery(this).find("a").attr("href"),'_blank');
        } else {
            window.location = jQuery(this).find("a").attr("href"); 
        }
     });



	 //Slider de noticias blog

	 if(jQuery('.slick-noticias')) {



	    jQuery('.slick-noticias').slick({

		    slidesToShow: 4,

		    slidesToScroll: 3,

		    arrows: true,

		    dots: false,

		    prevArrow: "<i class=\"fas fa-angle-left prev\"></i>",

		    nextArrow: "<i class=\"fas fa-angle-right next\"></i>",

		    responsive: [

		        {

		          breakpoint: 1200,

		          settings: {

		            slidesToShow: 3

		          }

		        },

		        {

		          breakpoint: 992,

		          settings: {

		            slidesToShow: 2

		          }

		        },

		        {

		          breakpoint: 768,

		          settings: {

		            slidesToShow: 1

		          }

		        }

		      ]

		});

	 }

	 if(jQuery('#carousel-opiniones')) {

		jQuery('#carousel-opiniones').slick({
			slidesPerRow: 2,
			rows: 3,
			arrows: false,
			dots: true,
			infinite: true,

			responsive: [
		        {
		          breakpoint: 992,
		          settings: {
					slidesPerRow:1,
					rows: 4,
		          }
		        },
		      ]
		});
	}


	if(jQuery('#carousel-opiniones-producto')) {

		jQuery('#carousel-opiniones-producto').slick({
			slidesPerRow: 1,
			rows: 1,
			arrows: true,
			dots: false,
			infinite: true,
			prevArrow: "<i class=\"fas fa-angle-left prev\"></i>",
		    nextArrow: "<i class=\"fas fa-angle-right next\"></i>",

			responsive: [
		        {
				  breakpoint: 992,
		          settings: {
					arrows: false,
					dots: true,
		          }

		        },
		      ]
		});
	}

})



