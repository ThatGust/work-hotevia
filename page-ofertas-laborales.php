<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Ofertas Laborales
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
   $posts_per_page = 35;

   //Header
   $f_s1_background = get_field("s1_background", $page_id);

   //Sites
   $f_s2_title = get_field("s2_title", $page_id);

   $banners_de_columna = get_field("banners_de_columna", "option");
   $banners_de_contenido = get_field("banners_de_contenido", "option");
   
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
      $post_type = "oferta-laboral",
      $search = $v_search_text,
      $taxonomies_array,
      $custom_field_array,  //%meta_value% 
      $order = array(0 => 'ORDER BY STR_TO_DATE(%meta_value%, "%Y%m%d" ) DESC'),
      $page = $v_paged,
      $posts_per_page,
      $total_rows
   );
   $max_num_pages = ceil($total_rows / $posts_per_page);
   $html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);

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
   foreach ($array_countries_states as $key_country => $array_states) {
      foreach ($array_states as $key_state => $state_name) {
         $ciudades[$key_country . "@" . $key_state] = $state_name;
      }
   }

   $ubicaciones_ofertas = $ciudades;
   $search_icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="white"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>';
   $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13px" height="13px" fill="red"><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9l0 176c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/></svg>';
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


                            <div class="search-bar">
                              <form id="form-ofertas-laborales" method="GET" action="">
                                 <div class="search-bar-inside">
                                    <input name="se" type="text" class="search-input" id="searchInput" value="<?php echo $v_search_text; ?>">
                                    <input name="pu" type="hidden" class="puesto" value="<?php echo $v_puesto_id; ?>" >
                                    <input name="pa" type="hidden" class="pais" value="<?php echo $v_pais_slug; ?>" >
                                    <input name="ci" type="hidden" class="ciudad" value="<?php echo $v_ciudad_slug; ?>" >
                                    <input name="pg" type="hidden" class="page" value="<?php echo $v_paged; ?>" >
                                    <button class="search-button" id="searchButton">
                                        <?php echo $search_icon_svg; ?>
                                    </button>
                                 </div>
                              </form>
                            </div>

                            <div class="filter-container">
                                <div class="filter-tabs">
                                    <label>Filtrar por:</label>
                                </div>

                                <div class="filter-tabs">
                                    <span class="filter-tab active" data-target="filtro-puesto">Puesto</span>
                                    <span class="filter-tab" data-target="filtro-lugar">Lugar</span>
                                </div>

                                <div class="filter-whole">
                                    <div class="filter-dropdowns">
                                        <div>

                                            <div class="custom-dropdown" id="filtro-puesto">
                                                <div class="dropdown-toggle" id="puesto-toggle">
                                                    <span>Seleccione un puesto</span>
                                                </div>
                                                <ul class="dropdown-menu" id="puesto-menu">
                                                    <?php if (!empty($puestos)): ?>
                                                        <?php foreach ($puestos as $puesto): ?>
                                                            <li>
                                                               <a data-id="<?php echo $puesto->term_id; ?>" data-slug="<?php echo $puesto->slug; ?>" class="option-puesto option-puesto-<?php echo $puesto->term_id; ?>" href="javascript:void(0);">   
                                                                  <label><?php echo $puesto->name; ?></label>
                                                               </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <li>No hay puestos disponibles</li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>

                                            <div class="custom-dropdown" id="filtro-lugar" style="display: none;">
                                                <div class="dropdown-group">
                                                    <div data-name="pais">
                                                        <label for="pais-select">País:</label>
                                                        <select id="pais-select">
                                                            <option value="">Selecciona un país</option>
                                                            <?php foreach ($paises as $codigo => $nombre): ?>
                                                                <option value="<?php echo $codigo; ?>"><?php echo $nombre; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>


                                                    <div data-name="ciudad">
                                                        <label for="ciudad-select">Ciudad:</label>
                                                        <select id="ciudad-select">
                                                            <option value="">Seleccione una ciudad</option>
                                                            <?php foreach ($ciudades as $codigo => $nombre): ?>
                                                                <option value="<?php echo $codigo; ?>"><?php echo $nombre; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                   <?php if(false): ?>
                                                    <div data-name="distrito">
                                                        <label for="distrito-input">Distrito:</label>
                                                        <input type="text" id="distrito-input" name="distrito" placeholder="Ingresa el distrito">
                                                    </div>

                                                    <div data-name="direccion">
                                                        <label for="direccion-input">Dirección:</label>
                                                        <input type="text" id="direccion-input" name="direccion" placeholder="Ingresa la dirección">
                                                    </div>
                                                   <?php endif; ?>
                                                </div>
                                            </div>

                                            <a id="form-run" href="javascript:void(0)" class="filter-button">
                                                <span>Filtro</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="job-listings">
                                <?php
                                $contador = 0;
                                $total_banners = !empty($banners_de_contenido) ? count($banners_de_contenido) : 0;
                                $indice_banner = 1;
                                ?>

                                <?php foreach ($rows as $o_row): ?>
                                    <?php
                                       $sf_ID = $o_row->ID;
                                       $sf_title = $o_row->post_title;
                                       $sf_fecha = get_field('fecha_de_expiracion', $sf_ID);
                                       $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID);
                                       $sf_ubicacion = get_field('ubicacion_geografica', $sf_ID);
                                       $sf_permalink = get_permalink($sf_ID);
                                    ?>

                                    <a href="<?php echo $sf_permalink; ?>" class="job-item">
                                        <span class="icon"><?php echo $svg_icon; ?></span>

                                        <?php if ($sf_title): ?>
                                            <span class="job-title-list"><?php echo $sf_title; ?> - </span>
                                        <?php endif; ?>

                                        <?php if ($sf_empresa): ?>
                                            <span class="job-location"><?php echo $sf_empresa; ?> /</span>
                                        <?php endif; ?>

                                        <?php if ($sf_ubicacion || $sf_fecha): ?>
                                            <span class="job-info">
                                                <?php echo $sf_ubicacion; ?> -
                                                <?php echo $sf_fecha; ?>
                                            </span>
                                        <?php endif; ?>
                                    </a>

                                    <?php
                                    $contador++;

                                    if ($contador > 0 && $contador % 10 === 0 && $total_banners > 0) {
                                        $sf_html = $banners_de_contenido[$indice_banner]["html"] ?? '';
                                        if (!empty($sf_html)) {
                                            ?>
                                            <div class="ad">
                                                <?php echo $sf_html; ?>
                                            </div>
                                            <?php
                                            $indice_banner = ($indice_banner + 1) % $total_banners;
                                        }
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </div>




                            <div class="paginate-links">
                                <?php
                                echo paginate_links(array(
                                    'base' => add_query_arg('pg', '%#%'),
                                    'format' => '?pg=%#%',
                                    'current' => $v_paged,
                                    'total' => $max_num_pages,
                                    'prev_text' => ('« Anterior'),
                                    'next_text' => ('Siguiente »'),
                                ));
                                ?>
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
<?php if($v_pais_slug || $v_ciudad_slug || $v_puesto_id): ?>
<?php endif; ?>
<?php get_footer(); ?>

<script>
   jQuery( document ).ready(function() {
      <?php if($v_puesto_id): ?>
         jQuery("a.option-puesto-<?php echo $v_puesto_id; ?>").click();
      <?php endif; ?>

      <?php if($v_pais_slug): ?>
         jQuery("select#pais-select").val("<?php echo $v_pais_slug; ?>");
         jQuery("select#pais-select").change();
      <?php endif; ?>

      <?php if($v_ciudad_slug): ?>
         jQuery("select#ciudad-select").val("<?php echo $v_pais_slug."@".$v_ciudad_slug; ?>");
      <?php endif; ?>
   });
</script>