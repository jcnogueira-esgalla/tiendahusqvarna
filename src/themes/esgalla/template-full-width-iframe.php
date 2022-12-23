<?php
/*
 * Template Name: Ancho Completo Iframe
 * Template Post Type: landings
 */
?>

<?php wp_head(); ?>

<style>iframe{width:100%!important;height:100%!important;}</style>
<div style="width:100vw;height:100vh;"><?=get_field('codigo_iframe');?></div>


<?php wp_footer(); ?>