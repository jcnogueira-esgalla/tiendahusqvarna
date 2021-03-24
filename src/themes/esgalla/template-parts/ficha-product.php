<?php
   global $product;
	$id_producto = get_the_ID();
	$id_producto = 23;
?>
<a href="https://esgalladev.com/husqvarna/producto/prueba/" class="ficha-producto d-flex flex-column justify-content-between text-decoration-none" data-id="<?php echo $id_producto ?>">

	<img class="mx-auto" src="<?php echo get_template_directory_uri() ?>/img/motosierras-439.png" alt="">

	<div class="ficha-body d-flex flex-column align-content-start ">

		<div class="producto-ref text-dark">Ref. 000000</div>

		<h5 class="text-dark">Motosierra 439</h5>

		<div class="producto-precio d-flex justify-content-between align-items-end">

			<p>+ info</p>

			<div class="d-flex justify-content-between align-items-center">

				<div class="pre-price text-primary">699.99€</div>

				<div class="price text-primary font-weight-bold">499.99€</div>

			</div>

		</div>

	</div>

		<button href="<?php echo get_site_url().'/?add-to-cart='.$id_producto ?>" class="btn btn-primary btn-cart text-white spacing font-weight-regular fs-125 text-center boton-add-cart-ficha" data-quantity="1" data-product_id="<?php echo $id_producto ?>">AÑADIR A LA CESTA</button>



</a>
