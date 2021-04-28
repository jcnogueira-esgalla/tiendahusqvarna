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
	$relacionados = $product->get_cross_sell_ids();
?>

<?php /*
<?php $categorias_producto = get_the_terms( $post->ID, 'product_cat' ); ?>
<section id="breadcrumb" class="py-2 py-md-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="text-primary breadcrumbs">
					<span class="pr-1"><a href="<?php echo get_home_url(); ?>"><?php _e("inicio","esgalla"); ?></a></span><i class="fas fa-angle-left pr-1"></i>
					<?php
					if($postProductTerm->errors){
						foreach($categorias_producto as $contador => $categoria){
							if($contador == count($categorias_producto) - 1) echo '<span class="last-breadcrumb"><a href="'.get_term_link( $categoria->term_id ).'">'.mb_strtolower($categoria->name).'</a></span>';
							else echo '<span class="pr-1"><a href="'.get_term_link( $categoria->term_id ).'">'.mb_strtolower($categoria->name).'</a></span><i class="fas fa-angle-left pr-1"></i>';
						}
					}
					else{
						foreach($parentcats as $contador => $categoria){
							$categoria_obj = get_term( $categoria );
							echo '<span class="pr-1"><a href="'.get_term_link( $categoria_obj->term_id ).'">'.mb_strtolower($categoria_obj->name).'</a></span><i class="fas fa-angle-left pr-1"></i>';
						}
						echo '<span class="last-breadcrumb"><a href="'.get_term_link( $postProductTerm->term_id ).'">'.mb_strtolower($postProductTerm->name).'</a></span>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
*/ ?>
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
				<div class="text-gray spacing pt-2 text-center text-md-left sku-reference">
					Ref. <span class="sku-parent"><?php echo $product->get_sku(); ?></span> <?php 

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

					// Ordenamos el array de manera descendente
					sort($variations_skus);
										
					// Testing output variations skus:  Array to string conversion (coma separated skus)
					$x = 1;
					
					foreach($variations_skus as $variation){
						echo '<span class=" sku-product sku-product-' . $x++ . '">'. $variation .'</span>';
					}

					 ?> |
					<span class="text-primary fong-weight-light text-opacity"><?php /*echo wc_get_product_category_list($product->get_id())*/ if(!$postProductTerm->errors) echo '<a href="'.get_term_link( $postProductTerm->term_id ).'">'.$postProductTerm->name.'</a>' ?></span>
				</div>

				<?php if(!$product->is_type('variable')): ?>
          <?php if($product->get_sale_price()): ?>
            <div class="fs-36 single-price spacing-096 font-weight-bold text-dark"><del><?php echo wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())) ?></del> <precioProducto><?php echo wc_get_price_including_tax($product,array('price'=>$product->get_sale_price())) ?></precioProducto>€<span>IVA incluído</span></div>
          <?php else: ?>
            <div class="fs-36 single-price spacing-096 font-weight-bold text-dark"><precioProducto><?php echo round(wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())),2 ) ?></precioProducto>€<span>IVA incluído</span></div>
          <?php endif; ?>
				<?php endif; ?>
        <? if(get_field('eco_tasa')): ?>
          <span style="font-size:12px;color:#8DC63F;">Incluido en el precio <? echo get_field("eco_tasa"); ?>€ por impuesto ecológico</span>
        <? endif; ?>
				<div class="single-product-add-cart mt-4"><?php woocommerce_template_single_add_to_cart(); ?></div>
				<div class="product-terms mt-4 py-3 border-top border-bottom border-gray w-100">
					<div class="font-weight-bold"><i class="fas fa-truck fs-fa pr-2"></i><?php _e("¡Envio GRATIS!","esgalla"); ?></div>
					<div class="font-weight-bold"><i class="fas fa-sync-alt pr-2"></i></i><?php _e("2 años de garantía","esgalla"); ?></div>
					<div class="font-weight-bold"><i class="fas fa-check pr-2"></i></i><?php _e("14 días de devolución","esgalla"); ?></div>
				</div>
				<p class="fs-19 mt-3 font-weight-light text-gray"><?php echo $product->get_short_description() ?></p>
				<?php /*
				<div class="mt-4 d-flex justify-content-start text-gray font-weight-light fs-19">
					<ul class="list-group d-flex flex-row flex-wrap">
						foreach ($product->get_attributes() as $atributo_id => $atributo_objeto ) {
							if($atributo_id!='pa_precioespecial'){
								$atributo_etiqueta = wc_attribute_label($atributo_id);
								$atributo_valor = $product->get_attribute( $atributo_objeto['data']['name'] );

								// echo '<li class="list-group-item list-group-item-action w-50">'.$atributo_etiqueta.': '.$atributo_valor.'</li>';
								echo '<li class="list-group-item list-group-item-action border-0 w-50"><strong>'.$atributo_etiqueta.'</strong>: '.$atributo_valor.'</li>';
							}
						}
					</ul>
				</div>
				*/ ?>
			</div>
		</div>
	</div>
</section>

<?php if(!empty(get_the_content()) && $relacionados): ?>

<section class="bg-light mt-4 py-5">
	<div class="container">
		<div class="row d-none d-md-flex">
			<div class="col-12 col-lg-9 pr-md-6">
				<p class="fs-19 mt-3 font-weight-light text-gray"><?php echo the_content() ?></p>
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

			</div>
			<div class="col-12 col-lg-3">
				<h3 class="font-weight-bold text-dark text-center"><?php _e("Accesorios","esgalla"); ?></h3>
				<div class="slick-accesorios">
				<?php
				//for($rel_i = 0; $rel_i <3; $rel_i++){

				foreach($relacionados as $relacionado){
					//get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionados[$rel_i]));
					get_template_part('template-parts/ficha', 'accesorio', array('id_producto' => $relacionado));
				}/*
				?>
				<?php for ($i = 1; $i <= 3; $i++): ?>
					<div class="w-100 mt-4">
						<?php get_template_part('template-parts/ficha', 'accesorio'); ?>
					</div>
				<?php endfor; */?>
				</div>
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

<?php if( !get_term( yoast_get_primary_term_id('product_cat') )->errors): ?>
<section id="#ofertas" class="bg-white pt-6">

	<div class="container">

		<div class="row">

			<div class="col-12">

				<h2 class="h2 text-center text-uppercase tit-line font-weight-bold"><?php /*_e("ofertas husqvarna","esgalla");*/echo 'Más '.get_term( yoast_get_primary_term_id('product_cat') )->name; ?></h2>

			</div>

		</div>

		<div class="row">
			<div class="col-12 slick-productos">
				<?php /*for ($i = 1; $i <= 8; $i++): ?>

					<?php get_template_part('template-parts/ficha', 'producto', array('id_producto' => 23)); ?>

				<?php endfor;*/ ?>
				<?php echo shortcode_fichas( array("t"=>"product", "d"=> "33", "c" =>9, "r" => "product_cat", 'cat' => yoast_get_primary_term_id('product_cat'), 'f' => 'producto')); ?>
			</div>
		</div>

	</div>

</section>
<?php endif; ?>

<?php get_footer();
