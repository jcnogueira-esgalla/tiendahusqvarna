<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Esgalla
 */

get_header();
?>

<header id="masthead" class="portada-blog px-20">
	<div class="d-flex flex-column justify-content-center tit-portada mx-auto">

		<h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php _e("Blog","esgalla"); ?> <span class="h1 font-weight-bold text-primary text-shadow">HUSQVARNA</span> <?php _e("un espacio de inspiración","esgalla"); ?></h1>

	</div>
</header>

<section class="pt-md-4 py-3 pb-md-4 bg-light">
	<div class="container">
		<div class="row">
            <div class="col-12 col-md-3">
            	<p class="h2 font-weight-bold fs-40"><?php _e("Blog","esgalla"); ?></p>
            </div>
            <div class="col-12 col-md-9">
            	<p class="font-weight-light fs-19 text-gray pt-2 pr-lg-5">¿Tienes un jardín y no sabes cómo cuidarlo? ¿Quieres decorar un espacio soso o aburrido y buscas inspiración? Si es así, nuestros artículos de jardinería y fichas te ayudarán a lograrlo.
				Además, nuestros post profesionales te enseñarán a trabajar con nuestras máquinas y equipos.
				</p>
            </div>
		</div>
	</div>
</section>

<?php
// print_r(get_categories(array('fields'=>'id=>slug')));
$categorias_principales = array(938,943,935,948);
if(get_site_url( ) == 'https://lojahusqvarna.com') $categorias_principales = array(519,523,517,529);
foreach ($categorias_principales as $categoria):
	$datos_categoria = get_term( $categoria );
?>

<? if( isset($_GET['newblog']) ): ?>

	<section class="py-2 py-md-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-3">
					<h3 class="fs-40"><?php echo $datos_categoria->name ?></h3>
					<div class="text-primary subtit-arrow pt-3 font-weight-bold font-italic fs-18 position-relative"><a href="<?php echo get_term_link( $categoria ) ?>"><?php _e("ver más","esgalla"); ?> <?php echo mb_strtolower($datos_categoria->name) ?></a></div>
				</div>
				<div class="col-12 col-md-8 col-lg-7">
					<p class="font-weight-light fs-19 text-gray pt-2 pr-md-5 pr-lg-6"><?php echo $datos_categoria->description ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-4 mt-lg-5 slick-noticias">
					<?php
						$ultimas_entradas = get_posts( array('numberposts'=>12,'category'=>$categoria) );
						foreach ($ultimas_entradas as $entrada) {
									get_template_part( 'template-parts/ficha','noticia-new',array('id_noticia'=>$entrada->ID));
						}
					?>
				</div>
			</div>
		</div>
	</section>

<? else: ?>

	<section class="py-2 py-md-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-3">
					<h3 class="fs-40"><?php echo $datos_categoria->name ?></h3>
					<div class="text-primary subtit-arrow pt-3 font-weight-bold font-italic fs-18 position-relative"><a href="<?php echo get_term_link( $categoria ) ?>"><?php _e("ver más","esgalla"); ?> <?php echo mb_strtolower($datos_categoria->name) ?></a></div>
				</div>
				<div class="col-12 col-md-8 col-lg-7">
					<p class="font-weight-light fs-19 text-gray pt-2 pr-md-5 pr-lg-6"><?php echo $datos_categoria->description ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-4 mt-lg-5 slick-noticias">
					<?php
						$ultimas_entradas = get_posts( array('numberposts'=>12,'category'=>$categoria) );
						foreach ($ultimas_entradas as $entrada) {
									get_template_part( 'template-parts/ficha','noticia',array('id_noticia'=>$entrada->ID));
						}
					?>
				</div>
			</div>
		</div>
	</section>
<? endif; ?>

<?php endforeach; ?>

<?php
get_footer();
