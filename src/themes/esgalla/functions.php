<?php
/**
 * Esgalla functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Esgalla
 */
include("func/shortcodes.php");
include("func/registro-elementos.php");
if(class_exists('WooCommerce')) {
    include("func/woocommerce-ajax.php");
    include("func/woocommerce-esgalla.php");
}

if ( ! function_exists( 'esgalla_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function esgalla_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on esgalla, use a find and replace
		 * to change 'esgalla' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'esgalla', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu().
		register_nav_menus( array(
			'primary'      => esc_html__( 'Menú Principal', 'esgalla' ),
			'mobile'       => esc_html__( 'Menú Movíl', 'esgalla' ),
			'footer'       => esc_html__( 'Menú Footer', 'esgalla' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'esgalla_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function esgalla_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'esgalla_content_width', 740 );
}
add_action( 'after_setup_theme', 'esgalla_content_width', 0 );


if ( ! function_exists( 'esgalla_header_menu' ) ) :
/**
 * Header menu (should you choose to use one)
 */
function esgalla_header_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'menu'              => esc_html__( 'Menú Principal', 'esgalla' ),
		'menu_class'        => 'navbar-nav ml-auto',
		'theme_location'    => 'primary',
		'container'       	=> 'div',
		'container_id'    	=> 'navbarSupportedContent',
		'container_class' 	=> 'collapse navbar-collapse',
		'depth'             => 2,
		'fallback_cb'    		=> 'WP_Bootstrap_Navwalker::fallback',
		'walker'         		=> new WP_Bootstrap_Navwalker(),
		'items_wrap' 				=> '<div class="d-flex justify-content-between"><img src="'.get_stylesheet_directory_uri().'/img/logo-mobile.png" class=""/>
							<a class="navbar navbar-fixed-top" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
					            <i class="fas fa-times fs-fa text-secondary"></i>
					        </a></div>		<div class="buscador-principal mt-4"><form role="search" method="get" class="search-form input-group border" action="/">
									<input type="search" data-swpengine="default" lass="form-control" placeholder="' . __("¿Qué estás buscando?","esgalla") . '" value="" name="s" data-swplive="true">
									<button class="btn btn-secondary rounded shadow font-weight-bold text-uppercase" style="width: auto;" type="submit">' . __("Buscar","esgalla") . '</button>
								</form></div><ul id="%1$s" class="%2$s"><p class="h3 font-weight-bold mt-3">' . __("Menú","esgalla") . '</p>%3$s</ul>
					        <div class="selector-idioma"></div>
									<div class="pt-3"><p class="h3 font-weight-bold mt-3 mb-4">Contacto</p><a href="tel:'.str_replace(' ', '', __("+34 981 680 101", "esgalla")).'" class="text-secondary font-weight-bold h6 w-100 d-block"><i class="fas fa-phone pr-sm-2"></i>'.__("+34 981 680 101", "esgalla").'</a><a href="mailto:'.__("soportecliente@tiendahusqvarna.com", "esgalla").'" class="text-secondary font-weight-bold h6 w-100 d-block word-break-all mt-3"><i class="fas fa-envelope pr-2"></i>'.__("soportecliente@tiendahusqvarna.com", "esgalla").'</a>
									<div class="mt-4">
									<a href="' . __("https://www.facebook.com/Husqvarna.es", "esgalla") . '" target="_blank"><i class="fab fa-facebook text-secondary fs-fa pr-3"></i></a>
									<a href="' . __("https://www.instagram.com/husqvarna_es/", "esgalla") . '" target="_blank"><i class="fab fa-instagram text-secondary fs-fa pr-3"></i></a>
									<a href="' . __("https://www.youtube.com/user/HusqvarnaSpain", "esgalla") . '" target="_blank"><i class="fab fa-youtube text-secondary fs-fa pr-3"></i></a>
									</div>
									</div>'

	));
} /* end esgalla header menu */
endif;

if ( ! function_exists( 'esgalla_mobile_menu' ) ) :
/**
 * Mobile menu
 */
function esgalla_mobile_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'menu'              => esc_html__( 'Menú Movíl', 'esgalla' ),
		'menu_class'        => 'navbar-nav ml-auto',
		'theme_location'    => 'mobile',
		'container'       	=> 'div',
		'container_id'    	=> 'navbarSupportedContent',
		'container_class' 	=> 'collapse navbar-collapse',
		'depth'             => 2,
		'fallback_cb'    	=> 'WP_Bootstrap_Navwalker::fallback',
		'walker'         	=> new WP_Bootstrap_Navwalker()

	));
} /* end esgalla mobile menu */
endif;

if ( ! function_exists( 'esgalla_footer_menu' ) ) :
/**
 * Footer menu
 */
function esgalla_footer_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'menu'              => esc_html__( 'Menú Pié de Página', 'esgalla' ),
		'menu_class'        => 'navbar-nav ml-auto',
		'theme_location'    => 'footer',
		'container'       	=> 'div',
		'container_id'    	=> 'navbarSupportedContent',
		'container_class' 	=> 'collapse navbar-collapse',
		'depth'             => 1,
		'fallback_cb'    	=> 'WP_Bootstrap_Navwalker::fallback',
		'walker'         	=> new WP_Bootstrap_Navwalker()

	));
} /* end esgalla footer menu */
endif;


