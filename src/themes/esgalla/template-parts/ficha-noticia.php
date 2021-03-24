<?php $id_noticia = $args['id_noticia']; ?>
<a href="<?php echo get_the_permalink($id_noticia); ?>" class="ficha-noticia d-flex flex-column justify-content-between text-decoration-none shadow-sm rounded bg-white mb-3">
	<h2 class="h6 fs-18 font-weight-bold text-dark"><?php echo get_the_title($id_noticia); ?></h2>
	<div class="text-primary link-noticia pt-3 font-weight-bold font-italic fs-18 position-relative">
		leer noticia
	</div>
</a>
