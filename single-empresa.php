<?php
/**
 * The Template for displaying all single posts
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */


   $post_id = get_the_ID();

   $posts_per_page = 20;

   $permalink_ofertas_laborales = get_bloginfo("url")."/ofertas-laborales";

   //Header
   $f_s1_background = get_field("s1_background", $post_id);

   //Sites
   $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
   $email = get_field("email", $post_id);
   $telefono = get_field("telefono", $post_id);
   $direccion = get_field("direccion", $post_id);

   $razon_social = get_field("razon_social", $post_id);

   $logotipo = get_field("logotipo", $post_id);
   $imagenes = get_field("imagenes", $post_id);
   $descripcion = get_field("descripcion", $post_id);

   $html_pie_de_pagina = get_field("html_pie_de_pagina", $post_id);
   $banners_de_columna = get_field("banners_de_columna", "option");
   //$temp = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>';
   $paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;
   $rows = get_custom_posts( 
         $post_type = "empleo", 
         $search = false, 
         $taxonomies_array = false, 
         $custom_field_array = array( array( "meta_key"=>"fecha_de_expiracion", "condition"=>"AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()"), array( "meta_key"=>"empresa", "condition"=>"AND %meta_value% = ".$post_id) ),  //%meta_value% 
         $order = array( 0=>'ORDER BY STR_TO_DATE(%meta_value%, "%Y%m%d" ) DESC'),
         $page = $paged, 
         $posts_per_page, 
         $total_rows );
   $max_num_pages = ceil($total_rows / $posts_per_page);

   $base_url = get_bloginfo("url");
   $title_negocio = get_the_title($post_id);
   $permalink_negocio = get_permalink($post_id);

   
   $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';

   /*echo "<pre>";
   var_dump(Array("row"=>$rows, "total_rows"=>$total_rows));
   echo "</pre>";*/
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-single-empresa" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-empr-details">

                           <div class="row custom-row">
                              <div class="col-12 col-lg-6 custom-col">
                                 <ol class="breadcrumbs">
                                    <li><a href="<?php echo $base_url; ?>">Home</a></li>
                                    <li><span><?php echo $title_negocio; ?></span></li>
                                 </ol>
                              </div>
                              <div class="col-12 col-lg-6 custom-col">
                                 <div class="wrap-buttons">
                                    <a href="<?php echo $permalink_ofertas_laborales; ?>" class="btn-gray">Volver al listado de ofertas</a>
                                 </div>
                              </div>
                           </div>

                            <h1 class="job-title"><?php echo $nombre_de_la_empresa; ?></h1>

                            <div class="empresa-info">
                                <?php if ($logotipo): ?>
                                    <img class="logo" src="<?php echo $logotipo['url']; ?>" alt="<?php echo esc_attr($logotipo['alt']); ?>" />
                                <?php endif; ?>

                                <?php if ($imagenes): ?>
                                    <div class="gallery">
                                        <?php foreach ($imagenes as $index => $imagen): ?>
                                            <img class="gallery-img" src="<?php echo esc_url($imagen['url']); ?>" alt="<?php echo esc_attr($imagen['alt']); ?>" />
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if($descripcion): ?>
                            <div class="empresa-info empresa-info-description">
                                <p><?php echo $descripcion;; ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if(false): ?>
                            <div class="empresa-info-details">
                              <?php if($email): ?>
                                 <div>
                                    <label>Email:</label>
                                    <?php echo $email; ?>
                                 </div>
                              <?php endif; ?>
                              <?php if($direccion): ?>
                                <div>
                                    <label>Direccion:</label>
                                    <?php $direccion; ?>
                                </div>
                              <?php endif; ?>
                              <?php if($telefono): ?>
                                <div>
                                    <label>Teléfono </label>
                                    <?php echo $telefono; ?>
                                </div>
                              <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <div class="job-offers">
                                <h4>CONVOCATORIAS VIGENTES</h4>
                                <?php foreach ($rows as $o_row): ?>
                                 <?php
                                    $sf_ID = $o_row->ID;
                                    $sf_title = $o_row->post_title;
                                    //$sf_fecha = get_post_meta($sf_ID, 'fecha_de_expiracion', true);
                                    
                                    //$sf_empresa = get_post_meta($sf_ID, 'nombre_de_la_empresa', true);
                                    //$sf_ubicacion = get_post_meta($sf_ID, 'ubicacion_geografica', true);
                                    $sf_fecha = get_field('fecha_de_expiracion', $sf_ID);
                                    $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID);
                                    $sf_ubicacion = get_field('distrito', $sf_ID);
                                    $sf_permalink = get_permalink($sf_ID);
                                 ?>

                                    <div class="wrap-item">
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
                                    </div>
                                    
                                    <?php if(false): ?>
                                       <div class="job-card-main">
                                          <a href="<?php echo $sf_permalink; ?>" >
                                          <div class="job-card-sub">
                                             <div class="job-card">
                                                   <div class="job-card-data">
                                                      <?php if($sf_title): ?>
                                                      <h3><?php echo $sf_title; ?></h3>
                                                      <?php endif; ?>
                                                      <?php if($sf_fecha): ?>
                                                      <label><?php echo $sf_fecha; ?></label>
                                                      <?php endif; ?>
                                                      <?php if($sf_empresa): ?>
                                                      <label><?php echo $sf_empresa; ?></label>
                                                      <?php endif; ?>
                                                      <?php if($sf_ubicacion): ?>
                                                      <label><?php echo $sf_ubicacion; ?></label>
                                                      <?php endif; ?>
                                                   </div>
                                                   <div class="button-details">
                                                      <button>Ver detalles >></button>
                                                   </div>
                                             </div>
                                             </div>
                                          </a>
                                       </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <div class="html-insert">

                            </div>

                            <div class="paginate-links">
                                <?php
                                echo paginate_links(array(
                                    'base' => add_query_arg('pg', '%#%'),
                                    'format' => '?pg=%#%',
                                    'current' => $paged,
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
                    </div>
                </div>
    </section>
</main>


<?php get_footer(); ?>