//Cookies js functionality

/**
 * Tipos de cookies
 * 1. Analítica
 * 2. Publicidad
 */

jQuery(document).ready(function(){
  var cookie_analitica = getCookie('e_cookie_analitica');
  var cookie_publicidad = getCookie('e_cookie_publicidad');
  // var cookie_tecnicas = getCookie('e_cookie_tecnicas');

  if(cookie_analitica === '') {
    // No existe la cookie, la creamos a false
    rechazarCookie('analitica');
    cookie_analitica = false;
  }
  if(cookie_publicidad === '') {
    // No existe la cookie, la creamos a false
    rechazarCookie('publicidad');
    cookie_publicidad = false;
  }

  //Inicializamos el estado de los switches según el valor de las cookies
  if(cookie_analitica === 'true') {
    jQuery('#check-cookies-analitica').prop('checked', true);
    cookies.push('c-analitica');
  }
  if(cookie_publicidad === 'true') {
    jQuery('#check-cookies-publicidad').prop('checked', true);
    cookies.push('c-publicidad');
  }

  //Enviamos evento a gtm para capar/permitir eventos
  if(cookies.length != 0) {
    let cookiesvalue = '';
    if(cookies.length == 0) {
      cookiesvalue = undefined;
    } else {
      cookiesvalue = cookies.join('|');
    }
    evento_gtm('wAnalyticsEvent', 'cookies', 'cookies', cookiesvalue);
  }
  //Enviamos evento a gtm para capar/permitir eventos

  //Activate cookies accordions
  jQuery('.accordion .mas-info').click(function(e) {
    e.preventDefault();
    let accordion = jQuery(this).parent().parent().parent()[0];
    accordion.classList.toggle("active");
    var panel = accordion.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
});

// var $popupCookies = jQuery('#popup-cookies');
var $popupCookies = jQuery('#popup-cookies-bottom');
var $popupConfigCookies = jQuery('#config-cookies');
if(!getCookie('e_cookies_configured') && !sessionStorage.getItem('e_cookies_session_configured')) {
  setTimeout(function() {
    ck_desplegar_desplegable($popupCookies, false);
    // jQuery('body').removeAttr("style");
    // jQuery('.desplegable-fondo').remove();
  }, 1000);
}

//Botones del popup
jQuery('#popup-cookies .aceptar-cookies, #popup-cookies-bottom .aceptar-cookies').click(function() {
  aceptarTodasCookies();
  ck_plegar_desplegable($popupCookies);
});
jQuery('#popup-cookies .rechazar-cookies').click(function() {
  rechazarTodasCookies();
  ck_plegar_desplegable($popupCookies);
});
jQuery('#popup-cookies .configurar-cookies, #popup-cookies-bottom .configurar-cookies, #pol-cookies .configurar-cookies').click(function() {
  ck_plegar_desplegable($popupCookies);
  ck_desplegar_desplegable($popupConfigCookies, false);
});


//Botones del configurador
jQuery('#config-cookies .aceptar-cookies').click(function() {
  aceptarTodasCookies();
  //Cerramos el desplegable lateral
  setTimeout(function() {
    ck_plegar_desplegable($popupConfigCookies);
  }, 500);
});
jQuery('#config-cookies .rechazar-cookies').click(function() {
  rechazarTodasCookies();
  //Cerramos el desplegable lateral
  setTimeout(function() {
    ck_plegar_desplegable($popupConfigCookies);
  }, 500);
});
jQuery('#config-cookies .guardar-cookies').click(function() {
  //Cerramos el desplegable lateral
  ck_plegar_desplegable($popupConfigCookies);
  guardarCookies();
});


//Switches change events
jQuery('#check-cookies-analitica').change(function() {
  if(jQuery(this).is(':checked')) {
    aceptarCookie('analitica');
  } else {
    rechazarCookie('analitica');
  }
  jQuery('.hidden-guardar-cookies').removeClass('ck_d-n');
});
jQuery('#check-cookies-publicidad').change(function() {
  if(jQuery(this).is(':checked')) {
    aceptarCookie('publicidad');
  } else {
    rechazarCookie('publicidad');
  }
  jQuery('.hidden-guardar-cookies').removeClass('ck_d-n');
});


function aceptarCookie(cookie) {
  //Aceptamos la cookie que nos llega
  setCookie('e_cookie_' + cookie, true, 365);
  sessionStorage.setItem('e_cookies_session_configured', 1);

  //Variable de sesion, se borra al cerrar pestaña
  sessionStorage.setItem('e_cookies_session_configured', 1);

  //Si tenemos las dos cookies aceptadas, creamos la cookie 9999
  if(getCookie('e_cookie_publicidad') == 'true' && getCookie('e_cookie_analitica') == 'true') {
    document.cookie = "e_cookies_configured=1; expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/";
  }

  if(cookies.includes('c-analitica')) {
    cookies.push('c-publicidad');
  }else if(cookies.includes('c-publicidad')) {
    cookies.push('c-analitica');
  } else {
    cookies.push('c-' + cookie);
  }

}

function rechazarCookie(cookie) {
  //Rechazamos la cookie que nos llega
  setCookie('e_cookie_' + cookie, false, 365);
  setCookie('e_cookies_configured', '', -1);
  //Variable de sesion, se borra al cerrar pestaña
  
  cookies = cookies.filter(function(cookiesc) {
    if(cookiesc != 'c-' + cookie) return cookiesc
  });
}

function aceptarTodasCookies() {
  //Aceptamos todas las cookies (cuando el usuario le da al botón "Aceptar todas")
  jQuery('#config-cookies input[type="checkbox"]').prop('checked', true);
  aceptarCookie('analitica');
  aceptarCookie('publicidad');
  document.cookie = "e_cookies_configured=1; expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/";
  cookies = ['c-analitica', 'c-publicidad'];

  let cookiesvalue = '';
  if(cookies.length == 0) {
    cookiesvalue = undefined;
  } else {
    cookiesvalue = cookies.join('|');
  }
  evento_gtm('wAnalyticsEvent', 'cookies', 'cookies', cookiesvalue);
}

function rechazarTodasCookies() {
  //Rechazamos todas las cookies (cuando el usuario le da al botón "Rechazar todas")
  jQuery('#config-cookies input[type="checkbox"]').prop('checked', false);
  rechazarCookie('analitica');
  rechazarCookie('publicidad');
  //Variable de sesion, se borra al cerrar pestaña
  sessionStorage.setItem('e_cookies_session_configured', 1);
  cookies = [];
}

function guardarCookies() {
  let cookiesvalue = '';
  if(cookies.length == 0) {
    cookiesvalue = undefined;
  } else {
    cookiesvalue = cookies.join('|');
  }
  evento_gtm('wAnalyticsEvent', 'cookies', 'cookies', cookiesvalue);
}



//Auxiliar functions
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


function evento_gtm(gtm_tipo,gtm_ev_cat,gtm_ev_act,gtm_ev_lab) {
  dataLayer.push({
    event: gtm_tipo,
    event_data: {
      category: gtm_ev_cat,
      action: gtm_ev_act,
      label: gtm_ev_lab
    }
  });
}



function ck_desplegar_desplegable($obj, navigation = true) {
  if ($obj.hasClass('desplegable-lat')) {//Si es botón lateral
      $obj.addClass("desplegable-lat-visible");
  } else if ($obj.hasClass('popup')) {//Si es botón lateral
      $obj.fadeIn('fast');
  } else {//Si es desplegable simple
      $obj.slideDown('fast', function () {
          jQuery($obj).css('overflow', 'visible')
      });
  }

  //Si hay fondo oscuro
  if(!navigation) {
    if ($obj.find(".desplegable-fondo").length) {
      $obj.find(".desplegable-fondo").fadeIn('800');
      jQuery("body").css({
          "height": "100%",
          "overflow": "hidden"
      });
    }
  }

}
function ck_plegar_desplegable($obj) {

  if ($obj.hasClass('desplegable-lat')) {//Si es botón lateral
      $obj.removeClass("desplegable-lat-visible");
  } else if ($obj.hasClass('popup')) {//Si es botón lateral
      $obj.fadeOut('fast');
  } else {//Si es desplegable simple
      $obj.slideUp('fast');
  }


  //Si hay fondo oscuro
  if ($obj.find(".desplegable-fondo").length) {
      $obj.find(".desplegable-fondo").fadeOut('800');
      console.log('asdas');
      jQuery("body").css({
          "height": "auto",
          "overflow": "visible"
      });
  }

}


