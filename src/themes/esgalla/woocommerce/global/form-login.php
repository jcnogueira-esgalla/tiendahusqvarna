<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-nospam woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

	<p class="woocommerce-msj-corto woocommerce-form-login-msj-corto m-3 bg-exito text-white"></p>

	<p class="form-row form-row-first">
		<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" autocomplete="username" />
	</p>
	<p class="form-row form-row-last">
		<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
	</p>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="form-row woocommerce-form__label-for-checkbox d-n">
		<label for="rememberme" class="inline">
			<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" checked/> 
			<span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
		</label>
	</p>

	<p class="form-row woocommerce-form__label-for-checkbox d-n">
		<label for="rememberme" class="inline">
			<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" checked/> 
			<?php (get_current_blog_id() == 1 ? _e( '<span>Autorizo el envío de comunicaciones relacionadas con campañas y mantenimientos respecto del producto que he adquirido</span>', 'woocommerce' ) : '')?>
		</label>
	</p>

	<p class="form-row">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<button type="submit" class="woocommerce-button btn btn-primary woocommerce-form-login__submit pos-r w-100 mt-30" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?> <div class="item-anim-carga"><span class="fa fa-spinner fa-spin fa-fw"></span></div></button>
	</p>

	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
