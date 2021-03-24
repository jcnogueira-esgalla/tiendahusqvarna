<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cursos.com
 */

get_header();
?>

	<main id="primary" class="site-main text-center">

		<section class="error-404 not-found py-5 py-sm-6 py-md-7 text-center">

			<header class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h5 class="display-1 font-weight-bold text-primary">404</h5>
							<h1 class="page-title">Ups! No pudimos encontrar esa página.</h1>
						</div>
					</div>
				</div>
			</header><!-- .page-header -->

			<div class="page-content">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-sm-12">
							<p>Parece que no se encontró nada en esta ubicación. ¿Quizás quieras probar una búsqueda?</p>
						</div>
						<div class="col-md-8 buscador-principal">
							<div class="mt-4 mt-md-5 mt-lg-6 input-group shadow">
							    <input type="text" class="form-control" placeholder="<?php _e("¿Qué estás buscando?","esgalla"); ?>">
							    <div class="input-group-append">
							      <button class="btn btn-secondary rounded shadow text-uppercase font-weight-bold" type="button"><?php _e("Buscar","esgalla"); ?></button>
							    </div>
							</div>
						</div>
						<div class="col-sm-12">
							<p class="mt-4 mt-md-6">O también puedes</p>
							<a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-primary btn-fw py-2 px-3">Ir al Inicio</a>
						</div>
					</div>
				</div>
			</div>

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
