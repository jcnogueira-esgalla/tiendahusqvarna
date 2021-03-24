<?php
/**
* Template Name: Ancho completo
* This is the template that displays a page with full width
* @package esgalla
*/

get_header();

?>

<main class="site-main">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile; // End of the loop.
		?>
	</div>
</main><!-- #main -->



<?php



get_footer();
