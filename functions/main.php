<?php
   // 7devlab
   wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/styles.css', 10 );
   wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );

   /*
   add_action('wp_enqueue_scripts', 'agregar_scripts_personalizados');
   function agregar_scripts_personalizados() {
      wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
   }

   add_action('init', 'registrar_ofertas_laborales');
   function registrar_ofertas_laborales() {
      $args = array(
         'public'       => true,
         'label'        => 'Ofertas Laborales',
         'supports'     => array( 'title', 'editor', 'thumbnail' ),
         // Otros parámetros según tus necesidades
      );
      register_post_type('oferta-laboral', $args);
   }*/


   if(function_exists('acf_add_options_page')) {
      acf_add_options_page(array(
         'page_title' 	=> 'Opciones de ofertas laborales',
         'menu_title'	=> 'Opciones de ofertas laborales',
         'menu_slug' 	=> 'opciones-ofertas',
         'redirect'		=> false,
         //'capability'=>'edit_posts',
         //'icon_url'=> get_template_directory_uri().'/images/logo.png',
      ));
   }

   function get_user_role() {
      global $current_user;  
      $user_roles = $current_user->roles;
      $user_role = array_shift($user_roles);

      return $user_role;
   }

   add_action('pre_get_posts', 'filtrar_posts_por_autor');
   function filtrar_posts_por_autor($query) {
      if (is_user_logged_in()):
         $user_role = get_user_role();
         if( is_admin() && $query->is_main_query() && $user_role == "editor"  ):
            $screen = get_current_screen();
            if( in_array($screen->post_type, array("oferta-laboral","empresa")) ):
               $user = wp_get_current_user();
               if (in_array('editor', $user->roles) || in_array('author', $user->roles)):
                  $query->set('author', $user->ID);
               endif;
            endif;
         endif;
      endif;
   }


   


   add_filter('acf/load_field/name=pais', 'populateCountry');
   function populateCountry( $field ){	
      $field['choices'] = array();
      $path_json_countries = get_template_directory()."/functions/php-countries/countries.php";
      $array_countries = include $path_json_countries;
      foreach($array_countries as $key=>$city_name):
         $field['choices'][ $key ] = $city_name;
      endforeach;
      return $field;
   }

   add_filter('acf/load_field/name=ciudad', 'populateCity');
   function populateCity( $field ){	
      $field['choices'] = array();

      $path_json_countries_states = get_template_directory()."/functions/php-countries/states.php";
      $array_countries_states = include $path_json_countries_states;
      foreach($array_countries_states as $key_city=>$array_states):
         foreach($array_states as $key_state=>$state_name):
            $field['choices'][ $key_city."@".$key_state ] = $state_name;
         endforeach;
      endforeach;
      return $field;
   }


   add_action('admin_footer', 'agregar_js_personalizado_admin');
   function agregar_js_personalizado_admin() {
      $screen = get_current_screen();
      if( in_array($screen->post_type, array("oferta-laboral")) ):
         echo '
         <script>
            jQuery(document).ready(function ($) {
               jQuery("div[data-name=\'pais\'] select").change(function(){
                  let code_country = jQuery(this).val();
                  code_country = code_country.trim();
                  jQuery("div[data-name=\'ciudad\'] select option").each(function(){
                     let code_country_state = $(this).val();
                     let array_codes = code_country_state.split("@");
                     let c_country = array_codes[0];
                     c_country = c_country.trim();
                     if(c_country == code_country){
                        //console.log("add");
                        jQuery(this).removeAttr("style");
                     }else{
                        //console.log("remove");
                        jQuery(this).css("display","none");
                     }
                  });   
                  //jQuery("div[data-name=\'ciudad\'] select").val(null); 
               });
               jQuery("div[data-name=\'pais\'] select").change();
            });
         </script>';
      endif;
  }
  