/**
 * Register footer widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function esgalla_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'esgalla' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'esgalla' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// First footer widget area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( 'First Footer Widget Area', 'esgalla' ),
		'id' => 'first-footer-widget-area',
		'description' => esc_html__( 'The first footer widget area', 'esgalla' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( 'Second Footer Widget Area', 'esgalla' ),
		'id' => 'second-footer-widget-area',
		'description' => esc_html__( 'The second footer widget area', 'esgalla' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( 'Third Footer Widget Area', 'esgalla' ),
		'id' => 'third-footer-widget-area',
		'description' => esc_html__( 'The third footer widget area', 'esgalla' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( 'Fourth Footer Widget Area', 'esgalla' ),
		'id' => 'fourth-footer-widget-area',
		'description' => esc_html__( 'The fourth footer widget area', 'esgalla' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'esgalla_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function esgalla_scripts() {

	if ( !is_admin() ) {

		// Add theme default CSS
		wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/custom.css' );
		wp_enqueue_style( 'esgalla-style', get_stylesheet_uri(), array() );
		// wp_enqueue_style( 'fa-css', get_template_directory_uri() . '/css/font-awesome/fontawesome.min.css' );

		//wp_enqueue_style( 'fa-css', get_template_directory_uri() . '/css/font-awesome/all.min.css' );
		


		


		// Main theme related functions
		wp_enqueue_script('popper-js', get_template_directory_uri() . '/js/popper.min.js', array('jquery') );
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );

		wp_enqueue_script('core-js', get_template_directory_uri() . '/js/core.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'slickjs', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), false, false);

		wp_enqueue_script( 'functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), false, true );

		// Main js file
		wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/js/scripts.js', array('jquery') );

		// Multiselect jQuery
		wp_enqueue_script( 'multiselect-js', get_template_directory_uri() . '/js/jquery.multi-select.js', array('jquery') );

		//Woocommerce
		//wp_enqueue_script( 'js-woocommerce', get_template_directory_uri() . '/js/woocommerce-esgalla.js', array('jquery'), '1.01', true );
		if(class_exists('WooCommerce')) {
            wp_register_script( 'woo-js', get_template_directory_uri().'/js/tienda.js', array('jquery'), '1.0.3' );
            wp_localize_script( 'woo-js', 'js_params_woo', array(
              'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
            ) );
            wp_enqueue_script( 'woo-js' );
            wp_dequeue_script( 'selectWoo');
            wp_deregister_script('selectWoo');
        } else {
					wp_enqueue_script('tienda-js', get_template_directory_uri() . '/js/tienda.js', array('jquery'), '', true );
				}


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'esgalla_scripts' );


function custom_admin_style() {
	if( (current_user_can('administrator') && wp_get_current_user()->user_login != 'esgalla') ) {
  	wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
	}
}
add_action('admin_enqueue_scripts', 'custom_admin_style');


/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */
function smartwp_remove_wp_block_library_css(){

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS

}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

//-------------------------------------------------------------- Añadimos favicon
    function head_favicon(){
    ?>
      <!-- generics -->
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-32.png" sizes="32x32">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-57.png" sizes="57x57">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-76.png" sizes="76x76">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-86.png" sizes="86x86">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-120.png" sizes="120x120">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-128.png" sizes="128x128">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-152.png" sizes="152x152">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-180.png" sizes="180x180">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-192.png" sizes="192x192">
      <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-husqvarna-228.png" sizes="228x228">
    <?php
    };
    add_action('wp_head', 'head_favicon');

/******************************************************************************************************************************   WOOCOMMERCE */

//Funcionaes de la galería de imágenes

    add_theme_support( 'wc-product-gallery-zoom' );

    //add_theme_support( 'wc-product-gallery-lightbox' );

    add_theme_support( 'wc-product-gallery-slider' );



	 function ec_get_template_part($parte1, $parte2 = null, $variables = null) {
	 	if ($variables && count($variables)) {
	 		foreach ($variables as $nombre => $valor) {
	 			set_query_var( $nombre, $valor );
	 		}
	 	}
	 	get_template_part($parte1, $parte2);
	 }


	 function my_searchwp_basic_auth_creds() {
	 	$credentials = array(
	 		'username' => 'admin', // the HTTP BASIC AUTH username
	 		'password' => 'TMmO9vIC98vi'  // the HTTP BASIC AUTH password
	 	);
	 	return $credentials;
	 }
	 add_filter( 'searchwp_basic_auth_creds', 'my_searchwp_basic_auth_creds' );



// Ocultamos la financiación de Caixabank si el importe es menor de 150€ o mayor de 3000€
add_filter( 'woocommerce_available_payment_gateways', 'conditionally_hide_payment_gateways', 100, 1 );
function conditionally_hide_payment_gateways( $available_gateways ) {
	$cartTotals = WC()->cart->cart_contents_total;

	if( is_checkout() && ! is_wc_endpoint_url() && ($cartTotals < 150 || $cartTotals > 3000) ) {
		// Disable WC_Caixabank_Financiacion
		if( isset($available_gateways['caixabankfin']) ) {
				unset($available_gateways['caixabankfin']);
		}
	}

	return $available_gateways;
}

//Remove shop link from Yoast breadcrumb
add_filter('wpseo_breadcrumb_single_link' , 'remove_shop_from_breadcrumb', 10 ,2);
function remove_shop_from_breadcrumb($link_output, $link ){
if( $link['text'] == 'Tienda' || $link['text'] == 'Loja' ) {
$link_output = '';
}
return $link_output;
}


