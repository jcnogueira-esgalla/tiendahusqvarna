<?php

/**

* Template Name: Opiniones

*

* This is the template that displays Home

*

* @package esgalla

*/

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container">

			<div class="row">

				<div class="col-12">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'opiniones' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	</main><!-- #main -->

<?php
get_footer();
