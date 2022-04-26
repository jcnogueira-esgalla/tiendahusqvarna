<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">

	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<?php 	 		 	
	 	echo '<div class="add-cart-product-qty product-qty">';
	 		do_action( 'woocommerce_before_add_to_cart_quantity' );
	 		if(!$product->is_sold_individually() || $product->get_max_purchase_quantity() == -1 || $product->get_max_purchase_quantity() > 1 ){
			 	echo '<a href="javascript:void(0)" rel="nofollow" class="add-cart-product-qty-cambio product-qty-cambio" data-accion="-1"><i class="fas fa-minus"></i></a>';
			 }
		 	woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			) );
		 	if(!$product->is_sold_individually() || $product->get_max_purchase_quantity() == -1 || $product->get_max_purchase_quantity() > 1){
				echo '<a href="javascript:void(0)" rel="nofollow" class="add-cart-product-qty-cambio product-qty-cambio" data-accion="1"><i class="fas fa-plus"></i></a>';
			}
			do_action( 'woocommerce_after_add_to_cart_quantity' );
		echo '</div>';
	?>
	<div class="mensaje-variacion-agotada" style="display:none;"><?= __("Producto temporalmente sin existencias online. Consulta disponibilidad en tu distribuidor más cercano","esgalla")?></div>
	<button type="submit" name="add-cart-product-boton" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button add-cart-product-boton"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