//Crear custom field para la eco tasa
function woo_create_custom_field() {
	$args = array(
		'id' => 'eco_tasa',
		'label' => __( 'Eco Tasa', 'Esgalla' ),
		'class' => 'ecotasa-custom-field',
		'desc_tip' => true,
		'type' => 'number',
		'custom_attributes' => array(
			'min'	=> '0',
			'step' => 0.01
		),
		'description' => __( 'Importe de la Eco Tasa.', 'Esgalla' ),
	);
	woocommerce_wp_text_input( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'woo_create_custom_field' );

function woo_save_custom_field( $post_id ) {
	$product = wc_get_product( $post_id );
	$title = isset( $_POST['eco_tasa'] ) ? $_POST['eco_tasa'] : '';
	$product->update_meta_data( 'eco_tasa', sanitize_text_field( $title ) );
	$product->save();
 }
 add_action( 'woocommerce_process_product_meta', 'woo_save_custom_field' );


// function add_cors_http_header(){
// 	header("Access-Control-Allow-Origin: *");
// }
// add_action('init','add_cors_http_header');

add_filter('wpseo_breadcrumb_single_link', 'remove_shop', 10 ,2);
	function remove_shop($link_output, $link ){
	if( $link['text'] ==  'Shop' ) {
		$link_output = '';
	}
	return $link_output;
}


add_filter('woocommerce_show_variation_price', function() {return true;});





// Actualiza automáticamente el estado de los pedidos PROCESANDO a COMPLETADO
add_action( 'woocommerce_order_status_processing', 'actualiza_estado_pedidos_a_completado' );
// add_action( 'woocommerce_order_status_on-hold', 'actualiza_estado_pedidos_a_completado' );
function actualiza_estado_pedidos_a_completado( $order_id ) {
	global $woocommerce;

	//ID's de las pasarelas de pago a las que afecta, te lo explico a continuación
	$paymentMethods = array( 'paypal' );

	if ( !$order_id ) return;
	$order = new WC_Order( $order_id );

	if ( !in_array( $order->payment_method, $paymentMethods ) ) return;
	$order->update_status( 'completed' );
}


add_filter( 'woocommerce_package_rates', 'bbloomer_unset_shipping_when_free_is_available_all_zones', 9999, 2 );
function bbloomer_unset_shipping_when_free_is_available_all_zones( $rates, $package ) {
   $all_free_rates = array();
   foreach ( $rates as $rate_id => $rate ) {
      if ( 'free_shipping' === $rate->method_id ) {
         $all_free_rates[ $rate_id ] = $rate;
         break;
      }
   }
   if ( empty( $all_free_rates )) {
      return $rates;
   } else {
      return $all_free_rates;
   } 
}

//Ordenar por precio ASC cuando sea Automower
add_filter('woocommerce_default_catalog_orderby', 'order_automower_price_asc');
function order_automower_price_asc( $sort_by ) {
	if( is_product_category('automower') || is_product_category('robots-automower') || is_product_category('robos-automower') ) {
		return 'price';
	} else {
		return $sort_by;
	}
}


if(get_current_blog_id() == 2) {
	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
	add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
	add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );

	function custom_override_checkout_fields( $fields ) {
		unset($fields['billing']['billing_state']);
		unset($fields['shipping']['shipping_state']);
		return $fields;
	}

	function custom_override_billing_fields( $fields ) {
		unset($fields['billing_state']);
		return $fields;
	}

	function custom_override_shipping_fields( $fields ) {
		unset($fields['shipping_state']);
		return $fields;
	}

}

