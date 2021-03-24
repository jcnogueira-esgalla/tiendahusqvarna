<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Esgalla
 */

get_header();
$shareUrl = urlencode(home_url( $wp->request ));
?>

<header id="masthead" class="portada-post px-20" style="background-image:url(<?php echo get_the_post_thumbnail_url( )?>)">
	<div class="d-flex flex-column justify-content-center tit-portada mx-auto">

		<h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php the_title() ?></h1>

	</div>
</header>
<?php /*
<section id="breadcrumb" class="py-2 py-md-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="text-primary breadcrumbs"><span class="pr-1"><a href="<?php echo get_home_url(); ?>"><?php _e("inicio","esgalla"); ?></a></span><i class="fas fa-angle-left pr-1"></i><span class="last-breadcrumb"><a href="#">blog</a></span></div>
			</div>
		</div>
	</div>
</section>
*/ ?>
<section class="py-3 py-md-4">
	<div class="container">
		<div class="row">
			<div class="col-12 post-content col-lg-9 pr-lg-7">
				<? the_content(); ?>
				<div class="cta-categoria my-4 my-md-5">
					<?php if(get_field('categoria_relacionada_productos')): ?>
						<?php $cat_prod_relacionado = get_field('categoria_relacionada_productos'); ?>
						<p class="text-white font-weight-bold text-uppercase"><?php echo $cat_prod_relacionado->description ?></p>
						<a href="<?php echo get_category_link($cat_prod_relacionado->term_id); ?>" class="text-light font-italic font-weight-bold subtit-automower text-decoration-none"><?php _e("ver más","esgalla"); ?> <?php echo $cat_prod_relacionado->name ?></a>
					<?php else: ?>
						<p class="text-white font-weight-bold text-uppercase"><?php echo get_the_category( )[0]->description ?></p>
						<a href="<?php echo get_category_link(get_the_category( )[0]->term_taxonomy_id); ?>" class="text-light font-italic font-weight-bold subtit-automower text-decoration-none"><?php _e("ver más","esgalla"); ?> <?php echo get_the_category( )[0]->name ?></a>
					<?php endif; ?>
				</div>
				<div class="compartir-noticia d-flex justify-content-between px-md-4 pt-3 pt-md-4 border-top">
					<p class="text-dark font-weight-bold"><?php _e("¡Comparte este artículo!","esgalla"); ?></p>
					<div class="redes">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" target="_blank"><i class="fab fa-facebook mr-3 fs-fa"></i></a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareUrl; ?>&title=&summary=<?php echo get_the_title(); ?>&source=" target="_blank"><i class="fab fa-linkedin fs-fa mr-3"></i></a>
						<a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo $shareUrl; ?>&hashtags=husqvarna" target="_blank"><i class="fab fa-twitter fs-fa"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3 mt-5 mt-md-0">
				<h4 class="font-weight-bold text-uppercase text-dark text-center text-lg-left"><?php _e("productos relacionados","esgalla"); ?></h4>
					<?php
					$relacionados_por_defecto = (get_site_url( ) == 'https://lojahusqvarna.com') ? array(9282, 9322, 9456) : array(11633, 12732, 12191) ;
					$productos_relacionados = (!get_field('productos_relacionados') || get_field('productos_relacionados')=='') ? $relacionados_por_defecto : get_field('productos_relacionados') ;
					foreach($productos_relacionados as $id_relacionado): ?>
					<div class="w-100 mt-4">
						<?php get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $id_relacionado)); ?>
					</div>
					<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<section id="#ofertas" class="bg-white pt-6">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="h2 text-center text-uppercase tit-line font-weight-bold"><?php _e("noticias relacionadas","esgalla"); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12 mt-4 mt-lg-5 mb-3 mb-lg-5 slick-noticias">
				<?php
					$ultimas_entradas = get_posts( array(
						'numberposts' => 12,
						'category' => get_the_category( )[0]->term_id,
						'post__not_in' => array(get_the_ID())
					) );
					foreach ($ultimas_entradas as $entrada) {
						get_template_part( 'template-parts/ficha','noticia',array('id_noticia'=>$entrada->ID));
					}
				?>
			</div>
		</div>
	</div>
</section>


<?php
get_footer();
