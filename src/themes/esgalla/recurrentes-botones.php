<?php
    if( have_rows('botones') ):
        while( have_rows('botones') ) : the_row();
?>
            <a class="btn text-uppercase<?php echo get_sub_field('contratipo') ? ' btn-blanco py-0 pl-0 pr-4 ml-3' : ' btn-internaco-color'; ?>" href="<?php echo get_sub_field('enlace'); ?>">
                <?php echo get_sub_field('texto'); ?>
                <?php if(get_sub_field('contratipo')): ?> <img src="<?php echo get_template_directory_uri().'/img/ico-flecha.png'; ?>" class="icono-flecha" alt="<?php _e('Arrow left'); ?>" /> <?php endif; ?>
            </a>
<?php
        endwhile;
    endif;
?>