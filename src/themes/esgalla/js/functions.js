//Ajax
//var urlAjax = js_params.ajaxurl;

//Scroll
var scroll_inicial = 0;
var scroll_contador = 0;
var scroll_ga = 1;
var scroll_pos_init = 0;

//Arranque

jQuery(document).ready(function(){

  //Añadimos los enlaces legales a los formularios
  if(jQuery(".gf-legal a").length){
    jQuery(".gf-legal a").each(function (index){

      var link = "";
      if(jQuery(".link-politica-privacidad").attr("href")){//Si el botón está en un menú
          link = jQuery(this).attr("href");
      }else{
          link = jQuery(this).find("a").attr("href");
      }

      jQuery(this).attr("href",link);
      jQuery(this).attr("target","_blank");
    });
  }
  //Añadimos La página a los envíos de formulario
  if(jQuery(".gf-page").length){
    jQuery(".gf-page").each(function (index){
      var $input = jQuery(this).find("input");
      $input.val(document.title);
    });
  }

  //Cookies
  if(!localStorage.getItem("cookies")){
    jQuery('.cookies').css("display", "block");
    jQuery(".cookies-boton").click(function(e) {
        localStorage.setItem("cookies", "activa");
        jQuery('.cookies').slideUp("fast");
        return false;
    });
  }
  //GTM envío confirmación
  jQuery(document).bind('gform_confirmation_loaded', function(event, formId){
    gtm_tipo = "gtm-pageview";
    gtm_pag_pag = '/gracias-page'+window.location.pathname;
    gtm_pag_tit = 'Gracias - '+document.title;
    gtm_pasar();
  });

  //Añadimos los cierres a los desplegables
  if(jQuery(".desplegable-lat").length){
    jQuery(".desplegable-lat").each(function (index){
      var id = jQuery(this).attr("id");
      jQuery(this).append('<a href="javascript:void(0)" class="desplegable-fondo desplegable-plegar" data-obj="#'+id+'"></a>');
      jQuery(this).find(".desplegable-lat-bloque-contain").append('<a href="javascript:void(0)" class="desplegable-plegar btn-cerrar" data-obj="#'+id+'"><span class="fa fa-times" aria-hidden="true"></span></a>');
    });
  }

  if(jQuery(".popup").length){
    jQuery(".popup").each(function (index){
      var id = jQuery(this).attr("id");
      if(!jQuery(this).find("desplegable-fondo").length){
        jQuery(this).find(".popup-bloque").append('<a href="javascript:void(0)" class="desplegable-fondo desplegable-plegar" data-obj="#'+id+'"></a>');
      }
      if(!jQuery(this).find(".btn-cerrar").length){
        jQuery(this).find(".popup-bloque-contain").append('<a href="javascript:void(0)" class="desplegable-plegar btn-cerrar" data-obj="#'+id+'"><span class="fa fa-times" aria-hidden="true"></span></a>');
      }
    });
  }

  //Añadimos el botón para desplegar los submenús verticales
  if(jQuery(".menu-ver .menu-item-has-children").length){

    jQuery(".menu-ver .menu-item-has-children").each(function (index){

      var btn = '<div class="menu-ver-btn"></div>';
      jQuery(this).append(btn);
    });
  }

  //Animaciones Scroll
  scroll_pos_init = jQuery(window).scrollTop() + jQuery(window).height();
  posScroll();
  jQuery(window).scroll(posScroll);

  //Resize
  maquetacion();
  jQuery(window).resize(maquetacion);

  // Cerrar menú on click fuera
  jQuery(document).click(function (event) {
    var click = jQuery(event.target);
    var _open = jQuery(".navbar-collapse").hasClass("show");
    if (_open === true && !click.hasClass("navbar-toggler")) {
      jQuery(".navbar-toggler").click();
    }
  });
});

jQuery(document).on('updated_checkout', function() {
  //Inicializamos popover
  jQuery('[data-toggle="popover"]').popover({html:true});
  jQuery(document).on('show.bs.popover', function() {
    jQuery('.popover').not(this).popover('hide');
  });
});

