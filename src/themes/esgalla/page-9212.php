<?php

/**

* Template Name: Contacto

*

* This is the template that displays contact

*

* @package esgalla

*/



get_header();



?>



<main id="page-contact">



	<section class="my-4 my-md-6">

		<div class="container">

			<div class="row">

				<div class="col-12 col-lg-6 d-flex flex-column pr-lg-5">

					<h2 class="tit-contacta"><?php _e("Contacta con","esgalla"); ?> <span class="h2 text-primary font-weight-bold"> <?php _e("Husqvarna España", "esgalla") ?></span></h2>

					<p class="fs-19 text-gray font-weight-light py-3"><?php _e("¿Dudas sobre algún producto Husqvarna? ¿Necesitas información sobre alguno de nuestros servicios? Envíanos todas tus preguntas o comentarios y te responderemos en la mayor brevedad posible.", "esgalla") ?></p>

					<a href="mailto:<?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?>" class="text-primary font-weight-bold h6"><i class="fas fa-envelope pr-2"></i><?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?></a>

					<a href="tel:+34<?php _e("981 680 101", "esgalla") ?>" class="text-primary font-weight-bold h6 pt-2"><i class="fas fa-phone pr-sm-2"></i>+34 <?php _e("981 680 101", "esgalla") ?></a>

					<p  class="text-primary font-weight-bold fs-19 pt-2"><i class="fas fa-map-marker-alt pr-2"></i><?php _e("INTERNACO S.A. Lg. Queirúa s/n, 15680 - Órdenes, A Coruña", "esgalla") ?></p>

					<h2 class="tit-contacta mt-4"><?php _e("Si quieres saber más...","esgalla"); ?></h2>

					<p class="fs-19 text-gray font-weight-light py-3"><?php _e("¿Quieres saber más sobre Husqvarna España? Si es así, no dudes en visitar nuestra página web oficial. En ella encontrarás todos los productos disponibles, información útil sobre toda nuestra gama y todos nuestros distribuidores oficiales Husqvarna.", "esgalla") ?></p>

					<a href="<?php _e("https://www.husqvarna.com/es/", "esgalla") ?>" class="text-primary subtit-arrow font-italic font-weight-bold text-decoration-none"><?php _e("visitar la web de Husqvarna","esgalla"); ?></a>

				</div>



				<div class="col-12 col-lg-6 mt-5 mt-lg-2 formulario-contacto">

					<?php echo do_shortcode( '[gravityform id="2" title="false" description="false" ajax="true" tabindex="200"]' ); ?>

				</div>

			</div>

		</div>

	</section>



</main>



<?php get_footer();
