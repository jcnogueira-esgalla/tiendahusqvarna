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

$queried_object = get_queried_object();

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
		<? if( isset($_GET['test']) ): ?>

			<?
				$children_terms = get_terms(['taxonomy' => 'product_cat', 'parent' => $queried_object->term_id]);
			?>
			<? if( !empty($children_terms) && count($children_terms) > 1 ): ?>

				<div class="row mt-3 mb-4 my-md-5">
					<? foreach ( $children_terms as $term ): ?>
						<div class="col-12 col-sm-6 col-lg text-center d-flex align-items-center p-3 p-md-4">
							<a href="<? echo get_term_link( $term ) ?>" class="d-flex justify-content-center align-items-center w-100 h-100 btn btn-primary btn-cart text-white rounded-0 spacing font-weight-regular fs-125 text-center">
								<? echo $term->name . '&nbsp;' . '(' . $term->count . ')'; ?>
							</a>
						</div>
					<? endforeach; ?>
				</div>

			<? endif; ?>

		<? endif; ?>

		<div class="row align-items-start">

			<div class="col-12 d-block d-md-none">

				<button class="btn btn-secondary text-uppercase rounded-0 px-4 mb-3 fs-1-2 text-light text-left" data-toggle="collapse" data-target="#facetWp" aria-expanded="false" aria-controls="facetWp">Abrir filtros</button>

			</div>





			<div class="col-12 col-md-4 col-lg-3 collapse not-collapse-md filtro-facet" id="facetWp">

				<?php echo facetwp_display( 'selections' ) ?>

				<div class="facetwp-facet"><?php woocommerce_catalog_ordering(); ?></div>

				<?php echo facetwp_display( 'facet', 'buscador_productos' ); ?>

				<?php echo facetwp_display( 'facet', 'price_range' ); ?>

				<?php
					switch ($queried_object->term_id) {
						case '1815':	//Automower
						case '1838':	//Automower máquinas
							echo facetwp_display( 'facet', 'categoria_automower' );
							echo facetwp_display( 'facet', 'superficie_jardn' );
						break;

						case '1836':	//Accesorios Automower
							echo facetwp_display( 'facet', 'categoria_automower' );
						break;

						case '864':		//Cortacesped
						case '1817':	//Cortacéspedes
						case '1826':	//Riders cortacésped
						case '1823':	//Tractores cortacésped
						case '1818':	//Accesorios cortacésped
						case '1819':	//Cortacésped batería
						case '1820':	//Cortacésped gasolina
						case '1821':	//Cortacésped manual
							echo facetwp_display( 'facet', 'categoria_cortacespedes' );
						break;

						case '871':	//Motosierras
						case '872':	//Accesorios motosierras
						case '884':	//Aceites de cadena de motosierra
						case '900':	//Motosierras batería
						case '902':	//Motosierras eléctricas
						case '876':	//Motosierras gasolina
							echo facetwp_display( 'facet', 'categoria_motosierras' );
							//echo facetwp_display( 'facet', 'categoria_aceites_y_gasolinas' );
						break;

						case '869':	//Desbrozadoras
						case '877':	//Accesorios desbrozadoras
						case '910':	//Desbrozadoras batería
						case '870':	//Desbrozadoras gasolina
							echo facetwp_display( 'facet', 'categoria_desbrozadoras' );
						break;

						case '893':	//Cortasetos
						case '916':	//Accesorios cortasetos
						case '911':	//Cortasetos batería
						case '897':	//Cortasetos gasolina
							echo facetwp_display( 'facet', 'categoria_cortasetos' );
						break;

						case '899':	//Motoazadas
						case '925':	//Motoazadas gasolina
							echo facetwp_display( 'facet', 'categoria_motoazada' );
						break;

						case '915':	//Hidrolimpiadoras
						case '920':	//Accesorios hidrolimpiadoras
							echo facetwp_display( 'facet', 'categora_hidrolimpiadoras' );
						break;

						case '882':	//Sopladores
						case '918':	//Accesorios soplador de hojas
						case '912':	//Soplador de hojas batería
						case '883':	//Soplador de hojas gasolina
							echo facetwp_display( 'facet', 'categoria_sopladores' );
						break;

						case '921':	//Aspiradoras
						case '923':	//Accesorios de aspiradoras
							echo facetwp_display( 'facet', 'categoria_aspiradoras' );
						break;

						case '914':	//Soplanieves
							echo facetwp_display( 'facet', 'categora_soplanieves' );
						break;

						case '1834':	//Motobombas y Generadores
							//echo facetwp_display( 'facet', 'categora_soplanieves' );
						break;

						case '885':	//Aceites y gasolinas
						case '889':	//Accesorios para aceites y gasolinas
						case '887':	//Aceite motor 2 tiempos
						case '886':	//Aceite motor 4 tiempos
						case '927':	//Aceites de cadena de motosierra
						case '928':	//Gasolinas
							echo facetwp_display( 'facet', 'categoria_aceites_y_gasolinas' );
						break;

						case '873':	//Herramientas Forestales
							echo facetwp_display( 'facet', 'categoria_herramientas_forestales' );
						break;

						case '878':	//Ropa
						case '880':	//Ropa de protección
						case '879':	//Ropa de trabajo
						case '922':	//Xplorer
							echo facetwp_display( 'facet', 'categoria_ropa' );
						break;

						case '903':	//Juguetes
							echo facetwp_display( 'facet', 'categoria_juguetes' );
						break;

						case '919':	//Merchandising
							echo facetwp_display( 'facet', 'categoria_merchandising' );
						break;

						case '1816':	//Escarificadores de césped
							echo facetwp_display( 'facet', 'categoria_escarificadores_cesped' );
						break;

						default:	//Si no está contemplado metemos todos los facets
							echo facetwp_display( 'facet', 'categoria_automower' );
							echo facetwp_display( 'facet', 'superficie_jardn' );
							echo facetwp_display( 'facet', 'categoria_cortacespedes' );
							echo facetwp_display( 'facet', 'categoria_motosierras' );
							echo facetwp_display( 'facet', 'categoria_aceites_y_gasolinas' );
							echo facetwp_display( 'facet', 'categoria_desbrozadoras' );
							echo facetwp_display( 'facet', 'categoria_cortasetos' );
							echo facetwp_display( 'facet', 'categoria_motoazada' );
							echo facetwp_display( 'facet', 'categora_hidrolimpiadoras' );
							echo facetwp_display( 'facet', 'categoria_sopladores' );
							echo facetwp_display( 'facet', 'categoria_aspiradoras' );
							echo facetwp_display( 'facet', 'categora_soplanieves' );
							echo facetwp_display( 'facet', 'categoria_aceites_y_gasolinas' );
							echo facetwp_display( 'facet', 'categoria_herramientas_forestales' );
							echo facetwp_display( 'facet', 'categoria_ropa' );
							echo facetwp_display( 'facet', 'categoria_juguetes' );
							echo facetwp_display( 'facet', 'categoria_merchandising' );
							echo facetwp_display( 'facet', 'categoria_escarificadores_cesped' );
						break;
					}
				?>


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

