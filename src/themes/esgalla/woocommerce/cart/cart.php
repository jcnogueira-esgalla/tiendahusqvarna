<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="row">
	<div class="col-12">
		<div class="col-contain">
			<?php do_action( 'woocommerce_before_cart' ); ?>
		</div>
	</div>


	<div class="col-12 col-lg-8 col-md-offset-1">
		<div class="col-contain">
			<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
					<thead>
						<tr>
							<th class="product-remove">&nbsp;</th>
							<th class="product-thumbnail">&nbsp;</th>
							<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
							<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
							<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
							<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="woocommerce-cart-form__cart-item d-flex justify-content-between <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

									<td class="product-remove">
										<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove remove-cart btn-cerrar" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="fa fa-times" aria-hidden="true"></span></a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'woocommerce' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
										?>
									</td>

									<td class="product-thumbnail">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail; // PHPCS: XSS ok.
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
									}
									?>
									</td>

									<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
									<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
									} else {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}
									?>
									</td>

									<td class="product-sep d-none"></td>

									<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
										<?php
											if ( $_product->is_sold_individually() ) {
												echo '1 <input type="hidden" name="cart[{$cart_item_key}][qty]" value="1" />';
											} else {
												$stock = $_product->backorders_allowed() ? '' : $_product->get_stock_quantity();
												$cantidad = apply_filters( 'woocommerce_widget_cart_item_quantity', $cart_item['quantity'], $cart_item, $cart_item_key );
												?>
													<div class="mini-cart-item-qty product-qty item-qty-<?php echo $cart_item_key; ?>">
														<?php if($_product->get_max_purchase_quantity() == -1 || $_product->get_max_purchase_quantity() > 1): ?>
															<a href="javascript:void(0)" rel="nofollow" class="item-cantidad-cambio product-qty-cambio d-inline-block" data-accion="-1"><i class="fas fa-minus"></i></a>
															<div class="quantity d-inline-block">
																<input class="item-cantidad-contador item-cantidad-contador-cart qty text-center w-100" type="number" value="<?php echo $cantidad; ?>" step="1" min="1" value="1" max="<?php echo $stock; ?>" data-type="cart" data-itemkey="<?php echo $cart_item_key; ?>" name="<?php echo "cart[{$cart_item_key}][qty]"; ?>"/>
															</div>
															<a href="javascript:void(0)" rel="nofollow" class="item-cantidad-cambio product-qty-cambio d-inline-block" data-accion="1"><i class="fas fa-plus"></i></a>
														<?php endif; ?>
													</div>
												<?php
											}
											?>

									</td>

									<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
									</td>
									<td class="d-n"><?php echo gtm_datos_product($_product); //GTM ?></td>
								</tr>
								<?php
							}
						}
						?>

						<?php do_action( 'woocommerce_cart_contents' ); ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6" class="actions">

								<?php if ( wc_coupons_enabled() ) { ?>
									<div class="d-flex  align-items-center justify-content-between flex-wrap">
										<label for="coupon_code" class="w-100 mb-10 text-left fs-1-2"><strong><?php _e( '¿Tienes un cupón de descuento?', 'esgalla' ); ?></strong></label>
										<div class="form-row form-row-first w-50 ">
					    					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
					    				</div>
					    				<div class="form-row form-row-first w-50 p-3">
					    					<button type="submit" class="button btn btn-primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
					    				</div>
					    				<div class="d-b w-100 ta-l">
					    					<?php do_action( 'woocommerce_cart_coupon' ); ?>
					    				</div>
									</div>
								<?php } ?>

								<button type="submit" class="button d-none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
							</td>
						</tr>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</tfoot>
				</table>
				<?php do_action( 'woocommerce_after_cart_table' ); ?>
			</form>
		</div>
	</div>

	<div class="col-12 col-lg-4">
		<div class="col-contain border p-3 p-md-4">
			<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
			<div class="cart-collaterals">
				<?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action( 'woocommerce_cart_collaterals' );
				?>
			</div>
		</div>
	</div>



	<div class="col">
		<div class="col-contain">
			<?php do_action( 'woocommerce_after_cart' ); ?>
		</div>
	</div>

</div>
