<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<div class="row pb-3 pb-lg-4 mt-4 mt-lg-6 justify-content-center">
		<div class="col-12 col-md-9 col-md-offset-3">
			<div class="text-center py-lg-4">
				<a href="<?php echo get_home_url(); ?>"><img class="logo-azul" src="/src/themes/esgalla/img/logo-azul.png" class="img-fluid logo-principal" alt="logo"></a>
			</div>
		</div>
	</div>

	<?php if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<div class="row justify-content-center">
				<div class="col-12 col-md-9 col-md-offset-3 woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed mb-30 p-20 fs-1-4 tt-u ">
					<div class="col-contain fs-1-4 text-uppercase py-3 text-center text-white bg-danger">
						<i class="fal fa-check-circle"></i> <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				<div class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions col">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
					<?php endif; ?>
				</div>
			</div>		

		<?php else : ?>
			
			<div class="row justify-content-center">
				<div class="col-12 col-md-9 col-md-offset-3 woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
					<div class="col-contain fs-1-4 text-uppercase py-3 text-center text-white bg-primary">
						<i class="fal fa-check-circle"></i> <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
			</div>

			<div class="row justify-content-center mt-y my-lg-5">
				<div class="col-12 col-md-9 col-md-offset-3 p-3 p-md-4 border">
					<div class="col-checkout-thx">
						
						<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<li class="woocommerce-order-overview__order order mb-10 fs-1-1">
								<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<li class="woocommerce-order-overview__date date mb-10 fs-1-1">
								<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
								<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
								<li class="woocommerce-order-overview__email email mb-10 fs-1-1">
									<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
									<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li>
							<?php endif; ?>

							<li class="woocommerce-order-overview__total total mb-10 fs-1-1">
								<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<?php if ( $order->get_payment_method_title() ) : ?>
								<li class="woocommerce-order-overview__payment-method method mb-10 fs-1-1">
									<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
									<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
								</li>
							<?php endif; ?>

						</ul>

						<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>


					</div>

				</div>
			</div>
			

			

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<div class="row justify-content-center">
			<div class="col-12 col-md-9 col-md-offset-3 woocommerce-notice woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
				<div class="col-contain fs-1-4 text-uppercase text-center text-white bg-primary">
					<i class="fal fa-check-circle"></i> <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div>

	<?php endif; ?>

</div>
