<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Esgalla
 */

get_header();
?>

<section class="py-3 py-md-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1 class="text-dark font-weight-bold"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Has buscado por: %s', 'esgalla' ), '<span class="h1 font-weight-bold">' . get_search_query() . '</span>' );
					?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12 d-block d-md-none">
				<button class="btn btn-secondary text-uppercase rounded-0 px-4 my-3 fs-1-2 text-light text-left" data-toggle="collapse" data-target="#facetWp" aria-expanded="false" aria-controls="facetWp">Abrir filtros</button>
			</div>
		</div>
	</div>
</section>




<?php
get_footer();
