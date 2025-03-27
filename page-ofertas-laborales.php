<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Ofertas Laborales
 */

$page_id = get_the_ID();

$posts_per_page = 35;

//Header
$f_s1_background = get_field("s1_background", $page_id);

//Sites
$f_s2_title = get_field("s2_title", $page_id);

$banners_de_columna = get_field("banners_de_columna", "option");
$banners_de_contenido = get_field("banners_de_contenido", "option");

$paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;
$rows = get_custom_posts(
    $post_type = "oferta-laboral",
    $search = false,
    $taxonomies_array = false,
    $custom_field_array = array(array("meta_key" => "fecha_de_expiracion", "condition" => "AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()")),  //%meta_value% 
    $order = array(0 => 'ORDER BY STR_TO_DATE(%meta_value%, "%Y%m%d" ) DESC'),
    $page = $paged,
    $posts_per_page,
    $total_rows
);
$max_num_pages = ceil($total_rows / $posts_per_page);
$html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13px" height="13px" fill="red">
            <path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9l0 176c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/>
        </svg>';
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

                            <div class="search-bar">
                                <?php
                                $search_icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="white">
    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
</svg>';
                                ?>
                                <div class="search-bar-inside">
                                    <input type="text" class="search-input" id="searchInput">
                                    <button class="search-button" id="searchButton">
                                        <?php echo $search_icon_svg; ?>
                                    </button>
                                </div>
                            </div>

                            <?php
                            $titulos_ofertas = array();
                            $ubicaciones_ofertas = array();

                            foreach ($rows as $o_row) {
                                $sf_title = $o_row->post_title;
                                $sf_ubicacion = get_post_meta($o_row->ID, 'ubicacion_geografica', true);

                                if (!in_array($sf_title, $titulos_ofertas)) {
                                    $titulos_ofertas[] = $sf_title;
                                }

                                if (!in_array($sf_ubicacion, $ubicaciones_ofertas)) {
                                    $ubicaciones_ofertas[] = $sf_ubicacion;
                                }
                            }
                            ?>

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
                                        <div class="filter-dropdown active" id="filtro-puesto">
                                            <ul>
                                                <?php if (!empty($titulos_ofertas)): ?>
                                                    <?php foreach ($titulos_ofertas as $titulo): ?>
                                                        <li data-value="<?php echo $titulo; ?>">
                                                            <?php echo $titulo; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li>No hay puestos disponibles</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <div class="filter-dropdown" id="filtro-lugar">
                                            <ul>
                                                <?php if (!empty($ubicaciones_ofertas)): ?>
                                                    <?php foreach ($ubicaciones_ofertas as $ubicacion): ?>
                                                        <li data-value="<?php echo $ubicacion; ?>">
                                                            <?php echo $ubicacion; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <li>No hay lugares disponibles</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="job-listings">
                                <?php
                                $contador = 0;
                                $total_banners = !empty($banners_de_columna) ? count($banners_de_columna) : 0;
                                $indice_banner = 0;
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

                                    if ($contador % 10 == 0 && $total_banners > 0):
                                        $sf_html = $banners_de_columna[$indice_banner]["html"] ?? '';

                                        if (!empty($sf_html)): ?>
                                            <div class="ad">
                                                <?php echo $sf_html; ?>
                                            </div>
                                            <?php
                                            $indice_banner = ($indice_banner + 1) % $total_banners;
                                        endif;
                                    endif;
                                    ?>
                                <?php endforeach; ?>

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
    </section>
</main>


<?php get_footer(); ?>