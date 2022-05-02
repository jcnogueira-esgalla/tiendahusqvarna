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
				<p class="font-weight-light fs-19 text-gray pt-2 pr-lg-5">
					¿Tienes un jardín y no sabes cómo cuidarlo? ¿Quieres decorar un espacio soso o aburrido y buscas inspiración? Si es así, nuestros artículos de jardinería y fichas te ayudarán a lograrlo.
					Además, nuestros post profesionales te enseñarán a trabajar con nuestras máquinas y equipos.
				</p>
			</div>
		</div>
	</div>
</section>

<? if( isset($_GET['newblog']) ): ?>
	<? if( !isset($_GET['search']) ): ?>
		<div class="container mt-4">
			<div class="row">
				<div class="col-12 col-md-9 ml-md-auto buscador-blog">
					<div class="row">
						<div class="col-12 col-lg-6">
							<p class="mt-4 mb-2">Encuentra un artículo</p>
							<form role="search" method="get" class="search-form input-group border" action="<?php echo get_home_url( '/blog/' ) ?>">
								<input type="search" data-swpengine="buscador_blog" id="searchNoticia" class="form-control" placeholder="<?php _e("Buscar...","esgalla"); ?>" value="" name="search">
								<button class="btn btn-secondary rounded font-weight-bold text-uppercase" type="submit"><i class="fas fa-search"></i></button>
							</form>
						</div>
						<div class="col-12 col-lg-6">
							<p class="mt-4 mb-2">Elige una categoría</p>
							<div class="form-group selector-categoria-blog">
								<?
									$catsPrincipales = get_categories([
										'parent' => 0,
									]);
									$catsPrincipalesIds = [];
								?>
								<select class="form-control border px-2" id="selector-categoria-blog">
									<option>Categoría</option>
									<? foreach ($catsPrincipales as $cat) : ?>
										<option data-url="<?=get_term_link($cat->term_id)?>"><?=$cat->name;?></option>
										<? $catsPrincipalesIds[] =  $cat->term_id;?>
									<? endforeach; ?>
								</select>
								<i class="fas fa-chevron-down text-secondary chevron-select"></i>
							</div>
						</div>
					</div>
					<div class="categorias-post d-lg-flex flex-wrap justify-content-between mt-4">
						<?
							$cats = get_categories([
								'orderby' => 'name',
								'order' 	=> 'asc',
							]);
							$catsFiltrado = [];
							//Limpio las cats de las principales
							foreach ($cats as $cat) {
								if( !in_array($cat->term_id, $catsPrincipalesIds) ) {
									$catsFiltrado[] = $cat;
								}
							}

							$index = 1;
							foreach ($catsFiltrado as $cat) : ?>
								<? if( $index == 8 ) : ?> <div class="collapse" id="collapseBlogCategories"><div class="d-lg-flex flex-wrap justify-content-start"> <? endif; ?>
									<a href="<?=get_term_link($cat->term_id)?>" class="btn btn-outline-secondary mb-3 mx-1"><?=$cat->name?></a>
								<? if( $index == count($catsFiltrado) ) : ?> </div></div> <? endif; ?>
								<? $index++; ?>
						<? endforeach; ?>
					</div>
					<div class="text-right">
						<a class="font-weight-bold colapsar-categorias-blog text-decoration-capitalize" data-toggle="collapse" href="#collapseBlogCategories" role="button" aria-expanded="false" aria-controls="collapseBlogCategories">
							<span class="colapse-vermas"><? _e("Ver más","esgalla"); ?></span><span class="colapse-vermenos d-none">Ver menos</span>&nbsp;<i class="fas fa-chevron-down ml-2"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	<? endif; ?>
	<? if( isset($_GET['search']) && $_GET['search'] != '' ): ?>
		<? 
			// var_dump($_REQUEST);
			$swppg = isset( $_REQUEST['swppg'] ) ? absint( $_REQUEST['swppg'] ) : 1;
			$busqueda = isset( $_REQUEST['search'] ) ? sanitize_text_field( $_REQUEST['search'] ) : '';
			// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			if ( class_exists( 'SWP_Query' ) ) {

				//$engine = 'bbpress'; // taken from the SearchWP settings screen
				$swp_query = new SWP_Query(
					// see all args at https://searchwp.com/docs/swp_query/
					[
						's'      => $busqueda,
						'engine' => 'buscador_blog',
						'page'   => $swppg,
						'posts_per_page' => 12,
					]
				);
				// var_dump($swp_query);
				// set up pagination
				$pagination = paginate_links( array(
						'format'  => '?swppg=%#%',
						'current' => $swppg,
						'total'   => $swp_query->max_num_pages,
						'mid_size'  => 3,
						'prev_text' => __( '<< Anterior', 'esgalla' ),
						'next_text' => __( 'Siguiente >>', 'esgalla' ),
				) );
			}
		?>
		<div class="container">
			<div class="row">
				<div class="col-12 mt-5">
					<h1>Resultados de búsqueda para: <span class="h1 text-primary"><?=$busqueda?></span>
				</div>
			</div>
			<div class="row my-3 mt-md-5 mb-md-3">
				<? foreach ( $swp_query->posts as $post ) : ?>
					<?
						$category = get_the_category($post->ID);
						$hierarchy = array_reverse( get_ancestors( $category[0]->term_id, 'category' ) );
						$hierarchy[] = $category[0]->term_id;
					?>
					<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
						<? get_template_part( 'template-parts/ficha','noticia-new',array('id_noticia'=>$post->ID, 'categoria' => $hierarchy[0])); ?>
					</div>
				<? endforeach; ?>
			</div>

			<!-- paginación -->
			<div class="w-100 d-flex justify-content-center mb-5 pagination-new-blog">
				<div class="nav-links">
					<?= $pagination; ?>
				</div>
			</div>
			<!-- paginación -->

			<div class="" style="margin-bottom:80px;">
				<div class="row">
					<div class="col-12 col-md-9 m-md-auto buscador-blog">
						<div class="row">
							<div class="col-12 col-lg-6">
								<p class="mt-4 mb-2">Encuentra un artículo</p>
								<form role="search" method="get" class="search-form input-group border" action="<?php echo get_home_url( '/blog/' ) ?>">
									<input type="search" data-swpengine="buscador_blog" id="searchNoticia" class="form-control" placeholder="<?php _e("Buscar...","esgalla"); ?>" value="" name="search">
									<button class="btn btn-secondary rounded font-weight-bold text-uppercase" type="submit"><i class="fas fa-search"></i></button>
								</form>
							</div>
							<div class="col-12 col-lg-6">
								<p class="mt-4 mb-2">Elige una categoría</p>
								<div class="form-group selector-categoria-blog">
									<?
										$catsPrincipales = get_categories([
											'parent' => 0,
										]);
										$catsPrincipalesIds = [];
									?>
									<select class="form-control border px-2" id="selector-categoria-blog">
										<option>Categoría</option>
										<? foreach ($catsPrincipales as $cat) : ?>
											<option data-url="<?=get_term_link($cat->term_id)?>"><?=$cat->name;?></option>
											<? $catsPrincipalesIds[] =  $cat->term_id;?>
										<? endforeach; ?>
									</select>
									<i class="fas fa-chevron-down text-secondary chevron-select"></i>
								</div>
							</div>
						</div>
						<div class="categorias-post d-lg-flex flex-wrap justify-content-between mt-4">
							<?
								$cats = get_categories([
									'orderby' => 'name',
									'order' 	=> 'asc',
								]);
								$catsFiltrado = [];
								//Limpio las cats de las principales
								foreach ($cats as $cat) {
									if( !in_array($cat->term_id, $catsPrincipalesIds) ) {
										$catsFiltrado[] = $cat;
									}
								}

								$index = 1;
								foreach ($catsFiltrado as $cat) : ?>
									<? if( $index == 8 ) : ?> <div class="collapse" id="collapseBlogCategories"><div class="d-lg-flex flex-wrap justify-content-start"> <? endif; ?>
										<a href="<?=get_term_link($cat->term_id)?>" class="btn btn-outline-secondary mb-3 mx-1"><?=$cat->name?></a>
									<? if( $index == count($catsFiltrado) ) : ?> </div></div> <? endif; ?>
									<? $index++; ?>
							<? endforeach; ?>
						</div>
						<div class="text-right">
							<a class="font-weight-bold colapsar-categorias-blog text-decoration-capitalize" data-toggle="collapse" href="#collapseBlogCategories" role="button" aria-expanded="false" aria-controls="collapseBlogCategories">
								<span class="colapse-vermas"><? _e("Ver más","esgalla"); ?></span><span class="colapse-vermenos d-none">Ver menos</span>&nbsp;<i class="fas fa-chevron-down ml-2"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	<? endif; ?>
