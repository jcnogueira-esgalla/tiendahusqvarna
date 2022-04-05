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
			<div class="col-12 text-center d-flex justify-content-center pagination-new-blog">
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
