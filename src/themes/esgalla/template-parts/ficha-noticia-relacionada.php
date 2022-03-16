<? $id_noticia = $args['id_noticia']; ?>

<div class="media ficha-noticia-relacionada position-relative">
	<?=get_the_post_thumbnail(get_the_ID(),'thumbnail', ['class' => 'mr-3'])?>
	<div class="media-body d-flex flex-column">
		<h5 class="mt-0 fs-16 titulo-noticia">
			<a href="<?=get_permalink()?>" class="text-secondary stretched-link text-decoration-none"><?=mb_strimwidth(get_the_title(), 0, 80, '...')?></a>
		</h5>
		<div class="text-primary link-noticia p-2 font-weight-bold font-italic fs-18 position-relative text-right bg-white align-self-end">
			<? _e("Leer más","esgalla"); ?> <i class="fas fa-arrow-right ml-2"></i>
		</div>
	</div>
</div>