//user.lastPurchase
//user.userId
//user.lastLogin
//user.firstLogin
if (typeof breadcrumb !== 'undefined') {
    let breadcrumb = {
        'value': undefined
    }
}
if (typeof user !== 'undefined') {
    let user = {
        'userId': undefined,
        'lastLogin': undefined,
        'firstLogin': undefined,
        'lastPurchase': undefined
    }
}
/*
 * ------------------------------------------------
 * Evento envio de newsletter
 * ------------------------------------------------
 */


const form = document.getElementById('gform_1');
if(form){
    form.addEventListener('submit', gtag_report_conversion_newsletter);
}
function gtag_report_conversion_newsletter() {
    console.log('event','gtag_report_conversion');
    var callback = function () {
        if (typeof (url) != 'undefined') {
            window.location = url;
        }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-691985440/bOKACNnJzPkBEKC4-8kC',
        'event_callback': callback
    });
    if (document.documentElement.lang !== 'pt-PT') {
        pintrk('track', 'lead', {
            lead_type: 'Newsletter'
        });
    }
    return false;
}
/*
 * ------------------------------------------------
 * Selectores de datos
 * ------------------------------------------------
 */
//Seleccinamos los datos de un producto en base a su id
function getProductDataById(itemKey, type = 'analytic-product') {
    let products = document.querySelectorAll('[data-' + type + '-id="' + itemKey + '"]');
    if (products.length < 1) {
        return
    }
    let product = products[0];
    if (type === 'analytic-product') {
        return {
            'name': product.dataset.analyticProductName, // nombre del producto
            'id': product.dataset.analyticProductId, // identificador único del producto (id y si no hay, sku)
            'price': product.dataset.analyticProductPrice, // precio unitario producto (sin gastos de envío)
            'category': product.dataset.analyticProductCategory,
            'variant': product.dataset.analyticProductCategories,
            'quantity': product.dataset.analyticProductQuantity,
            'position': product.dataset.analyticProductPosition, // Posición que ocupa el producto dentro del listado de productos
            'list': undefined,
        };
    } else {
        return {
            'name': product.dataset.analyticCartProductName, // nombre del producto
            'id': product.dataset.analyticCartProductId, // identificador único del producto (id y si no hay, sku)
            'price': product.dataset.analyticCartProductPrice, // precio unitario producto (sin gastos de envío)
            'category': product.dataset.analyticCartProductCategory,
            'variant': product.dataset.analyticCartProductCategories,
            'quantity': product.dataset.analyticCartProductQuantity,
            'position': product.dataset.analyticCartProductPosition, // Posición que ocupa el producto dentro del listado de productos
            'list': undefined,
        };
    }


}

//Convertimos los datos de producto que provienen del checkout a un producto a enviar a analytics. Solo se utiliza en el checkout
function getProductData(product) {
    return {
        'name': product.name, // nombre del producto
        'id': product.id, // identificador único del producto (id y si no hay, sku)
        'price': product.price, // precio unitario producto (sin gastos de envío)
        'category': product.category,
        'variant': product.categories,
        'quantity': product.quantity,
        'list': undefined,
        'position': undefined // Posición que ocupa el producto dentro del listado de productos
    };
}
/*
function getListHomeProductByList(list) {
    let products = [];
    let listProducts = document.getElementById(list).getElementsByClassName("ficha-producto");
    if (listProducts) {
        for (var i = 0; i < listProducts.length; i++) {
            var product = getProductDataById(listProducts[i].dataset.analyticProductId);
            if (product) {
                product.list = 'home - ' + list;
                products.push(product);
            }
        }
    }
    return products;
}*/
function getListHomeProductByList(list) {
    let products = [];
    let listProducts = document.querySelectorAll(".slick-active .ficha-producto");
    document.addEventListener("DOMContentLoaded" , () => {
        if (listProducts) {
            for (var i = 0; i < listProducts.length; i++) {
                var product = getProductDataById(listProducts[i].dataset.analyticProductId);
                if (product) {
                    product.list = 'home - ' + list;
                    products.push(product);
                }
            }
        }
    });
    
    return products;
}

