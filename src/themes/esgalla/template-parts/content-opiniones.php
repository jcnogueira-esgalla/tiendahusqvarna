
<!-- Caruosel -->

<div id="carousel-opiniones" class="pt-4 opiniones">
    <?php $contador = 0; ?>
        <?php foreach(get_field('objeto_opiniones') as $opinion){ ?>
            <div class="ficha-opiniones">
                <div class="inner-opinion">
                    <div class="image">
                        <div class="quote">
                         <?php  if(get_current_blog_id() == 2) {
                             echo wp_get_attachment_image(23212);}
                             else {
                                echo wp_get_attachment_image(17517);
                             };  ?>
                        </div>
                        <?php if(get_field('imagen_opinion', $opinion)): ?>
                            <div class="personal-image pr-35">
                                <?php echo wp_get_attachment_image( get_field('imagen_opinion' , $opinion), 'large'); ?>
                            </div>
                        <?php endif; ?>
                                
                         <?php if(get_field('imagen_del_video', $opinion)): ?>
                            <a type="button" data-toggle="modal" data-target="#videomodal<?php echo $contador; ?>">
                                <div class="personal-image">
                                <i class="far fa-play-circle"></i>
                                <?php echo wp_get_attachment_image( get_field('imagen_del_video' , $opinion), 'large'); ?>
                                    
                                </div>
                            </a> 
                        <?php endif; ?>
                    </div>
                    <div class="contenido">
                        <div class="title"><?php echo get_the_title($opinion); ?></div>
                        <div class="description"><?php echo get_field('descripcion_opinion' , $opinion); ?></div>
                    </div>
                </div>
    
</div>     
<?php $contador++; } ?>
</div>

<!-- Modal -->
<?php $contador1 = 0; ?>
<?php foreach(get_field('objeto_opiniones') as $opinion){ ?>
<?php if(get_field('video', $opinion)): ?>
    <div class="modal-video modal fade" id="videomodal<?php echo $contador1; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <div class="modal-body">
                    <div class="personal-video">
                        <?php echo get_field('video', $opinion); ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>  
<?php $contador1++; } ?>




<!-- Video -->
    <div id="video-opiniones" class="video-opiniones">
        <?php echo get_field('iframe_video_opinion'); ?> 
        <a target="_blank" href="<?php echo get_field('url_lista_de_reproduccion'); ?>" class="lista-reproduccion"> -  <?php _e("ver lista de reproducción","esgalla"); ?> </a>
    </div>
        
           
<!-- SEO -->
    <div id="seo" class="pt-5 mb-5 contenido-seo">
        <h2 class="mb-4"><?php echo get_field('titulo_seo'); ?></h2>
        <?php echo get_field('contenido_seo'); ?>
    </div>


<!-- Productos destacados -->          
    <div id="productos destacados" class="pt-5 productos-destacados">
		<div class="row">
			<div class="col-12">
				<h2 class="h2 text-center text-uppercase tit-line font-weight-bold">
                    <?php echo get_field('titulo_producto_destacado'); ?>
                </h2>
			</div>
		</div>
		
        <div class="row mb-5">
			<div class="col-12 slick-productos">
				<?php
				$producto_descatado = get_field('producto_descatado');
				$post_idx =1;
					foreach($producto_descatado as $id_producto){
						get_template_part('template-parts/ficha', 'producto', array('id_producto' => $id_producto, 'position' => $post_idx));
						$post_idx++;
					}
				?>
			</div>
		</div>
    </div>






