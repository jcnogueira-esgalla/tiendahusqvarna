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

<? if( get_field('activar_plantilla_nueva') == true ): ?>
	<? if( have_rows('campos_plantilla_nueva') ): ?>

			<div class="container">
				<? while ( have_rows('campos_plantilla_nueva') ) : the_row();
					if( get_row_layout() == 'texto_izq_con_imagen_dcha' ):
						$content = get_sub_field('texto_izq_con_imagen_dcha');
						$text = $content['texto'];
						$imagen = $content['imagen']; ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 col-lg-6">
									<?= (get_row_index() == 1) ? '<h1>' . get_the_title() . '</h1>' : '' ; ?>
									<div class="wysiwyg">
										<?=$text?>
									</div>
								</div>
								<div class="col-12 col-lg-6 text-center">
									<?= wp_get_attachment_image($imagen, 'large') ?>
								</div>
							</div>
						</div>

					<? elseif( get_row_layout() == 'texto_dcha_con_imagen_izq' ):
						$content = get_sub_field('texto_dcha_con_imagen_izq');
						$text = $content['texto'];
						$imagen = $content['imagen']; ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 col-lg-6">
									<?= (get_row_index() == 1) ? '<h1>' . get_the_title() . '</h1>' : '' ; ?>
									<div class="wysiwyg">
										<?=$text?>
									</div>
								</div>
								<div class="col-12 col-lg-6 text-center order-lg-first">
									<?= wp_get_attachment_image($imagen, 'large') ?>
								</div>
							</div>
						</div>

					<? elseif( get_row_layout() == 'cita' ): 
						$cita = get_sub_field('cita'); ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto text-center">
									<div class="text-secondary font-weight-bold fs-26 py-4 px-4 px-sm-5 px-md-5 cita-quotes"><?=$cita?></div>
								</div>
							</div>
						</div>

					<? elseif( get_row_layout() == 'tabla' ): 
						$titulo = get_sub_field('titulo');
						$tabla = get_sub_field('tabla'); ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 text-secondary font-weight-bold fs-26 mb-4">
									<?=$titulo?>
								</div>
								<div class="col-12 tabla-post">
									<? foreach($tabla as $fila): ?>
										<?
											$fila_content = $fila['linea'];
											$titulo = $fila_content['titulo'];
											$descripcion = $fila_content['descripcion'];
										?>
										<div class="mx-3">
											<div class="row">
												<div class="col-6 col-lg-3 bg-secondary text-white font-weight-bold py-2 tabla-post-titulo"><?=$titulo?></div>
												<div class="col-6 col-lg-5 py-2 tabla-post-descripcion"><?=$descripcion?></div>
											</div>
										</div>
									<? endforeach; ?>
								</div>
							</div>
						</div>

					<? elseif( get_row_layout() == 'slider_productos' ): 
						$productos = get_sub_field('slider_productos'); ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 text-secondary font-weight-bold fs-26 mb-4">
									Decubre nuestra gama de productos
								</div>
								<div class="col-12 slick-productos-blog">
									<?
										$post_idx =1;
										foreach($productos as $producto) {
											get_template_part('template-parts/ficha', 'producto-blog', array('id_producto' => $producto, 'position' => $post_idx));
											$post_idx++;
										}
									?>
								</div>
							</div>
						</div>

					<? elseif( get_row_layout() == 'acordeones' ): 
						// Do something...

					elseif( get_row_layout() == 'texto' ): ?>
						<div class="mb-5">
							<div class="row" id="#seccion-post-<?=get_row_index()?>">
								<div class="col-12 wysiwyg wysiwyg-blog">
									<div><?=get_sub_field('texto')?></div>
								</div>
							</div>
						</div>

					<? endif;

				// End loop.
				endwhile; ?>
				<div class="cta-categoria-blog mb-5">
					<?php if(get_field('categoria_relacionada_productos')): ?>
						<?php $cat_prod_relacionado = get_field('categoria_relacionada_productos'); ?>
						<p class="text-white font-weight-bold text-uppercase"><?php echo $cat_prod_relacionado->description ?></p>
						<a href="<?php echo get_category_link($cat_prod_relacionado->term_id); ?>" class="text-light font-italic font-weight-bold subtit-automower text-decoration-none"><?php _e("ver más","esgalla"); ?> <?php echo $cat_prod_relacionado->name ?></a>
					<?php else: ?>
						<p class="text-white font-weight-bold text-uppercase"><?php echo get_the_category( )[0]->description ?></p>
						<a href="<?php echo get_category_link(get_the_category( )[0]->term_taxonomy_id); ?>" class="text-light font-italic font-weight-bold subtit-automower text-decoration-none"><?php _e("ver más","esgalla"); ?> <?php echo get_the_category( )[0]->name ?></a>
					<?php endif; ?>
				</div>
				<div class="mb-5">
					<div class="row">
						<div class="col-12">
							<h4 class="font-weight-bold text-capitalize text-dark text-center text-lg-left"><?php _e("productos relacionados","esgalla"); ?></h4>
						</div>
						<div class="col-12 slick-productos-blog">
							<?
							$relacionados_por_defecto = (get_site_url( ) == 'https://lojahusqvarna.com') ? array(9282, 9322, 9456) : array(11633, 12732, 12191) ;
							$productos_relacionados = (!get_field('productos_relacionados') || get_field('productos_relacionados')=='') ? $relacionados_por_defecto : get_field('productos_relacionados') ;
							$post_idx =1;
							foreach($productos_relacionados as $id_relacionado): ?>
								<? get_template_part('template-parts/ficha', 'producto-blog', array('id_producto' => $producto, 'position' => $post_idx)); ?>
								<? $post_idx++; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="compartir-noticia-blog d-flex justify-content-start">
					<?php if(get_current_blog_id() == 1): //España ?>
						<p class="text-secondary font-weight-bold"><?php _e("¡Comparte este artículo!","esgalla"); ?></p>
					<?php elseif(get_current_blog_id() == 2): //Portugal ?>
						<p class="text-secondary font-weight-bold"><?php _e("¡Partilhe este artigo!","esgalla"); ?></p>
					<?php endif; ?>
					<div class="redes ml-3">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" target="_blank"><i class="fab fa-facebook text-secondary mr-3 fs-fa"></i></a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareUrl; ?>&title=&summary=<?php echo get_the_title(); ?>&source=" target="_blank"><i class="fab fa-linkedin text-secondary fs-fa mr-3"></i></a>
						<a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo $shareUrl; ?>&hashtags=husqvarna" target="_blank"><i class="fab fa-twitter text-secondary fs-fa"></i></a>
					</div>
				</div>
			</div>
		<? else :
			// Do something...
		endif;
	?>

<? else: ?>
	<header id="masthead" class="portada-post px-20" style="background-image:url(<?php echo get_the_post_thumbnail_url( )?>)">
	<div class="d-flex flex-column justify-content-center tit-portada mx-auto">
		<h1 class="text-center pt-3 pt-md-6 text-light font-weight-bold w-100 text-uppercase mx-auto"><?php the_title() ?></h1>
	</div>
</header>
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
<? endif; ?>




<?php
get_footer();
