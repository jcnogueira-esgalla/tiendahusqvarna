<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Esgalla
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<script>var cookies = [];</script>
	<?php if(get_current_blog_id() == 1): //España ?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-W9LQ67X');</script>
			<!-- End Google Tag Manager -->
	<?php endif; ?>
	<?php if(get_current_blog_id() == 2): //Portugal ?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-WPRLPZS');</script>
			<!-- End Google Tag Manager -->
	<?php endif; ?>

	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/e09e280ac0.js" crossorigin="anonymous"></script>

</head>

<body <?php body_class(); ?>>

<?php if(get_current_blog_id() == 1): //España ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9LQ67X"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<?php if(get_current_blog_id() == 2): //Portugal ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WPRLPZS"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>



<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'esgalla' ); ?></a>

	<div class="topbar topbar-first bg-secondary border-bottom text-center py-2 justify-content-center d-none d-md-flex">
		<div class="subheader bg-secondary text-white d-flex justify-content-between w-100">
			<a href="tel:<?php _e("+34 981 680 101", "esgalla") ?>" class="text-light p"><i class="fas fa-phone pr-2"></i><?php _e("981 680 101", "esgalla") ?></a>
			<a href="mailto:<?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?>" class="text-light p"><i class="fas fa-envelope pr-2"></i><?php _e("soportecliente@tiendahusqvarna.com", "esgalla") ?></a>
			<p class="text-light"><i class="fas fa-undo pr-2"></i><?php _e("Devolución garantizada", "esgalla") ?></p>
			<p class="text-light"><i class="fas fa-check pr-2"></i><?php _e("Garantía Husqvarna", "esgalla") ?></p>
			<p class="text-light"><i class="fas fa-truck pr-2"></i><?php _e("¡Envíos GRATIS!", "esgalla") ?></p>
			<p class="text-light"><i class="fas fa-money-bill-wave pr-2"></i><?php _e("Pago seguro", "esgalla") ?></p>
			<?php if(get_post_type()!='post'): ?>
			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>" class="text-light p"><?php _e("BLOG", "esgalla") ?></a>
			<?php else: ?>
			<!--<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) )?>" class="text-light p"><?php _e("TIENDA", "esgalla") ?></a>-->
			<?php endif; ?>
		</div>
	</div>
	
	<?php get_template_part( 'template-parts/navbar', 'fixed' ); ?>