//Validacion NIFs
if(get_current_blog_id() == 1) {	//Solo España
	//Validando el campo NIF/CIF
	function validar_nifcifnie_esp() {
		$falso = true;

		if ( isset( $_POST['billing_numero_documento'] ) ) {
			$nif = strtoupper( $_POST['billing_numero_documento'] );
			for ( $i = 0; $i < 9; $i ++ ) {
				$num[$i] = substr( $nif, $i, 1 );
			}
			if ( !preg_match( '/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $nif ) ) { //No tiene formato válido
				$falso = true;
			}
			if ( preg_match( '/(^[0-9]{8}[A-Z]{1}$)/', $nif ) ) {
				if ( $num[8] == substr( 'TRWAGMYFPDXBNJZSQVHLCKE', substr( $nif, 0, 8 ) % 23, 1 ) ) { //NIF válido
					$falso = false;
				}
			}
			$suma = $num[2] + $num[4] + $num[6];
			for ( $i = 1; $i < 8; $i += 2 ) {
				$suma += substr( ( 2 * $num[$i] ), 0, 1 ) + substr( ( 2 * $num[$i] ), 1, 1 );
			}
			$n = 10 - substr( $suma, strlen( $suma ) - 1, 1 );
			if ( preg_match( '/^[KLM]{1}/', $nif ) ) { //NIF especial válido
				if ( $num[8] == chr( 64 + $n ) ) {
					$falso = false;
				}
			}
			if ( preg_match( '/^[ABCDEFGHJNPQRSUVW]{1}/', $nif ) ) {
				if ( $num[8] == chr( 64 + $n ) || $num[8] == substr( $n, strlen( $n ) - 1, 1 ) ) { //CIF válido
					$falso = false;
				}
			}
			if ( preg_match( '/^[T]{1}/', $nif ) ) {
				if ( $num[8] == preg_match( '/^[T]{1}[A-Z0-9]{8}$/', $nif ) ) { //NIE válido (T)
					$falso = false;
				}
			}
			if ( preg_match( '/^[XYZ]{1}/', $nif ) ) { //NIE válido (XYZ)
				if ( $num[8] == substr( 'TRWAGMYFPDXBNJZSQVHLCKE', substr( str_replace( array( 'X','Y','Z' ), array( '0','1','2' ), $nif ), 0, 8 ) % 23, 1 ) ) {
					$falso = false;
				}
			}
		}

		if ( $falso ) {
			wc_add_notice( __( 'Por favor, introduzca un NIF/CIF válido. No introduzcas espacios ni caracteres especiales.' ), 'error' );
		}
	}
	add_action( 'woocommerce_checkout_process', 'validar_nifcifnie_esp' );

	//Validando el campo NIF/CIF
	function validar_telefono_esp() {
		$falso = false;

		if ( isset( $_POST['billing_phone'] ) ) {
			$tlf = $_POST['billing_phone'];

			//Validamos que el teléfono sea español
			$input = str_replace(array(" ","-"),"",$tlf);
			$pattern = "/^(\+34|0034|34)?[9|8|6|7][0-9]{8}$/";
			if(!preg_match( $pattern, $input )){
				$falso = true;
			}
		}

		if ( $falso ) {
			wc_add_notice( __( 'Por favor, añade un número de teléfono válido de España.' ), 'error' );
		}
	}
	add_action( 'woocommerce_checkout_process', 'validar_telefono_esp' );
}
if(get_current_blog_id() == 2) {	//Solo Portugal
	//Validando el campo NIF
	function validar_nifcifnie_por() {
		if ( isset( $_POST['billing_numero_documento'] ) ) {
			$nif = strtoupper( $_POST['billing_numero_documento'] );
			$err = true;
			//Limpamos eventuais espaços a mais
			$nif = trim( $nif );
			//Verificamos se é numérico e tem comprimento 9
			if ( !is_numeric( $nif ) || strlen( $nif ) != 9 ) {
				$err = true;
			} else {
				$nifSplit = str_split( $nif );
				//O primeiro digíto tem de ser 1, 2, 5, 6, 8 ou 9
				//Ou não, se optarmos por ignorar esta "regra"
				if (in_array( $nifSplit[0], array( 1, 2, 3, 5, 6, 8, 9 ) ) || $ignoreFirst) {
					//Calculamos o dígito de controlo
					$checkDigit=0;
					for( $i=0; $i<8; $i++ ) {
						$checkDigit += $nifSplit[$i] * ( 10-$i-1 );
					}
					$checkDigit = 11 - ( $checkDigit % 11 );
					//Se der 10 então o dígito de controlo tem de ser 0
					if( $checkDigit >= 10 ) $checkDigit = 0;
					//Comparamos com o último dígito
					if ( $checkDigit == $nifSplit[8] ) {
						$err = false;
					} else {
						$err = true;
					}
				} else {
					$err = true;
				}
			}

			if ( $err ) {
				wc_add_notice( __( 'Insira um NIF válido. Não insira espaços ou caracteres especiais.' ), 'error' );
			}
		}

	}
	add_action( 'woocommerce_checkout_process', 'validar_nifcifnie_por' );
}
add_action( 'wp_footer', 'limitar_dni_caracteres');
function limitar_dni_caracteres() {
	if ( is_checkout() ) { ?>
		<script>jQuery('#billing_numero_documento').attr('maxlength', 9);</script>
	<? }
}
//Validacion NIFs


/* Campos extra en form registro */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {	//Validar campos
	if ( isset( $_POST['billing_birthdate'] ) && empty( $_POST['billing_birthdate'] ) ) {	//Fecha de nacimiento
		$validation_errors->add( 'billing_birthdate_error', __( 'Fecha de nacimiento es un campo requerido.', 'esgalla' ) );
	}
}
//add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_save_extra_register_fields( $customer_id ) {	//Guardar campos
	//if ( isset( $_POST['billing_birthdate'] ) ) {
		// WooCommerce billing birthdate.
		//update_user_meta( $customer_id, 'billing_birthdate', sanitize_text_field( $_POST['billing_birthdate'] ) );
	//}
	if ( isset( $_POST['comunicaciones_comerciales'] ) && $_POST['comunicaciones_comerciales'] == 1 ) {
		update_user_meta( $customer_id, 'comunicaciones_comerciales', sanitize_text_field( $_POST['comunicaciones_comerciales'] ) );
	}
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );


//Añadimos el campo fecha de nacimiento a la parte admin
// @param WP_User $user
function custom_user_profile_fields( $user ) { ?>
	<table class="form-table">
		<tr>
			<th>
				<label for="billing_birthdate"><?php _e( 'Fecha de nacimiento', 'esgalla' ); ?></label>
			</th>
			<td>
				<input type="date" name="billing_birthdate" id="reg_billing_birthdate" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_birthdate', true ) ); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<table class="form-table">
		<tr>
			<th>
				<label for="comunicaciones_comerciales"><?php _e( 'Deseo recibir comunicaciones comerciales', 'esgalla' ); ?></label>
			</th>
			<td>
				<input type="checkbox" name="comunicaciones_comerciales" id="reg_comunicaciones_comerciales" value="true" <? if(get_user_meta( $user->ID, 'comunicaciones_comerciales', true ) == '1') echo 'checked'; ?> />
			</td>
		</tr>
	</table>
<?php }
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');