/*
 * ------------------------------------------------
 * Enventos para analytics
 * ------------------------------------------------
 */

/*
 * Se lanza cuando carga la home
 */
function eventLoadHome() {
    let ofertas = getListHomeProductByList('#ofertas');
    let motosierras = getListHomeProductByList('motosierras');
    let cortacespedes = getListHomeProductByList('cortacéspedes');
    let desbrozadoras = getListHomeProductByList('desbrozadoras');
    var event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'productImpresion',
        'eventLbl': 'home',
        'noInteraction': 'true',
        'ecommerce': {
            'currencyCode': 'EUR',
            'impressions': [...ofertas, ...motosierras, ...cortacespedes, ...desbrozadoras]
        }
    };
    console.log('eventLoadHome', event);
    window.dataLayer.push(event);
}

/*
 * Se lanza cuando carga un pagina de un product
 */
function eventLoadProductPage() {
    if (typeof product !== 'undefined') {
        let event = {
            'event': 'eventoEC',
            'eventCat': 'ecommerce',
            'eventAct': 'detail',
            'eventLbl': product.name, // 'nombre del producto'
            'noInteraction': true,
            'ecommerce': {
                'currencyCode': 'EUR', // Indicador de moneda, sólo si se trabaja con multimoneda
                'detail': {
                    'actionField': {'list': breadcrumb.value},
                    'products': [
                        {
                            'name': product.name, // nombre del producto
                            'id': product.id, // identificador único del producto (id y si no hay, sku)
                            'price': product.price, // precio unitario producto (sin gastos de envío)
                            'brand': 'Husqvarna', // marca del producto
                            'category': product.category, // categoría producto (cortacesped | motosierras | desbrozadoras |
                            'variant': product.categories, // Subcategoría del producto (cortacespedes | riders cortacesped
                        }]
                }
            }
        };
        console.log('eventLoadProductPage', event);
        window.dataLayer.push(event);
        if (document.documentElement.lang !== 'pt-PT') {
            if(typeof fbq !== 'undefined') {
                fbq('track', 'ViewContent', {
                    value: product.price,
                    currency: 'EUR',
                    content_ids: product.id,
                    content_type: product.category,
                });
            }
        }
    }
}

/*
 * Se lanza cuando carga una categoria de productos
 */
function eventLoadCategoryPage(config) {
    let listProducts = document.getElementsByClassName("ficha-producto");
    let products = [];
    let list = '';
    if (listProducts) {
        if (config.order) {
            list += 'Ordenar ' + config.order;
        }
        if (config.price) {
            list += ' Filtro precio ';
        }
        if (config.search) {
            list += 'Busqueda interna '+config.search+' ';
        }
        if (config.categories.length > 0) {
            list += config.categories.join(' - ');
        } else {
            list += breadcrumb.value;
        }

        for (var i = 0; i < listProducts.length; i++) {
            var product = getProductDataById(listProducts[i].dataset.analyticProductId);
            if (product) {
                product.list = list;
                products.push(product);
            }
        }
    }


    let event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'productImpresion',
        'eventLbl': breadcrumb.value,
        'noInteraction': 'true',
        'ecommerce': {
            'currencyCode': 'EUR',
            'impressions': products
        }
    };
    window.dataLayer.push(event);

    if (config.search && document.documentElement.lang !== 'pt-PT') {
        if(typeof fbq !== 'undefined') {
            fbq('track', 'Search');
        }
    }
    if(config.search){
        var callback = function () {
            console.log('gtag buscador');
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-691985440/FTs3CJ3GzPkBEKC4-8kC',
            'event_callback': callback
        });

    }
    console.log('eventLoadCategoryPage', event);
}

/*
 * Se lanza cuando carga la pagina de finalizar compra
 */