jQuery(document).on('gform_post_render', function(e,f,p){
  jQuery('.jquery-multiselect select').multiSelect({

    // Custom templates
    'containerHTML': '<div class="multi-select-container">',
    'menuHTML': '<div class="multi-select-menu">',
    'buttonHTML': '<span class="multi-select-button">',
    'menuItemsHTML': '<div class="multi-select-menuitems">',
    'menuItemHTML': '<label class="multi-select-menuitem">',
    'presetsHTML': '<div class="multi-select-presets">',

    // sets some HTML (eg: <div class="multi-select-modal">) to enable the modal overlay.
    'modalHTML': undefined,

    // Active CSS class
    'activeClass': 'multi-select-container--open',

    // Text to show when no option is selected
    'noneText': '¿En qué estás interesado?',

    // Text to show when all options are selected
    'allText': undefined,

    // an array of preset option groups
    // presets: [{
    //   name: 'All categories',
    //   all: true // select all
    // },{
    //   name: 'My categories',
    //   options: ['a', 'c']
    // }]
    'presets': undefined,

    // CSS class added to the container, when the menu is about to extend beyond the right edge of the position<a href="https://www.jqueryscript.net/menu/">Menu</a>Within element
    'positionedMenuClass': 'multi-select-container--positioned',

    // If you provide a jQuery object here, the plugin will add a class (see positionedMenuClass option) to the container when the right edge of the dropdown menu is about to extend outside the specified element, giving you the opportunity to use CSS to prevent the menu extending, for example, by allowing the option labels to wrap onto multiple lines.
    'positionMenuWithin': undefined,

    // The plugin will attempt to keep this distance, in pixels, clear between the bottom of the menu and the bottom of the viewport, by setting a fixed height style if the menu would otherwise approach this distance from the bottom edge of the viewport.
    'viewportBottomGutter': 20,

    // minimal height
    'menuMinHeight': 200
  });
});




//------------------------------------------------------------------------- Scroll
function posScroll(){
  var nav_ancho = jQuery(window).width();
  var nav_alto = jQuery(window).height();
  var scroll_pos = jQuery(window).scrollTop();

  var $header = jQuery(".header");
  if(scroll_pos > 30){

  $header.addClass('header-scroll');

  if(scroll_pos > 200){
    jQuery(".comprar-flotante").addClass('add-cart-product-float');
    if(scroll_pos <= scroll_inicial){
        $header.removeClass('header-scroll-hide');
    }else{
      $header.addClass('header-scroll-hide');
      scroll_contador=0;
    }
  }
  //Desplazador
  jQuery(".desplazador-top").addClass("desplazador-top-show");
  }else{
    $header.removeClass('header-scroll header-scroll-hide');
    jQuery(".desplazador-top").removeClass("desplazador-top-show");
    jQuery(".comprar-flotante").removeClass('add-cart-product-float');
    scroll_inicial=0;
  }


  //Animaciones Scroll
  jQuery(".anim-scroll").each(function (index){
    var pos = jQuery(this).offset().top;
    var pos_anim = scroll_pos + nav_alto;
    if(scroll_pos_init > pos){
      jQuery(this).addClass("anim-start");
    }else if(pos <= pos_anim){
      jQuery(this).addClass("anim-start");
    }
  });


  //Delimitador
  scroll_inicial = scroll_pos;

}

//---------------------------------------------------------------------------------------------------------- Maquetación
function maquetacion(){
}


//----------------------------------------------------------------------------------------------------------- Formulario

jQuery(document).on('gform_post_render', function(e,f,p){
  jQuery('#gform_ajax_frame_'+f).attr('src', 'about:blank'); //Prevenimos que se envién duplicados en el formulario
});
//------------------------------------------------------------------------------------------------------------ MENÚS


//--------- Mostrar submenus horizontales
jQuery(document).on('mouseenter', '.menu-hor.menu-pc .menu-item-has-children', function(e) {
  if(jQuery("body").css("overflow") != "hidden"){
      var $obj = jQuery(this).find('> .sub-menu');
      $obj.slideDown('fast', function(){jQuery($obj).css('overflow','visible')});
  }
});

jQuery(document).on('mouseleave', '.menu-hor.menu-pc .menu-item-has-children', function(e) {
  if(jQuery("body").css("overflow") != "hidden"){
    var $obj = jQuery(this).find('> .sub-menu');
    $obj.slideUp(0);
  }
});

