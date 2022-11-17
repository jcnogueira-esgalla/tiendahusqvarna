<?php

/**
 *  Imprime los dataset para los fichas de producto
 *
 * @param WC_Product $product
 * @param string $class
 * @param int $quantity
 * @param int $position
 * @param false $create_div
 * @return string
 */
function print_data_product_analytics(WC_Product $product, $class = 'analytic-product', $quantity = 1, $position = 1, $create_div = false)
{
    $terms = get_the_terms($product->get_id(), 'product_cat');
    $category = '';
    if ($terms && !is_wp_error($terms)) {
        if (!empty($terms)) {
            $category = $terms[0]->name;
        }
    }

    $id = $product->get_id();
    $name = esc_html($product->get_name());

    $data = ' data-' . $class . '-id="' . $id . '" 
    data-' . $class . '-position="' . $position . '" 
    data-' . $class . '-name="' . $name . '" 
    data-' . $class . '-price="' . wc_get_price_including_tax($product) . '" 
    data-' . $class . '-category="' . $category . '" 
    data-' . $class . '-sku="' . $product->get_sku() . '" 
    data-' . $class . '-quantity="' . $quantity . '" 
    data-' . $class . '-categories="' . strip_tags(wc_get_product_category_list($product->get_id(), ' - ', '', '')) . '" 
    data-' . $class . '-stock="' . $product->get_max_purchase_quantity() . '" ';

    if ($create_div) {
        return '<div style="display:none"  $data ></div>';
    } else {
        return $data;
    }


}

/*
 * Modificamos el link del redirect del registro, para pasarle el parametro new-registrer y caputurar el evento para enviarlo a analytics
 */
function custom_registration_redirect()
{
    return get_permalink(get_option('woocommerce_myaccount_page_id')) . '?new-register';
}

add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);

/**
 * Genera un array con el breadcrum para pasarlo como parametro a analytics.js
 * @return array
 */
function get_breadcrums()
{
    $breadcrumbs_enabled = current_theme_supports('yoast-seo-breadcrumbs');
    if (!$breadcrumbs_enabled) {
        $breadcrumbs_enabled = WPSEO_Options::get('breadcrumbs-enable', false);
    }
    $links = [];
    if ($breadcrumbs_enabled) {

        $links_breadcrumbs = (WPSEO_Breadcrumbs::get_instance())->get_links();
        if (is_array($links_breadcrumbs) && !empty($links_breadcrumbs)) {
            foreach ($links_breadcrumbs as $link) {

                if (isset($link['text'])) {
                    $links[] = $link['text'];
                }
            }
        }
    }
    return $links;
}

add_action('wp_head', 'bysidecar_analytics');


/**
 * Cargamos el fichero de analytics.js con las variables comunes para los eventos page, breadcrum y user
 * @throws Exception
 */
function bysidecar_analytics()
{
    $page = 'other';
    if (is_admin()) {
        return; //Si es una pagina de administracion no cargamos analytics
    }
    $the_theme     = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    $js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/analytics.js' );
    wp_register_script('analytics-js', get_template_directory_uri() . '/js/analytics.js', array('jquery'), $js_version);
    wp_localize_script('analytics-js', 'breadcrumb', ['value' => implode(' - ', get_breadcrums())]);


    //Si el usuario esta logueado creo la variable user para javascript
    if (is_user_logged_in()) {
        $customer = new WC_Customer(get_current_user_id());
        $last_order = $customer->get_last_order();
        $translation_array = array(
            'userId' => get_current_user_id(),
            'lastLogin' => null,
            'firstLogin' => get_userdata(get_current_user_id())->user_registered,
            'lastPurchase' => ($last_order) ? $last_order->order_date : null,
        );
        wp_localize_script('analytics-js', 'user', $translation_array);
    }

    //Si estoy visualizando una pagina de producto, le paso los datos a la variable product
    if (is_product()) {
        $page = 'product';
        $product = wc_get_product(get_the_ID());
        $terms = get_the_terms($product->get_id(), 'product_cat');
        $category = '';
        if ($terms && !is_wp_error($terms)) {
            if (!empty($terms)) {
                $category = $terms[0]->name;
            }
        }
        $product_data = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => $product->get_price(),
            'sku' => $product->get_sku(),
            'category' => $category,
            'categories' => strip_tags(wc_get_product_category_list($product->get_id(), ' - ', '', '')),
            'quantity' => null

        ];
        wp_localize_script('analytics-js', 'product', $product_data);

    }

    //Si l pagina es  la de checkout, generamos una variable para js con los datos de los productos
    if (is_checkout()) {
        $page = 'checkout';
        $products_data = [];
        if (count(WC()->cart->get_cart_contents()) > 0) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

                $product = wc_get_product($cart_item['product_id']);
                $terms = get_the_terms($product->get_id(), 'product_cat');
                $category = '';
                if ($terms && !is_wp_error($terms)) {
                    if (!empty($terms)) {
                        $category = $terms[0]->name;
                    }
                }
                $products_data[] = [
                    'id' => $product->get_id(),
                    'name' => $product->get_name(),
                    'price' => $product->get_price(),
                    'category' => $category,
                    'categories' => strip_tags(wc_get_product_category_list($product->get_id(), ' - ', '', '')),
                    'quantity' => $cart_item['quantity']

                ];
            }

            wp_localize_script('analytics-js', 'products', $products_data);
        }
    }

    if (is_front_page()) {
        $page = 'home';
    }

    if (is_account_page()) {
        $page = 'my-account';
    }

    wp_localize_script('analytics-js', 'page', ['name' => $page]);
    wp_enqueue_script('analytics-js');
}

