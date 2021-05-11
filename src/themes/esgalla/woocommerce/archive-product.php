<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

// Inicializada la variable para evitar errores de ejecución
$ficha = '';

//Si es Automower cambiamos orden de productos
// if(isset($_GET['test'])) {
// 	if(get_queried_object()->slug == 'automower') {

// 	}
// }
?>

<?php get_header(); ?>

<?php /*

<section id="breadcrumb" class="py-2 py-md-4">

	<div class="container">

		<div class="row">

			<div class="col">

				<div class="text-primary breadcrumbs">

					<span class="pr-1"><a href="<?php echo get_home_url(); ?>"><?php _e("inicio","esgalla"); ?></a></span><i class="fas fa-angle-left pr-1"></i>

					<?php echo get_term_parents_list(get_queried_object()->term_id, get_queried_object()->taxonomy, array('separator' => ' <i class="fas fa-angle-left pr-1"></i> ', 'inclusive' => false)) ?>

					<span class="last-breadcrumb"><a href="#"><?php echo get_queried_object()-> name ?></a></span>

				</div>

			</div>

		</div>

	</div>

</section>

*/ ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<section class="header-categoria mt-2 mt-md-3">

	<div class="container">



		<div class="row">

			<div class="col-12 col-xl-3">

				<h1 class="h1 font-weight-bold"><?php echo get_queried_object()->name; ?></h1>

			</div>

			<div class="col-12 col-xl-7">

				<p class="text-gray pr-lg-7 pt-lg-1 font-weight-light fs-19 "><?php echo get_queried_object()->description; ?></p>

			</div>

		</div>



		<div class="row align-items-start">

			<div class="col-12 d-block d-md-none">

				<button class="btn btn-secondary text-uppercase rounded-0 px-4 mb-3 fs-1-2 text-light text-left" data-toggle="collapse" data-target="#facetWp" aria-expanded="false" aria-controls="facetWp">Abrir filtros</button>

			</div>





			<div class="col-12 col-md-4 col-lg-3 collapse not-collapse-md filtro-facet" id="facetWp">

				<?php echo facetwp_display( 'selections' ) ?>

				<div class="facetwp-facet"><?php woocommerce_catalog_ordering(); ?></div>

				<?php echo facetwp_display( 'facet', 'buscador_productos' ); ?>

				<?php echo facetwp_display( 'facet', 'price_range' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_motosierras' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_aceites_y_gasolinas' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_aspiradoras' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_cortacespedes' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_cortasetos' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_desbrozadoras' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_herramientas_forestales' ); ?>

				<?php echo facetwp_display( 'facet', 'categora_hidrolimpiadoras' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_juguetes' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_merchandising' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_motoazada' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_ropa' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_sopladores' ); ?>

				<?php echo facetwp_display( 'facet', 'categora_soplanieves' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_automower' ); ?>

				<?php echo facetwp_display( 'facet', 'categoria_escarificadores_cesped' ); ?>

				<?php echo facetwp_display( 'facet', 'superficie_jardn' ); ?>


				<div class="ta-c"><a class="btn btn-primary" href="javascript:void(0)" onclick="FWP.reset()"><?php _e("Limpiar filtros", "esgalla"); ?></a></div>

			</div>



			<div class="products col-12 col-md-8 col-lg-9 d-flex flex-wrap justify-content-start w-100">

				<?php echo shortcode_fichas( array("t"=>"product", "c" => 15, "a" =>false, "d"=> "33", 'f' => 'producto')); ?>

				<div class="pt-3 w-100 d-flex justify-content-center">

					<?php echo facetwp_display( 'facet', 'paginacin' ); ?>

					<div class="d-none">

						<?php the_posts_pagination(); ?>

						<!-- <span class="bg-secondary border text-white px-2 mr-1">1</span><span class="text-secondary border px-2 mr-1">2</span><span class="text-secondary border px-2 mr-1">3</span><span class="text-secondary border px-2 mr-1">4</span> -->

					</div>

				</div>

			</div>



		</div>

	</div>

</section>

<?php do_action( 'woocommerce_after_main_content' ); ?>


<?php if(get_field('texto_seo', get_queried_object())!=''): ?>
<section class="product-cat-info mt-8 bg-light">

	<div class="container py-4 py-md-6">

		<div class="row">

			<div class="col-12 col-lg-9 fs-36">
				<?php echo str_replace('<p>', '<p class="pt-4 pr-5 fs-19 font-weight-light text-gray">', get_field('texto_seo', get_queried_object())) ?>

			</div>

			<div class="col-12 col-lg-3 d-flex flex-wrap justify-content-between w-100">

				<?php for ($i = 1; $i <= 3; $i++): ?>

					<div class="w-100">

						<?php get_template_part('template-parts/ficha', 'noticia', array('id_noticia'=>$ficha)); ?>

					</div>

				<?php endfor; ?>

			</div>

		</div>

	</div>

</section>

<?php endif; ?>
<?php // if(get_field('objeto_opiniones', get_queried_object())!=''): ?>
<?php if(get_field('objeto_opiniones', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id)):
	
	//** var_dump(get_field('objeto_opiniones', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id));

	get_template_part('template-parts/content', 'testimonial');
endif; ?>

<?php get_footer();

