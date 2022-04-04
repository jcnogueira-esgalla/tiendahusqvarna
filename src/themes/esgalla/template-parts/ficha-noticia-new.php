<?
 	$id_noticia = $args['id_noticia'];
	$cat_noticia = $args['categoria'];
?>
<a href="<? echo get_the_permalink($id_noticia); ?>" class="ficha-noticia-new d-flex flex-column justify-content-between text-decoration-none mb-3">
	<?
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
	<div class="contenedor-titulo-noticia d-flex" style="background:linear-gradient(180deg, rgba(39, 58, 96, 0) 36.2%, #273A60 77.25%),url('<?=$imagen;?>');">

		<h2 class="h6 fs-18 text-white mt-auto"><?=mb_strimwidth(get_the_title($id_noticia), 0, 80, '...')?></h2>
	</div>
	<div class="text-primary link-noticia p-2 pr-3 font-weight-bold font-italic fs-18 position-relative text-right bg-white">
		<? _e("Leer más","esgalla"); ?> <i class="fas fa-arrow-right ml-2"></i>
	</div>
</a>
