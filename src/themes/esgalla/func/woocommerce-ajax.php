<?php



    //Añadir productos

    function add_producto() {

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));

		  $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount(wp_unslash($_POST['quantity']));

        $variation_id = absint($_POST['variation_id']);

        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);



        if ($passed_validation && WC()->cart->add_to_cart($_POST['product_id'], $_POST['quantity'], $variation_id)) {

            //do_action('woocommerce_ajax_added_to_cart', $product_id);

            wc_get_template('cart/mini-cart.php');

        } else {

            $data = array(

                'error' => true,

					 'POST' => json_encode($_POST),

                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),

					 'validation' => $passed_validation,

					 'product_id' => $product_id,

					 'quantity' => $quantity,

					 'variation_id' => $variation_id,

				 );

            echo wp_send_json($data);

        }

        wp_die();

    }

    add_filter( 'wp_ajax_add_producto', 'add_producto' );

    add_filter( 'wp_ajax_nopriv_add_producto', 'add_producto' );



    //Cambio de cantidad del carrito

    function cambio_cantidad() {

        //Añadir producto

        $id = $_POST['id'];

        $quantity = $_POST['quantity'];

        if (WC()->cart->set_quantity($id, $quantity)) {

            wc_get_template( 'cart/mini-cart.php' );

            //WC_AJAX :: get_refreshed_fragments();

        } else {

            $data = array('error' => true);

            echo wp_send_json($data);

        }

        wp_die();

    }

    add_filter( 'wp_ajax_cambio_cantidad', 'cambio_cantidad' );

    add_filter( 'wp_ajax_nopriv_cambio_cantidad', 'cambio_cantidad' );



    //Borrar productos del carrito

    function borrar_producto() {

        $id = $_POST['id'];

        if (WC()->cart->remove_cart_item($id)) {

            wc_get_template( 'cart/mini-cart.php' );

            //WC_AJAX :: get_refreshed_fragments();

        } else {

            $data = array('error' => true);

            echo wp_send_json($data);

        }

        wp_die();

    }

    add_filter( 'wp_ajax_borrar_producto', 'borrar_producto' );

    add_filter( 'wp_ajax_nopriv_borrar_producto', 'borrar_producto' );



    //Cambio cart

    function cambio_cart() {

        WC()->cart->calculate_totals();

        echo wc_get_template( 'cart/cart-totals.php' );

        wp_die();

    }

    add_filter( 'wp_ajax_cambio_cart', 'cambio_cart' );

    add_filter( 'wp_ajax_nopriv_cambio_cart', 'cambio_cart' );



    //Cambio carrito

    function cambio_minicart() {

        echo wc_get_template( 'cart/mini-cart.php' );

        wp_die();

    }

    add_filter( 'wp_ajax_cambio_minicart', 'cambio_minicart' );

    add_filter( 'wp_ajax_nopriv_cambio_minicart', 'cambio_minicart' );



    //Cambio botón carrito

    function cambio_boton_minicart() {

        $cantidad = WC()->cart->get_cart_contents_count();

        $total = WC()->cart->total."€";

        $data = array('cantidad' => $cantidad, 'total' => $total);

        echo wp_send_json($data);

        wp_die();

    }

    add_filter( 'wp_ajax_cambio_boton_minicart', 'cambio_boton_minicart' );

    add_filter( 'wp_ajax_nopriv_cambio_boton_minicart', 'cambio_boton_minicart' );









     //-------------------------------------------------------------- Login

    function woo_login(){

        //check_ajax_referer( 'ajax-login-nonce', 'security' );

        $info = array();

        $info['user_login'] = $_POST['user'];

        $info['user_password'] = $_POST['pass'];

        $info['remember'] = true;

        $user_signon = wp_signon( $info, false );

        if ( is_wp_error($user_signon) ){

            echo json_encode(array('loggedin'=>false, 'message'=>__('Usuario o contraseña incorrecta','esgalla')));

        } else {

            $customer = new WC_Customer($user_signon->ID);
            if($customer) {
                $last_order = $customer->get_last_order();
                $translation_array = array(
                    'userId' => $user_signon->ID,
                    'lastLogin' => null,
                    'firstLogin' => get_userdata($user_signon->ID)->user_registered,
                    'lastPurchase' => ($last_order) ? $last_order->order_date : null,
                );
            }else{
                $translation_array = [];
            }

            echo json_encode(array('loggedin'=>true, 'user'=> $translation_array, 'message'=>__('Login correcto. Redirigiendo...','esgalla')));

        }

        wp_die();

    }

    add_action('wp_ajax_woo_login', 'woo_login');

    add_action('wp_ajax_nopriv_woo_login', 'woo_login');







?>