var ajax_wc_cambio = "";//Variable para valorar la actividad del Ajax
var urlAjax = js_params_woo.ajaxurl;


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////ARRANQUE
jQuery(document).ready(function(){

  //Pageview si producto view
  if(jQuery(".single-product").length){
    gtm_view_product();
  }

  //Evento si hay mensajes
  if(jQuery(".popup-wc-info").length){
    jQuery("body").css({
        "height":"100%",
        "overflow":"hidden"
    });
  }

  //Retiramos el desplegable del minicar si es la página de carrito
  if(jQuery(".woocommerce-cart").length){
    jQuery('a[data-obj="#mini-cart"]').removeClass('desplegable-desplegar');
  }



  //Minicart
  cambio_minicart();
  cambio_boton_minicart();
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Añadir producto


jQuery(document).on('click', '.boton-add-cart-ficha', function(e) {
  var itemKey= jQuery(this).data("product_id");
  var quantity= jQuery(this).data("quantity");
  var variacion = "";
  var orig = "ficha";
  add_cart(itemKey,quantity,variacion,orig);
  e.preventDefault();
});

jQuery(document).ready(function(){
// console.log(jQuery("#pofw_product_options"));
if(jQuery("#pofw_product_options input").length){
	// console.log("he encontrado la variacion");
	setAjaxButtons();
	// AJAX buy button for variable products
	function setAjaxButtons() {
	   jQuery(document).on('submit', '.add-cart-product', function(e) {
	      var target = e.target;
      if(document.documentElement.lang == 'pt-PT'){
        jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">A carregar</span></div>'); //Animación de carga
      } else {
        jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">Cargando</span></div>'); //Animación de carga
      }
      desplegar_desplegable(jQuery("#mini-cart")); //Desplegamos el minicarrito
      e.preventDefault();
      var dataset = jQuery(e.target).closest('form');
      var product_id = jQuery(e.target).closest('form').find("input[name*='product_id']");
			product_id= jQuery(this).data("product_id");
      values = dataset.serialize();
			console.log(values);

      jQuery.ajax({
        type: 'POST',
        url: '?add-to-cart='+product_id,
        data: values,
        success: function(response, textStatus, jqXHR){
          // $response = jQuery.parseHTML(response);
          console.log(response);
          // console.log($response);
          jQuery("#mini-cart-content").html(jQuery(jQuery.parseHTML(response)).find('#mini-cart-content'));
          cambio_boton_minicart();
          // loadPopup(target); // function show popup
          // updateCartCounter();
        },
      });
      return false;
    });
	}
}
else{
jQuery(document).on('submit', '.add-cart-product', function(e) {
  var itemKey= jQuery(this).data("product_id");
  var quantity= jQuery(this).find(".qty").val();
  var variacion = "";
  if(jQuery(this).find(".variation_id").length){
    variacion = jQuery(this).find(".variation_id").val();
  }
  var orig = "product";
  // console.log("id: " + itemKey + " -- can: " + quantity + " -- var: " + variacion + " -- orig: " + orig);
  add_cart(itemKey,quantity,variacion,orig);
  e.preventDefault();
});
}
});

jQuery(document).on('click', '.product-qty-cambio', function(e) {
  var input = jQuery(this).siblings(".quantity").find(".qty");
  var cambio = parseInt(jQuery(this).data("accion"));
  cambio_cantidad(input, cambio);
});


jQuery(document).on('change', '.item-cantidad-contador', function(e) {
  var input = jQuery(this);
  var cambio = parseInt(jQuery(this).val());
  cambio_cantidad(input);
});


function cambio_cantidad(input, cambio){
  var diff = 0;//Bysidecar
  var total = parseInt(input.val());//Hago numerico
  if(typeof cambio != "undefined"){ //Si mandamos un cambio desde los manejadores
    total = total + cambio;
    diff = cambio;//Bysidecar
  }else{ //Si el cambio es manual desde el input
    total = input.val();
    var prev_value = parseInt(input.data("val"));//Bysidecar
    var value = parseInt(input.val());//Bysidecar
    diff = value - prev_value;//Bysidecar
  }
  if(total < 1){
    total = 1;
  }else if(input.attr('max') && total > input.attr('max')){
    total = input.attr('max');
  }
  input.val(total);

  if(input.data("type")=="mini-cart" || input.data("type")=="cart"){ //Si estamos en el carro
    cambio_cantidad_cart(input.data("itemkey"), total);
    //Bysidecar
    let productToCart = getProductDataById(input.data("id"),'analytic-cart-product');
    if(productToCart) {
        if (Math.sign(diff) > 0) {
              eventClickAddCart(productToCart, productToCart.position, diff, undefined);
          } else if (Math.sign(diff) < 0) {
              eventClickRemoveCart(productToCart, productToCart.position, diff, undefined);
          }
      }
  }

}


function cambio_cantidad_cart(itemKey, total){
  if(ajax_wc_cambio != ""){
    ajax_wc_cambio.abort();
  };
  var data = {
      action: 'cambio_cantidad',
      id: itemKey,
      quantity: total,
  };
  ajax_wc_cambio = jQuery.ajax({
    type: "POST",
    url: urlAjax,
    data: data,
    dataType: 'html',
    cache: false,
    headers: {'cache-control': 'no-cache'},
    beforeSend : function(response) {
     jQuery(".item-anim-carga-"+itemKey).css({"opacity":1,"display":"flex"});
    },success: function(response){
      ajax_wc_cambio = "";
      jQuery(".item-anim-carga").css({"opacity":0,"display":"none"});
      if (response.error) {
      } else {
        jQuery("#mini-cart-content").html(response);
        if(jQuery(".woocommerce-cart").length){//Si estoy en el carrito
          cambio_cart();
        }
        cambio_boton_minicart();
      }
    },
    error: function(response){
      console.log(response);
    }
  });
}


function add_cart(itemKey,quantity,variacion,orig){
   var data = {
      action: 'add_producto',
      product_id: itemKey,
      quantity: quantity,
      variation_id: variacion,
  };
  jQuery.ajax({
      type: 'post',
      url: urlAjax,
      data: data,
      dataType: 'html',
      cache: false,
      headers: {'cache-control': 'no-cache'},
      beforeSend: function(response) {
        if(document.documentElement.lang == 'pt-PT'){
          jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">A carregar</span></div>'); //Animación de carga
        } else {
          jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">Cargando</span></div>'); //Animación de carga
        }
        desplegar_desplegable(jQuery("#mini-cart")); //Desplegamos el minicarrito
      },success: function(response) {
          if (response.error & response.product_url) {
          } else {
              jQuery("#mini-cart-content").html(response);
              cambio_boton_minicart();
              if(orig != "product"){ //Si no es producto, hacemos nuestro envío a GTM
                gtm_add_to_cart(itemKey,quantity);
              }
              //Bysidecar
              let productToAddCart = getProductDataById(itemKey, 'analytic-cart-product');
              if(productToAddCart){
                  eventClickAddCart(productToAddCart, productToAddCart.position, quantity, undefined);
              }
              //jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, ""]);
          }
      },
  });
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Borrar elementos
jQuery(document).on('click', '#mini-cart-content .remove', function(e) {
  var itemKey = jQuery(this).data("cart_item_key");
  var itemID = jQuery(this).data("product_id");
  var data = {
      action: 'borrar_producto',
      id: itemKey,
  };
 jQuery.ajax({
      type: "POST",
      url: urlAjax,
      data: data,
      dataType: 'html',
      cache: false,
      headers: {'cache-control': 'no-cache'},
      beforeSend: function(response) {
          //Bysidecar
          let productToRemove = getProductDataById(itemID, 'analytic-cart-product');
          if(productToRemove) {
              eventClickRemoveCart(productToRemove, 1, productToRemove.quantity, undefined);
          }
        gtm_remove_to_cart(itemID);
        if(document.documentElement.lang == 'pt-PT'){
          jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">A carregar</span></div>'); //Animación de carga
        } else {
          jQuery("#mini-cart-content").html('<div class="mini-cart-anim-carga"><span class="fas fa-spinner fa-spin"></span> <span class="d-ib ml-10">Cargando</span></div>'); //Animación de carga
        }
        if(jQuery(".woocommerce-cart").length){//Si estoy en el carrito
          jQuery(".item-anim-carga-"+itemKey).css("opacity",1);
        }
      },success: function(response){
          if (response.error & response.product_url) {
          } else {
              jQuery("#mini-cart-content").html(response);
              cambio_boton_minicart();

              if(jQuery(".woocommerce-cart").length){//Si estoy en el carrito
                jQuery("#cart-item-"+itemKey).slideUp("fast", function() {
                   jQuery("#cart-item-"+itemKey).remove();
                });
                jQuery(".item-anim-carga-"+itemKey).css("opacity",0);
                cambio_cart();
              }
          }
      },
      error: function(msg){
        console.log(msg);
      }
    });
  return false;
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Cambio de variación
jQuery(document).on('click', '.cambio-variacion-alt', function(e) {
  jQuery(this).siblings(".cambio-variacion-alt-select").removeClass('cambio-variacion-alt-select');
  jQuery(this).addClass('cambio-variacion-alt-select');
  var obj = "#"+jQuery(this).data("obj");
  var variation = jQuery(this).data("variation");
  jQuery(obj).val(variation);
  jQuery(obj).change();
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Cambio minicart

function cambio_minicart(){
    jQuery.ajax({
      type: "POST",
      url: urlAjax,
      data: {action:'cambio_minicart'},
      beforeSend : function ( xhr ) {
      },success: function(msg){
        jQuery("#mini-cart-content").html(msg);
      },
      error: function(msg){
        console.log(msg);
      }

    });
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Cambio minicart

function cambio_cart(){
    jQuery.ajax({
      type: "POST",
      url: urlAjax,
      data: {action:'cambio_cart'},
      beforeSend : function ( xhr ) {
      },success: function(msg){
        jQuery("#cart-total-content").html(msg);
      },
      error: function(msg){
        console.log(msg);
      }
    });
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Control boton carrito

function cambio_boton_minicart(){
    jQuery.ajax({
      type: "POST",
      url: urlAjax,
      data: {action:'cambio_boton_minicart'},
      beforeSend : function ( xhr ) {
        jQuery(".mini-cart-btn-total").find(".label").css("display","none");
        jQuery(".mini-cart-btn-cantidad").find(".label").css("display","none");
        jQuery(".mini-cart-btn-total").find(".anim").css("display","inherit");
        jQuery(".mini-cart-btn-cantidad").find(".anim").css("display","inherit");
      },success: function(response){
        jQuery(".mini-cart-btn-total").find(".label").css("display","inherit");
        jQuery(".mini-cart-btn-cantidad").find(".label").css("display","inherit");
        jQuery(".mini-cart-btn-total").find(".label").html(response.total);
        jQuery(".mini-cart-btn-cantidad").find(".label").html(response.cantidad);
        jQuery(".mini-cart-btn-total").find(".anim").css("display","none");
        jQuery(".mini-cart-btn-cantidad").find(".anim").css("display","none");

        //Actualizamos el chekout
        if(jQuery(".woocommerce-checkout").length){
          jQuery(document.body).trigger("update_checkout");
        }
      },
      error: function(msg){
        console.log(msg);
      }

    });
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////Login

jQuery(document).on('submit', '.woocommerce-form-login', function(e) {

  var user = jQuery(this).find("#username").val();
  var pass = jQuery(this).find("#password").val();

  jQuery.ajax({
      type: "POST",
      dataType: 'json',
      url: urlAjax,
      data: {action:'woo_login', 'user': user, 'pass': pass},
      beforeSend : function ( xhr ) {
        jQuery(".woocommerce-form-login-msj-corto").slideUp('fast');
        jQuery(".woocommerce-form-login__submit").find(".item-anim-carga").css("opacity","1");
      },success: function(msg){
        jQuery(".woocommerce-form-login__submit").find(".item-anim-carga").css("opacity","0");

        if(msg.loggedin == true){
          jQuery(".woocommerce-form-login-msj-corto").addClass('woocommerce-msj-corto-ok');
        }else{
          jQuery(".woocommerce-form-login-msj-corto").addClass('woocommerce-msj-corto-error');
        }

        jQuery(".woocommerce-form-login-msj-corto").html(msg.message)
        jQuery(".woocommerce-form-login-msj-corto").slideDown('fast');

        if(msg.loggedin == true){
          eventLogintUser(msg.user);//Bysidecar
          document.location.href = window.location;
        }

      },
      error: function(msg){
        console.log(msg);
      }

    });


  e.preventDefault();
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////GTM Productos


var lista = 'Lista genérica';
jQuery(document).ready(function(){

  //Listas de productos
  if((jQuery(".gtm-product-ficha").length)){

    var products = [];
    var products = [];
    var pos = 1;

    //Origen de la lista
    if(jQuery(".single-product").length){
      lista = "Producto relacionado";
    }else if(jQuery(".search").length){
      lista = "Buscador";
    }else if(jQuery(".single-post").length){
      lista = "Blog";
    }


    jQuery(".gtm-product-ficha").each(function (index){



      products.push({
        'name':       jQuery(this).data( 'gtm-product-name' ),
        'id':         jQuery(this).data( 'gtm-product-id' ),
        'price':      jQuery(this).data( 'gtm-product-price' ),
        'category':   jQuery(this).data( 'gtm-product-cat' ),
        'position':   pos,
        'list':       lista,
        'stocklevel': jQuery(this).data( 'gtm-product-stocklevel' )
      });

      pos++;

    });

     dataLayer.push({
      'event': 'gtm-woo-impression',
      'ecommerce': {
        'currencyCode': 'EUR',
        'impressions':products
      }
    });
  }


});


//Click de producto
jQuery(document).on('click', '.gtm-product-link', function(e) {
  var datos_product = get_datos_product(jQuery(this).data("item-key"));
  dataLayer.push({
    'event': 'gtm-woo-clickProduct',
    'ecommerce': {
      'click': {
        'actionField': {'list': lista},
        'products': [{
          'name':       datos_product['name'],
          'id':         datos_product['id'],
          'price':      datos_product['price'],
          'category':   datos_product['category'],
          'stocklevel':   datos_product['stocklevel'],
        }]
      }
    }
  });
});


//Vista de producto
function gtm_view_product(){
  var product = jQuery(".gtm-product-detalle");
  dataLayer.push({
    'event': 'gtm-woo-viewProduct',
    'ecommerce': {
      'detail': {
        'products': [{
          'name':       product.data( 'gtm-product-name' ),
          'id':         product.data( 'gtm-product-id' ),
          'price':      product.data( 'gtm-product-price' ),
          'category':   product.data( 'gtm-product-cat' ),
          'stocklevel':   product.data( 'gtm-product-stocklevel' )
          //'variant':    variacion,
        }]
      }
    }
  });
}

function gtm_add_to_cart(itemKey,quantity){
  var datos_product = get_datos_product(itemKey);
  dataLayer.push({
    'event': 'gtm-woo-addCart',
    'ecommerce': {
      'currencyCode': 'EUR',
      'add': {
        'products': [{
          'name':       datos_product['name'],
          'id':         datos_product['id'],
          'price':      datos_product['price'],
          'category':   datos_product['category'],
          'quantity':   quantity
        }]
      }
    }
  });
}

function gtm_remove_to_cart(itemKey){
  var datos_product = get_datos_product(itemKey);
  dataLayer.push({
    'event': 'gtm-woo-removeCart',
    'ecommerce': {
      'remove': {
        'products': [{
          'name':       datos_product['name'],
          'id':         datos_product['id'],
          'price':      datos_product['price'],
          'category':   datos_product['category'],
          'quantity':   datos_product['cantidad'],
        }]
      }
    }
  });
}


//Recuperar datos de productos
function get_datos_product(itemKey){
  var product = jQuery(".gtm-product-datos-"+itemKey);
  var product_data = [];
  product_data["name"] = product.data( 'gtm-product-name' );
  product_data["id"] = product.data( 'gtm-product-id' );
  product_data["price"] = product.data( 'gtm-product-price' );
  product_data["category"] = product.data( 'gtm-product-cat' );
  product_data["list"] = 'Lista genérica',
  product_data["stocklevel"] = product.data( 'gtm-product-stocklevel' );
  product_data["cantidad"] = product.data( 'gtm-product-cantidad' );

 return product_data;

}


///////////////////////////////////////////////////////////////////////////////////////////////////////////Redimensionar slider accesorios en móvil
jQuery(document).on('click', 'a[aria-controls="collapseAccesorios"]', function(e) {
	jQuery('#collapseAccesorios .slick-slider').slick('refresh');
});

jQuery(document).ready(function(){
  jQuery( ".variations select" ).change(function(){
    var skuindex = jQuery(this)[0].selectedIndex;
    jQuery(".sku-product").hide();
    jQuery(".sku-parent").hide();
    jQuery(".sku-product-" +  skuindex).show();
  });
});