function update_extra_profile_fields( $user_id ) {
	if ( current_user_can( 'edit_user', $user_id ) ) {
		update_user_meta( $user_id, 'billing_birthdate', $_POST['billing_birthdate'] );
		if($_POST['comunicaciones_comerciales']) {
			update_user_meta( $user_id, 'comunicaciones_comerciales', '1' );
		} else {
			update_user_meta( $user_id, 'comunicaciones_comerciales', '0' );
		}
	}
}
add_action( 'personal_options_update', 'update_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );


//Añadimos el campo fecha de nacimiento a la parte pública
add_action( 'woocommerce_edit_account_form', 'add_birthdate_to_edit_account_form' );
function add_birthdate_to_edit_account_form() {
	$user = wp_get_current_user();
	?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_billing_birthdate"><?php _e( 'Fecha de nacimiento', 'esgalla' ); ?></label>
			<input type="date" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_birthdate" id="reg_billing_birthdate" value="<?php echo esc_attr( $user->billing_birthdate ); ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_comunicaciones_comerciales"><?php _e( 'Deseo recibir comunicaciones comerciales', 'esgalla' ); ?></label>
			<input type="checkbox" class="woocommerce-Input woocommerce-Input--text input-text" style="width: auto;margin-right: auto;margin-left: 12px;" name="comunicaciones_comerciales" id="reg_comunicaciones_comerciales" value="true" <? if($user->comunicaciones_comerciales == '1') echo 'checked'; ?> />
		</p>
	<?php
}

// Save the custom field 'birthdate' 
add_action( 'woocommerce_save_account_details', 'save_birthdate_account_details', 12, 1 );
function save_birthdate_account_details( $user_id ) {
	// For Fecha de nacimiento
	if( isset( $_POST['billing_birthdate'] ) )
		update_user_meta( $user_id, 'billing_birthdate', sanitize_text_field( $_POST['billing_birthdate'] ) );

	if( isset( $_POST['comunicaciones_comerciales'] ) )
		update_user_meta( $user_id, 'comunicaciones_comerciales', '1' );
	else
		update_user_meta( $user_id, 'comunicaciones_comerciales', '0' );

}


//Add birthdate to checkout billing form
add_filter( 'woocommerce_checkout_fields' , 'add_birthdate_to_checkout_form' );
// Our hooked in function – $fields is passed via the filter!
function add_birthdate_to_checkout_form( $fields ) {
	$fields['billing']['billing_birthdate'] = array(
		'label'     => __( 'Fecha de nacimiento', 'esgalla' ),
		'placeholder'   => __( 'Fecha de nacimiento', 'esgalla' ),
		'required'  => true,
		'class'     => array('form-row-wide'),
		'clear'     => true,
		'type'			=> 'date'
		);
	return $fields;
}


//Add info a productos combustión del carrito
add_filter( 'woocommerce_checkout_cart_item_quantity', 'qty_input_field_on_checkout', 20, 3 );
function qty_input_field_on_checkout( $quantity_html, $cart_item, $cart_item_key ) {
	$product_id = $cart_item['product_id'];
	$categorias_combustion = [
		//ES
		'motosierras-gasolina',
		'cortacesped-gasolina',
		'rider-gasolina-riders',
		'tractores-cortacesped-gasolina',
		'cortasetos-gasolina',
		'desbrozadoras-gasolina',
		'motoazadas-gasolina',
		'soplador-gasolina',
		'motobombas-generadores',
		//PT
		'gasolina',
		'corta-sebes-gasolina',
		'geradores',
		'motoenxadas',
		'motosserras-a-gasolina',
		'rocadoras-gasolina',
		'sopradores-gasolina',
	];

	$quantity_string = '';
	if(has_term($categorias_combustion, 'product_cat', $product_id)) {
		if(get_current_blog_id() == 1) {	//España
			$quantity_string = '<strong class="product-quantity">×&nbsp;' . $cart_item['quantity'] . '&nbsp;
			<a href="javascript:void(0)" class="link-popover" data-toggle="popover" data-placement="top" data-container="body" title="" data-content="Este producto necesita ser regulado por un Distribuidor Oficial Husqvarna antes del primer uso. <a href=\'https://tiendahusqvarna.com/terminos-y-condiciones/#info-garantias\' target=\'_blank\'>Más info</a>">
				<i class="fas fa-info-circle text-primary"></i>
			</a></strong>';
		} else if(get_current_blog_id() == 2) {	//Portugal
			$quantity_string = '<strong class="product-quantity">×&nbsp;' . $cart_item['quantity'] . '&nbsp;
			<a href="javascript:void(0)" class="link-popover" data-toggle="popover" data-placement="top" data-container="body" title="" data-content="Este produto deve ser verificado por um Revendedor Oficial Husqvarna antes do primeiro uso. <a href=\'https://lojahusqvarna.com/termos-e-condicoes/#info-garantias\' target=\'_blank\'>Mais info</a>">
				<i class="fas fa-info-circle text-primary"></i>
			</a></strong>';
		}
	} else {
		$quantity_string = '<strong class="product-quantity">×&nbsp;' . $cart_item['quantity'] . '</strong>';
	}

	return $quantity_string;
}


add_action( 'woocommerce_order_item_meta_end', 'add_aviso_linea_producto_email_pedido_procesando_y_completado', 10, 3 );
function add_aviso_linea_producto_email_pedido_procesando_y_completado( $item_id, $item, $order = null ){
	$refNameGlobalsVar = $GLOBALS;
	$email_id = $refNameGlobalsVar['email_id_str'];
	$product_id = $item->get_variation_id() > 0 ? $item->get_variation_id() : $item->get_product_id();
	$categorias_combustion = [
		//ES
		'motosierras-gasolina',
		'cortacesped-gasolina',
		'rider-gasolina-riders',
		'tractores-cortacesped-gasolina',
		'cortasetos-gasolina',
		'desbrozadoras-gasolina',
		'motoazadas-gasolina',
		'soplador-gasolina',
		'motobombas-generadores',
		//PT
		'gasolina',
		'corta-sebes-gasolina',
		'geradores',
		'motoenxadas',
		'motosserras-a-gasolina',
		'rocadoras-gasolina',
		'sopradores-gasolina',
	];

	if(has_term($categorias_combustion, 'product_cat', $product_id)) {
		echo '&nbsp;<span style="color:#F35321;font-weight:bold;font-size: 20px;">*</span>';
	}
}


add_action( 'woocommerce_email_after_order_table', 'add_aviso_email_pedido_procesando_y_completado', 20, 4 );
function add_aviso_email_pedido_procesando_y_completado( $order, $sent_to_admin, $plain_text, $email ) {
	foreach ( $order->get_items() as $item ) {
		// Product ID
		$product_id = $item->get_variation_id() > 0 ? $item->get_variation_id() : $item->get_product_id();
		$categorias_combustion = [
			//ES
			'motosierras-gasolina',
			'cortacesped-gasolina',
			'rider-gasolina-riders',
			'tractores-cortacesped-gasolina',
			'cortasetos-gasolina',
			'desbrozadoras-gasolina',
			'motoazadas-gasolina',
			'soplador-gasolina',
			'motobombas-generadores',
			//PT
			'gasolina',
			'corta-sebes-gasolina',
			'geradores',
			'motoenxadas',
			'motosserras-a-gasolina',
			'rocadoras-gasolina',
			'sopradores-gasolina',
		];
		if(has_term($categorias_combustion, 'product_cat', $product_id)) {
			if ( $email->id == 'customer_completed_order' || $email->id == 'customer_processing_order' ) {
				if(get_current_blog_id() == 1) {	//España
					echo '<p class="aviso-productos" style="font-weight:bold;margin-bottom:20px;"><span style="color:#F35321;font-weight:bold;font-size: 20px;">*</span> Este producto necesita ser regulado por un Distribuidor Oficial Husqvarna antes del primer uso. <a href="https://tiendahusqvarna.com/terminos-y-condiciones/#info-garantias" target="_blank">Más info</a></p>';
				}	else if(get_current_blog_id() == 2) {	//Portugal
					echo '<p class="aviso-productos" style="font-weight:bold;margin-bottom:20px;"><span style="color:#F35321;font-weight:bold;font-size: 20px;">*</span> Este produto deve ser verificado por um Revendedor Oficial Husqvarna antes do primeiro uso. <a href="https://lojahusqvarna.com/termos-e-condicoes/#info-garantias" target="_blank">Mais info</a></p>';
				}
			}
			break;
		}
	}
}


//Add cron para comprobar tabla de carritos abandonados y updatear fichero .txt

// add_action('evento_10_min', 'comprobar_tabla_carritos');
add_action( 'comprobar_tabla_carritos', 'comprobar_tabla_carritos' );
function comprobar_tabla_carritos() {
	// do something every hour

	// NOMBRE FICHERO: husqvarna_abandonedcarts_online_AAAAMMDD.csv
	// CABECERA FICHERO: order_id;customer_key;store_id;order_date;shipping_amount;discount_amount;tax_amount;total_amount;currency;url_carrito

	// NOMBRE FICHERO: husqvarna_ordersitems_carritos_AAAAMMDD.csv
	// CABECERA FICHERO: order_id;product_id;unit_price;quantity;discount_amount;tax_amount;total_line_amount;currency;img_producto;url_producto;nombre_producto

	$filename_cart = WP_CONTENT_DIR . '/carritos/ES/husqvarna_abandonedcarts_online_' . date('Ymd') . '.csv';
	$filename_cart_lines = WP_CONTENT_DIR . '/carritos/ES/husqvarna_ordersitems_carritos_' . date('Ymd') . '.csv';

	//Comprobamos si existe
	if( !file_exists($filename_cart) ) {
		//No existe. Lo creamos con sus cabeceras.
		$open = fopen($filename_cart, "a");
		$cabecera_carritos = 'order_id;customer_key;store_id;order_date;shipping_amount;discount_amount;tax_amount;total_amount;currency;url_carrito' . "\r\n";
		$write = fputs($open, $cabecera_carritos);
		fclose($open);
	}
	if( !file_exists($filename_cart_lines) ) {
		//No existe. Lo creamos con sus cabeceras.
		$open = fopen($filename_cart_lines, "a");
		$cabecera_items_carritos = 'order_id;product_id;unit_price;quantity;discount_amount;tax_amount;total_line_amount;currency;img_producto;url_producto;nombre_producto' . "\r\n";
		$write = fputs($open, $cabecera_items_carritos);
		fclose($open);
	}
	//Pasamos el contenido de la tabla 'gKcN57I_cartbounty' al fichero
	global $wpdb;
	$table_name = $wpdb->prefix . "cartbounty";
	// Usamos el campito "mail_sent" para marcar cuales hemos enviado ya a Splio ya que
	// el plugin de recuperación de carritos nunca lo vamos a usar para enviar estos emails de recuperacion
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE mail_sent = 0" );
	$carrito = '';
	$items_carrito = '';
	$carritos_guardados = [];
	foreach ($retrieve_data as $retrieved_data) {
		if($retrieved_data->email) {
			//Creamos al usuario en splio para poder enviar su carrito a la plataforma
			createUserSplio($retrieved_data->name, $retrieved_data->surname, $retrieved_data->email, $retrieved_data->phone);

			$carrito .= $retrieved_data->id . ';' .
									$retrieved_data->email . ';' .
									'tiendahusqvarna.com' . ';' .
									$retrieved_data->time . ';' .
									'0' . ';' .
									'0' . ';' .
									'0' . ';' .
									$retrieved_data->cart_total . ';' .
									'EUR' . ';' .
									'https://tiendahusqvarna.com/finalizar-compra/' . "\r\n";
			$carritos_guardados[] = $retrieved_data->id;

			//Obtenemos los contenidos del carrito
			$cart_contents = maybe_unserialize($retrieved_data->cart_contents);
			foreach ($cart_contents as $cart_content) {
				if ($cart_content['product_variation_id'] != 0) {
					$product_id = $cart_content['product_variation_id'];
				} else {
					$product_id = $cart_content['product_id'];
				}

				$item_price = $cart_content['product_variation_price'] + $cart_content['product_tax'];
				$item_sku = get_post_meta( $product_id, '_sku', true );
				$items_carrito .= $retrieved_data->id . ';' .
													$item_sku . ';' .
													$item_price . ';' .
													$cart_content['quantity'] . ';' .
													'0' . ';' .
													'0' . ';' .
													$item_price * $cart_content['quantity'] . ';' .
													'EUR' . ';' .
													wp_get_attachment_image_src( get_post_thumbnail_id( $cart_content['product_id'] ), 'medium' )[0] . ';' .
													get_permalink($product_id) . ';' .
													$cart_content['product_title'] . "\r\n";
			}
		}
	}
	$update = $wpdb->query("UPDATE `$table_name` SET mail_sent = 1 WHERE id IN (" . implode(',', $carritos_guardados) . ")");



	//Escribo en fichero de carritos
	$open = fopen($filename_cart, "a");
	$write = fputs($open, $carrito);
	fclose($open);

	//Escribo en fichero de items de carritos
	$open = fopen($filename_cart_lines, "a");
	$write = fputs($open, $items_carrito);
	fclose($open);
	// $delete = $wpdb->query("TRUNCATE TABLE `$table_name`");
	// $delete = $wpdb->query("DELETE FROM `$table_name`");
	//FIN fichero carritos

}

add_action( 'mandar_csvs_a_splio', 'mandar_csvs_a_splio' );
function mandar_csvs_a_splio() {
	include( WP_CONTENT_DIR . '/../script_ftp/upload.php' );
	$cliente = curl_init();
	curl_setopt($cliente, CURLOPT_URL, "https://tiendahusqvarna.com/script_ftp/upload.php");
	curl_setopt($cliente, CURLOPT_HEADER, 0);
	curl_exec($cliente);
	curl_close($cliente);
}

function createUserSplio($user_name, $user_surname, $user_email, $user_phone) {
	//API key esgalla: b988fd0db0d0e16de45c516ccb4319d8bb25dbdf33b73c08680cfb16c0a231c5
	//eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiI5YWU1NTA5ZC01NDA4LTQyNzEtYWZiNi1iYTAyNjk3YTg0MzMiLCJzdWIiOiJ1c2VyIiwiYXVkIjoiYXBpLmNsaWVudCIsImlzX2FwaSI6dHJ1ZSwiZXhwIjoxNjM4NTQ3ODM5LCJpYXQiOjE2Mzg0NTc4MzksImp0aSI6IjEzMTYuNjFhOGUxZWY0MzZiNSIsIm5hbWUiOiJlc2dhbGxhIiwibG9jYWxlIjpudWxsLCJ1c2VyIjp7ImlkIjoxMzE2LCJ1bml2ZXJzZSI6Imh1c3F2YXJuYSJ9fQ.VuaZDujbqV5ahvFgyNThCij1vAt7H371jL9UR96Y4MMX0V-5XMH7rBsLWe8LZtYfRKVbOpRZljQ8POCI1vBT0n7Wt4mOGI92XYOgF1OikrNw_kOw8NUEaZ9qpfc9yJqZdProZpKJlqXzVkza6HVOGR8lfYyBtFY4zjDkSaJOTsIjjcDejxS6YTBnTmwfPGfQcstKN7V2B4mg_uEI2HZR2KXMoBHV0Yh2EM_2pd6xbB042-dRjlf4MJz2KNM5z2jSH1U9KWxwJuRijticLUsIdagZoBx5jmYCkOPhPtl3SCGpptgDSzFmQq3gJlIU_L8Pd2SE7Qcavi6vZxCrruJoymifdcH_r0XeS2bI2SguXNHaLd1vsKDHGXBgqy3tQB1Rkx1eNKgC-TfA_yMkzVqtYyxC6Ax1mTiHHynspHmpJYPAWrP6yodwnoK64CJA2phbowXAU2C0eVMSVbDGsYIJgyGgTIacqygQBBwXfrCffMI5N-DX1BnbnvSN_c3l4mDJYZiw9Dsfa_eA0hfrQi8nYf8D5TVlQg3siY2ZKjCcF8M7TAJuD8hXy_CWjG90oRNnO2xDQI7CGi2fyU5GpOcaHwfxSoqDHo_DaGLJdFTn6Ma6tRAjWWB1wD9JPFLjhdzyrOpRFeCdz-kcT2ZNS8bBo6NdPT7lI2bIpLvf3lsl-3Q
	
	//Solicitud token acceso - SPLIO
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.splio.com/authenticate');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"api_key\":\"b988fd0db0d0e16de45c516ccb4319d8bb25dbdf33b73c08680cfb16c0a231c5\"}");

	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$token = json_decode($result)->token;
	if (curl_errno($ch)) {
		return false;
	}
	curl_close($ch);

	//Creacion usuario - SPLIO
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.splio.com/data/contacts');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"double_optin\":{},\"email\":\"" . $user_email . "\",\"language\":\"es\",\"lists\":[{\"id\":2,\"name\":\"Prueba carritos\"}],\"lastname\":\"" . $user_surname . "\",\"firstname\":\"" . $user_name . "\",\"cellphone\":\"" . $user_phone . "\"}");

	
	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Authorization: Bearer ' . $token;
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		return false;
	}
	curl_close($ch);
	return true;

}

