<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="row p-0">
    <div class="col-12 col-lg-6">
        <div class="p-3 p-md-4 bg-light mb-3">
            <div class="woocommerce-form-nospam">
                <div class="woocommerce-form-login-toggle fs-1-2">
                    <?php _e("¿Tienes una cuenta de usuario?","esgalla"); ?><a href="javascript:void(0)" class="desplegable-desplegar c-1 td-u fw-b d-ib ml-5" data-obj="#popup-login"><?php _e( 'Click here to login', 'woocommerce' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
