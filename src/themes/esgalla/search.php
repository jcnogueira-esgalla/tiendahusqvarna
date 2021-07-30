<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Esgalla
 */

get_header();
?>

<section class="py-3 py-md-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1 class="text-dark font-weight-bold"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Has buscado por: %s', 'esgalla' ), '<span class="h1 font-weight-bold">' . get_search_query() . '</span>' );
					?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12 d-block d-md-none">
				<button class="btn btn-secondary text-uppercase rounded-0 px-4 my-3 fs-1-2 text-light text-left" data-toggle="collapse" data-target="#facetWp" aria-expanded="false" aria-controls="facetWp">Abrir filtros</button>
			</div>
			

			<div class="col-12 col-md-3 collapse not-collapse-md filtro-facet" id="facetWp" style="height: fit-content!important;">
				<div class="facetwp-facet"><?php woocommerce_catalog_ordering(); ?></div>
				<?php echo facetwp_display( 'selections' ) ?>
				<?php echo facetwp_display( 'facet', 'buscador_productos' ); ?>
				<?php echo facetwp_display( 'facet', 'price_range' ); ?>
				<?php echo facetwp_display( 'facet', 'categoras_productos' ); ?>
				<?php echo facetwp_display( 'facet', 'etiquetas_productos' ); ?>
				<div class="ta-c"><a class="btn btn-primary" href="javascript:void(0)" onclick="FWP.reset()"><?php _e("Limpiar filtros", "esgalla"); ?></a></div>
			</div>
			<div class="products col-12 col-md-8 d-flex flex-wrap justify-content-start w-100">
				<!-- <div class="container">
					<div class="row"> -->
						<?php while ( have_posts() ) : the_post();
							if(get_post_type()=='product') get_template_part('template-parts/ficha', 'producto', array('id_producto' => get_the_id()));
						endwhile; ?>
					<!-- </div>
				<div> -->
			</div>
			
			<?php /*for ($i = 1; $i <= 8; $i++): ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<? get_template_part('template-parts/ficha', 'producto', array('id_producto' => 130)); ?>
				</div>
			<? endfor; */?>

		</div>
		<div class="pt-3 w-100 d-flex justify-content-center">
			<?php echo facetwp_display( 'facet', 'paginacin' ); ?>
		</div>
	</div>
</section>

<section class="py-3 py-md-4 py-lg-5 bg-light">
	<div class="container">
		<div class="row">
			<div class="col-7 mx-auto buscador-principal">
				<h2 class="text-dark font-weight-bold text-center"><?php _e("¿No has encontrado lo que buscabas?","esgalla"); ?></h2>
				<h3 class="mt-4 text-gray text-center font-weight-light"><?php _e("¡Te ayudamos! Vuelve a intentarlo.","esgalla"); ?></h3>
				<div class="mt-4 mt-md-5 mt-lg-6 input-group shadow">

				    <input type="text" class="form-control" placeholder="<?php _e("¿Qué estás buscando?","esgalla"); ?>">

				    <div class="input-group-append">

				      <button class="btn btn-secondary rounded shadow text-uppercase font-weight-bold" type="button"><?php _e("Buscar","esgalla"); ?></button>

				    </div>

				</div>
			</div>
		</div>
	</div>
</section>



<?php
get_footer();