function add_user_to_splio_newsletter_list($user_name, $user_surname = '', $user_email, $user_provincia = '', $user_intereses = '', $user_tipo = '') {
	//API key esgalla: b988fd0db0d0e16de45c516ccb4319d8bb25dbdf33b73c08680cfb16c0a231c5
	//eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiI5YWU1NTA5ZC01NDA4LTQyNzEtYWZiNi1iYTAyNjk3YTg0MzMiLCJzdWIiOiJ1c2VyIiwiYXVkIjoiYXBpLmNsaWVudCIsImlzX2FwaSI6dHJ1ZSwiZXhwIjoxNjM4NTQ3ODM5LCJpYXQiOjE2Mzg0NTc4MzksImp0aSI6IjEzMTYuNjFhOGUxZWY0MzZiNSIsIm5hbWUiOiJlc2dhbGxhIiwibG9jYWxlIjpudWxsLCJ1c2VyIjp7ImlkIjoxMzE2LCJ1bml2ZXJzZSI6Imh1c3F2YXJuYSJ9fQ.VuaZDujbqV5ahvFgyNThCij1vAt7H371jL9UR96Y4MMX0V-5XMH7rBsLWe8LZtYfRKVbOpRZljQ8POCI1vBT0n7Wt4mOGI92XYOgF1OikrNw_kOw8NUEaZ9qpfc9yJqZdProZpKJlqXzVkza6HVOGR8lfYyBtFY4zjDkSaJOTsIjjcDejxS6YTBnTmwfPGfQcstKN7V2B4mg_uEI2HZR2KXMoBHV0Yh2EM_2pd6xbB042-dRjlf4MJz2KNM5z2jSH1U9KWxwJuRijticLUsIdagZoBx5jmYCkOPhPtl3SCGpptgDSzFmQq3gJlIU_L8Pd2SE7Qcavi6vZxCrruJoymifdcH_r0XeS2bI2SguXNHaLd1vsKDHGXBgqy3tQB1Rkx1eNKgC-TfA_yMkzVqtYyxC6Ax1mTiHHynspHmpJYPAWrP6yodwnoK64CJA2phbowXAU2C0eVMSVbDGsYIJgyGgTIacqygQBBwXfrCffMI5N-DX1BnbnvSN_c3l4mDJYZiw9Dsfa_eA0hfrQi8nYf8D5TVlQg3siY2ZKjCcF8M7TAJuD8hXy_CWjG90oRNnO2xDQI7CGi2fyU5GpOcaHwfxSoqDHo_DaGLJdFTn6Ma6tRAjWWB1wD9JPFLjhdzyrOpRFeCdz-kcT2ZNS8bBo6NdPT7lI2bIpLvf3lsl-3Q
	
	//Solicitud token acceso - SPLIO
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.splio.com/authenticate');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"api_key\":\"b988fd0db0d0e16de45c516ccb4319d8bb25dbdf33b73c08680cfb16c0a231c5\"}");

	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$token = json_decode($result)->token;
	if (curl_errno($ch)) {
		return false;
	}
	curl_close($ch);

	//Creacion usuario newsletter - SPLIO
	//Lista newsletter españa: 		5 - "Newsletter Tiendahusqvarna"
	//Lista newsletter portugal: 	6 - "Newsletter Lojahusqvarna"
	if( get_current_blog_id() == 1 ) {
		$id_lista = 5;
		$nombre_lista = 'Newsletter Tiendahusqvarna';
	} else {
		$id_lista = 6;
		$nombre_lista = 'Newsletter Lojahusqvarna';
	}

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.splio.com/data/contacts');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"double_optin\":{},\"email\":\"" . $user_email . "\",\"language\":\"es\",\"lists\":[{\"id\":" . $id_lista . ",\"name\":\"" . $nombre_lista . "\"}],\"lastname\":\"" . $user_surname . "\",\"firstname\":\"" . $user_name . "\",\"Provincia\":\"" . $user_provincia . "\"}");

	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Authorization: Bearer ' . $token;
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	// var_dump($result);
	if (curl_errno($ch)) {
		return false;
	}
	curl_close($ch);
	return true;

}

