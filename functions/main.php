<?php
   // 7devlab
   wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/styles.css', 10 );
   wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/main.min.js', array('jquery'), '1.0.0', true );

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


   


