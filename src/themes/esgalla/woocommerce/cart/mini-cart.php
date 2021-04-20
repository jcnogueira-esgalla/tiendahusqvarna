<?php

/**

 * Mini-cart

 *

 * Contains the markup for the mini-cart, used by the cart widget.

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see     https://docs.woocommerce.com/document/template-structure/

 * @package WooCommerce/Templates

 * @version 3.5.0

 */

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="woocommerce-mini-cart cart_list product_list_widget mini-cart-list">

		<?php

			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

				echo '<script>console.log('.json_encode($cart_item).')</script>';

				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					$stock = $_product->backorders_allowed() ? '' : $_product->get_stock_quantity();

					$cantidad = apply_filters( 'woocommerce_widget_cart_item_quantity', $cart_item['quantity'], $cart_item, $cart_item_key );

					$id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $_product->get_id();

					?>

					<div <?php echo print_data_product_analytics($_product,"analytic-cart-product",$cantidad); ?> class="mini-cart-item d-flex justify-content-between mb-4 w-100 <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

						<?php

							//GTM

							echo gtm_datos_product($_product,"gtm-cart-product",$id,$cantidad);

						?>

						<a href="javascript:void(0)" class="desplegable-plegar btn-cerrar" data-obj="#mini-cart"><span class="fa fa-times" aria-hidden="true"></span></a>

						<div class="mini-cart-item-img">

							<div class="item-anim-carga item-anim-carga-<?php echo $cart_item_key; ?>"><span class="fas fa-spinner fa-spin d-ib mr-1"></span></div>

							<?php echo $thumbnail; ?>

						</div>

						<div class="mini-cart-item-content d-flex flex-column justify-content-between pb-4">

							<div class="mini-cart-item-content-1 d-flex justify-content-between w-100">

								<div class="mini-cart-item-nombre font-weight-bold pt-3">

									<?php echo $product_name; ?>

									<div class="mini-cart-item-datos font-weight-normal fs-14 mt-3">

										<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

										<?php

											if($stock != ""){

												//echo '<span class="d-block mini-cart-stock">'.$stock.' '.__("Disponibles").'</span>';

											}

										?>

									</div>

								</div>

								<div class="mini-cart-item-remove text-right mt-3">

									<?php

										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(

											'<a href="%s" class="remove remove-mini-cart text-red" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="far fa-trash-alt"></i></a>',

											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),

											__( 'Remove this item', 'woocommerce' ),

											esc_attr( $id ),

											esc_attr( $cart_item_key ),

											esc_attr( $_product->get_sku() )

										), $cart_item_key );

									?>

								</div>

							</div>

							<div class="mini-cart-item-content-2 d-flex justify-content-between align-items-center w-100 mt-3">

								<div class="mini-cart-item-qty product-qty item-qty-<?php echo $cart_item_key; ?>">

									<?php if($_product->get_max_purchase_quantity() == -1 || $_product->get_max_purchase_quantity() > 1): ?>

										<a href="javascript:void(0)" rel="nofollow" class="item-cantidad-cambio product-qty-cambio d-inline-block" data-accion="-1"><i class="fas fa-minus"></i></a>

										<div class="quantity d-inline-block w-50">

											<input  data-val="<?php echo $cantidad;?>" data-id="<?php echo $_product->get_ID();?>" class="item-cantidad-contador item-cantidad-contador-mini-cart qty text-center w-100" type="number" value="<?php echo $cantidad; ?>" step="1" min="1" value="1" max="<?php echo $stock; ?>" data-type="mini-cart" data-itemkey="<?php echo $cart_item_key; ?>"/>

										</div>

										<a href="javascript:void(0)" rel="nofollow" class="item-cantidad-cambio product-qty-cambio d-inline-block" data-accion="1"><i class="fas fa-plus"></i></a>

									<?php endif; ?>

								</div>

								<div class="mini-cart-item-total text-right">

									x <?php echo $product_price;  ?>

								</div>

							</div>

						</div>

					</div>

					<?php

				}

			}

			do_action( 'woocommerce_mini_cart_contents' );

		?>

	</div>

	<div class="woocommerce-mini-cart__total total mini-cart-total d-flex justify-content-between w-100 fs-125 pt-3 mt-3">

		<div class="mini-cart-total-txt font-weight-bold text-primary"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>

		<div class="mini-cart-total-precio font-weight-bold text-primary"><?php echo WC()->cart->get_cart_subtotal(); ?></div>

	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="woocommerce-mini-cart__buttons mini-cart-botones mt-30">

		<a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-primary w-100 mt-3 mt-md-4"><?php _e("Confirmar tu compra","esgalla"); ?></a>

		<div class="text-center mt-3 font-weight-bold w-100"><a href="javascript:void(0)" class="desplegable-plegar" data-obj="#mini-cart"><?php _e("Seguir comprando","esgalla"); ?></a></div>

		<?php //do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>

	</div>

<?php else : ?>

	<div class="woocommerce-mini-cart__empty-message mini-cart-botones mt-3 w-100 ta-c p-20 fs-1-1"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></div>

	<div class="text-center mt-3 w-100"><a href="javascript:void(0)" class="desplegable-plegar text-center font-weight-bold mt-3 mt-md-4 w-100" data-obj="#mini-cart"><?php _e("Seguir comprando","esgalla"); ?></a></div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>