/**
 * Genero evento en el envio de newsletter
 */
add_action('gform_after_submission', 'action_gform_after_submission_send_event', 10, 2);
function action_gform_after_submission_send_event($entry, $form)
{
    if ((int)$entry['form_id'] !== 1) {
        return;
    }

    ?>
    <div></div>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];

        let event = {
            'event': 'evento',
            'eventCat': 'contacto',
            'eventAct': 'newsletter',
            'eventLbl': '<?php echo $entry[4];?>',
            'city': '<?php echo $entry[3];?>',
        };
        window.dataLayer.push(event);
        console.log(event);


    </script>
    <!-- Gtag Tracking Code BEGIN -->
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                console.log('gtag newsletter');
                if (typeof (url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-691985440/bOKACNnJzPkBEKC4-8kC',
                'event_callback': callback
            });
            return false;
        }
    </script>
    <!-- Gtag Tracking Code END -->

    <!-- Adform Tracking Code BEGIN -->
    <script type="text/javascript">
        window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
        window._adftrack.push({
            HttpHost: 'track.adform.net',
            pm: 2316232,
            divider: encodeURIComponent('|'),
            pagename: encodeURIComponent('Newsletter'),
        });
        (function () {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'https://s2.adform.net/banners/scripts/st/trackpoint-async.js';
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();

    </script>
    <noscript>
        <p style="margin:0;padding:0;border:0;">
            <img src="https://track.adform.net/Serving/TrackPoint/?pm=2316232&ADFPageName=Newsletter&ADFdivider=|"
                 width="1" height="1" alt=""/>
        </p>
    </noscript>
    <!-- Adform Tracking Code END -->

    <?php
    if (get_current_blog_id() == 1):
        ?>
        <!-- facebook Tracking Code BEGIN -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '4180208645345952');
            fbq('track', 'Subscribe');
        </script>
        <!-- Facebook Tracking Code END -->
    <?php
    endif;
    // The code that you want to run for submissions which aren't spam.
}

/**
 * Genero evento vento  una vez se ha completado la compra
 */
