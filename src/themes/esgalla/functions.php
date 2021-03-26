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
									<input type="search" class="form-control" placeholder="' . __("¿Qué estás buscando?","esgalla") . '" value="" name="s" data-swplive="true">
									<button class="btn btn-secondary rounded shadow font-weight-bold text-uppercase" style="width: auto;" type="submit">' . __("Buscar","esgalla") . '</button>
								</form></div><ul id="%1$s" class="%2$s"><h3 class="mt-3">' . __("Menú","esgalla") . '</h3>%3$s</ul>
					        <div class="selector-idioma"></div>
									<div class="pt-3"><h3 class="mt-3 mb-4">Contacto</h3><a href="tel:'.str_replace(' ', '', __("+351 800 834137", "esgalla")).'" class="text-secondary font-weight-bold h6 w-100 d-block"><i class="fas fa-phone pr-sm-2"></i>'.__("+34 981 680 101", "esgalla").'</a><a href="mailto:'.__("soportecliente@tiendahusqvarna.com", "esgalla").'" class="text-secondary font-weight-bold h6 w-100 d-block word-break-all mt-3"><i class="fas fa-envelope pr-2"></i>'.__("soportecliente@tiendahusqvarna.com", "esgalla").'</a>
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
		wp_enqueue_style( 'fa-css', get_template_directory_uri() . '/css/font-awesome/fontawesome.min.css' );

		//wp_enqueue_style( 'fa-css', get_template_directory_uri() . '/css/font-awesome/all.min.css' );


		// Banner cookiesc
		wp_enqueue_style('cookies-css', get_template_directory_uri() . '/css/cookies.css' );
		wp_enqueue_script('cookies-js', get_template_directory_uri() . '/js/cookies.js', array('jquery'), '', true );


		// Main theme related functions
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );

		wp_enqueue_script('core-js', get_template_directory_uri() . '/js/core.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'slickjs', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), false, false);

		wp_enqueue_script( 'functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), false, true );

		// Main js file
		wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/js/scripts.js', array('jquery') );

		//Woocommerce
		//wp_enqueue_script( 'js-woocommerce', get_template_directory_uri() . '/js/woocommerce-esgalla.js', array('jquery'), '1.01', true );
		if(class_exists('WooCommerce')) {
            wp_register_script( 'woo-js', get_template_directory_uri().'/js/tienda.js', array('jquery'), true );
            wp_localize_script( 'woo-js', 'js_params_woo', array(
              'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
            ) );
            wp_enqueue_script( 'woo-js' );
            wp_dequeue_script( 'selectWoo');
            wp_deregister_script('selectWoo');
        }


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'esgalla_scripts' );


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


//Ordenar por precio ASC cuando sea Automower
add_filter('woocommerce_default_catalog_orderby', 'order_automower_price_asc');
function order_automower_price_asc( $sort_by ) {
	if( is_product_category('automower') ) {
		return 'price';
	} else {
		return $sort_by;
	}
}


if(get_current_blog_id() == 2) {
	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
	add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
	// add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );

	function custom_override_checkout_fields( $fields ) {
		unset($fields['billing']['billing_state']);
		return $fields;
	}

	function custom_override_billing_fields( $fields ) {
		unset($fields['billing_state']);
		return $fields;
	}

}

?>