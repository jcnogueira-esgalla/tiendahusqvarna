<?php

/**

 * The Template for displaying all single products

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see 	    https://docs.woocommerce.com/document/template-structure/

 * @package 	WooCommerce/Templates

 * @version     3.6.0

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



global $product;

get_header();

do_action( 'woocommerce_before_single_product' );





?>

<?php 

$primary_term_product_id = yoast_get_primary_term_id('product_cat');

$postProductTerm = get_term( $primary_term_product_id );

if(!$postProductTerm->errors) $parentcats = get_ancestors($postProductTerm->term_id, 'product_cat');



	the_post();

	//Pillamos solo los relacionados publicados
	$relacionadosIds = $product->get_cross_sell_ids();
	$relacionados = [];
	foreach ($relacionadosIds as $id) {
		$productCross = wc_get_product( $id );
		if($productCross->status == 'publish') {
			$relacionados[] = $id;
		}
	}

?>


<section class="single-product">

	<div class="container">

		<div class="row">

			<?php do_action( 'woocommerce_single_product_summary' ); ?>

			<div class="col-12 col-md-5">

				<?php echo wc_get_template( 'single-product/product-image.php' ); ?>

				<?php //print_r($product); ?>

			</div>

			<div class="col-12 col-md-6">

				<h1 class="font-weight-bold text-dark product-name text-center text-md-left"><?php echo get_the_title() ?></h1>

				<div class="text-gray spacing pt-2 text-center text-md-left">
				Ref.  <?php 

function get_variations_skus( $product_id ){
	global $wpdb;

return $wpdb->get_col("
		SELECT pm.meta_value
		FROM {$wpdb->prefix}postmeta as pm
		INNER JOIN {$wpdb->prefix}posts as p ON p.ID = pm.post_id
		WHERE p.post_type = 'product_variation'
		AND p.post_status = 'publish'
		AND p.post_parent = $product_id
		AND pm.meta_key = '_sku'
		AND pm.meta_value != ''
   ");
}
		global $product;

		// Variable product main sku
		$sku = $product->get_sku();
		
		// The variations skus for this variable product (in an array)
		$variations_skus = get_variations_skus( $product->get_id() );

							
		// Testing output variations skus:  Array to string conversion (coma separated skus)
		$x = 1;
        
        $post = get_post();
        $id =  $post->ID;
        $product_variations = new WC_Product_Variable( $id );
        $product_variations = $product_variations->get_available_variations();
		$count_variations = count($product_variations);
		
		foreach($variations_skus as $variation){
            for( $i =  0; $i < $count_variations; $i++){
			    echo '<span id="' . reset($product_variations[$i]["attributes"]) . '"class=" sku-product sku-product-' . $x++ . '">'. $product_variations[$i]['sku'] .'</span>';
            }
			break;
		}

		 ?>
					 <span class="sku-parent"><?php echo $product->get_sku(); ?></span> |
					<span class="text-primary fong-weight-light text-opacity"><?php if(!$postProductTerm->errors) echo '<a href="'.get_term_link( $postProductTerm->term_id ).'">'.$postProductTerm->name.'</a>' ?></span>
				</div>

				<?php if(!$product->is_type('variable')): ?>

					<?php if($product->get_sale_price()): ?>

						<div class="fs-36 single-price spacing-096 font-weight-bold text-dark"><del><?php echo wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())) ?></del> <precioProducto><?php echo wc_get_price_including_tax($product,array('price'=>$product->get_sale_price())) ?></precioProducto>€<span>IVA incluído</span></div>

					<?php else: ?>

						<div class="fs-36 single-price spacing-096 font-weight-bold text-dark"><precioProducto><?php echo round(wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())),2 ) ?></precioProducto>€<span>IVA incluído</span></div>

					<?php endif; ?>

					<?php if(get_field('eco_tasa')): ?>
						<p class="text-dark" style="font-size:12px;">Eco Tasa <?php echo get_field('eco_tasa'); ?>€ incluida.</p>
					<?php endif; ?>

				<?php endif; ?>

				<div class="single-product-add-cart mt-4"><?php woocommerce_template_single_add_to_cart(); ?></div>

				<?php if($product->get_stock_status()=='instock'): ?>

				<?php else: ?>
					<?php  _e("Producto temporalmente sin existencias online. Consulta disponibilidad en tu distribuidor más cercano","esgalla"); ?>
				<?php endif; ?>

				<div class="row envios-garantia-producto mt-4 py-3 border-top border-bottom border-gray w-100">

					<div class="col-12 col-lg-6 font-weight-bold mb-3 text-nowrap">
						<i class="fas fa-truck pr-1"></i><?php _e("¡Envío gratis a partir de 19€!","esgalla"); ?>
					</div>

					<?php 
						$link_garantias = '';
						if(get_current_blog_id() == 1) {
							$link_garantias = 'https://tiendahusqvarna.com/terminos-y-condiciones/#info-garantias';
						} else if(get_current_blog_id() == 2) {
							$link_garantias = 'https://lojahusqvarna.com/termos-e-condicoes/#info-garantias';
						}
					?>
					<div class="col-12 col-md-6 col-lg-4 mb-3 text-nowrap">
						<a href="<?php echo $link_garantias; ?>" class="text-dark"><div class="font-weight-bold position-relative"><i class="fas fa-sync-alt pr-2"></i></i><?php _e("3 años de garantía","esgalla"); ?> <br/><p class="ml-3 mb-0" style="font-size:10px;position: absolute;bottom: -10px;">&nbsp;<i>*<?php _e("ver condiciones","esgalla"); ?></i></p></div></a>
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-3 font-weight-bold text-nowrap">
						<i class="fas fa-check pr-2"></i></i><?php _e("14 días de devolución","esgalla"); ?>
					</div>

					<? if( get_current_blog_id() == 1 ): ?>
						<?
							if($product->is_type('variable')) {
								$variations = $product->get_available_variations();
								$precioProd = 0;
								foreach ($variations as $prod) {
									if($prod['display_price'] > $precioProd) {
										$precioProd = $prod['display_price'];
									}
								}
							} else {
								$precioProd = wc_get_price_including_tax($product,array('price'=>$product->get_regular_price()));
							}
						?>
						<? if( $precioProd >= 150 && $precioProd <= 3000 ): ?>
							<div class="col-12 col-md-6 col-lg-6 mb-3 font-weight-bold text-nowrap">
								<i class="fas fa-coins pr-2"></i></i><?php _e("Financia hasta 6 meses sin intereses","esgalla"); ?>
								<br/><p class="ml-3 mb-0" style="font-size:10px;position: absolute;bottom: -10px;">&nbsp;<i>*<?php _e("sujeto a aprobación por la entidad financiera","esgalla"); ?></i></p>
							</div>
						<? endif; ?>
					<? endif; ?>

				</div>

				<?php
					$terms = get_the_terms( $post->ID, 'product_cat' );
				?>
				<?php if($terms[0]->slug == 'automower'): ?>
					<div class="alert alert-info alert-dismissible fade show mb-3 p-3" role="alert">
						<p class="h4"><?php _e('Atención', "esgalla"); ?></a>
						<p><?php _e('Automower® necesita ser instalado, te ofrecemos dos opciones:', "esgalla"); ?></p>
						<ul class="m-0 p-0 mb-3" style="list-style-type: none;">
							<li><?php esc_html_e('- Lo puedes hacer tú mismo gracias a un kit de instalación.', "esgalla"); ?></li>
							<li><?php esc_html_e('- Lo puede hacer un técnico profesional autorizado.',"esgalla"); ?></li>
						</ul>
						<p class="">
							<?php _e('De la calidad de la instalación dependerá el correcto funcionamiento de Automower®, por ello, salvo en el modelo Automower® 105, recomendamos que escojas la Instalación Profesional.', "esgalla"); ?>
						</p>
						<p class="mb-0">
							<?php _e('En la Instalación Profesional no esta incluida la instalación de ninguna toma de corriente ni cortes en pavimentos.', "esgalla"); ?>
						</p>
					</div>
				<?php endif; ?>

				<p class="fs-19 mt-3 font-weight-light text-gray long-contenido-producto"><?php echo strip_tags($product->get_short_description(), '<strong><ul><li>') ?></p>

			</div>

		</div>

	</div>

</section>



<?php if(!empty(get_the_content())): ?>



<section class="bg-light mt-4 py-5">

	<div class="container long-contenido-producto">

		<div class="row d-none d-md-flex">

			<div class="col-12 col-lg-9 pr-md-6">

				<!-- <p class="fs-19 mt-3 font-weight-light text-gray"><?php echo strip_tags(get_the_content(), '<strong><p>') ?></p> -->
				<p class="fs-19 mt-3 font-weight-light text-gray"><?php the_content() ?></p>

				<?php /*

				<h3 class="pt-4 h2 font-weight-bold"><?php _e("Ficha técnica","esgalla"); ?></h3>

				 <div class="d-flex justify-content-between mt-4 pt-3 px-lg-2">

					<div class="d-flex flex-column justify-content-between col-ficha-tecnica">

						<div class="d-flex flex-column justify-content-between">

						<?php

						foreach ($product->get_attributes() as $atributo_id => $atributo_objeto ) {

							$atributo_etiqueta = wc_attribute_label($atributo_id);

							$atributo_valor = $product->get_attribute( $atributo_objeto['data']['name'] );



							echo '<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray">'.$atributo_etiqueta.'</span><span class="fs-18 font-weight-normal text-dark text-right">'.$atributo_valor.'</span></div>';

						}

						?>

						</div>

					</div>

<?php /*

					<div class="d-flex flex-column justify-content-between col-ficha-tecnica">

						<div class="d-flex flex-column justify-content-between">

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Combustible","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Gasolina</span></div>

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Paso de cadena","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">3/8</span></div>

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Longitud Barra (pulgadas/cm)","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">12"/30cm</span></div>

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Motosierra profesional","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">De poda</span></div>

						</div>

						<button href="#" class="btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125 text-center text-uppercase mt-2 p-2"><?php _e("Descargar manual de instrucciones","esgalla"); ?></button>



					</div>

					<div class="d-flex flex-column justify-content-between col-ficha-tecnica">

						<div class="d-flex flex-column justify-content-between">

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Autotune","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Sí</span></div>

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Uso","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Profesional</span></div>

							<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Tipo","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">De poda</span></div>

						</div>

						<button href="#" class="btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125 text-center text-uppercase mt-2 p-2"><?php _e("Descargar guía autonomía baterías","esgalla"); ?></button>

					</div>

				</div>

*/ ?>

				<?php if(get_field('descargable') == true): ?>
						<div class="boton-producto"><a class="btn btn-primary btn-cart text-white spacing font-weight-regular fs-125 text-center" target="_blank" href="<?php echo wp_get_attachment_url(get_field('pdf')); ?>"><?php echo get_field('texto_del_boton'); ?></a></div>
				<?php endif; ?>

			</div>

			<div class="col-12 col-lg-3">
			<? if($relacionados && count($relacionados) > 0): ?>
				<h3 class="font-weight-bold text-dark text-center"><?php _e("Accesorios","esgalla"); ?></h3>

				<div class="slick-accesorios">

				<?php

				//for($rel_i = 0; $rel_i <3; $rel_i++){



				foreach($relacionados as $relacionado){

					//get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionados[$rel_i]));
					// if(true && wc_get_product( $id )) {
						get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionado));
					// }
					

				}/*

				?>

				<?php for ($i = 1; $i <= 3; $i++): ?>

					<div class="w-100 mt-4">

						<?php get_template_part('template-parts/ficha', 'accesorio'); ?>

					</div>

				<?php endfor; */?>

				</div>
					<? endif; ?>
			</div>

		</div>

		<div class="row d-md-none">

			<div class="col">

				<a href="#collapseMasinfo" data-toggle="collapse"  class="font-weight-bold text-dark d-flex justify-content-between text-decoration-none" aria-expanded="false" aria-controls="collapseMasinfo">

					<h3><?php _e("Más información sobre","esgalla"); ?> <?php echo get_the_title() ?> </h3>

					<i class="fas fa-angle-down fs-fa pt-2"></i>

				</a>

				<div class="collapse" id="collapseMasinfo">

					<?php echo the_content() ?>

				</div>

				<a href="#collapseFichaTecnica" data-toggle="collapse"  class="mt-4 font-weight-bold text-dark d-flex justify-content-between text-decoration-none" aria-expanded="false" aria-controls="collapseFichaTecnica">

					<h3 class="fs-26"><?php _e("Ficha técnica","esgalla"); ?></h3>

					<i class="fas fa-angle-down fs-fa pt-2"></i>

				</a>

				<div class="collapse" id="collapseFichaTecnica">

					<?php

					foreach ($product->get_attributes() as $atributo_id => $atributo_objeto ) {

						if($atributo_id!='pa_precioespecial'){

							$atributo_etiqueta = wc_attribute_label($atributo_id);

							$atributo_valor = $product->get_attribute( $atributo_objeto['data']['name'] );



							echo '<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray">'.$atributo_etiqueta.'</span><span class="fs-18 font-weight-normal text-dark text-right">'.$atributo_valor.'</span></div>';

						}

					}

					?>

					<?php /*

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Combustible","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Gasolina</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Paso de cadena","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">3/8</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Longitud Barra (pulgadas/cm)","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">12"/30cm</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Motosierra profesional","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">De poda</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Autotune","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Sí</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Uso","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">Profesional</span>

					</div>

					<div class="d-flex justify-content-between border-bottom px-1 py-2"><span class="fs-18 font-weight-light text-gray"><?php _e("Tipo","esgalla"); ?></span><span class="fs-18 font-weight-normal text-dark text-right">De poda</span>

					</div>

					<button href="#" class="btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125  w-100 p-2 text-center text-uppercase mt-3"><?php _e("Descargar manual de instrucciones","esgalla"); ?></button>

					<button href="#" class="btn-primary btn-cart text-white spacing font-weight-regular border-0 fs-125  w-100 p-2 text-center text-uppercase mt-3 mb-2"><?php _e("Descargar guía autonomía baterías","esgalla"); ?></button>

					*/ ?>

				</div>

				<a href="#collapseAccesorios" data-toggle="collapse"  class="mt-4 font-weight-bold text-dark d-flex justify-content-between text-decoration-none" aria-expanded="false" aria-controls="collapseAccesorios">

					<h3 class="fs-26"><?php _e("Accesorios","esgalla"); ?></h3>

					<i class="fas fa-angle-down fs-fa pt-2"></i>

				</a>

				<div class="collapse" id="collapseAccesorios">

					<div class="slick-accesorios-mov">

						<?php foreach($relacionados as $relacionado){

							//get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionados[$rel_i]));
							get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionado));

						} ?>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<?php endif; ?>



