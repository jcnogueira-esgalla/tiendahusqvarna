<?php

/**

* Template Name: Home

*

* This is the template that displays Home

*

* @package esgalla

*/



get_header();



$categorias_tienda = array(

	'motosierras' => 871,

	'cortacespedes' => 864,

	'desbrozadoras' => 869,

	'motozada' => 899,

	'hidrolimpiadora' => 915,

	'aspiradora' => 921,

	'soplanieves' => 914,

	'herramientas' => 873,

	'aceites-gasolinas' => 885,

	'automower' => 1838,

	'juguetes' => 903,

	'ropa' => 878,

);

// 'motosierras' => 1832,

// 'cortacespedes' => 1831,

// 'desbrozadoras' => 1834,

// 'motozada' => 1843,

// 'hidrolimpiadora' => 1846,

// 'aspiradora' => 921,

// 'soplanieves' => 1849,

// 'herramientas' => 1835,

// 'aceites-gasolinas' => 1840,

// 'automower' => 1836,

// 'juguetes' => 1844,

// 'ropa' => 878,



if(get_site_url( ) == 'https://lojahusqvarna.com'){
	// if(get_site_url( ) == 'https://lojahusqvarna.esgallapre.com'){
	

	$categorias_tienda = array(

		'motosierras' => 1069,

		'cortacespedes' => 461,

		'desbrozadoras' => 468,

		'motozada' => 498,

		'hidrolimpiadora' => 1075,

		'aspiradora' => 475,

		'soplanieves' => 495,

		'herramientas' => 492,

		'aceites-gasolinas' => 493,

		'automower' => 479,

		'juguetes' => 481,

		'ropa' => 476,

	);

}



?>

