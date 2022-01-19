<?php

$id_producto = $args['id_producto'];
$position = (isset($args['position']))?$args['position']:1;

// Usar como referencia https://www.businessbloomer.com/woocommerce-easily-get-product-info-title-sku-desc-product-object/

$producto = wc_get_product( $id_producto );

?>

<a <?php echo print_data_product_analytics($producto,"analytic-product",1, $position);
?> data-slick-index="<?php echo $position;?>"  href="<?php echo get_permalink( $producto->get_id() ) ?>" class="ficha-producto d-flex flex-column justify-content-between text-decoration-none<?php echo ' '.$args['class'] ?>" data-id="<?php echo $producto->get_id() ?>">

	<?php /*<img class="mx-auto" src="<?php echo get_template_directory_uri() ?>/img/motosierras-439.png" alt=""> */ ?>

	<?php echo $producto->get_image(); ?>

	<div class="ficha-body d-flex flex-column align-content-start ">

		<div class="producto-ref text-dark">Ref. <?php echo $producto->get_sku() ?></div>
		<?php if( is_product_category() ): //En categoría de producto van a ser H2s ?>
			<h2 class="h5 text-dark font-weight-bold"><?php echo $producto->get_name() ?></h2>
		<?php else: ?>
			<h3 class="h5 text-dark font-weight-bold"><?php echo $producto->get_name() ?></h3>
		<?php endif; ?>

		<div class="producto-precio d-flex justify-content-between align-items-end">

			<p>+ info</p>

			<div class="d-flex justify-content-between align-items-center">

				<?php if($producto->get_sale_price()): ?>

					<del class="pre-price text-primary pr-2"><?php echo wc_get_price_including_tax($producto,array('price'=>$producto->get_regular_price())) ?>€</del>

					<div class="price text-primary font-weight-bold"><?php echo wc_get_price_including_tax($producto,array('price'=>$producto->get_sale_price())) ?>€</div>

				<?php else: ?>

					<? if($producto->has_child( )): ?>
						<div class="price text-primary font-weight-bold"><span class="font-weight-normal">Desde </span><?php echo round(wc_get_price_including_tax($producto,array('price'=>$producto->get_variation_price( 'min', true ))), 2) ?>€</div>
					<?  else: //Tiene variaciones. Pillamos el más alto. ?>
						<div class="price text-primary font-weight-bold"><?php echo round(wc_get_price_including_tax($producto,array('price'=>$producto->get_regular_price())), 2) ?>€</div>
					<? endif; ?>

				<?php endif; ?>

			</div>

		</div>

	</div>

<?php if(!$producto->has_child( ) && $producto->get_stock_status()=='instock' && !in_array(wp_get_post_terms( $producto->id, 'product_cat' )[0]->term_id, [1815,479])): ?>
	<button href="<?php echo get_site_url().'/?add-to-cart='.$producto->get_id() ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular fs-125 text-center boton-add-cart-ficha" data-quantity="1" data-product_id="<?php echo $producto->get_id() ?>"><?php _e('AÑADIR AL CARRITO', 'esgalla') ?></button>
<?php elseif(in_array(wp_get_post_terms( $producto->id, 'product_cat' )[0]->term_id, [1815,479])): ?>
	<button href="<?php echo get_permalink( $producto->get_id() ) ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular fs-125 text-center" ><?php _e('COMPRAR', 'esgalla') ?></button>
<?php else: ?>
	<button href="<?php echo get_permalink( $producto->get_id() ) ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular fs-125 text-center" ><?php _e('VER PRODUCTO', 'esgalla') ?></button>
<?php endif; ?>
</a>

