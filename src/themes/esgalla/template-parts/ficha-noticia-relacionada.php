<? 
	$cat_noticia = $args['categoria'];

	//Lógica imagen para listados
	if(get_field('activar_plantilla_nueva', $id_noticia)) {
		$imagen = get_the_post_thumbnail_url( $id_noticia, 'medium' );
		if(!$imagen) {
			//No tiene imagen destacada definida. Pillo las de la categoría. 1 aleatoria.
			$defaultImagenes = get_field('imagenes_listados_articulos', 'category_' . $cat_noticia );
			$randImage = array_rand($defaultImagenes, 1);
			$imagen = wp_get_attachment_url( $defaultImagenes[$randImage] );
		}
	} else {
		//Es la plantilla antigua, pillo las randoms de categoría. 1 aleatoria.
		$defaultImagenes = get_field('imagenes_listados_articulos', 'category_' . $cat_noticia );
		$randImage = array_rand($defaultImagenes, 1);
		$imagen = wp_get_attachment_url( $defaultImagenes[$randImage] );
	}
?>

<div class="media ficha-noticia-relacionada position-relative">
	<img src="<?=$imagen;?>"/>
	<div class="media-body d-flex flex-column pl-3">
		<h5 class="mt-0 fs-16 titulo-noticia">
			<a href="<?=get_permalink()?>" class="text-secondary stretched-link text-decoration-none"><?=mb_strimwidth(get_the_title(), 0, 80, '...')?></a>
		</h5>
		<div class="text-primary link-noticia p-2 font-weight-bold font-italic fs-18 position-relative text-right bg-white align-self-end">
			<? _e("Leer más","esgalla"); ?> <i class="fas fa-arrow-right ml-2"></i>
		</div>
	</div>
</div>