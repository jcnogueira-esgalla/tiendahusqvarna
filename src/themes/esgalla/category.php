<?php

/**

 * The category posts template file

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

if(get_queried_object()->parent == 0) {
	$catIdImg = get_queried_object()->term_id;
} else {
	$catIdImg = get_queried_object()->parent;
}

?>


<? if( isset($_GET['newblog']) ): ?>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="fs-32 pt-3 pt-md-6 text-secondary"><?= get_queried_object()->name; ?></h1>
				<span class="fs-16 text-gray"><?= get_queried_object()->description; ?></span>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row my-3 mt-md-5 mb-md-3">
					<?
						$args = [
							'cat' => get_queried_object()->term_id,
							'posts_per_page' => 12,
							'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
						];
						$query = new WP_Query( $args );
					?>
					<? if ( $query->have_posts() ) : ?>
						<? while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
								<? get_template_part( 'template-parts/ficha','noticia-new',array('id_noticia'=>get_the_ID(), 'categoria' => $catIdImg)); ?>
							</div>
						<? endwhile; ?>
					<? endif; ?>
				</div>
			</div>
			<!-- Paginación -->
			<div class="col-12 text-center d-flex justify-content-center pagination-new-blog mb-5">
				<? the_posts_pagination(
						[
							'mid_size'  => 3,
							'prev_text' => __( '<< Anterior', 'esgalla' ),
							'next_text' => __( 'Siguiente >>', 'esgalla' ),
						]
					);
				?>
			</div>
			<!-- Paginación -->
		</div>
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
								'orderby' => 'count',
								'order' 	=> 'desc',
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



<? else: ?>
	<header id="#masthead" class="portada-blog px-20">

<div class="d-flex flex-column justify-content-center tit-portada mx-auto">



	<!-- <h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php _e("Profesional","esgalla"); ?></h1> -->
	<h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php echo get_queried_object()->name; ?></h1>



</div>

</header>


<?php /*
<section id="breadcrumb" class="py-2 py-md-4">

<div class="container">

	<div class="row">

		<div class="col">

			<div class="text-primary breadcrumbs"><span class="pr-1"><a href="<?php echo get_home_url(); ?>"><?php _e("inicio","esgalla"); ?></a></span><i class="fas fa-angle-left pr-1"></i><span class=""><a href="#">blog</a></span></span><i class="fas fa-angle-left pr-1"></i><span class="last-breadcrumb"><a href="#">profesional</a></span></div>

		</div>

	</div>

</div>

</section>


*/ ?>
<section class="py-3 py-md-4">

<div class="container">

<?php /*
	<div class="row d-none d-md-flex">

		<div class="col-12">

			<button href="" class="btn btn-secondary text-white spacing font-weight-regular fs-125 text-center text-uppercase mr-3">subcategoría 1</button>

			<button href="" class="btn btn-tertiary  spacing  fs-125 text-center text-uppercase mr-3">subcategoría 2</button>

			<button href="" class="btn btn-tertiary  spacing  fs-125 text-center text-uppercase mr-3">subcategoría 3</button>

			<button href="" class="btn btn-tertiary  spacing  fs-125 text-center text-uppercase mr-3">subcategoría 4</button>

		</div>

	</div>

	<div class="row d-md-none">

		<div class="input-group mb-3 px-4">

			<select class="custom-select bg-light" id="inputGroupSelect01">

				<option selected><?php _e("SUBCATEGORÍAS","esgalla"); ?></option>

				<option value="1">One</option>

				<option value="2">Two</option>

				<option value="3">Three</option>

			</select>

		</div>

	</div>

	*/ ?>
	<div class="row my-3 my-md-5">

		<?php
			$args = [
				'cat' => get_queried_object()->term_id,
				'posts_per_page' => 12,
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
			];
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					echo '<div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex">';
					get_template_part( 'template-parts/ficha','noticia',array('id_noticia'=>get_the_ID()));
					echo '</div>';
				}
			}

		?>
	</div>

	<div class="w-100 d-flex justify-content-center">

		<?php the_posts_pagination(); ?>
	</div>

</div>

</section>
<? endif; ?>




<?php get_footer(); ?>
