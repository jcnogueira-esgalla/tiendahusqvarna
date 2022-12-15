<?php
/**
 * The template for displaying all single landings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-landings
 *
 * @package Esgalla
 */

get_header();
$shareUrl = urlencode(home_url( $wp->request ));
?>

	<header id="masthead" class="portada-post px-20" style="background-image:url(<?php echo get_the_post_thumbnail_url( )?>)">
	<div class="d-flex flex-column justify-content-center tit-portada mx-auto">
		<h1 class="text-center py-3 py-md-6 m-0 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php the_title() ?></h1>
	</div>
	</header>
	<section class="py-3 py-md-4">
		<div class="container">
			<div class="row">
				<div class="col-12 post-content col-lg-12">
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
						<?php if(get_current_blog_id() == 1): //España ?>
							<p class="text-dark font-weight-bold"><?php _e("¡Comparte este artículo!","esgalla"); ?></p>
						<?php elseif(get_current_blog_id() == 2): //Portugal ?>
							<p class="text-dark font-weight-bold"><?php _e("¡Partilhe este artigo!","esgalla"); ?></p>
						<?php endif; ?>
						<div class="redes">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" target="_blank"><i class="fab fa-facebook mr-3 fs-fa"></i></a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareUrl; ?>&title=&summary=<?php echo get_the_title(); ?>&source=" target="_blank"><i class="fab fa-linkedin fs-fa mr-3"></i></a>
							<a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo $shareUrl; ?>&hashtags=husqvarna" target="_blank"><i class="fab fa-twitter fs-fa"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
<?php
get_footer();
