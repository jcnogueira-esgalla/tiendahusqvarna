<header class="w-navbar header">
	<nav class="navbar mx-auto">

		<div class="navbar-bg w-100">

			<div class="px-2">



				<div class="w-100 d-flex align-content-center justify-content-between">



					<div class="d-flex justify-content-between align-items-center">

						<button class="navbar-toggler collapsed navbar-light btn-light d-none d-sm-block" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

							<img src="<?php echo get_template_directory_uri() ?>/img/toggler-azul.png" class="img-fluid toggler-azul" alt="toggler">

						</button>



						<a class="navbar-brand" href="<?php echo get_home_url(); ?>">
							<img class="logo-azul" src="<?php echo get_template_directory_uri() ?>/img/logo-azul.png" class="img-fluid logo-principal" alt="logo">
						</a>

					</div>



					<div class="buscador">

						<form role="search" method="get" class="search-form input-group" action="<?php echo get_home_url(); ?>">

							<input type="text" class="form-control" placeholder="<?php _e("¿Qué estás buscando?","esgalla"); ?>" value="" name="s" data-swplive="true">

							<div class="input-group-append">

								<button class="btn btn-secondary rounded" type="submit"><i class="fas fa-search"></i></button>

							</div>

						</form>

						<?php /*

						<div class="input-group">



							<input type="text" class="form-control" placeholder="¿Qué estás buscando?">



							<div class="input-group-append">



							<button class="btn btn-secondary rounded" type="button"><i class="fas fa-search"></i></button>



							</div>



						</div>

						*/ ?>

					</div>



					<div class="d-flex justify-content-between align-items-center">



						<div class="d-flex justify-content-between">

						<?php if(get_current_blog_id() == 1): //España ?>
							<!-- <a href="<? echo get_permalink(4396); ?>" class="text-secondary  ico-header-mobile"><i class="fas fa-envelope pr-3"></i></a> -->
						<?php elseif(get_current_blog_id() == 2): //Portugal ?>
							<!-- <a href="<? echo get_permalink(9212); ?>" class="text-secondary  ico-header-mobile"><i class="fas fa-envelope pr-3"></i></a> -->
						<?php endif; ?>
						<a href="javascript:void(0)" class="text-secondary  ico-header-mobile" data-toggle="modal" data-target=".search-modal"><i class="fas fa-search pr-3"></i></a>

							<? if(is_user_logged_in()){ ?>

							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="text-secondary  ico-header-mobile"><i class="fas fa-user pr-3"></i></a>

						<? }else{ ?>

							<a data-obj="#popup-login" href="javascript:void(0)" class="text-secondary  ico-header-mobile desplegable-desplegar"><i class="fas fa-user pr-3"></i></a>

						<? } ?>

							<a href="<?php echo wc_get_cart_url(); ?>" data-obj="#mini-cart" class="text-secondary  ico-header-mobile desplegable-desplegar"><i class="fas fa-shopping-cart"></i></i></a>



						</div>

						<button class="navbar-toggler collapsed btn-light d-block d-sm-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

							<img src="<?php echo get_template_directory_uri() ?>/img/toggler-azul.png" class="img-fluid toggler-azul" alt="toggler">

						</button>



					</div>



				</div>

				<!-- <div class="buscador-mobile mx-auto">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="¿Qué estás buscando?">
						<div class="input-group-append">
							<button class="btn btn-secondary rounded" type="button"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</div> -->



				<?php esgalla_header_menu(); ?>



			</div>

		</div>

	</nav>
</header>





<?php if ( function_exists('yoast_breadcrumb') && !is_front_page()): ?>

<section id="breadcrumb" class="py-2 py-md-4">

	<div class="container">

		<div class="row">

			<div class="col">

				<div class="text-primary breadcrumbs">

				<?php if( is_page( 17399 ) || is_page( 23130 )) { ?>
 					<div class="text-primary breadcrumbs">
					 	<span><span><a href="/">Portada</a> &gt;  <a href="/automower/">Automower®</a> &gt; <strong class="breadcrumb_last" aria-current="page">Automower® > Opiniones</strong></span></span>		   
			   		</div>

					   
					   
				<?php } else{ ?>

					  <?php yoast_breadcrumb( '',''); ?>

				<?php } ?>
				
				</div>

			</div>

		</div>

	</div>

</section>



<?php endif; ?>

