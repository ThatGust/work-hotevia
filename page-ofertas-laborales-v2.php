<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Ofertas Laborales v2
 */
   //$paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;
   //$selected_puesto = isset($_GET['puesto']) ? sanitize_text_field($_GET['puesto']) : '';

   $v_search_text = false;
   $v_puesto_id = false;
   $v_pais_slug = false;
   $v_ciudad_slug = false;
   $v_paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;;
   if( isset($_GET["se"]) ):
      if( !empty($_GET["se"]) ):
         $v_search_text = $_GET["se"];
      endif;
   endif;
   if( isset($_GET["pu"]) ):
      if( is_numeric($_GET["pu"]) ):
         $v_puesto_id = $_GET["pu"];
      endif;
   endif;
   if( isset($_GET["pa"]) ):
      if( !empty($_GET["pa"]) ):
         $v_pais_slug = $_GET["pa"];
      endif;
   endif;
   if( isset($_GET["ci"]) ):
      if( !empty($_GET["ci"]) ):
         $v_ciudad_slug = $_GET["ci"];
      endif;
   endif;

   $page_id = get_the_ID();

   $html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
   $ofertas_num = get_field("ofertas_num", $page_id);
   $banners_de_columna = get_field("banners_de_columna", "option");
   $banners_de_contenido = get_field("banners_de_contenido", "option");

   $posts_per_page = 35;
   if( is_numeric($ofertas_num) ):
      $posts_per_page = $ofertas_num;
   endif;

   
   $taxonomies_array = false;
   if( $v_puesto_id ):
      $taxonomies_array = array(
         array(
            'taxonomy' => 'puesto',
            'term_id' => $v_puesto_id,
         ),
      );
   endif;

   
   $custom_field_array = array(
      array("meta_key" => "fecha_de_expiracion", "condition" => "AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()")
   );

   if( $v_pais_slug ):
      $custom_field_array[] = array("meta_key" => "pais", "condition" => "AND %meta_value% = '".$v_pais_slug."' ");
   endif;

   if( $v_ciudad_slug ):
      $custom_field_array[] = array("meta_key" => "ciudad", "condition" => "AND %meta_value% = '".$v_pais_slug."@".$v_ciudad_slug."' ");
   endif;
   

   $rows = get_custom_posts(
      $post_type = "empleo",
      $search = $v_search_text,
      $taxonomies_array,
      $custom_field_array,  //%meta_value% 
      $order = array(0 => 'ORDER BY STR_TO_DATE(%meta_value%, "%Y%m%d" ) DESC'),
      $page = $v_paged,
      $posts_per_page,
      $total_rows
   );
   $max_num_pages = ceil($total_rows / $posts_per_page);

   $base_url = get_bloginfo("url");
   $title_negocio = get_the_title($page_id);

   $puestos = get_terms(array(
      'taxonomy' => 'puesto',
      'hide_empty' => false,
   ));

   $path_json_countries = get_template_directory() . "/functions/php-countries/countries.php";
   $array_countries = include $path_json_countries;
   $paises = array();
   foreach ($array_countries as $key => $country_name) {
      $paises[$key] = $country_name;
   }

   $path_json_countries_states = get_template_directory() . "/functions/php-countries/states.php";
   $array_countries_states = include $path_json_countries_states;
   $ciudades = array();
   foreach ($array_countries_states as $key_country => $array_states):
      foreach ($array_states as $key_state => $state_name):
         $ciudades[$key_country . "@" . $key_state] = $state_name;
      endforeach;
   endforeach;

   $ubicaciones_ofertas = $ciudades;
   $search_icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="white"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>';
   //$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13px" height="13px" fill="red"><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9l0 176c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/></svg>';
   $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-ofertas-laborales" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-ofertas-laborales">

                            <ol class="breadcrumbs">
                                <li><a href="<?php echo $base_url; ?>">Home</a></li>
                                <li><span><?php echo $title_negocio; ?></span></li>
                            </ol>

                            <h2 class="job-title">
                                Ofertas de empleo hoteles y restaurantes Peru
                            </h2>

                            <?php
                            if (!empty($banners_de_contenido)) {
                                $first_banner_html = $banners_de_contenido[0]["html"] ?? '';
                                if (!empty($first_banner_html)) {
                                    echo '<div class="ad-long">' . $first_banner_html . '</div>';
                                }
                            }
                            ?>

                            <div class="google-style-search-container">
                                <div class="search-input-wrapper" id="searchWrapper">
                                    <div id="searchTags" class="search-tags-container"></div>
                                    <input type="text" id="autocompleteSearch" placeholder="Busca por empresa, ciudad, distrito o palabra..." autocomplete="off">                                    
                                    <div id="searchSpinner" class="search-spinner" style="display: none;"></div>
                                </div>
                                <div id="autocompleteResults" class="autocomplete-suggestions-box" style="display:none;"></div>
                            </div>

                            <div id="lista-empleos-container">
                                <div id="mainSpinner" class="main-spinner-wrapper" style="display: none;">
                                    <div class="loader-wheel"></div>
                                </div>
                                <div id="lista-empleos" class="empleos-grid job-listings"></div>
                                <div id="paginacion-empleos" class="paginacion-container1 paginate-links"></div>
                            </div>

                            <div class="footer-html">
                              <?php
                                echo $html_pie_de_pagina;
                              ?>
                            </div>

                        </div>
                        <?php if ($banners_de_columna): ?>
                            <div class="col col-ad-place">
                                <?php foreach ($banners_de_columna as $o_item): ?>
                                    <?php
                                    $sf_html = $o_item["html"];
                                    if ($sf_html):
                                        ?>
                                        <div class="ad">
                                            <?php echo $sf_html; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div>
                                <?php endif; ?>
                            </div>
                        </div>
    </section>
</main>
<?php get_footer(); ?>

<?php get_template_part('parts/page-ofertas-laborales-v2-js'); ?>