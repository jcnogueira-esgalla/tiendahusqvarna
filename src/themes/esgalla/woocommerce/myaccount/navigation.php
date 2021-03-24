<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

//Esgalla 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation mt-4 mt-md-5 mb-3">
    <div class="col-12">
        
            <div class="myaccount-name mb-3 mb-md-4 fs-2-0"><?php printf(__( 'Hola %1$s', 'esgalla' ),'<strong>'.wp_get_current_user()->display_name.'</strong>')?></div>
        
    
    
            <ul class=" myaccount-nav">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <li class="d-inline-block mr-3 mb-3 <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                        <a class="boton text-white bg-primary py-2 px-4" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        
    </div>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
