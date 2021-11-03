<?php



    add_action( 'after_setup_theme', 'woocommerce_support' );

    function woocommerce_support() {

        add_theme_support( 'woocommerce' );

    }





    //-------------------------------------------------------------------------------------------------- Añadimos losm elementos al footer



    function footer_woocommerce(){

    ?>

      <!--Minicart-->

      <div class="desplegable desplegable-lat desplegable-lat-der minicart" id="mini-cart">

        <div class="desplegable-lat-bloque">

          <div class="desplegable-lat-bloque-contain">

              <div class="mini-cart-content" id="mini-cart-content">

                  <?php woocommerce_mini_cart(); ?>

              </div>

          </div><!--desplegable-lat-bloque-contain-->

        </div><!--desplegable-lat-bloque-->

      </div><!--desplegable-lat-->

      <!--Usuario-->

      <?php if(!is_user_logged_in()): ?>

          <div class="popup popup-login" id="popup-login">

              <div class="popup-bloque">

                  <div class="popup-bloque-contain">

                          <span class="fs-0-9 d-b mb-30">
                          <?php
                              _e( 'Si ya ha comprado con nosotros, ingrese sus datos a continuación. Si es un cliente nuevo podrá registrarse al finalizar su primera compra o', 'esgalla');
                          ?>
                          <a class="fw-b td-u" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                            <?php _e('accediendo aquí', 'esgalla'); ?>
                          </a>
                          </span>

                          <?php

                          woocommerce_login_form(

                              array(

                                  'message'  => '',

                                  'redirect' => '',

                                  'hidden'   => false,

                              )

                          );

                      ?>

                  </div>

              </div>

          </div>

      <?php endif; ?>

    <?php

    };

    add_action('wp_footer', 'footer_woocommerce');



    //-------------------------------------------------------------------------------------------------- GTM

    function gtm_datos_product($product,$class="gtm-product-ficha", $variation_id = NULL, $quantity = ""){

        //Categorías

        $term_name = "";

        $primary_term = get_post_meta($product->get_id(), 'rank_math_primary_product_cat',true);

        $term = get_term_by("id",$primary_term,"product_cat");

        $term_name = ($term) ? $term->name : "";

        //ID

        $id = ($variation_id) ? $variation_id : $product->get_id();

        //$variation = ($product->get_variation_attributes()) ? implode( ',', $product->get_variation_attributes() ) : "";

        $variation = "";

        $bloque = '<div class="'.$class.' gtm-product-datos gtm-product-datos-'.$id.' d-n" data-gtm-product-id="'.$id.'" data-gtm-product-name="'.esc_html($product->get_name()).'" data-gtm-product-price="'.wc_get_price_including_tax($product).'" data-gtm-product-cat="'.$term_name.'" data-gtm-product-url="'.esc_url( $product->get_permalink() ).'" data-gtm-product-stocklevel="'.$product->get_max_purchase_quantity().'" data-gtm-product-cantidad="'.$quantity.'"></div>';

        return $bloque;

    }



    //-------------------------------------------------------------------------------------------------- Eliminar Recursos



    //Eliminar estilos

    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );



    //Eliminar Breadcrcumb

    function remove_shop_breadcrumbs(){

        if (is_shop()){remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);}

    }

    add_action('template_redirect', 'remove_shop_breadcrumbs' );





    //Eliminar elementos de before_main_content

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );



    //Eliminar elementos de before_single_product_summary

    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );



    //Eliminar elementos de single_product_summary

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);



    //Eliminar elementos de after_single_product_summary

    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );



    //Eliminar el texto de la política de privacidad en chekout

    remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );



    //Carrito

    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );

    add_filter( 'wc_add_to_cart_message_html', '__return_false' );

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');







    //-------------------------------------------------------------------------------------------------- Chekout



    //Añadir los campos requeridos inline

    function error_inline( $field, $key, $args, $value ) {

       if ( strpos( $field, '</p>' ) !== false && $args['required'] ) {

          $error = '<span class="input-nota input-error" style="display:none">';

          $error .= sprintf( __( '%s is a required field.', 'woocommerce' ), $args['label'] );

          $error .= '</span>';

          $field = substr_replace( $field, $error, strpos( $field, '</p>' ), 0);

       }



       return $field;

    }

    add_filter( 'woocommerce_form_field', 'error_inline', 10, 4 );





    ///Añadir los campos requeridos política privacidad

    function errores_aceptacion_privacidad_registro( $errors, $username, $email ) {

      if ( ! is_checkout() ) {

          if ( ! (int) isset( $_POST['privacy_policy_reg'] ) ) {

              $errors->add( 'privacy_policy_reg_error', __( 'Por favor, lee y acepta lá política de privacidad', 'esgalla' ) );

          }

      }

      return $errors;

    }

    add_filter( 'woocommerce_registration_errors', 'errores_aceptacion_privacidad_registro', 10, 3 );





    //-------------------------------------------------------------------------------------------------- Registro nuevo usuario



    //Añadir campo de aceptación de la política de privacidad en el campo de registro de nuevo usuario

    function add_aceptacion_privacidad_registro() {

      woocommerce_form_field( 'privacy_policy_reg', array(

         'type'          => 'checkbox',

         'class'         => array('form-row privacy'),

         'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),

         'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),

         'required'      => true,


         'label'         => (get_current_blog_id() == 1 ? '<span>'.__("He leído y acepto la ","esgalla").' <a href="/politica-de-privacidad">'.__("Política de Privacidad","esgalla").'</a> y el <a href="/aviso-legal">Aviso Legal </a> de INTERNACO S.A </span>' : '<span>Li e aceito a&nbsp;<a href="https://lojahusqvarna.com/politica-de-privacidade/" target="_blank">política de privacidade*</a></span>'),
        //  'label'        '<span>'.__("He leído y acepto la ","esgalla").' <a href="' . (get_current_blog_id() == 1 ? '/terminos-y-condiciones' : '/termos-e-condicoes') . '">'.__("Política de Privacidad","esgalla").'</a> y el <a href="/aviso-legal">Aviso Legal </a> de INTERNACO S.A </span>',


      ));


    }

    add_action( 'woocommerce_register_form', 'add_aceptacion_privacidad_registro', 11 );


    function add_aceptacion_comunicaciones_comerciales() {

      woocommerce_form_field( 'comunicaciones_comerciales', array(

         'type'          => 'checkbox',

         'class'         => array('form-row privacy'),

         'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),

         'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),

         'required'      => true,


         'label'         => (get_current_blog_id() == 1 ? '<span>Autorizo el envío de comunicaciones relacionadas con campañas y mantenimientos respecto del producto que he adquirido</span>' : ''),
        //  'label'        '<span>'.__("He leído y acepto la ","esgalla").' <a href="' . (get_current_blog_id() == 1 ? '/terminos-y-condiciones' : '/termos-e-condicoes') . '">'.__("Política de Privacidad","esgalla").'</a> y el <a href="/aviso-legal">Aviso Legal </a> de INTERNACO S.A </span>',


      ));


    }

    add_action( 'woocommerce_register_form', 'add_aceptacion_comunicaciones_comerciales', 11 );





    //-------------------------------------------------------------------------------------------------- Mi cuenta



    //Añadir pedidos al dassboard de mi cuenta

    function mi_cuenta_pedidos_escritorio() {

      $current_page = empty( $current_page ) ? 1 : absint( $current_page );

      $customer_orders = wc_get_orders( apply_filters( 'woocommerce_my_account_my_orders_query', array( 'customer' => get_current_user_id(), 'page' => $current_page, 'paginate' => true ) ) );



      wc_get_template(

        'myaccount/orders.php',

        array(

        'current_page' => absint( $current_page ),

        'customer_orders' => $customer_orders,

        'has_orders' => 0 < $customer_orders->total,

        )

      );

    }

    add_action( 'woocommerce_account_dashboard', 'mi_cuenta_pedidos_escritorio' );



    //Cambiamos el término "escritorio" de mi cuenta

    function mi_cuenta_renombrar_menus( $menu_links ){

      $menu_links['dashboard'] = __( 'Orders', 'woocommerce' );

      return $menu_links;

    }

     add_filter ( 'woocommerce_account_menu_items', 'mi_cuenta_renombrar_menus' );





    //-------------------------------------------------------------------------------------------------- WP All export



    //Mandar las categorías correctamente

    function export_product_cat($value){



        $product = wc_get_product($value);



        if($product->get_parent_id() != 0){

             $primary_term = get_post_meta($product->get_parent_id(), 'rank_math_primary_product_cat',true);

        }else{

            $primary_term = get_post_meta($value, 'rank_math_primary_product_cat',true);

        }



        $term_principal = get_term($primary_term,"product_cat");



          //si tiene padre

          $export_product_cat = "";

          if($term_principal->parent != 0){

            $term_padre = get_term($term_principal->parent,"product_cat");

            $export_product_cat = $term_padre->name." > ";

          }

          $export_product_cat .= $term_principal->name;



          return $export_product_cat;

    }



    function export_price($value){

      $product = wc_get_product($value);

      $price = wc_get_price_including_tax($product);

      return $price;

    }





	 /**

	  * Change number of products that are displayed per page (shop page)

	  */

	 add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );



	 function new_loop_shop_per_page( $cols ) {

	   // $cols contains the current number of products per page based on the value stored on Options –> Reading

	   // Return the number of products you wanna show per page.

	   $cols = 18;

	   return $cols;

	 }

