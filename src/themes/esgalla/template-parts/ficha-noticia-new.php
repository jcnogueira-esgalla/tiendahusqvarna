<? $id_noticia = $args['id_noticia']; ?>
<a href="<? echo get_the_permalink($id_noticia); ?>" class="ficha-noticia-new d-flex flex-column justify-content-between text-decoration-none mb-3">
	<div class="contenedor-titulo-noticia d-flex" style="background:linear-gradient(180deg, rgba(39, 58, 96, 0) 36.2%, #273A60 77.25%),url('<?=get_the_post_thumbnail_url( $id_noticia, 'medium' ) ?>');">
		<h2 class="h6 fs-18 text-white mt-auto"><?=mb_strimwidth(get_the_title($id_noticia), 0, 80, '...')?></h2>
	</div>
	<div class="text-primary link-noticia p-2 pr-3 font-weight-bold font-italic fs-18 position-relative text-right bg-white">
		<? _e("Leer más","esgalla"); ?> <i class="fas fa-arrow-right ml-2"></i>
	</div>
</a>