function eventLoadCheckoutPage() {
    let productsList = [];
    if (typeof products !== 'undefined') {
        for (var i = 0; i < products.length; i++) {
            productsList.push(getProductData(products[i]));
        }
        let event = {
            'event': 'eventoEC',
            'eventCat': 'ecommerce',
            'eventAct': 'checkout-2',
            'eventLbl': 'datos de facturacion',
            'noInteraction': 'true',
            'ecommerce': {
                'currencyCode': 'EUR',
                'checkout': {
                    'actionField': {'step': 2},
                    'products': productsList
                }
            }
        };
        console.log('eventLoadCheckoutPage', event);
        window.dataLayer.push(event);
    }
}

/*
 * Se lanza cuando se hace click en un producto para visualizarlo
 */
function eventClickProduct(product, position) {
    let event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'productClick',
        'eventLbl': breadcrumb.value,
        'ecommerce': {
            'click': {
                'actionField': {
                    'list': breadcrumb.value
                },
                'products': [
                    {
                        'name': product.name, // nombre del producto
                        'id': product.id, // identificador único del producto (id y si no hay, sku)
                        'price': product.price, // precio unitario producto (sin gastos de envío)
                        'brand': 'Husqvarna', // marca del producto
                        'category': product.category, // categoría producto
                        'variant': product.categories, // Subcategoría del producto
                        'list': breadcrumb.value, // Nombre de la lista
                        'position': position// Posición que ocupa el producto dentro del listado de productos
                    }]
            }
        }
    };
    console.log('eventClickProduct', event);
    window.dataLayer.push(event);


}

/*
 * Se lanza cuando carga se hace click en el boton de añadir a carrito
 */
function eventClickAddCart(product, position, quantity, dimension6) {
    let event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'addToCart',
        'eventLbl': product.name,
        'ecommerce': {
            'currencyCode': 'EUR',
            'add': {
                'products': [
                    {
                        'name': product.name, // nombre del producto
                        'id': product.id, // identificador único del producto (id y si no hay, sku)
                        'price': product.price, // precio unitario producto (sin gastos de envío)
                        'brand': 'Husqvarna', // marca del producto
                        'category': product.category, // categoría producto (cortacesped | motosierras | desbrozadoras |
                        'variant': product.categories, // Subcategoría del producto (cortacespedes | riders cortacesped
                        'dimension6': dimension6, // talla seleccionada por el usuario (S 40/42 | M 40/46 | L 48/50....38 |
                        'quantity': quantity, // cantidad de unidades del producto que se añaden al carrito
                        'list': breadcrumb.value,
                        'position': product.position ? product.position : position
                    }]
            }
        }
    };
    if (document.documentElement.lang !== 'pt-PT') {
        /**
         * ADD pinterest
         */
        pintrk('track', 'addtocart', {
            value: product.price,
            order_quantity: quantity,
            currency: 'USD'
        });
        if(typeof fbq !== 'undefined') {
            fbq('track', 'AddToCart', {
                value: product.price,
                currency: 'EUR',
                contents: [
                    {
                        id: product.id,
                        quantity: quantity
                    }
                ],
                content_ids: product.id,
            });
        }
    }
    window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
    window._adftrack.push({
        HttpHost: 'track.adform.net',
        pm: 2316232,
        divider: encodeURIComponent('|'),
        pagename: encodeURIComponent('Añadir al carro'),
        order: {
            sales: product.price,
            orderid: product.id,
            itms: [{
                categoryname: product.category,
                productname: product.name,
                productid: product.id,
                productcount: quantity,
                productsales: product.price
            }]
        }
    });
    (function () {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://s2.adform.net/banners/scripts/st/trackpoint-async.js';
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
    console.log('eventClickAddCart', event);
    window.dataLayer.push(event);
    /**
     * Add to gtag
     */
    var callbackAdd = function () {
        console.log('gtag add to cart');
        if (typeof(url) != 'undefined') {
            window.location = url;
        }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-691985440/m_TWCNiQ7_kBEKC4-8kC',
        'event_callback': callbackAdd
    });

    return false;

}

/*
 * Se lanza cuando se elimina un producto del mini cart
 */
