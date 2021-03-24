<?php



    function shortcode_fichas($atts){

      global $wp_query;

      ob_start();//Pare devolver tempalte parts



      $a = (isset($atts["a"])) ? true : false; //a --> si es archive o no

      $t = (isset($atts["t"])) ? $atts["t"] : "post"; //t --> tipo de elemento

      $f = (isset($atts["f"])) ? $atts["f"] : $t; //f --> tipo de fichas

      $d = (isset($atts["d"])) ? "w-".$atts["d"] : "w-100"; //d --> tamaño de los elementos

      $c = (isset($atts["c"])) ? $atts["c"] : -1; //c --> total de elementos

      $r = (isset($atts["r"])) ? $atts["r"] : false; //r --> si son artículos relacionados

      $m = (isset($atts["m"])) ? $atts["m"] : "div"; //m --> etiqueta meta

      $p = (isset($atts["p"])) ? $atts["p"] : false;//p --> si solo llamamos a páginas padres

      $o = (isset($atts["o"])) ? $atts["o"] : "DESC";//o --> order

      $oby = (isset($atts["oby"])) ? $atts["oby"] : "date";//oby --> orderby

      $tit = (isset($atts["tit"])) ? $atts["tit"] : "";//tit --> título de sección




      //*********************************************************************************************************************************Archivo



      if($a == true){ //----------------------------------------------------------------------------- Si es archivo

              echo $tit;

                if($t == "product" && !is_search()){

                    if ( woocommerce_product_loop() ) {

                        if ( wc_get_loop_prop( 'total' ) ) {

                          while ( have_posts() ) {

                              the_post();

                              do_action( 'woocommerce_shop_loop' );

                              $var = array("class" => $d." ficha-".$f, "hns" => $m, 'id_producto' => get_the_id());

                              get_template_part( 'template-parts/ficha', $f, $var);

                          }

                        }

                    }

                }else{

                    if(have_posts()):

                        while ( have_posts() ): the_post();

                           $var = array("class" => $d." ficha-".$f, "hns" => $m);

                           get_template_part( 'template-parts/ficha',$f,$var);

                        endwhile;

                    endif;

                }

      }else{  //--------------------------------------------------------------------------------------------- Si forzamos el loop

        //Montamos el loop

        $post_parent = array();

        $post__in = array();

        $post__not_in = array();

        $meta_query = array();

        $tax_query = array();



        //--------------------------------------------------------------------------------------------- Condicionales



        //Solo padres

        if($p == "padres"){

          $post_parent = 0;



        //Solo hijos

        }else if($p == "hijos"){

          $post_parent = get_the_ID();

        }



        //Productos destacados

        else if($r == "destacados"){

          $tax_query = array(array(

                'taxonomy' => 'product_visibility',

                'field'    => 'name',

                'terms'    => 'featured',

            ));

        }



        //Productos por categorías

        else if($r == "product_cat" && isset($atts["cat"])){

          $tax_query = array(array(

                'taxonomy' => 'product_cat',

                'field'    => 'term_id',

                'terms'    => $atts["cat"],

            ));

        }



		  //Productos destacados por categorías

        else if($r == "product_cat_dest" && isset($atts["cat"])){

          $tax_query = array(

				 array(

                'taxonomy' => 'product_cat',

                'field'    => 'term_id',

                'terms'    => $atts["cat"],

            ),

				array(

				 'taxonomy' => 'product_visibility',

				 'field'            => 'name',

				 'terms' => 'featured',

				 'operator'         => 'IN',

			 	),

				'relation' => 'AND'

			);

        }



        //Productos relacionados

        else if($r == "product"){

          $product_tag = wp_get_post_terms(get_the_ID(), 'product_tag', array("fields" => "ids"));

          if(!empty($product_tag)){

            $tax_query = array(array(

                'taxonomy' => 'product_tag',

                'field'    => 'term_id',

                'terms'    => $product_tag,

            ));



          }else{

            $product_cat = wp_get_post_terms(get_the_ID(), 'product_cat', array("fields" => "ids"));

            $tax_query = array(array(

                'taxonomy' => 'product_cat',

                'field'    => 'term_id',

                'terms'    => $product_cat,

            ));

          }





          $post__not_in = array(get_the_ID());

        }



        //--------------------------------------------------------------------------------------------- Presentamos el loop

        $loop = new WP_Query( array('post_type' => $t, 'posts_per_page'  => $c, 'order' => $o, 'orderby'=> $oby, 'post_parent' => $post_parent,  'post__in' => $post__in, 'post__not_in' => $post__not_in, 'meta_query' => $meta_query, 'tax_query' => $tax_query, 'orderby' => 'meta_value_num', 'meta_key' => '_price', 'facetwp' => true));

		  //echo '<script>console.log('.json_encode($loop->query).')</script>';



        if ( $loop->have_posts()) :

              echo $tit;

              while ($loop->have_posts() ) : $loop->the_post();

                if($t == "product"){

                    //the_post();

                    do_action( 'woocommerce_shop_loop' );

                    // $var = array("class" => $d." ficha-".$f, "hns" => $m);

						  $var = array("class" => $d." ficha-".$f, "hns" => $m, 'id_producto' => get_the_id());

                    get_template_part( 'template-parts/ficha',$f,$var);

                }else{

                     $var = array("class" => $d." ficha-".$f, "hns" => $m);

                    get_template_part( 'template-parts/ficha',$f,$var);

                }

              endwhile;

              wp_reset_postdata();

        endif;



      };

      return ob_get_clean(); //Devolvemos los tempalte parts

    }

    add_shortcode('fichas', 'shortcode_fichas');





    /*************************************************************************************************Fichas cat******/

    function shortcode_fichas_cat($atts){



      ob_start();//Pare devolver tempalte parts



      $t = (isset($atts["t"])) ? $atts["t"] : "category"; //t --> tipo de elemento

      $d = (isset($atts["d"])) ? "ficha-".$atts["d"] : "ficha-100"; //d --> tamaño de los elementos

      $c = (isset($atts["c"])) ? $atts["c"] : 0; //c --> total de elementos

      $r = (isset($atts["r"])) ? $atts["r"] : false; //r --> si son artículos relacionados

      $m = (isset($atts["m"])) ? $atts["m"] : "div"; //m --> etiqueta meta

      $p = (isset($atts["p"])) ? false : "";//p --> si solo llamamos a páginas padres

      $ch = "";

      if(isset($atts["ch"]) && $atts["ch"] == true){

        $ch = get_queried_object()->term_id;

      }else if(isset($atts["ch"]) && $atts["ch"] != true){

        $ch = $atts["ch"];

      }

      $tit = (isset($atts["tit"])) ? $atts["tit"] : "";//tit --> título de sección



      //Conseguir las categorías

      $terms = get_terms( array('taxonomy' => $t, 'hide_empty' => false, 'number' => 0, 'parent' => $p, 'child_of' => $ch));

      echo '<div class="fichas-contenedor">';

        echo $tit;

        foreach ($terms as $term) {

            $var = array("class" => $d, "hns" => $m, "term"=> $term);

            get_template_part( 'template-parts/ficha',$atts["t"],$var);

        }

      echo '</div>';





      return ob_get_clean(); //Devolvemos los tempalte parts

    }

    add_shortcode('fichas-cat', 'shortcode_fichas_cat');





    /*************************************************************************************************Buscadores******/

    function shortcode_buscador($atts){



      ob_start();//Pare devolver tempalte parts



      $t = (isset($atts["t"])) ? $atts["t"] : "principal"; //t --> tipo de elemento

      $p = (isset($atts["p"])) ? $atts["p"] : __("Buscar...","esgalla"); //t --> tipo de elemento



        echo '<form action="'.get_home_url().'" method="get" class="form-search form-search-'.$t.'">';

          echo '<input type="text" name="s" value="" data-swplive="true" placeholder="'.$p.'"/>';

          echo '<button type="submit"><span class="fas fa-search"></span></button>';

        echo '</form>';







      return ob_get_clean(); //Devolvemos los tempalte parts

    }

    add_shortcode('buscador', 'shortcode_buscador');