<main id="page-home" class="site-main">



	<?php

	while ( have_posts() ) :

		the_post();



		// If comments are open or we have at least one comment, load up the comment template.



		if ( comments_open() || get_comments_number() ) :

			comments_template();

		endif;



	endwhile; // End of the loop.

	?>



	<header id="#masthead" class="portada-superior px-20">

		<div class="d-flex flex-column justify-content-center tit-portada buscador-principal mx-auto">
			<h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase"><?php _e("Encuentra las herramientas","esgalla"); ?> <span class="h1 font-weight-bold text-primary">HUSQVARNA</span> <?php _e("que estás buscando","esgalla"); ?></h1>

			<form role="search" method="get" class="search-form input-group" action="<?php echo get_home_url( ) ?>">
				<input type="search"  data-swpengine="default" class="form-control" placeholder="<?php _e("¿Qué estás buscando?","esgalla"); ?>" value="" name="s" data-swplive="true">
				<button class="btn btn-secondary rounded shadow font-weight-bold text-uppercase" type="submit"><?php _e("Buscar","esgalla"); ?></button>
			</form>

		</div>
	</header>


	<? if(get_field('productos_destacados')): ?>
	<section id="#ofertas" class="bg-white pt-6">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="h2 text-center text-uppercase tit-line font-weight-bold"><?php _e("ofertas husqvarna","esgalla"); ?></h2>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-12 slick-productos">
					<?php
					$productos_destacados = get_field('productos_destacados');
					$post_idx =1;
					foreach($productos_destacados as $id_producto){
						get_template_part('template-parts/ficha', 'producto', array('id_producto' => $id_producto, 'position' => $post_idx));
						$post_idx++;
					}
					?>
				</div>
			</div>
		</div>

	</section>
	<? endif; ?>

	<div class="container-fluid container-md px-0" id="banner-folleto">
		<div class="row py-4 mt-4">
			<div class="col-12">
				<?php if(get_site_url( ) == 'https://tiendahusqvarna.com'){ ?>
					<? date_default_timezone_set('Europe/Madrid'); //Nos aseguramos de que pillamos la hora Española ?>
					<? //if( (date("Ymd") > 20220228) ): //Despues de esta fecha se acaba el período promo Ofertas Otoño  ?>
						<a href="https://folleto.tiendahusqvarna.com/?utm_source=TiendaHusqvarnab&utm_medium=BannerHome&utm_campaign=primavera22" target="_blank">
							<img src="https://tiendahusqvarna.com/files/2022/05/2246x970-ES_Mayo.jpg" class="img-fluid"/>
						</a>
					<? //else: ?>
						
					<? //endif; ?>
				<?php } ?>
				<?php if(get_site_url( ) == 'https://lojahusqvarna.com'){ ?>
					<? date_default_timezone_set('Europe/Lisbon'); //Nos aseguramos de que pillamos la hora Portuguesa ?>
					<? //if( (date("Ymd") > 20220228) ): //Despues de esta fecha se acaba el período promo Ofertas Otoño ?>
						<a href="https://folheto.lojahusqvarna.com/?utm_source=LojaHusqvarna&utm_medium=BannerHome&utm_campaign=primavera22" target="_blank">
							<img src="https://lojahusqvarna.com/files/sites/2/2022/05/2246x970_PT_Mayo.jpg" class="img-fluid"/>
						</a>
					<? //else: ?>
						
					<? //endif; ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<? $motosierras = get_field('seccion_motosierras'); ?>
	<section id="motosierras" class="bg-white pt-6">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-xl-3">
					<h2 class="h1 font-weight-bold"><?php _e("Motosierras","esgalla"); ?></h2>
					<a href="<?php echo get_term_link($categorias_tienda['motosierras']); ?>" class="text-primary font-italic font-weight-bold subtit-arrow text-decoration-none"><?php _e("ver todas las motosierras","esgalla"); ?></a>
				</div>
				<div class="col-12 col-xl-8 col-xl-offset-1">
					<p class="text-gray pr-lg-4 text-gray-dark">
						<? if($motosierras['descripcion_motosierras']): ?>
							<? echo $motosierras['descripcion_motosierras']; ?>
						<? else: ?>
							<?php echo term_description($categorias_tienda['motosierras']); ?>
						<? endif; ?>
					</p>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12 col-md-9 slick-categorias">
					<? if($motosierras['slider_motosierras']): ?>
					<?
                        $post_idx = 1;
                        foreach($motosierras['slider_motosierras'] as $id_producto){
							get_template_part('template-parts/ficha', 'producto', array('id_producto' => $id_producto, 'position' => $post_idx));
							$post_idx++;
						}
					?>
					<? else: ?>
						<?php echo shortcode_fichas( array("t"=>"product", "d"=> "33", "c" =>9, "r" => "product_cat", 'cat' => $categorias_tienda['motosierras'], 'f' => 'producto')); ?>
					<? endif; ?>
				</div>
				<div class="d-none d-md-block col-md-3 img-banner-cat p-3">
					<p class="h2 text-light text-shadow text-uppercase font-weight-bold"><?php _e("Motosierras husqvarna","esgalla"); ?></p>
				</div>
			</div>
		</div>
	</section>


	<? $cortacespedes = get_field('seccion_cortacespedes'); ?>
	<section id="cortacéspedes" class="bg-white mt-3 pt-6">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-xl-3">
					<h2 class="h1 font-weight-bold"><?php _e("Cortacéspedes","esgalla"); ?></h2>
					<a href="<?php echo get_term_link($categorias_tienda['cortacespedes']); ?>" class="text-primary font-italic font-weight-bold subtit-arrow text-decoration-none"><?php _e("ver todos los cortacéspedes","esgalla"); ?></a>
				</div>
				<div class="col-12 col-xl-8 col-xl-offset-1">
					<p class="text-gray pr-lg-4 text-gray-dark">
						<? if($cortacespedes['descripcion_cortacespedes']): ?>
							<? echo $cortacespedes['descripcion_cortacespedes']; ?>
						<? else: ?>
							<?php echo term_description($categorias_tienda['cortacespedes']); ?>
						<? endif; ?>
					</p>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12 col-md-9 slick-categorias">
					<? if($cortacespedes['slider_cortacespedes']): ?>
					<?
                        $post_idx = 1;
                        foreach($cortacespedes['slider_cortacespedes'] as $id_producto){
                            get_template_part('template-parts/ficha', 'producto', array('id_producto' => $id_producto, 'position' => $post_idx));
                            $post_idx++;
						}
					?>
					<? else: ?>
						<?php echo shortcode_fichas( array("t"=>"product", "d"=> "33", "c" =>9, "r" => "product_cat", 'cat' => $categorias_tienda['cortacespedes'], 'f' => 'producto', 'oby' => 'price')); ?>
					<? endif; ?>
				</div>
				<div class="d-none d-md-block col-md-3 img-banner-cat cortacespedes p-3">
					<p class="h2 text-light text-shadow text-uppercase font-weight-bold"><?php _e("Cortacéspedes husqvarna","esgalla"); ?></p>
				</div>
			</div>
		</div>
	</section>


	<? $desbrozadoras = get_field('seccion_desbrozadoras'); ?>
	<section id="desbrozadoras" class="bg-white mt-3 pt-6">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-xl-3">
					<h2 class="h1 font-weight-bold"><?php _e("Desbrozadoras","esgalla"); ?></h2>
					<a href="<?php echo get_term_link($categorias_tienda['desbrozadoras']); ?>" class="text-primary font-italic font-weight-bold subtit-arrow text-decoration-none"><?php _e("ver todas las desbrozadoras","esgalla"); ?></a>
				</div>
				<div class="col-12 col-xl-8 col-xl-offset-1">
					<p class="text-gray pr-lg-4 text-gray-dark">
						<? if($desbrozadoras['descripcion_desbrozadoras']): ?>
							<? echo $desbrozadoras['descripcion_desbrozadoras']; ?>
						<? else: ?>
							<?php echo term_description($categorias_tienda['desbrozadoras']); ?>
						<? endif; ?>
					</p>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12 col-md-9 slick-categorias">
					<? if($desbrozadoras['slider_desbrozadoras']): ?>
					<?
                        $post_idx = 1;

                        foreach($desbrozadoras['slider_desbrozadoras'] as $id_producto){
                            get_template_part('template-parts/ficha', 'producto', array('id_producto' => $id_producto, 'position' => $post_idx));
                            $post_idx++;						}
					?>
					<? else: ?>
						<?php echo shortcode_fichas( array("t"=>"product", "d"=> "33", "c" =>9, "r" => "product_cat", 'cat' => $categorias_tienda['desbrozadoras'], 'f' => 'producto')); ?>
					<? endif; ?>
				</div>
				<div class="d-none d-md-block col-md-3 img-banner-cat desbrozadoras p-3">
					<p class="h2 text-light text-shadow text-uppercase font-weight-bold"><?php _e("Desbrozadoras husqvarna","esgalla"); ?></p>
				</div>
			</div>
		</div>
	</section>



	<section class="mt-3 mb-6 pt-6">

		<div class="container">

			<div class="row">

				<div class="col">

					<h2 class="text-uppercase font-weight-bold text-center tit-line-2"><?php _e("Todas las herramientas husqvarna","esgalla"); ?></h2>

				</div>

			</div>

			<div class="row pt-5">

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['motozada']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/ficha-categoria-motoazada.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Motoazada husqvarna","esgalla"); ?></h2></a>
				</div>

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['hidrolimpiadora']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/foto-categoria-hidrolimpiadora.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Hidrolimpiadora husqvarna","esgalla"); ?></h2></a>
				</div>

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['aspiradora']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/ficha-categoria-aspiradora.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Aspiradora husqvarna","esgalla"); ?></h2></a>
				</div>

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['soplanieves']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/ficha-categoria-quitanieves.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Soplanieves husqvarna","esgalla"); ?></h2></a>
				</div>

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['herramientas']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/ficha-cat-herramientas.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Herramientas forestales husqvarna","esgalla"); ?></h2></a>
				</div>

				<div class="col-sm-6 col-md-4 mb-4">
					<a class="" href="<?php echo get_term_link($categorias_tienda['aceites-gasolinas']); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/ficha-cat-aceites-ok.jpg" alt="motoazadas husqvarna"><h2 class="tit-herramientas fs-30 text-white font-weight-bold text-uppercase"><?php _e("Aceites y gasolinas husqvarna","esgalla"); ?></h2></a>
				</div>

			</div>

		</div>

	</section>



	<section class="pt-7">

		<div class="container">

			<div class="row row-automower py-4 pl-3">

				<div class="col-lg-8 col-lg-offset-4 col-xl-5 col-xl-offset-12 ">

					<h2 class="h1 text-light font-weight-bold text-uppercase mt-2"><?php _e("Disfruta de un césped perfecto y sin esfuerzo todos los días del año. ¡Prueba el ","esgalla"); ?><a href="<?php echo get_term_link($categorias_tienda['automower']); ?>" class="text-primary h1 font-weight-bold text-decoration-none"><?php _e("automower","esgalla"); ?>&reg;</a>!</h2>

					<a href="<?php echo get_term_link($categorias_tienda['automower']); ?>" class="text-light font-italic font-weight-bold subtit-arrow text-decoration-none"><?php _e("ver todos los automower","esgalla"); ?><span>&reg;</span></a>

				</div>

			</div>

		</div>

	</section>



	<section class="mt-5 juguetes">

		<div class="container">

			<div class="row">

				<div class="col-12 col-sm-6">

					<a href="<?php echo get_term_link($categorias_tienda['juguetes']); ?>">

						<img src="<?php echo get_template_directory_uri() ?>/img/ficha-juguetes.jpg" alt="">

					</a>

					<div class="tit-ficha-absolute">

						<h2 class="text-dark"><?php _e("Juguetes","esgalla"); ?></h2>

						<a href="<?php echo get_term_link($categorias_tienda['juguetes']); ?>" class="text-primary subtit-arrow font-italic font-weight-bold text-decoration-none"><?php _e("ver todos los juguetes","esgalla"); ?></a>

					</div>

				</div>

				<div class="col-12 mt-3 mt-sm-0 col-sm-6">

					<a href="<?php echo get_term_link($categorias_tienda['ropa']); ?>">

						<img src="<?php echo get_template_directory_uri() ?>/img/ficha-ropa.jpg" alt="">

					</a>

					<div class="tit-ficha-absolute">

						<h2 class="text-dark"><?php _e("Ropa","esgalla"); ?></h2>

						<a href="<?php echo get_term_link($categorias_tienda['ropa']); ?>" class="text-primary subtit-arrow font-italic font-weight-bold text-decoration-none"><?php _e("ver toda la ropa","esgalla"); ?></a>

					</div>

				</div>

			</div>

		</div>

	</section>



	<section class="mt-6" id="contacto">

		<div class="container">

			<div class="row p-4">

				<div class="col-lg-8 pt-3 d-flex flex-column">

					<h2 class="tit-contacta"><?php _e("Contacta con","esgalla"); ?> <span class="h2 text-primary font-weight-bold"> <?php _e("Husqvarna España", "esgalla") ?></span></h2>

					<p class="h6 text-gray font-weight-light py-3"><?php _e("¿Dudas sobre algún producto Husqvarna? ¿Necesitas información sobre alguno de nuestros servicios? Envíanos todas tus preguntas o comentarios y te responderemos en la mayor brevedad posible.", "esgalla") ?></p>

						<a href="mailto:<?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?>" class="text-primary font-weight-bold h6"><i class="fas fa-envelope pr-2"></i><?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?></a>

						<a href="tel:<?php _e("+34 981 680 101", "esgalla") ?>" class="text-primary font-weight-bold h6 pt-2"><i class="fas fa-phone pr-sm-2"></i><?php _e("981 680 101", "esgalla") ?></a>

						<p  class="text-primary font-weight-bold h6 pt-2"><i class="fas fa-map-marker-alt pr-2"></i><?php _e("INTERNACO S.A. Lg. Queirúa s/n, 15680 - Órdenes, A Coruña", "esgalla") ?></p>

						<p class="h2 tit-contacta font-weight-bold mt-4"><?php _e("Si quieres saber más...","esgalla"); ?></p>

						<p class="h6 text-gray font-weight-light py-3"><?php _e("¿Quieres saber más sobre Husqvarna España? Si es así, no dudes en visitar nuestra página web oficial. En ella encontrarás todos los productos disponibles, información útil sobre toda nuestra gama y todos nuestros distribuidores oficiales Husqvarna.", "esgalla") ?></p>

							<a href="<?php _e("https://www.husqvarna.com/es/", "esgalla") ?>" class="text-primary subtit-arrow font-italic font-weight-bold text-decoration-none"><?php _e("visitar la web de Husqvarna","esgalla"); ?></a>

						</div>

					</div>

				</div>

			</section>





		</main><!-- #main -->







		<?php







		get_footer();

