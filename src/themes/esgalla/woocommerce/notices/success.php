<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $messages ) {
	return;
}

?>


<div class="popup popup-wc-info" id="popup-message" role="alert">
    <div class="popup-bloque">
        <div class="popup-bloque-contain">
            <div class="wysiwyg">
                <?php foreach ( $messages as $message ) : ?>
                    <div class="woocommerce-message" role="alert">
                        <?php
                            echo wc_kses_notice( $message );
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="javascript:void(0)" class="desplegable-plegar btn-cerrar" data-obj="#popup-message"><span class="fa fa-times" aria-hidden="true"></span></a>
        </div>
        <a href="#" class="desplegable-fondo desplegable-plegar" data-obj="#popup-message"></a>
    </div>
</div>
