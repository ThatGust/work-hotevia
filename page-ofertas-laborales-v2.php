<?php
    /**
     * @package WordPress
     * @subpackage Default_Theme
     * Template Name: Ofertas Laborales v2
     */

    $page_id = get_the_ID();

    $html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
    $ofertas_num = get_field("ofertas_num", $page_id);
    $banners_de_columna = get_field("banners_de_columna", "option");
    $banners_de_contenido = get_field("banners_de_contenido", "option");
    $empresas_destacadas = get_field('empresas_seleccionadas', 'option'); //grilla
    $ciudades_destacadas = get_field('ciudades_seleccionadas_distritos', 'option'); //grilla
    $mostrar_banner_header = get_field('mostrar_banner_header', 'option');
    $contenido_banner_top = get_field('contenido_banner_top', 'option');
    $contenido_banner_bottom = get_field('contenido_banner_bottom', 'option');




    $base_url = get_bloginfo("url");
    $title_negocio = get_the_title($page_id);
    $permalink_ofertas_laborales = home_url('/ofertas-empleos/');

    $path_states = get_template_directory() . "/functions/php-countries/states.php";
    $array_states = file_exists($path_states) ? include $path_states : array();

    global $wpdb;
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

                             <?php
                                if (!empty($banners_de_contenido)) {
                                    $first_banner_html = $banners_de_contenido[0]["html"] ?? '';
                                    if (!empty($first_banner_html)) {
                                        echo '<div class="ad-long">' . $first_banner_html . '</div>';
                                    }
                                }
                            ?>

                            <h2 class="job-title">
                                Ofertas de empleo hoteles y restaurantes Peru
                            </h2>

                            <div class="google-style-search-container">
                                <form role="search" method="get" action="<?php echo esc_url($permalink_ofertas_laborales); ?>">
                                    <div class="search-input-wrapper" id="searchWrapper">
                                        <div id="searchTags" class="search-tags-container"></div>
                                        <input type="text" name="s" id="autocompleteSearch" placeholder="Busca por empresa, ciudad, distrito o palabra..." autocomplete="off">                                    
                                        <div id="searchSpinner" class="search-spinner" style="display: none;"></div>
                                        <button type="submit" style="display:none;"></button>
                                    </div>
                                    <div id="autocompleteResults" class="autocomplete-suggestions-box" style="display:none;"></div>
                                </form>
                            </div>

                            <div class="logo-grid-container">
                                <div class="wrap">
                                    <div class="container">
                                        <div class="logo-grid">
                                            <?php 
                                            if (!empty($empresas_destacadas)) :
                                                foreach ($empresas_destacadas as $row) : 
                                                    
                                                    $empresa_obj = $row["empresa"];
                                                    $empresa_id = $empresa_obj->ID;
                                                    
                                                    $permalink = get_permalink($empresa_id);
                                                    $title = get_the_title($empresa_id);
                                                    
                                                    $logotipo_array = get_field('logotipo', $empresa_id);
                                                    $logo_url = '';
                                                    
                                                    if ($logotipo_array && is_array($logotipo_array)) {
                                                        $logo_url = isset($logotipo_array['sizes']['medium']) ? $logotipo_array['sizes']['medium'] : $logotipo_array['url'];
                                                    }
                                                    ?>
                                                    
                                                    <a href="<?php echo esc_url($permalink); ?>" class="logo-item" title="<?php echo esc_attr($title); ?>">
                                                        <?php if ($logo_url): ?>
                                                            <img src="<?php echo esc_url($logo_url); ?>" alt="Logo de <?php echo esc_attr($title); ?>">
                                                        <?php else: ?>
                                                            <span class="logo-text"><?php echo esc_html($title); ?></span>
                                                        <?php endif; ?>
                                                    </a>

                                                <?php endforeach; 
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($mostrar_banner_header && !empty($contenido_banner_top)): ?>
                                <div class="ad-long ad-long-top">
                                    <?php echo wp_kses_post($contenido_banner_top); ?>
                                </div>
                            <?php endif; ?>

                            <div class="city-districts-grid-container">
                                <div class="wrap">
                                    <div class="container">
                                        <div class="city-districts-grid">
                                            <?php if (!empty($ciudades_destacadas) && is_array($ciudades_destacadas)): ?>
                                                <?php foreach ($ciudades_destacadas as $row): ?>
                                                    <?php
                                                        $ciudad_obj = $row["ciudad"];
                                                        $ciudad_id = is_object($ciudad_obj) ? $ciudad_obj->ID : intval($ciudad_obj);
                                                        if (!$ciudad_id) {
                                                            continue;
                                                        }

                                                        $ciudad_title = get_the_title($ciudad_id);
                                                        $ciudad_permalink = get_permalink($ciudad_id);
                                                        $ciudad_raw = get_field('nombre_ciudad', $ciudad_id, false);

                                                        if (empty($ciudad_raw)) {
                                                            continue;
                                                        }

                                                        $ciudad_visual = $ciudad_title;
                                                        if (strpos($ciudad_raw, '@') !== false) {
                                                            $parts = explode('@', $ciudad_raw);
                                                            if (isset($array_states[$parts[0]][$parts[1]])) {
                                                                $ciudad_visual = $array_states[$parts[0]][$parts[1]];
                                                            }
                                                        }

                                                        $distritos = $wpdb->get_col($wpdb->prepare(
                                                            "SELECT DISTINCT m_dist.meta_value
                                                            FROM {$wpdb->posts} p
                                                            INNER JOIN {$wpdb->postmeta} m_city ON (p.ID = m_city.post_id AND m_city.meta_key = 'ciudad')
                                                            INNER JOIN {$wpdb->postmeta} m_dist ON (p.ID = m_dist.post_id AND m_dist.meta_key = 'distrito')
                                                            INNER JOIN {$wpdb->postmeta} m_exp ON (p.ID = m_exp.post_id AND m_exp.meta_key = 'fecha_de_expiracion')
                                                            WHERE p.post_type = 'empleo'
                                                            AND p.post_status = 'publish'
                                                            AND m_city.meta_value = %s
                                                            AND m_dist.meta_value <> ''
                                                            AND STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') >= CURDATE()
                                                            ORDER BY m_dist.meta_value ASC",
                                                            $ciudad_raw
                                                        ));
                                                    ?>
                                                    <div class="city-column">
                                                        <a href="<?php echo esc_url($ciudad_permalink); ?>" class="city-column-title"><?php echo esc_html('Empleos en ' . $ciudad_visual); ?></a>
                                                        <?php if (!empty($distritos)): ?>
                                                            <ul class="district-list">
                                                                <?php foreach ($distritos as $distrito): ?>
                                                                    <?php
                                                                    $filtros = array(
                                                                        array('key' => 'ciudad', 'value' => $ciudad_visual, 'tipoLabel' => 'Ciudad'),
                                                                        array('key' => 'distrito', 'value' => $distrito, 'tipoLabel' => 'Distrito'),
                                                                    );
                                                                    $url_distrito = add_query_arg(
                                                                        'filtros',
                                                                        rawurlencode(wp_json_encode($filtros)),
                                                                        $permalink_ofertas_laborales
                                                                    );
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($url_distrito); ?>"><?php echo esc_html('Empleos en ' . $distrito); ?></a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($mostrar_banner_header && !empty($contenido_banner_bottom)): ?>
                                <div class="ad-long ad-long-bottom">
                                    <?php echo wp_kses_post($contenido_banner_bottom); ?>
                                </div>
                            <?php endif; ?>

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
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>

<?php get_template_part('parts/page-ofertas-laborales-v2-js'); ?>