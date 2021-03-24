<?php

$id_producto = $args['id_producto'];
$producto = wc_get_product( $id_producto );

?>

<div class="w-100 mt-4">

	<a href="<?php echo get_permalink( $producto->get_id() ) ?>" class="ficha-accesorio d-flex flex-column justify-content-between shadow">

		<div class="body-accesorio d-flex justify-content-between w-100">

			<?php echo $producto->get_image(array(100,100)); ?>

			<div class="desc-accesorio">

				<h3 class="text-secondary font-weight-regular fs-18"><?php echo $producto->get_name() ?></h3>

				<div class="text-primary font-weight-bold fs-20"><?php echo round($producto->get_price(), 2) ?>€</div>

			</div>

		</div>

		<?php if($producto->get_stock_status()=='instock' && !in_array(wp_get_post_terms( $producto->id, 'product_cat' )[0]->term_id, [1815, 479])): ?>
			<button href="<?php echo get_site_url().'/?add-to-cart='.$producto->get_id() ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125 text-center text-uppercase boton-add-cart-ficha" data-quantity="1" data-product_id="<?php echo $producto->get_id() ?>"><?php _e('AÑADIR AL CARRITO') ?></button>
		<?php else: ?>
			<button href="<?php echo get_permalink( $producto->get_id() ) ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125 text-center text-uppercase" ><?php _e('VER PRODUCTO') ?></button>
		<?php endif; ?>
		<?php /* <button href="#" class="btn btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125 text-center text-uppercase mt-2">Añadir a la cesta</button> */ ?>
	</a>

</div>

