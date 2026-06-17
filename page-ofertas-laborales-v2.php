<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Ofertas Laborales v2
 */

$page_id = get_the_ID();
$base_url = get_bloginfo("url");
$permalink_ofertas_laborales = get_permalink($page_id);

// ----------------------------------------------------------------------
// CAPTURAR BÚSQUEDA EVITANDO EL SECUESTRO DE WORDPRESS ("s" -> "buscar")
// ----------------------------------------------------------------------
$keyword_raw = isset($_GET['buscar']) ? sanitize_text_field($_GET['buscar']) : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '');
$is_search = !empty($keyword_raw);

// FUNCIÓN PARA LIMPIAR TEXTO (ignorar mayúsculas y tildes en la búsqueda)
if (!function_exists('limpiar_texto_busqueda')) {
    function limpiar_texto_busqueda($texto) {
        $texto = mb_strtolower(trim($texto), 'UTF-8');
        $sustituciones = array('á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u', 'ü'=>'u', 'ñ'=>'n');
        return strtr($texto, $sustituciones);
    }
}
$keyword = limpiar_texto_busqueda($keyword_raw);

// FUNCIÓN ESCUDO
if (!function_exists('obtener_texto_acf')) {
    function obtener_texto_acf($valor_acf) {
        if (empty($valor_acf)) return '';
        if (is_object($valor_acf)) return get_the_title($valor_acf->ID);
        if (is_numeric($valor_acf)) return get_the_title($valor_acf);
        if (is_array($valor_acf) && isset($valor_acf[0])) return (is_object($valor_acf[0]) ? get_the_title($valor_acf[0]->ID) : get_the_title($valor_acf[0]));
        return (string) $valor_acf;
    }
}

// ----------------------------------------------------------------------
// VARIABLES COMUNES
// ----------------------------------------------------------------------
$html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
$banners_de_columna = get_field("banners_de_columna", "option");
$svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';


