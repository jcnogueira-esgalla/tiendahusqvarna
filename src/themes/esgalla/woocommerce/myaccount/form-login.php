<?php

/**

 * Login Form

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see     https://docs.woocommerce.com/document/template-structure/

 * @package WooCommerce/Templates

 * @version 3.6.0

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.

}



//Esgalla



do_action( 'woocommerce_before_customer_login_form' ); ?>



<div class="row mt-4 mt-md-6 mb-4 mb-md-5" id="customer_login">

	<div class="col-12 col-xl-6">

		<div class="border p-3 p-md-4">

			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-msj-corto woocommerce-form-login-msj-corto m-3 bg-exito text-white"></p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>

				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />

				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">

					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">

						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>

					</label>

					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">

						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="comunicaciones_comerciales" type="checkbox" id="comunicaciones_comerciales" value="1" /> 			<?php (get_current_blog_id() == 1 ? _e( '<span>Autorizo el envío de comunicaciones relacionadas con campañas y mantenimientos respecto del producto que he adquirido</span>', 'woocommerce' ) : '')?>

					</label>

					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

					<button type="submit" class="woocommerce-button btn btn-primary woocommerce-form-login__submit pos-r w-100 mt-30" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?><div class="item-anim-carga"><span class="fa fa-spinner fa-spin fa-fw"></span></div></button>

				</p>

				<p class="woocommerce-LostPassword lost_password">

					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>

				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>

	</div>



		



<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>



	<div class="col-12 col-xl-6 mt-3 mt-xl-0">

		<div class="border p-3 p-md-4">

			<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register mt-3" <?php do_action( 'woocommerce_register_form_tag' ); ?> >



				<?php do_action( 'woocommerce_register_form_start' ); ?>



				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>



					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>

					</p>



				<?php endif; ?>



				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<?php else : ?>

						<span class="input-nota"><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></span>

					<?php endif; ?>

				</p>

				<p class="form-row form-row-wide">
					<label for="reg_billing_birthdate"><?php _e( 'Fecha de nacimiento', 'esgalla' ); ?> <span class="required">*</span></label>
					<input type="date" class="input-text" name="billing_birthdate" id="reg_billing_birthdate" value="<?php if ( ! empty( $_POST['billing_birthdate'] ) ) esc_attr_e( $_POST['billing_birthdate'] ); ?>" />
				</p>


				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>



					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />

					</p>

				<?php endif; ?>			



				<?php do_action( 'woocommerce_register_form' ); ?>



				<p class="woocommerce-FormRow form-row">

					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

					<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn btn-primary pos-r w-100 mt-30" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>

				</p>



				<?php do_action( 'woocommerce_register_form_end' ); ?>



			</form>



		</div>

	</div>



<?php endif; ?>



	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

</div>