// add_action( 'gform_after_submission_1', 'newsletter_form_after_submission', 10, 2 );
function newsletter_form_after_submission( $entry, $form ) {
	$nombre = rgar( $entry, '1' );
	$email = rgar( $entry, '2' );
	$provincia = rgar( $entry, '3' );
	$intereses = rgar( $entry, '6' );
	$tipo_usuario = rgar( $entry, '4' );

	// echo $nombre;
	// echo $email;
	// echo $provincia;


	add_user_to_splio_newsletter_list($nombre, '', $email, $provincia, $intereses, $tipo_usuario);

}


include("func/analytics.php");


add_action( 'woocommerce_after_shipping_rate', 'action_after_shipping_rate', 20, 2 );
function action_after_shipping_rate ( $method, $index ) {
    // Targeting checkout page only:
    if( is_cart() ) return; // Exit on cart page

		if( get_current_blog_id() == 1 ) {
			echo '<p class="allow" style="font-size:12px;">Plazo de entrega 24/48h.</p>';
		} elseif( get_current_blog_id() == 2 ) {
			echo '<p class="allow" style="font-size:12px;">Prazo de entrega 48/72h.</p>';
		}
		
}

add_filter( 'woocommerce_cart_shipping_method_full_label', 'change_cart_shipping_method_full_label', 10, 2 );
function change_cart_shipping_method_full_label( $label, $method ) {
	if( $method->get_method_id() == 'flat_rate') {
		if( get_current_blog_id() == 1 ) {
			$label .= '&nbsp;(incluye&nbsp;<b>€1,04</b>&nbsp;de&nbsp;IVA)';
		} elseif( get_current_blog_id() == 2 ) {
			$label .= '&nbsp;(inclui&nbsp;<b>€1,12</b>&nbsp;de&nbsp;IVA)';
		}
	}
	return $label;
}