<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Esgalla
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container">

			<div class="row">

			<div class="col-12">
            <div class="col-12 pb-5 row">
            <div class="col-12 col-md-6">
            <div class="bloque mb-5">
            <h2 id="pages" class="fs-24 lh-32 black fw-600 mb-40">Páginas</h2>
            <ul>
                <?php
                // Add pages you'd like to exclude in the exclude here
                wp_list_pages(
                    array(
                    'exclude' => 'Contacto del delegado de proteccion de datos',
                    'title_li' => '',
                    )   
                );
                ?>
            </ul>
            </div>
            <div class="bloque mb-5">
            <h2 id="posts" class="fs-24 lh-32 black fw-600 mb-40">Entradas</h2>
            <ul>
            <?php
            // Add categories you'd like to exclude in the exclude here
            $cats = get_categories('exclude=');
            foreach ($cats as $cat) {
                echo "<li><h3 class='fs-18 fw-600 lh-24 black pt-4'>".$cat->cat_name."</h3>";
                echo "<ul  class='mb-0'>";
                query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
                while(have_posts()) {
                the_post();
                $category = get_the_category();
                // Only display a post link once, even if it's in multiple categories
                if ($category[0]->cat_ID == $cat->cat_ID) {
                    echo '<li class="page_item"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                }
                }
                echo "</ul>";
                echo "</li>";
            }
            ?>
            </ul>
            </ul>
            </div>
            </div>
            <div class="col-12 col-md-6">
            <div class="bloque mb-5">
            <h2 id="posts" class="fs-24 lh-32 black fw-600 mb-40">Produtos</h2>
            <ul>
            <?php
            $args = array( 'status' => 'publish', 'limit' => -1 );
            $products = wc_get_products( $args );
        
            foreach ( $products as $product ){
                $product_id = $product->id;
                echo '<li class="page_item"><a href="'.get_permalink($product_id).'">'.get_the_title($product_id).'</a></li>';
            }
            ?>
            </div>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	</main><!-- #main -->

<?php
get_footer();