// ----------------------------------------------------------------------
// LÓGICA SI ES MODO BÚSQUEDA (?buscar=...)
// ----------------------------------------------------------------------
if ($is_search) {
    $activar_banner_sup = get_field('activar_banner_busqueda', 'option');
    $html_banner_sup    = get_field('banner_header_busqueda', 'option');
    $banners_ads        = get_field('banners_recurrentes_busqueda', 'option');

    // Traemos TODOS los empleos publicados (evitamos fallos de WP_Query con las fechas)
    $args_all = array(
        'post_type'      => 'empleo',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    $todos_los_empleos = get_posts($args_all);
    $destacados = array();
    $normales = array();
    $hoy = (int) date('Ymd');

    foreach ($todos_los_empleos as $job) {
        
        // 1. Filtrar manualmente los que ya expiraron
        $fecha_exp = get_field('fecha_de_expiracion', $job->ID);
        if (!empty($fecha_exp) && (int)$fecha_exp < $hoy) {
            continue; 
        }

        // 2. Limpiar textos para que emparejen perfecto (sin tildes/mayúsculas)
        $job_title = limpiar_texto_busqueda($job->post_title);
        $empresa   = limpiar_texto_busqueda(obtener_texto_acf(get_field('empresa', $job->ID))); 
        if (empty($empresa)) { $empresa = limpiar_texto_busqueda((string) get_field('nombre_de_la_empresa', $job->ID)); }
        
        $etiquetas = limpiar_texto_busqueda(obtener_texto_acf(get_field('etiquetas', $job->ID)));
        $ciudad    = limpiar_texto_busqueda(get_field('ciudad', $job->ID));
        $distrito  = limpiar_texto_busqueda(obtener_texto_acf(get_field('distrito', $job->ID)));
        
        // 3. Comprobar si coincide con la búsqueda
        $es_coincidencia = empty($keyword) ? true : (
            strpos($job_title, $keyword) !== false ||
            strpos($empresa, $keyword) !== false ||
            strpos($ciudad, $keyword) !== false ||
            strpos($distrito, $keyword) !== false ||
            strpos($etiquetas, $keyword) !== false
        );
        
        // 4. Si coincide, validamos si es destacado y leemos su peso
        if ($es_coincidencia) {
            $es_destacado = get_field('destacado', $job->ID); 
            $peso = (int) get_field('peso_destacado', $job->ID);
            
            $job_data = array(
                'post' => $job, 
                'peso' => $peso, 
                'title' => $job->post_title,
                'es_destacado' => ($es_destacado || $es_destacado == '1')
            );
            
            if ($job_data['es_destacado']) { 
                $destacados[] = $job_data; 
            } else { 
                $normales[] = $job_data; 
            }
        }
    }

    // Ordenar Destacados por PESO de mayor a menor
    usort($destacados, function($a, $b) { return $b['peso'] <=> $a['peso']; });
    
    // Ordenar Normales ALEATORIAMENTE
    shuffle($normales);
    
    // Unimos la lista final
    $final_results = array_merge($destacados, $normales);
    $total_rows_search = count($final_results);
    $posts_per_page_search = 50; 
    $max_num_pages_search = ceil($total_rows_search / $posts_per_page_search);
    $paged_search = isset($_GET["pg"]) ? max(1, intval($_GET["pg"])) : 1;
    $offset = ($paged_search - 1) * $posts_per_page_search;
    $resultados_paginados = array_slice($final_results, $offset, $posts_per_page_search);

// ----------------------------------------------------------------------
// LÓGICA SI ES MODO DIRECTORIO NORMAL (V2 Original)
// ----------------------------------------------------------------------
} else {
    $ofertas_num = get_field("ofertas_num", $page_id);
    $banners_de_contenido = get_field("banners_de_contenido", "option");
    $empresas_destacadas = get_field('empresas_seleccionadas', 'option');
    $title_negocio = get_the_title($page_id);
    
    // Consulta para Destacados en la Vista Normal (Validaremos la fecha dentro del loop)
    $args_destacados_main = array(
        'post_type'      => 'empleo',
        'posts_per_page' => -1,
        'meta_key'       => 'peso_destacado', 
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'meta_query'     => array(
            array('key' => 'destacado', 'value' => '1', 'compare' => '=')
        )
    );
    $query_destacados_main = new WP_Query($args_destacados_main);
}

get_header(); 
?>

<main id="main-content" class="page wrapper page-ofertas-laborales page-single-ciudad <?php echo $is_search ? 'page-resultados-busqueda' : ''; ?>" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-ofertas-laborales" style="<?php echo $is_search ? 'width:100%;' : ''; ?>">

                            <ol class="breadcrumbs">
                                <li><a href="<?php echo $base_url; ?>">Home</a></li>
                                <li><span><?php echo $is_search ? 'Resultados de Búsqueda' : (isset($title_negocio) ? $title_negocio : 'Ofertas Laborales'); ?></span></li>
                            </ol>

                            <?php if (!$is_search): ?>
                                <h2 class="job-title">Ofertas de empleo hoteles y restaurantes Peru</h2>
                            <?php endif; ?>

                            <?php if ($is_search): ?>

                                <?php if ($activar_banner_sup && !empty($html_banner_sup)): ?>
                                    <div class="ciudad-bloque ciudad-banner mb-4">
                                        <?php echo wp_kses_post($html_banner_sup); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="ciudad-bloque search-bar" style="margin-top: 20px; position:relative;">
                                    <form role="search" method="get" action="<?php echo esc_url($permalink_ofertas_laborales); ?>">
                                        <div class="search-bar-inside">
                                            <input type="text" class="search-input" placeholder="Buscar empleo, empresa, ciudad..." value="<?php echo esc_attr($keyword_raw); ?>" name="buscar" />
                                            <button type="submit" class="search-button">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <p class="contador-ofertas" style="font-size: 1.1em; margin-bottom: 30px;">
                                    Se encontraron <strong><?php echo $total_rows_search; ?></strong> resultados para "<strong><?php echo esc_html($keyword_raw); ?></strong>"
                                </p>

                                <div class="ciudad-bloque ciudad-listado job-offers">
                                    <?php if (!empty($resultados_paginados)): ?>
                                        <?php 
                                        $contador_anuncios = 0; 
                                        $indice_banner_ad = 0;
                                        $total_ads = !empty($banners_ads) ? count($banners_ads) : 0;
                                        ?>
                                        <?php foreach ($resultados_paginados as $item): ?>
                                            <?php
                                            $sf_ID = $item['post']->ID;
                                            $sf_title = $item['post']->post_title;
                                            $sf_fecha = obtener_texto_acf(get_field('fecha_de_expiracion', $sf_ID));
                                            
                                            $sf_empresa = obtener_texto_acf(get_field('empresa', $sf_ID));
                                            if (empty($sf_empresa)) { $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID); }
                                            
                                            $codigo_ciudad_raw = get_field('ciudad', $sf_ID);
                                            $sf_ubicacion = $codigo_ciudad_raw;
                                            if (strpos($codigo_ciudad_raw, '@') !== false) {
                                                $path_states = get_template_directory() . "/functions/php-countries/states.php";
                                                if (file_exists($path_states)) {
                                                    $array_states = include $path_states;
                                                    $parts = explode("@", $codigo_ciudad_raw);
                                                    if (isset($array_states[$parts[0]][$parts[1]])) {
                                                        $sf_ubicacion = $array_states[$parts[0]][$parts[1]];
                                                    }
                                                }
                                            }

                                            $sf_permalink = get_permalink($sf_ID);
                                            $fecha_publicacion = human_time_diff(get_the_time('U', $sf_ID), current_time('timestamp')) . ' atrás';
                                            ?>
                                            
                                            <?php if ($item['es_destacado']): ?>
                                                <div class="card-destacado">
                                                    <div class="card-destacado-header">
                                                        <span class="etiqueta-gold">⭐ Empleo destacado</span>
                                                        <span class="opciones-dots">&#8942;</span>
                                                    </div>
                                                    <h3 class="card-destacado-title"><?php echo esc_html($sf_title); ?></h3>
                                                    <p class="card-destacado-empresa"><?php echo esc_html($sf_empresa); ?></p>
                                                    <p class="card-destacado-ubicacion"><?php echo esc_html($sf_ubicacion); ?></p>
                                                    <div class="card-destacado-footer">
                                                        <span class="card-destacado-tiempo">Hace <?php echo esc_html($fecha_publicacion); ?></span>
                                                        <a href="<?php echo esc_url($sf_permalink); ?>" class="btn-vista">Vista</a>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="wrap-item">
                                                    <a href="<?php echo esc_url($sf_permalink); ?>" class="job-item">
                                                        <span class="icon"><?php echo $svg_icon; ?></span>
                                                        <span class="job-title-list"><?php echo esc_html($sf_title); ?></span>
                                                        <span class="job-separator"> - </span>
                                                        <?php if ($sf_empresa): ?>
                                                            <span class="job-location"><?php echo esc_html($sf_empresa); ?> /</span>
                                                        <?php endif; ?>
                                                        <?php if ($sf_ubicacion || $sf_fecha): ?>
                                                            <span class="job-info">
                                                                <?php echo esc_html($sf_ubicacion); ?> - <?php echo esc_html($sf_fecha); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php 
                                            $contador_anuncios++;
                                            if ($contador_anuncios % 25 === 0 && $total_ads > 0) {
                                                $html_ad = $banners_ads[$indice_banner_ad]['html'] ?? '';
                                                if (!empty($html_ad)) {
                                                    echo '<div class="ad ad-intercalado" style="margin: 30px 0; text-align: center;">' . $html_ad . '</div>';
                                                    $indice_banner_ad = ($indice_banner_ad + 1) % $total_ads;
                                                }
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Lo sentimos, no hay resultados que coincidan con tu búsqueda.</p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($max_num_pages_search > 1): ?>
                                    <div class="paginate-links">
                                        <?php
                                        echo paginate_links(array(
                                            'base' => add_query_arg('pg', '%#%'),
                                            'format' => '?pg=%#%',
                                            'current' => $paged_search,
                                            'total' => $max_num_pages_search,
                                            'prev_text' => ('« Anterior'),
                                            'next_text' => ('Siguiente »'),
                                        ));
                                        ?>
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>

                                <div class="google-style-search-container" style="position:relative; margin-bottom: 30px;">
                                    <form role="search" method="get" action="<?php echo esc_url($permalink_ofertas_laborales); ?>">
                                        <div class="search-input-wrapper" id="searchWrapper">
                                            <div id="searchTags" class="search-tags-container"></div>
                                            <input type="text" name="buscar" id="autocompleteSearch" placeholder="Busca por empresa, ciudad, distrito o palabra..." autocomplete="off">                                    
                                            <div id="searchSpinner" class="search-spinner" style="display: none;"></div>
                                            <button type="submit" style="display:none;"></button>
                                        </div>
                                        <div id="autocompleteResults" class="autocomplete-suggestions-box" style="display:none;"></div>
                                    </form>
                                </div>

                                <div class="logo-grid-container mb-4">
                                    <div class="wrap">
                                        <div class="container">
                                            <div class="logo-grid">
                                                <?php 
                                                if (!empty($empresas_destacadas)) :
                                                    foreach ( $empresas_destacadas as $empresa_obj ): 
                                                        $empresa_id = $empresa_obj->ID;
                                                        $permalink = get_permalink( $empresa_id );
                                                        $title     = get_the_title( $empresa_id );
                                                        $logotipo_array = get_field('logotipo', $empresa_id);
                                                        $logo_url = '';
                                                        
                                                        if ( $logotipo_array && is_array($logotipo_array) ) {
                                                            $logo_url = isset($logotipo_array['sizes']['medium']) ? $logotipo_array['sizes']['medium'] : $logotipo_array['url'];
                                                        }
                                                        ?>
                                                        <a href="<?php echo esc_url( $permalink ); ?>" class="logo-item" title="<?php echo esc_attr( $title ); ?>">
                                                            <?php if ( $logo_url ): ?>
                                                                <img src="<?php echo esc_url( $logo_url ); ?>" alt="Logo de <?php echo esc_attr( $title ); ?>">
                                                            <?php else: ?>
                                                                <span class="logo-text"><?php echo esc_html( $title ); ?></span>
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endforeach; 
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $activar_banner_destacados = get_field('activar_banner_superior', $page_id); 
                                $html_banner_destacados = get_field('html_banner_superior', $page_id);
                                if ($activar_banner_destacados && !empty($html_banner_destacados)) {
                                    echo '<div class="ad ad-banner-destacados mb-4">' . $html_banner_destacados . '</div>';
                                }
                                ?>

                                <?php if ($query_destacados_main->have_posts()): ?>
                                    <div class="destacados-container" style="margin-bottom: 40px;">
                                        <?php while ($query_destacados_main->have_posts()): $query_destacados_main->the_post(); 
                                            $sf_ID = get_the_ID();
                                            
                                            // Verificación extra de fecha (por si falla el WP_Query)
                                            $hoy = (int) date('Ymd');
                                            $fecha_exp = get_field('fecha_de_expiracion', $sf_ID);
                                            if (!empty($fecha_exp) && (int)$fecha_exp < $hoy) {
                                                continue; 
                                            }

                                            $sf_title = get_the_title();
                                            $sf_empresa = obtener_texto_acf(get_field('empresa', $sf_ID));
                                            if (empty($sf_empresa)) { $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID); }
                                            
                                            $codigo_ciudad_raw = get_field('ciudad', $sf_ID);
                                            $sf_ubicacion = $codigo_ciudad_raw;
                                            if (strpos($codigo_ciudad_raw, '@') !== false) {
                                                $path_states = get_template_directory() . "/functions/php-countries/states.php";
                                                if (file_exists($path_states)) {
                                                    $array_states = include $path_states;
                                                    $parts = explode("@", $codigo_ciudad_raw);
                                                    if (isset($array_states[$parts[0]][$parts[1]])) {
                                                        $sf_ubicacion = $array_states[$parts[0]][$parts[1]];
                                                    }
                                                }
                                            }

                                            $sf_permalink = get_permalink($sf_ID);
                                            $fecha_publicacion = human_time_diff(get_the_time('U', $sf_ID), current_time('timestamp')) . ' atrás';
                                        ?>
                                            <div class="card-destacado">
                                                <div class="card-destacado-header">
                                                    <span class="etiqueta-gold">⭐ Empleo destacado</span>
                                                    <span class="opciones-dots">&#8942;</span>
                                                </div>
                                                <h3 class="card-destacado-title"><?php echo esc_html($sf_title); ?></h3>
                                                <p class="card-destacado-empresa"><?php echo esc_html($sf_empresa); ?></p>
                                                <p class="card-destacado-ubicacion"><?php echo esc_html($sf_ubicacion); ?></p>
                                                <div class="card-destacado-footer">
                                                    <span class="card-destacado-tiempo">Hace <?php echo esc_html($fecha_publicacion); ?></span>
                                                    <a href="<?php echo esc_url($sf_permalink); ?>" class="btn-vista">Vista</a>
                                                </div>
                                            </div>
                                        <?php endwhile; wp_reset_postdata(); ?>
                                    </div>
                                <?php endif; ?>
                                <div id="lista-empleos-container">
                                    <div id="mainSpinner" class="main-spinner-wrapper" style="display: none;">
                                        <div class="loader-wheel"></div>
                                    </div>
                                    <div id="lista-empleos" class="empleos-grid job-listings"></div>
                                    <div id="paginacion-empleos" class="paginacion-container1 paginate-links"></div>
                                </div>

                            <?php endif; ?>
                            <div class="footer-html">
                              <?php echo $html_pie_de_pagina; ?>
                            </div>

                        </div>
                        
                        <?php if (!$is_search && $banners_de_columna): ?>
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
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php if (!$is_search) {
    get_template_part('parts/page-ofertas-laborales-v2-js'); 
} ?>