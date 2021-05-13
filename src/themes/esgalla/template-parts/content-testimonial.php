<div id="carousel-opiniones-producto" class="container pt-4 opiniones">
    <?php $contador = 0; ?>
        <?php foreach(get_field('objeto_opiniones', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id) as $opinion){ ?>
            <div class="ficha-opiniones">
                <div class="inner-opinion">
                    <div class="image">
                        <div class="quote">
                            <?php if(get_current_blog_id() == 2) {
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
                        <div class="title mb-2"><?php echo get_the_title($opinion); ?></div>
                        <div class="description"><?php echo get_field('descripcion_opinion' , $opinion); ?></div>
                        <a class="ver-mas" href="https://tiendahusqvarna.com/automower/opiniones/" target="blank"> - ver más opiniones </a>
                    </div>
                </div>

    
</div>     
<?php $contador++; } ?>
</div>

<!-- Modal -->
<?php $contador1 = 0; ?>
<?php foreach(get_field('objeto_opiniones', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id) as $opinion){ ?>
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