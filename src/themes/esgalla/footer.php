<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Esgalla
 */

?>
	<section class="my-6">
		<div class="row no-gutters img-nuestras-ofertas-mobile d-lg-none"></div>
		<div class="container  nuestras-ofertas position-relative">

			<div class="row mx-1 my-4 mx-md-4 bg-primary">
				<div class="col-12 bg-primary col-xl-7 py-3 my-sm-4 px-sm-5 form-nuestras-ofertas">
					<h2 class="h3 text-white font-weight-normal"><?php _e("¡No te pierdas nuestras novedades y promociones!","esgalla"); ?></h2>
					<p class="text-white font-weight-light pt-1 fs-125"><?php _e("Suscríbete a nuestra newsletter y no te pierdas nada sobre Husqvarna. Cubre el formulario y recibe información sobre promociones, novedades y ¡mucho más!","esgalla"); ?></p>
					<?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true" tabindex="49"]' ); ?>
				</div>
				<img src="<?php echo get_template_directory_uri() ?>/img/foto-newsletter.jpg" alt="" class="d-none d-xl-block img-nuestras-ofertas">
			</div>
		</div>
	</section>
	<div id="colophon" class="site-footer bg-secondary mt-5 py-6">
		<div class="container">
			<div class="row py-2 py-md-4 align-items-center border-bottom border-1 border-light">
				<div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
					<img src="<?php echo get_template_directory_uri() ?>/img/logo-husqvarna.png" class="img-fluid logo-principal" alt="logo">
				</div>
				<div class="col-12 col-md-6 pt-4 pt-md-0 d-flex justify-content-center justify-content-md-end">
					<a href="<?php _e("https://www.facebook.com/Husqvarna.es", "esgalla") ?>" target="_blank"><i class="fab fa-facebook text-white fs-fa pr-3"></i></a>
					<a href="<?php _e("https://www.instagram.com/husqvarna_es/", "esgalla") ?>" target="_blank"><i class="fab fa-instagram text-white fs-fa pr-3"></i></a>
					<a href="<?php _e("https://www.youtube.com/user/HusqvarnaSpain", "esgalla") ?>" target="_blank"><i class="fab fa-youtube text-white fs-fa pr-3"></i></a>
					<!-- <a href="<?php _e("https://www.flickr.com/people/husqvarnagroup/", "esgalla") ?>" target="_blank"><i class="fab fa-flickr text-white fs-fa pr-3"></i></a> -->
					<!-- <a href="<?php _e("https://twitter.com/husqvarna_es", "esgalla") ?>" target="_blank"><i class="fab fa-twitter text-white fs-fa pr-3"></i></a> -->
				</div>
			</div>
			<div class="row d-flex justify-content-between py-3">
				<?php if(get_current_blog_id() == 1): //España ?>
					<div class="col-md-6 d-flex flex-column flex-md-row justify-content-center justify-content-md-start">
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(10986); ?>">Política de privacidad</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(10988); ?>">Política de cookies</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(10987); ?>">Aviso legal</a>
					</div>
					<div class="col-md-6 d-flex flex-column flex-md-row justify-content-center justify-content-md-end">
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" target="_blank" href="/files/2021/07/20201215_FAQs-CPC-online-v3.pdf">Condiciones de Financiación</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(10959); ?>">Condiciones de venta</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(10989); ?>">Mapa del sitio</a>
					</div>
				<?php elseif(get_current_blog_id() == 2): //Portugal ?>
					<div class="col-md-6 d-flex flex-column flex-md-row justify-content-center justify-content-md-start">
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(9216); ?>">Política de privacidade</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(9217); ?>">Política de cookies</a>
						<a class="text-white text-center text-md-left mt-4 mt-md-0" href="<? echo get_permalink(9218); ?>">Aviso legal</a>
					</div>
					<div class="col-md-6 d-flex flex-column flex-md-row justify-content-center justify-content-md-end">
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(9205); ?>">Condições de venda</a>
						<a class="text-white text-center text-md-left pr-md-4 mt-4 mt-md-0" href="<? echo get_permalink(9219); ?>">Mapa do site</a>
					</div>
				<?php endif; ?>
			</div>
		</div>



	</div><!-- #colophon -->

</div><!-- #page -->

<?php include('func/cookies.php') ?>
<?php wp_footer(); ?>


	<div class="menu-overlay"></div>

	<!-- Search modal -->
	<div class="modal fade search-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content buscador-principal p-4 p-md-6">
		<h2 class="text-center text-dark font-weight-bold w-100 text-uppercase mb-3"><?php _e("Encuentra las herramientas","esgalla"); ?> <span class="h1 font-weight-bold text-primary">HUSQVARNA</span> <?php _e("que estás buscando","esgalla"); ?></h2>
		<form role="search" method="get" class="search-form input-group border modal-form-search" action="<?php echo get_home_url( ) ?>">
			<input type="search" data-swpengine="default" class="form-control" placeholder="<?php _e("¿Qué estás buscando?","esgalla"); ?>" value="" name="s" data-swplive="true">
			<button class="btn btn-secondary rounded shadow font-weight-bold text-uppercase" type="submit"><?php _e("Buscar","esgalla"); ?></button>
		</form>
    </div>
  </div>
</div>
</body>
</html>
