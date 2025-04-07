<?php
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



   add_filter('acf/fields/post_object/query/name=empresa', 'populateEmpresa', 10, 3);
   function populateEmpresa( $args, $field, $post_id){	
      $current_user = wp_get_current_user();
      if (in_array('editor', $current_user->roles)):
         $args['author'] = $current_user->ID;
      endif;
      //$args['post__not_in'] = array(123, 456);
      return $args;
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
      /*$path_json_countries_states = get_template_directory()."/functions/php-countries/states.php";
      $array_countries_states = include $path_json_countries_states;
      foreach($array_countries_states as $key_city=>$array_states):
         foreach($array_states as $key_state=>$state_name):
            $field['choices'][ $key_city."@".$key_state ] = $state_name;
         endforeach;
      endforeach;*/
      return $field;
   }

   add_action('admin_footer', 'agregar_js_personalizado_admin');
   function agregar_js_personalizado_admin() {
      $path_json_countries_states = get_template_directory() . "/functions/php-countries/states.php";
      $array_countries_states = include $path_json_countries_states;
      $ciudades = array();
      foreach ($array_countries_states as $key_country => $array_states):
         foreach ($array_states as $key_state => $state_name):
            $ciudades[$key_country . "@" . $key_state] = $state_name;
         endforeach;
      endforeach;
      $post_id = $_GET["post"];
      $ciudad = get_field("ciudad", $post_id);
      $js_ciudad = "";
      if($ciudad):
         $js_ciudad = 'jQuery("div[data-name=\'ciudad\'] select").val("'.$ciudad.'");';
      endif;
      $html_default_option_selected = "";
      if( !is_numeric($post_id) ):
         $html_default_option_selected = 'jQuery("div[data-name=\'pais\'] select").val("PE")';
      endif;

      $screen = get_current_screen();
      if( in_array($screen->post_type, array("oferta-laboral")) ):
         echo '
         <script>
            var array_ciudades = '.json_encode($ciudades).';
            function updateSelectCiudades(){
               let code_country = jQuery("div[data-name=\'pais\'] select").val();
               code_country = code_country.trim();
               jQuery("div[data-name=\'ciudad\'] select").html("");
               jQuery.each(array_ciudades, function(indice, valor) {
                  let code_country_state = indice;
                  let array_codes = code_country_state.split("@");
                  let c_country = array_codes[0];
                  c_country = c_country.trim();
                  if(c_country == code_country){
                     let html_option = \'<option value="\'+indice+\'">\'+valor+\'</option>\';
                     jQuery("div[data-name=\'ciudad\'] select").append(html_option);
                  }
               });
            }
            jQuery(document).ready(function () {
               '.$html_default_option_selected.'
               jQuery("div[data-name=\'pais\'] select").change(function(){
                  updateSelectCiudades();                 
               });
               jQuery("div[data-name=\'pais\'] select").change();
               '.$js_ciudad.'
            });
         </script>';
      endif;

      echo '
         <style>
            #nri-sub-wrapper{ display:none; }
         </style>
         <script>
            jQuery(document).ready(function () {
               jQuery("#wp-admin-bar-new-content-default #wp-admin-bar-new-post").remove();
               jQuery("#wp-admin-bar-new-content-default #wp-admin-bar-new-media").remove();
               jQuery("#wp-admin-bar-new-content-default #wp-admin-bar-new-empresa").remove();
               jQuery("#wp-admin-bar-new-content-default #wp-admin-bar-new-kc-section").remove();
            });
         </script>
      ';
   }