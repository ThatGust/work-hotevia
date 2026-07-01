<?php
   // 7devlab
   //wp_enqueue_style('custom-style', get_template_directory_uri().'/css/styles.css', array(), filemtime(get_template_directory().'/css/styles.css'));
   function enqueue_theme_styles() {
      $swiper_path = get_template_directory() . '/css/swiper-bundle.min.css';
      $swiper_version = file_exists($swiper_path) ? filemtime($swiper_path) : '1.0.0';
      wp_enqueue_style(
         'swiper-bundle', 
         get_template_directory_uri() . '/css/swiper-bundle.min.css', 
         array(), 
         $swiper_version
      );
      $style_path = get_template_directory() . '/css/styles.css';
      $style_version = file_exists($style_path) ? filemtime($style_path) : '1.0.0';
      wp_enqueue_style(
         'custom-style', 
         get_template_directory_uri() . '/css/styles.css', 
         array('swiper-bundle'), // Forces Swiper to load first
         $style_version
      );
   }
   add_action('wp_enqueue_scripts', 'enqueue_theme_styles');
   wp_enqueue_script('custom-scripts', get_template_directory_uri().'/js/main.min.js', array('jquery'), filemtime(get_template_directory().'/js/main.min.js'));
   
   function mis_estilos_tema() {
      // 1. Encolar Swiper CSS (con control de versión por fecha de modificación)
      $swiper_path = get_template_directory() . '/css/swiper-bundle.min.css';
      $swiper_version = file_exists($swiper_path) ? filemtime($swiper_path) : '1.0.0';

      wp_enqueue_style(
         'swiper-bundle', 
         get_template_directory_uri() . '/css/swiper-bundle.min.css', 
         array(), 
         $swiper_version
      );

      // 2. Tu estilo personalizado (que ahora depende de 'swiper-bundle')
      $style_path = get_template_directory() . '/css/styles.css';
      $style_version = file_exists($style_path) ? filemtime($style_path) : '1.0.0';

      wp_enqueue_style(
         'custom-style', 
         get_template_directory_uri() . '/css/styles.css', 
         array('swiper-bundle'), // <--- Esto fuerza a que Swiper cargue antes
         $style_version
      );
   }
   add_action('wp_enqueue_scripts', 'mis_estilos_tema');
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
            if( in_array($screen->post_type, array("empleo","empresa")) ):
               $user = wp_get_current_user();
               if (in_array('editor', $user->roles) || in_array('author', $user->roles)):
                  $query->set('author', $user->ID);
               endif;
            endif;
         endif;
      endif;
   }


   
   

   
  