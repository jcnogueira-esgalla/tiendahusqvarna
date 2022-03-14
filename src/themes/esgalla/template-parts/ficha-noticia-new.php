<?php $id_noticia = $args['id_noticia']; ?>
<a href="<?php echo get_the_permalink($id_noticia); ?>" class="ficha-noticia-new d-flex flex-column justify-content-between text-decoration-none shadow-sm rounded mb-3">
	<div class="contenedor-titulo-noticia d-flex" style="background:linear-gradient(180deg, rgba(39, 58, 96, 0) 36.2%, #273A60 77.25%),url('<?=get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>');">
		<h2 class="h6 fs-18 font-weight-bold text-white mt-auto">new <?php echo get_the_title($id_noticia); ?></h2>
	</div>
	<div class="text-primary link-noticia p-2 font-weight-bold font-italic fs-18 position-relative text-right bg-white">
		<?php _e("Leer más","esgalla"); ?> <i class="fas fa-arrow-right ml-2"></i>
	</div>
</a>