function eventClickRemoveCart(product, position, quantity, dimension6) {
    let event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'removeFromCart',
        'eventLbl': product.name,
        'ecommerce': {
            'currencyCode': 'EUR',
            'remove': {
                'products': [
                    {
                        'name': product.name, // nombre del producto
                        'id': product.id, // identificador único del producto (id y si no hay, sku)
                        'price': product.price, // precio unitario producto (sin gastos de envío)
                        'brand': 'Husqvarna', // marca del producto
                        'category': product.category, // categoría producto (cortacesped | motosierras | desbrozadoras |
                        'variant': product.categories, // Subcategoría del producto (cortacespedes | riders cortacesped
                        'dimension6': dimension6, // talla seleccionada por el usuario (S 40/42 | M 40/46 | L 48/50....38 |
                        'quantity': quantity, // cantidad de unidades del producto que se añaden al carrito
                        'list': breadcrumb.value
                    }]
            }
        }
    };
    console.log('eventClickRemoveCart', event);
    window.dataLayer.push(event);

}

/*
 * Se lanza cuando carga el mini cart
 */
function eventLoadMiniCartPage() {
    let listProducts = document.getElementsByClassName("mini-cart-item");

    let products = [];
    let list = breadcrumb.value;
    if (listProducts) {
        for (var i = 0; i < listProducts.length; i++) {
            var product = getProductDataById(listProducts[i].dataset.analyticProductId);
            if (product) {
                product.list = list;
                products.push(product);
            }
        }
    }


    let event = {
        'event': 'eventoEC',
        'eventCat': 'ecommerce',
        'eventAct': 'checkout-1',
        'eventLbl': 'carrito',
        'noInteraction': 'true',
        'ecommerce': {
            'currencyCode': 'EUR',
            'checkout': {
                'actionField': {'step': 1},
                'products': products
            }
        }
    }
    console.log('eventLoadMiniCartPage', event);
    window.dataLayer.push(event);
}

/*
 * Se lanza cuando un usuacion hacer click sobre logout
 */
function gtag_report_conversion_logout(url) {
    var callback = function () {
        console.log('gtag logout');
        if (typeof(url) != 'undefined') {
            window.location = url;
        }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-691985440/FMImCPrYzPkBEKC4-8kC',
        'event_callback': callback
    });
    return false;
}
function eventLogoutUser() {
    let event = {
        'event': 'evento',
        'eventCat': 'privateArea',
        'eventAct': 'logout', // Indicar si el usuario ha hecho login, registro o logout (login | registro | logout)
        'eventLbl': 'ok',
        'userId': user.userId, // Identificador unico del usuario
        'lastLogin': user.lastLogin, // devuelve la fecha en la que el usuario se logo por última vez.
        'firstLogin': user.firstLogin, // devuelve la fecha en la que el usuario se registro por primera vez.
        'lastPurchase': user.lastPurchase // devuelve la fecha en la que el usuario compro por última vez.
    };
    if (document.documentElement.lang !== 'pt-PT') {
        if(typeof fbq !== 'undefined') {
            fbq('track', 'SubmitApplication');
        }
    }
    console.log('eventLogoutUser', event);
    window.dataLayer.push(event);
    gtag_report_conversion_logout();
}

/*
 * Se lanza cuando un usuario hace login
 */
function eventLogintUser(user) {
    let event = {
        'event': 'evento',
        'eventCat': 'privateArea',
        'eventAct': 'login', // Indicar si el usuario ha hecho login, registro o logout (login | registro | logout)
        'eventLbl': 'ok',
        'userId': user.userId, // Identificador unico del usuario
        'lastLogin': user.lastLogin, // devuelve la fecha en la que el usuario se logo por última vez.
        'firstLogin': user.firstLogin, // devuelve la fecha en la que el usuario se registro por primera vez.
        'lastPurchase': user.lastPurchase // devuelve la fecha en la que el usuario compro por última vez.
    };
    console.log('eventLogintUser', event);
    window.dataLayer.push(event);
}

/*
 * Se lanza cuando un usuario se registra
 */