<? endif; ?>

<?php
// print_r(get_categories(array('fields'=>'id=>slug')));
$categorias_principales = array(938,943,935,948);
if(get_site_url( ) == 'https://lojahusqvarna.com') $categorias_principales = array(519,523,517,529);
foreach ($categorias_principales as $categoria):
	$datos_categoria = get_term( $categoria );
?>

<? if( isset($_GET['newblog']) ): ?>
	<? if( !isset($_GET['search']) ): ?>
		<div class="mt-5"><!-- Borrar esta seccion cuanto se publique y meterle mb a la seccion de arriba --></div>
		<section class="py-2 mb-4">
			<div class="container">
				<div class="row">
					<div class="col-12 d-flex justify-content-between">
						<h3 class="fs-40"><?php echo $datos_categoria->name ?></h3>
						<a href="<?php echo get_term_link( $categoria ) ?>" class="text-primary font-weight-bold font-italic fs-15 mt-auto mb-3 d-md-none"><?php _e("Ver todas","esgalla"); ?></a>
					</div>
					<div class="col-12 d-flex justify-content-between">
						<span class="fs-16 text-gray"><?php echo $datos_categoria->description ?></span>
						<a href="<?php echo get_term_link( $categoria ) ?>" class="text-primary font-weight-bold font-italic fs-20 mt-auto mb-3 d-none d-md-block"><?php _e("Ver todas","esgalla"); ?></a>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mt-4 slick-noticias-new">
						<?php
							$entradas = get_posts( array('numberposts'=>12,'category'=>$categoria) );
							foreach ($entradas as $entrada) {
										get_template_part( 'template-parts/ficha','noticia-new',array('id_noticia' => $entrada->ID, 'categoria' => $categoria));
							}
						?>
					</div>
				</div>
			</div>
		</section>
	<? endif; ?>
	

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