//--------- Mostrar submenus Verticales
jQuery(document).on('click', '.menu-ver .menu-item-has-children .menu-ver-btn', function(e) {
    var $obj = jQuery(this).siblings('.sub-menu');
    if(jQuery(this).parent().attr("data-estado")){
      $obj.slideUp('fast');
      jQuery(this).parent().removeAttr("data-estado");
    }else{
      $obj.slideDown('fast', function(){jQuery($obj).css('overflow','visible')});
      jQuery(this).parent().attr("data-estado","on");
    }

});



//------------------------------------------------------------------------------------------------------------ DESPLEGABLES LATERALES

jQuery(document).on('click', '.desplegable-desplegar', function(e) {
    var obj = jQuery(this).attr("data-obj");
    console.log(obj);
    var $obj = jQuery(obj);

    //Si hay que cambiar el texto
    if(jQuery(this).data("txt-off")){
      jQuery(this).html(jQuery(this).data("txt-off"));
    }

    //Si hay que cambiar iconos
    if(jQuery(this).data("ico-on") && jQuery(this).data("ico-off")){
      jQuery(this).find(".fa").removeClass(jQuery(this).data("ico-off"));
      jQuery(this).find(".fa").addClass(jQuery(this).data("ico-on"));
    }

    //Cambio de elemento si tiene cierre
    if(jQuery(this).data("txt-on") || jQuery(this).data("ico-on") || jQuery(this).data("off")){
      jQuery(this).removeClass("desplegable-desplegar");
      jQuery(this).addClass("desplegable-plegar");
    }

    //Función de despliege
    desplegar_desplegable($obj);

    event.preventDefault();

});


function desplegar_desplegable($obj){

  if($obj.hasClass('desplegable-lat')){//Si es botón lateral
    $obj.addClass("desplegable-lat-visible");
  }else if($obj.hasClass('popup')){//Si es botón lateral
    $obj.fadeIn('fast');
  }else{//Si es desplegable simple
    $obj.slideDown('fast', function(){jQuery($obj).css('overflow','visible')});
    jQuery(this).removeClass("desplegable-desplegar");
    jQuery(this).addClass("desplegable-plegar");
  }

  //Si hay fondo oscuro
  if($obj.find(".desplegable-fondo").length){
    $obj.find(".desplegable-fondo").fadeIn('800');
    jQuery("body").css({
        "height":"100%",
        "overflow":"hidden"
    });
  }

}




//--------- Desplegable Plegar
jQuery(document).on('click', '.desplegable-plegar', function(e) {
    var obj = jQuery(this).attr("data-obj");
    var $obj = jQuery(obj);

    if($obj.hasClass('desplegable-lat')){//Si es botón lateral
      $obj.removeClass("desplegable-lat-visible");
    }else if($obj.hasClass('popup')){//Si es botón lateral
      $obj.fadeOut('fast');
    }else{//Si es desplegable simple
      $obj.slideUp('fast');
      if(jQuery(this).data("txt-on") || jQuery(this).data("ico-on")){
        jQuery(this).removeClass("desplegable-plegar");
        jQuery(this).addClass("desplegable-desplegar");
      }
    }

    //Si hay fondo oscuro
    if($obj.find(".desplegable-fondo").length){
      $obj.find(".desplegable-fondo").fadeOut('800');
      jQuery("body").css({
          "height":"auto",
          "overflow":"visible"
      });
    }

    //Si hay que cambiar el texto
    if(jQuery(this).data("txt-on")){
      jQuery(this).html(jQuery(this).data("txt-on"));
    }

    //Si hay que cambiar iconos
    if(jQuery(this).data("ico-on") && jQuery(this).data("ico-off")){
      jQuery(this).find(".fa").removeClass(jQuery(this).data("ico-on"));
      jQuery(this).find(".fa").addClass(jQuery(this).data("ico-off"));
    }



    event.preventDefault();
});





//----------------------------------------------------------------------------------------------------------- Ocultar menú
jQuery(document).on('click', '.menu-item > a', function(e) {

   //Revisamos si el menú lateral esta desplegado
   if(jQuery("body").css("overflow") == "hidden" && jQuery(this).attr("href")){
      jQuery("#header-contenedor-movil").css("right","-100%");
      jQuery(".desplegable-fondo").fadeOut('800');
      jQuery(".desplegable-fondo").removeClass('desplegable-lat-plegar');
      jQuery("body").css({
          "height":"auto",
          "overflow":"visible"
      });
   }

});



