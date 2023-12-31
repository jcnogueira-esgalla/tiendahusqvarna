<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

//Esgalla

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<div class="woocommerce-order-details row pb-0 ml-md-3">
	<div class="col-12 col-md-9 col-offset-3 p-3 p-md-4 border ">
		<div class="col-contain bd bdc-g p-col">
			<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

			<h3 class="woocommerce-order-details__title mb-4"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h3>

			<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

				<thead>
					<tr>
						<th class="woocommerce-table__product-name product-name "><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
						<th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php
					do_action( 'woocommerce_order_details_before_order_table_items', $order );

					foreach ( $order_items as $item_id => $item ) {
						$product = $item->get_product();

						wc_get_template(
							'order/order-details-item.php',
							array(
								'order'              => $order,
								'item_id'            => $item_id,
								'item'               => $item,
								'show_purchase_note' => $show_purchase_note,
								'purchase_note'      => $product ? $product->get_purchase_note() : '',
								'product'            => $product,
							)
						);
					}

					do_action( 'woocommerce_order_details_after_order_table_items', $order );
					?>
				</tbody>

				<tfoot>
					<?php
					$x = 1;
					foreach ( $order->get_order_item_totals() as $key => $total ) {
						?>
							
							<?php
								//Medimimos el último elemento para pillar el total
								$class = ($x == count($order->get_order_item_totals())) ? "order-total" : "";
							?>

							<tr class="<?php echo $class; ?>">
								<th scope="row"><?php echo esc_html( $total['label'] ); ?></th>
								<td><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
							</tr>
							<?php
							$x++;
					}
					?>
					<?php if ( $order->get_customer_note() ) : ?>
						<tr class="order-note">
							<th><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
							<td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
						</tr>
					<?php endif; ?>
				</tfoot>
			</table>

			<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
		</div>
	</div>
</div>

<?php
if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