<?php do_action( 'woocommerce_after_single_product_summary' );?>

<?
	$cat = get_the_terms( $product->ID, 'product_cat' );

	foreach ($cat as $categoria) {
		// if($categoria->parent == 0){
		// 	$mainCategory = $categoria;
		// }
		$children = get_categories( array ('taxonomy' => 'product_cat', 'parent' => $categoria->term_id ));

		if ( count($children) == 0 ) {
			// if no children, then echo the category name.
			$mainCategory = $categoria;
		}
	}

?>

<?php if(get_field('objeto_opiniones')):
	
	//** var_dump(get_field('objeto_opiniones', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id));

	get_template_part('template-parts/content', 'testimonial-product');

endif; ?>

<?php if( $mainCategory ): ?>

<section id="#ofertas" class="bg-white pt-6">



	<div class="container">



		<div class="row">



			<div class="col-12">



				<h2 class="h2 text-center text-uppercase tit-line font-weight-bold"><?php _e("Más","esgalla"); ?><?php echo ' '.$mainCategory->name; ?></h2>



			</div>



		</div>

		<div class="row">

			<div class="col-12 slick-productos">

				<?php /*for ($i = 1; $i <= 8; $i++): ?>



					<?php get_template_part('template-parts/ficha', 'producto', array('id_producto' => 23)); ?>



				<?php endfor;*/ ?>

				<?php echo shortcode_fichas( array("t"=>"product", "d"=> "33", "c" =>8, "r" => "product_cat", 'cat' => $mainCategory->term_id, 'f' => 'producto', 'oby' => 'random')); ?>

			</div>

		</div>



	</div>



</section>

<?php endif; ?>



<?php get_footer();

