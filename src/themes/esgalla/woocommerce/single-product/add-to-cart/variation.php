<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description wysiwyg fs-0-9">{{{ data.variation.variation_description }}}</div>
    <div class="woocommerce-variation-availability mt-10 ta-c">{{{ data.variation.availability_html }}}</div>
	<div class="woocommerce-variation-price ta-l mt-10 mb-0 fs-1-2 fw-b">{{{ data.variation.price_html }}}</div>
	
    <?php if(get_field('eco_tasa')): ?>
        <p class="text-dark mb-4" style="font-size:12px;">Eco Tasa <?php echo get_field('eco_tasa'); ?>€ incluida.</p>
    <?php endif; ?>

</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php _e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>