add_action('woocommerce_thankyou', 'action_thankyou_send_event', 10, 2);
function action_thankyou_send_event($order_id)
{
    $order = wc_get_order($order_id);
    $order->get_total();
    $line_items = $order->get_items();
    $products = [];
    $products_adform = [];
    $products_facebook = [];
    foreach ($line_items as $item) {
        // This will be a product
        $product = wc_get_product($item['product_id']);
        $terms = get_the_terms($product->get_id(), 'product_cat');
        $category = '';
        if ($terms && !is_wp_error($terms)) {
            if (!empty($terms)) {
                $category = $terms[0]->name;
            }
        }
        $products[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => $product->get_price(),
            'category' => $category,
            'categories' => strip_tags(wc_get_product_category_list($product->get_id(), ' - ', '', '')),
            'quantity' => $item['quantity']

        ];
        $products_adform[] = [
            'productname' => $product->get_name(),
            'categoryname' => $category,
            'price' => $product->get_price(),
            'productid' => $product->get_id(),
            'productcount' => $item['quantity'],
            'productsales' => $product->get_price()

        ];
        $products_facebook[] = [
            'id' => $product->get_sku().'_'.$product->get_id(),
            'quantity' => $item['quantity'],
        ];


    }
    $coupons = [];
    if ($order->get_coupon_codes()) {
        foreach ($order->get_coupon_codes() as $coupon_code) {
            // Get the WC_Coupon object
            $coupon = new WC_Coupon($coupon_code);
            $coupons[] = $coupon->get_discount_type();
            //$discount_type = $coupon->get_discount_type(); // Get coupon discount type
            //$coupon_amount = $coupon->get_amount(); // Get coupon amount
        }
    }
    $iva = [];
    if ($order->get_tax_totals()) {
        foreach ($order->get_tax_totals() as $tax_code => $tax) {
            $iva [] = wc_format_decimal($tax->amount, 2);
            /* implode('|', array(
             'rate_id:'.$tax->id,
             'code:' . $tax_code,
             'total:' . wc_format_decimal($tax->amount, 2),
             'label:'.$tax->label,
             'tax_rate_compound:'.$tax->is_compound,
         ));*/
        }

    }
    ?>
    <div></div>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        let event = {
            'event': 'eventoEC',
            'eventCat': 'ecommerce',
            'eventAct': 'purchase',
            'eventLbl': '<?php echo $order_id;?>', //Número de pedido
            'noInteraction': 'true',
            'ecommerce': {
                'currencyCode': 'EUR',
                'purchase': {
                    'actionField': {
                        'id': '<?php echo $order_id;?>', //ID unico de transaccion
                        'revenue': '<?php echo $order->get_total();?>', //Ingresos (incluidos los impuestos y gastos de envío)
                        'tax': '<?php echo implode(' ', $iva);?>', //IVA de la transacción
                        'shipping': '<?php echo $order->get_shipping_total();?>', //gastos de envío
                        'coupon': '<?php echo implode(',', $coupons);?>', //Código de descuento que utiliza el usuario
                    },
                    'products': <?php echo json_encode($products);?>
                }
            }
        };
        window.dataLayer.push(event);
        console.log(event);
    </script>
    <!-- Adform Tracking Code BEGIN -->
    <script type="text/javascript">
        window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
        window._adftrack.push({
            HttpHost: 'track.adform.net',
            pm: 2316232,
            divider: encodeURIComponent('|'),
            pagename: encodeURIComponent('Compra'),
            order: {
                sales: '<?php echo $order->get_total()?>',
                orderid: '<?php echo $order_id?>',
                itms: <?php echo json_encode($products_adform);?>
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
    </script>
    <noscript>
        <p style="margin:0;padding:0;border:0;">
            <img src="https://track.adform.net/Serving/TrackPoint/?pm=2316232&ADFPageName=Compra&ADFdivider=|" width="1"
                 height="1" alt=""/>
        </p>
    </noscript>
    <!-- Adform Tracking Code END -->
    <!-- GTAG EVETN-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-691985440"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'AW-691985440');

        gtag('event', 'conversion', {
            'send_to': 'AW-691985440/yQM6COjG0fkBEKC4-8kC',
            'value': <?php echo $order->get_total()?>,
            'currency': 'EUR',
            'transaction_id': '<?php echo $order_id;?>'
        });
    </script>
    <!-- bing tracking -->
    <script>
        window.uetq.push(
            'event',
            'compra',
            {
                'event_category': 'ventas',
                'event_label': 'producto',
                'event_value': '0',
                'revenue_value': <?php echo $order->get_total();?>,
                'currency': 'EUR'
            }
        );
    </script>
    <!-- end bing tracking -->
    <?php
    if (get_current_blog_id() == 1):
        ?>
        <!-- facebook Tracking Code BEGIN -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '4180208645345952');

            fbq('track', 'Purchase', {
                value: <?php echo $order->get_total();?>,
                currency: 'EUR',
                contents: <?php echo json_encode($products_facebook);?>,
                content_ids: '<?php echo $order_id;?>',
                content_category:'<?php echo implode(',',get_breadcrums());?>'
            });
        </script>
        <!-- facebook Tracking Code END -->


        <!-- Pinterest Tag -->
        <script>
            !function(e){if(!window.pintrk){window.pintrk = function () {
                window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
                n=window.pintrk;n.queue=[],n.version="3.0";var
                t=document.createElement("script");t.async=!0,t.src=e;var
                r=document.getElementsByTagName("script")[0];
                r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");
            pintrk('load', '2614440109792', {em: '<user_email_address>'});
            pintrk('page');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none;" alt=""
                 src="https://ct.pinterest.com/v3/?event=init&tid=2614440109792&pd[em]=<hashed_email_address>&noscript=1" />
        </noscript>

        <script>
            pintrk('track', 'checkout', {
                value: <?php echo $order->get_total();?>,
                order_quantity: <?php echo $order_id;?>,
                currency: 'EUR'
            });
        </script>
        <!-- end Pinterest Tag -->

        <!-- Splio purchase pixel -->
        <img src="https://s3s.fr/sales.php?universe=husqvarna&amount=<?=$order->get_total();?>&id=<?=$order_id;?>" width="0" height="0" border="0" alt=""/>
        <!-- Splio purchase pixel END -->

    <?php
    endif;

    if (get_current_blog_id() == 2):
        ?>
        <!-- facebook Tracking Code BEGIN -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '157175479846755');

            fbq('track', 'Purchase', {
                value: <?php echo $order->get_total();?>,
                currency: 'EUR',
                contents: <?php echo json_encode($products_facebook);?>,
                content_ids: '<?php echo $order_id;?>',
                content_category:'<?php echo implode(',',get_breadcrums());?>'
            });
        </script>
        <!-- facebook Tracking Code END -->

    <?php
    endif;

}