//GTag event
function gtag_report_conversion_register(url) {
    console.log('event', 'gtag_report_conversion');
    var callback = function () {
        if (typeof (url) != 'undefined') {
            window.location = url;
        }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-691985440/E-kSCJCe4_kBEKC4-8kC',
        'event_callback': callback
    });
    return false;
}
function eventRegisterUser() {
    let event = {
        'event': 'evento',
        'eventCat': 'privateArea',
        'eventAct': 'register', // Indicar si el usuario ha hecho login, registro o logout (login | registro | logout)
        'eventLbl': 'ok',
        'userId': user.userId, // Identificador unico del usuario
        'lastLogin': user.lastLogin, // devuelve la fecha en la que el usuario se logo por última vez.
        'firstLogin': user.firstLogin, // devuelve la fecha en la que el usuario se registro por primera vez.
        'lastPurchase': user.lastPurchase // devuelve la fecha en la que el usuario compro por última vez.
    };
    window.dataLayer.push(event);

    gtag_report_conversion_register();


    //Adform event
    window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
    window._adftrack.push({
        HttpHost: 'track.adform.net',
        pm: 2316232,
        divider: encodeURIComponent('|'),
        pagename: encodeURIComponent('Registro'),

    });
    (function () {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://s2.adform.net/banners/scripts/st/trackpoint-async.js';
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
    //facebook event
    if (document.documentElement.lang !== 'pt-PT') {
        if(typeof fbq !== 'undefined') {
            fbq('track', 'CompleteRegistration');
        }
        pintrk('track', 'signup');
    }
    console.log('eventRegisterUser', event);


}

/*
 *----------------------------------------------------------------------
 *  Funciones que recorren el DOM para localizar clases a las que asignar los eventos
 *----------------------------------------------------------------------
 */
/**
 * Recorre todas las clases ficha-producto para asinganle el envento click
 */
function loopProductSheet() {
    let productSheet = document.getElementsByClassName("ficha-producto");
    if (productSheet && productSheet.length > 0) {
        let clickProduct = function (event) {
            if (this.dataset.analyticProductId) {
                let position = 1;
                if (this.parentElement.parentElement.dataset.slickIndex) {
                    position = parseInt(this.parentElement.parentElement.dataset.slickIndex) + 1;
                } else if (this.dataset.slickIndex) {
                    position = this.dataset.slickIndex;
                }
                eventClickProduct(getProductDataById(this.dataset.analyticProductId), position);
            }
        }
        for (let i = 0; i < productSheet.length; i++) {
            productSheet[i].addEventListener('click', clickProduct, false);
        }
    }
}

/**
 * Recorre todas las clases para localicar la clase de logout en el boton
 */
function loopUserLogout() {
    let logoutClick = document.getElementsByClassName('woocommerce-MyAccount-navigation-link--customer-logout');
    if (logoutClick && logoutClick.length > 0) {
        let addLogoutClick = function (event) {
            eventLogoutUser();
        };
        for (var i = 0; i < logoutClick.length; i++) {
            logoutClick[i].addEventListener('click', addLogoutClick, false);
        }
    }
}

/**
 * Recorre todas las clases para localicar la clase de dessplegar carrito de compra
 */
function loopOpenCart() {
    var clickShowMiniCart = document.getElementsByClassName("desplegable-desplegar");
    if (clickShowMiniCart && clickShowMiniCart.length > 0) {
        let clickMiniCart = function (event) {
            eventLoadMiniCartPage();
        };

        for (var i = 0; i < clickShowMiniCart.length; i++) {
            if (clickShowMiniCart[i].dataset.obj === '#mini-cart') {
                clickShowMiniCart[i].addEventListener('click', clickMiniCart, false);
            }
        }
    }
}


jQuery(document).ready(function () {

    if (page.name === 'home') {
        eventLoadHome();
    }
    if (document.body.classList.contains('single-product') || page.name === 'product') {
        eventLoadProductPage();

    }
    if (page.name === 'checkout') {
        eventLoadCheckoutPage();
    }

    if (window.location.search.substr(1) === 'new-register' && page.name === 'my-account') {
        eventRegisterUser();
    }

    loopProductSheet();
    loopUserLogout();
    loopOpenCart();


    /* Init event products order */
    var $orderElement = jQuery('.woocommerce-ordering select');
    if ($orderElement.length) {
        var stringToAnalyticsOrder = {
            'popularity': 'popularidad',
            'date': 'útlimos',
            'price': 'precio bajo a precio alto',
            'price-desc': 'precio alto a precio bajo',
        }
        $orderElement.on('change', function () {
            var valueOrder = jQuery(this).val();
            if (valueOrder && stringToAnalyticsOrder.hasOwnProperty(valueOrder)) {
                var eventOrder = {
                    'event': 'evento',
                    'eventCat': 'filtro',
                    'eventAct': 'ordenar',
                    'eventLbl': stringToAnalyticsOrder[valueOrder]
                };
                console.log('eventOrder', eventOrder);
                window.dataLayer.push(eventOrder);
            }
        });
    }
    /* / event products order */

    /**
     * Escucha el evento que carga los productos
     */
    jQuery(document).on('facetwp-loaded', function () {
        let config = {
            price: false,
            order: false,
            search: false,
            categories: []
        };
        let categories = [];
        if (FWP.facets.categora_hidrolimpiadoras) {
            FWP.facets.categora_hidrolimpiadoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categora_soplanieves) {
            FWP.facets.categora_soplanieves.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_aceites_y_gasolinas) {
            FWP.facets.categoria_aceites_y_gasolinas.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_automower) {
            FWP.facets.categoria_automower.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_aspiradoras) {
            FWP.facets.categoria_aspiradoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_cortacespedes) {
            FWP.facets.categoria_cortacespedes.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_cortasetos) {
            FWP.facets.categoria_cortasetos.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_desbrozadoras) {
            FWP.facets.categoria_desbrozadoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_escarificadores_cesped) {
            FWP.facets.categoria_escarificadores_cesped.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_herramientas_forestales) {
            FWP.facets.categoria_herramientas_forestales.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_juguetes) {
            FWP.facets.categoria_juguetes.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_merchandising) {
            FWP.facets.categoria_merchandising.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_motoazada) {
            FWP.facets.categoria_motoazada.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_motosierras) {
            FWP.facets.categoria_motosierras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_ropa) {
            FWP.facets.categoria_ropa.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_sopladores) {
            FWP.facets.categoria_sopladores.forEach(element => categories.push(element));
        }
        config.categories = categories;
        if (FWP.facets.price_range.length > 0) {
            config.price = FWP.facets.price_range;
        }

        if (FWP.facets.buscador_productos !== '') {
            config.search = FWP.facets.buscador_productos;
        }
        if (FWP_HTTP.get.orderby) {
            config.order = FWP_HTTP.get.orderby;
        }
        eventLoadCategoryPage(config);
        //console.log('FWP.facets', FWP.facets);
        //console.log('FWP.settings', FWP.settings);
        //console.log('FWP.extras', FWP.extras);
    });
    jQuery(document).on('facetwp-refresh', function () {

        let config = {
            price: false,
            order: false,
            search: false,
            categories: []
        };
        let categories = [];
        if (FWP.facets.categora_hidrolimpiadoras) {
            FWP.facets.categora_hidrolimpiadoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categora_soplanieves) {
            FWP.facets.categora_soplanieves.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_aceites_y_gasolinas) {
            FWP.facets.categoria_aceites_y_gasolinas.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_automower) {
            FWP.facets.categoria_automower.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_aspiradoras) {
            FWP.facets.categoria_aspiradoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_cortacespedes) {
            FWP.facets.categoria_cortacespedes.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_cortasetos) {
            FWP.facets.categoria_cortasetos.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_desbrozadoras) {
            FWP.facets.categoria_desbrozadoras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_escarificadores_cesped) {
            FWP.facets.categoria_escarificadores_cesped.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_herramientas_forestales) {
            FWP.facets.categoria_herramientas_forestales.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_juguetes) {
            FWP.facets.categoria_juguetes.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_merchandising) {
            FWP.facets.categoria_merchandising.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_motoazada) {
            FWP.facets.categoria_motoazada.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_motosierras) {
            FWP.facets.categoria_motosierras.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_ropa) {
            FWP.facets.categoria_ropa.forEach(element => categories.push(element));
        }
        if (FWP.facets.categoria_sopladores) {
            FWP.facets.categoria_sopladores.forEach(element => categories.push(element));
        }
        config.categories = categories;
        if (FWP.facets.price_range.length > 0) {
            config.price = FWP.facets.price_range;
            let min_price =0;
            let max_price =0;
            if(config.price.length > 0){

                for(let i = 0; i < config.price.length; i++){

                    if(i===0){
                        min_price = parseInt(config.price[0]);
                    }
                    if(i===1){
                        max_price = parseInt(config.price[1]);
                    }
                }
            }
            let eventPrice = {
                'event': 'evento',
                'eventCat': 'filtro',
                'eventAct': 'precio',
                'eventLbl': min_price +' - '+ max_price
            };
            //dataLayer.push(eventPrice);
            console.log('eventPrice', eventPrice);
            window.dataLayer.push(eventPrice);
        }

        if (FWP.facets.buscador_productos !== '') {

        }
        if (FWP_HTTP.get.orderby) {
            /* lo hace la funcion de la line 558
            config.order = FWP_HTTP.get.orderby;
             let eventOrder = {
                 'event': 'evento',
                 'eventCat': 'filtro',
                 'eventAct': 'ordenar',
                 'eventLbl': FWP_HTTP.get.orderby
             };
             //dataLayer.push(eventOrder);
             console.log(eventOrder);*/
        }
        if (FWP.facets.superficie_jardn && FWP.facets.superficie_jardn !== '' && FWP.facets.superficie_jardn.length > 0) {
            let eventSuperf = {
                'event': 'evento',
                'eventCat': 'filtro',
                'eventAct': 'superficie',
                'eventLbl': FWP.facets.superficie_jardn.join(' - ')
            };
            //dataLayer.push(eventSuperf);
            console.log('eventSuperf', eventSuperf);
            window.dataLayer.push(eventSuperf);
        }

        if (categories.length > 0) {
            let eventCategories = {
                'event': 'evento',
                'eventCat': 'filtro',
                'eventAct': 'subcategorias',
                'eventLbl': categories.join(' - ')
            };
            //dataLayer.push(eventCategories);
            console.log('eventCategories', eventCategories);
            window.dataLayer.push(eventCategories);
        }
    });
    /* Init payment method event */
    var classPaymentMethod = '.wc_payment_method';
    var $inputPaymentMethod = jQuery(classPaymentMethod);   // caching our input
    if ($inputPaymentMethod.length) {
        var $childsMethods;
        var paymentMethodUpdate = function () {
            var $inputs = jQuery('input[name="payment_method"]', $inputPaymentMethod);
            var $selectedElement = jQuery('input:radio[name="payment_method"]:checked');
            var financingType;
            var selectedIndex = 1;
            for (var i = 0; i < $inputs.length; i++) {
                if ($inputs[i].id === $selectedElement.attr('id')) {
                    selectedIndex = i + 1;
                }
            }
            var $childsSelected = $selectedElement.parent().find('fieldset input:checked');
            if ($childsSelected.length) {
                if (!$childsMethods) {
                    $childsMethods = $selectedElement.parent().find('fieldset input');
                    $childsMethods.on('change', function () {
                        paymentMethodUpdate();
                    })
                }
                financingType = $childsSelected.next().text();
            }
            var event = {
                'event': 'eventoEC',
                'eventCat': 'ecommerce',
                'eventAct': 'checkout-2',
                'eventLbl': 'paymentType',
                'noInteraction': true,
                'ecommerce': {
                    'checkout_option': {
                        'actionField': {
                            'step': selectedIndex,
                            'option': $selectedElement.val(),
                            'financingType': financingType
                        }
                    }
                }
            };
            console.log('eventPaymentMethod', event);
            window.dataLayer.push(event);
        }

        jQuery('body').on('payment_method_selected', function () {
            paymentMethodUpdate();
        });
    }
    /* / payment method event */
});