//----------------------------------------------------------------------------------------------------------- Desplazar
jQuery(document).on('click', '.desplazar', function(e) {

   var destino = "";

   if(jQuery(this).attr("href")){//Si el botón está en un menú
        destino = jQuery(this).attr("href");
   }else{
        destino = jQuery(this).find("a").attr("href");

   }

   //Revisamos si tiene una url completa
   if(destino.indexOf('http') == -1){
        //Eliminamos la URL
        destino = destino.split("#");
        destino = "#"+destino[1];
   }

   //Revisamos si el menú lateral esta desplegado
   if(jQuery("body").css("overflow") == "hidden"){

      jQuery("#header-contenedor-movil").css("right","-100%");
      jQuery(".desplegable-fondo").fadeOut('800');
      jQuery(".desplegable-fondo").removeClass('desplegable-lat-plegar');
      jQuery("body").css({
          "height":"auto",
          "overflow":"visible"
      });
   }



   //REvisamos si existe el elemento en página para efectuar la animación
   if(destino == "#"){
        jQuery('body,html').animate({scrollTop: 0}, 500);
        return false;
   }else if(jQuery(destino).length){
        var distancia = jQuery(destino).offset().top-20;
        jQuery('body,html').animate({scrollTop: distancia-50}, 500);
        return false;
   }

});


//***************************************************************************************************************Recuperar parámetros

function getParameterByName(name) {//Recuperar el modo de llegada
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


//***************************************************************************************************************limpiar Cadenas()*/
function limpiar_cadena(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "¡!@#$^&%*()+[]\{}|:<>¿.";
   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }
   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();
   // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"_");
   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/-/gi,"_");
   cadena = cadena.replace(/,/gi,"|");
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   cadena = cadena.replace(/ň/gi,"n");

   return cadena;
}

function solo_numeros(cadena){
   // Definimos los caracteres que queremos eliminar
   cadena = cadena.replace(/[^\d]/, '');
   cadena = cadena.replace(/ /g,"");
   cadena = cadena.replace(/ /g,"");
   cadena = cadena.substr(5, cadena.length);
   return cadena;
}


//***************************************************************************************************************Fechas()*/
function conseguir_fecha(){
  var f = new Date();
  var f_ano = f.getFullYear();
  var f_mes = f.getMonth()+1;
  var f_dia = f.getDate();
  var f_hora = f.getHours();
  var f_min = f.getMinutes();
  var f_seg = f.getSeconds();
  var fecha_final = ""+f_ano+f_mes+f_dia+f_hora+f_min+f_seg;
  return fecha_final

}


//***************************************************************************************************************Analítica*/
var gtm_tipo = undefined;
var gtm_ev_cat = undefined;
var gtm_ev_act = undefined;
var gtm_ev_lab = undefined;
var gtm_pag_pag = undefined;
var gtm_pag_tit = undefined;

function gtm_limpiar(){
  gtm_tipo = undefined;
  gtm_ev_cat = undefined;
  gtm_ev_act = undefined;
  gtm_ev_lab = undefined;
  gtm_pag_pag = undefined;
  gtm_pag_tit = undefined;
}

function gtm_pasar(){

  dataLayer.push({
    'event': gtm_tipo,
    'event_data': {
      'category': gtm_ev_cat,
      'action': gtm_ev_act,
      'label': gtm_ev_lab
    },
    'pageview_data': {
      'page': gtm_pag_pag,
      'title': gtm_pag_tit
    }
  });

  gtm_limpiar();

}


//----------------------------------------------------------------------------------------------------------- Seguimiento de contactos
jQuery(document).on('click', '.link-contacto a', function(e) {
   gtm_tipo = "gtm-event";
   gtm_ev_cat = "contacto";
   gtm_ev_act = "clic";
   gtm_ev_lab = "link";
   gtm_pasar();
});

jQuery(document).on('click', '.link-contacto-a', function(e) {
   gtm_tipo = "gtm-event";
   gtm_ev_cat = "contacto";
   gtm_ev_act = "clic";
   gtm_ev_lab = "link";
   gtm_pasar();
});
