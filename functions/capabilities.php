<?php
   //add_action('admin_menu', 'ver_capacities_de_paginas_admin', 999);
   /*function ver_capacities_de_paginas_admin() {
      global $menu, $submenu;

      echo '<pre>';
      print_r($menu);      // Menús de nivel superior
      print_r($submenu);   // Submenús
      echo '</pre>';
      die();
   }*/

   add_action('admin_init', 'restringir_admin_para_rol_personalizado');
   function restringir_admin_para_rol_personalizado() {
      /*echo "<div><pre>";
      var_dump($rol);
      echo "</pre></div>";
      die();*/
      $rol = get_role('editor');
      if($rol):
         //$rol->remove_cap('edit_posts'); //afecta ofetas y empresas
         $rol->remove_cap('edit_empresa');
         $rol->remove_cap('edit_pages');
         $rol->remove_cap('edit_others_pages');
         $rol->remove_cap('edit_kc-section');
         $rol->remove_cap('edit_medio');
         $rol->remove_cap('moderate_comments');
         //$rol->add_cap('manage_options');
         //$rol->add_cap('edit_posts');
         //var_dump("test"); die();
      endif;

      
   }

   add_action('current_screen', 'mi_funcion_con_get_current_screen');
   function mi_funcion_con_get_current_screen() {
      $screen = get_current_screen();
      $user = wp_get_current_user();
      /*echo "<br><br><br><br><br><br><br><br><br><center><pre>";
      var_dump($screen);
      echo "</pre></center><br><br><br><br><br><br><br><br><br>";*/
      if (in_array('editor', $user->roles)):
         $flag = !($screen && in_array($screen->id, array( "edit-empleo", "empleo", "edit-puesto", "profile")));
         //var_dump($screen->id, $flag); die();
         if ( $flag ):
            wp_redirect(admin_url('edit.php?post_type=empleo'));
         endif;
      endif;
   }
  
  

   add_action('admin_menu', 'ocultar_menus_para_rol_personalizado', 999);
   function ocultar_menus_para_rol_personalizado() {
      $user = wp_get_current_user();
      if (in_array('editor', $user->roles)):
         remove_menu_page('index.php');
         remove_menu_page('edit.php');
         remove_menu_page('upload.php');
         remove_menu_page('tools.php');
         remove_menu_page('options-general.php');
         remove_menu_page('edit-comments.php');
         remove_menu_page('empresa');

         remove_menu_page('edit.php?post_type=page');
         remove_menu_page('edit.php?post_type=empresa');
         
         remove_menu_page('menu-links');
         remove_menu_page('Apariencia');
         remove_menu_page('themes.php');
         remove_menu_page('menu-users');
         remove_menu_page('opciones-ofertas');
         remove_menu_page('wpcf7');
         remove_menu_page('kingcomposer');
         /*
         global $menu;
         echo "<center><pre>";
         var_dump( Array( "menu"=>$menu ) );
         echo "</pre></center>";
         */

         /*
          global $submenu;
          echo "<center><pre>";
          var_dump( Array( "submenu"=>$submenu ) );
          echo "</pre></center>";
          */
      endif;
   }


   add_filter('login_redirect', 'redirigir_despues_login_por_rol', 10, 3);
   function redirigir_despues_login_por_rol($redirect_to, $request, $user) {
      if (isset($user->roles) && is_array($user->roles)):
         /*if (in_array('author', $user->roles)):
            return home_url('/pagina-para-autores/');
         endif;*/
         if (in_array('editor', $user->roles)):
            return admin_url('edit.php?post_type=empleo');
         endif;
      endif;
      return $redirect_to;
  }
  