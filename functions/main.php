<?php
   // 7devlab
   wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/styles.css', 10 );
   wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );

   
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


   
   

   
  