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
    <!-- Adform Tracking Code BEGIN -->
    <script type="text/javascript">
        window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
        window._adftrack.push({
            HttpHost: 'track.adform.net',
            pm: 2316232,
        });
        (function () { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'https://s2.adform.net/banners/scripts/st/trackpoint-async.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();

    </script>
    <noscript>
        <p style="margin:0;padding:0;border:0;">
            <img src="https://track.adform.net/Serving/TrackPoint/?pm=2316232" width="1" height="1" alt="" />
        </p>
    </noscript>
    <!-- Adform Tracking Code END -->
    <!-- Global site tag (gtag.js) - Google Ads: 691985440 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-691985440"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-691985440');
    </script>
	<?php if(get_current_blog_id() == 1): //España
        $current_user = wp_get_current_user();
        $email_to_pinterest = $current_user->user_email ?? 'undefined';
        ?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-W9LQ67X');</script>
			<!-- End Google Tag Manager -->
            <!-- Facebook Pixel Code -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '4180208645345952');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
                           src="https://www.facebook.com/tr?id=1000617640306245&ev=PageView&noscript=1"
                /></noscript>
            <!-- End Facebook Pixel Code -->
            <!-- Pinterest Tag -->
        <script>
            !function(e){if(!window.pintrk){window.pintrk = function () {
                window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
                n=window.pintrk;n.queue=[],n.version="3.0";var
                t=document.createElement("script");t.async=!0,t.src=e;var
                r=document.getElementsByTagName("script")[0];
                r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");
            pintrk('load', '2614440109792', {em: '<?php echo $email_to_pinterest;?>'});
            pintrk('page');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none;" alt=""
                 src="https://ct.pinterest.com/v3/?event=init&tid=2614440109792&pd[em]=<?php echo urlencode($email_to_pinterest);?>&noscript=1" />
        </noscript>
        <!-- end Pinterest Tag -->
	<?php endif; ?>
	<?php if(get_current_blog_id() == 2): //Portugal ?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-WPRLPZS');</script>
			<!-- End Google Tag Manager -->
            <!-- Facebook Pixel Code -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '157175479846755');
                fbq('track', 'PageView');
            </script>
            <noscript>
                <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=157175479846755&ev=PageView&noscript=1"/>
            </noscript>
            <!-- End Facebook Pixel Code -->
	<?php endif; ?>

	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/e09e280ac0.js" crossorigin="anonymous"></script>

    <!-- Hreflang -->
    <?php if(get_current_blog_id() == 1): //España ?>
        <link rel="alternate" hreflang="es-ES" href="https://tiendahusqvarna.com/"/>
    <?php endif; ?>
    <?php if(get_current_blog_id() == 2): //Portugal ?>
        <link rel="alternate" hreflang="pt-PT" href="https://lojahusqvarna.com/"/>
    <?php endif; ?>


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
            <p class="text-light"><i class="fas fa-truck pr-2"></i><?php _e("¡Envío gratis a partir de 19€!", "esgalla") ?></p>

            <? if(get_current_blog_id() == 1): //España ?>
			    <p class="text-light"><i class="fas fa-money-bill-wave pr-2"></i><?php _e("Financiación hasta 6 meses sin intereses", "esgalla") ?></p>
            <? else: //Portugal ?>
                <p class="text-light"><i class="fas fa-money-bill-wave pr-2"></i><?php _e("Pago seguro", "esgalla") ?></p>
            <?endif;?>

			<?php if(get_post_type()!='post'): ?>
			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>" class="text-light p"><?php _e("BLOG", "esgalla") ?></a>
			<?php else: ?>
			<!--<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) )?>" class="text-light p"><?php _e("TIENDA", "esgalla") ?></a>-->
			<?php endif; ?>
		</div>
	</div>
	
	<?php get_template_part( 'template-parts/navbar', 'fixed' ); ?>
