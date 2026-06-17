<?php
/**
 * Template Name: Página de Área
 * The Template for displaying all single posts for "area"
 *
 * @package NewsPlus
 */

$post_id = get_the_ID();
$base_url = get_bloginfo("url");
$permalink_ofertas_laborales = get_bloginfo("url")."/ofertas-laborales";

// ----------------------------------------------------------------------
// FUNCIÓN ESCUDO: Evita errores fatales con Objetos de Publicación
// ----------------------------------------------------------------------
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
// OBTENER CAMPO NUEVO Y BÁSICOS
// ----------------------------------------------------------------------
$nombre_area = get_field("nombre_area", $post_id);
$title_area = !empty($nombre_area) ? $nombre_area : get_the_title($post_id);

$activar_bloque_1   = get_field("activar_bloque_1", $post_id);
$contenido_bloque_1 = get_field("contenido_bloque_1", $post_id);

$activar_bloque_2   = get_field("activar_bloque_2", $post_id);
$texto_contador     = get_field("texto_contador_bloque_2", $post_id);

$activar_bloque_3   = get_field("activar_bloque_3", $post_id);
$activar_bloque_4   = get_field("activar_bloque_4", $post_id);
$ciudades_prioritarias = get_field("ciudades_prioritarias", $post_id); 
if (!is_array($ciudades_prioritarias)) $ciudades_prioritarias = array();

$banners_de_columna = get_field("banners_de_columna", "option");
$svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';

// Consulta Listado General (Todas las ofertas del Área)
$args_all = array(
    'post_type'      => 'empleo',
    'posts_per_page' => -1,
    'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'     => 'area',
            'value'   => '"' . $post_id . '"',
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'fecha_de_expiracion',
            'value'   => date('Ymd'),
            'compare' => '>=',
            'type'    => 'DATE'
        )
    )
);
$todas_las_ofertas = get_posts($args_all);
$total_rows = count($todas_las_ofertas);

usort($todas_las_ofertas, function($a, $b) use ($ciudades_prioritarias) {
    $ciudad_a = get_field('ciudad', $a->ID, false);
    $ciudad_b = get_field('ciudad', $b->ID, false);
    
    $pos_a = array_search($ciudad_a, $ciudades_prioritarias);
    $pos_b = array_search($ciudad_b, $ciudades_prioritarias);
    
    if ($pos_a === false) $pos_a = 9999;
    if ($pos_b === false) $pos_b = 9999;
    
    if ($pos_a != $pos_b) {
        return $pos_a - $pos_b;
    }
    
    return strcmp($a->post_title, $b->post_title);
});

$posts_per_page = 20;
$max_num_pages = ceil($total_rows / $posts_per_page);
$paged = isset($_GET["pg"]) ? max(1, intval($_GET["pg"])) : 1;
$offset = ($paged - 1) * $posts_per_page;
$ofertas_paginadas = array_slice($todas_las_ofertas, $offset, $posts_per_page);

// Consulta Destacados (Con los nuevos slugs "peso" y "destacado")
$args_destacados = array(
    'post_type'      => 'empleo',
    'posts_per_page' => -1,
    'meta_key'       => 'peso', // Actualizado
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
    'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'     => 'area',
            'value'   => '"' . $post_id . '"',
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'destacado', // Actualizado
            'value'   => '1',
            'compare' => '='
        ),
        array(
            'key'     => 'fecha_de_expiracion',
            'value'   => date('Ymd'),
            'compare' => '>=',
            'type'    => 'DATE'
        )
    )
);
$query_destacados = new WP_Query($args_destacados);

get_header(); 
?>

<main id="main-content" class="page wrapper page-single-area page-single-ciudad" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-empr-details">

                            <div class="row custom-row">
                                <div class="col-12 col-lg-6 custom-col">
                                    <ol class="breadcrumbs">
                                        <li><a href="<?php echo esc_url($base_url); ?>">Home</a></li>
                                        <li><a href="<?php echo esc_url($permalink_ofertas_laborales); ?>">Empleos</a></li>
                                        <li><span><?php echo esc_html($title_area); ?></span></li>
                                    </ol>
                                </div>
                                <div class="col-12 col-lg-6 custom-col">
                                    <div class="wrap-buttons">
                                        <a href="<?php echo esc_url($permalink_ofertas_laborales); ?>" class="btn-gray">Volver al listado general</a>
                                    </div>
                                </div>
                            </div>

                            <?php if ($activar_bloque_1 && !empty($contenido_bloque_1)): ?>
                                <div class="ciudad-bloque ciudad-banner">
                                    <?php echo wp_kses_post($contenido_bloque_1); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($activar_bloque_2): ?>
                                <div class="ciudad-bloque search-bar">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                        <div class="search-bar-inside">
                                            <input type="text" class="search-input" placeholder="Buscar en <?php echo esc_attr($title_area); ?>..." value="<?php echo get_search_query(); ?>" name="s" />
                                            <input type="hidden" name="post_type" value="empleo" />
                                            <input type="hidden" name="meta_key" value="area" />
                                            <input type="hidden" name="meta_value" value="<?php echo esc_attr($post_id); ?>" />
                                            <button type="submit" class="search-button">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                if (!empty($texto_contador)) {
                                    $texto_mostrar = str_replace('{count}', '<strong>' . $total_rows . '</strong>', $texto_contador);
                                    $texto_mostrar = str_replace('{area}', '<strong>' . esc_html($title_area) . '</strong>', $texto_mostrar);
                                    echo '<p class="contador-ofertas" style="font-size: 1.1em;">' . wp_kses_post($texto_mostrar) . '</p>';
                                }
                                ?>
                            <?php endif; ?>

                            <?php if ($activar_bloque_3 && $query_destacados->have_posts()): ?>
                                <div class="ciudad-bloque ciudad-destacados job-offers">
                                    <h4>DESTACADOS EN <?php echo strtoupper(esc_html($title_area)); ?></h4>
                                    
                                    <?php while ($query_destacados->have_posts()): $query_destacados->the_post(); ?>
                                        <?php
                                        $sf_ID = get_the_ID();
                                        $sf_title = get_the_title();
                                        $sf_fecha = obtener_texto_acf(get_field('fecha_de_expiracion', $sf_ID));
                                        
                                        // Extracción segura de Empresa
                                        $sf_empresa = obtener_texto_acf(get_field('empresa', $sf_ID));
                                        if (empty($sf_empresa)) { $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID); }
                                        
                                        // Extracción segura de Ciudad
                                        $sf_ubicacion = obtener_texto_acf(get_field('ciudad', $sf_ID)); 
                                        
                                        $sf_permalink = get_permalink($sf_ID);
                                        ?>
                                        <div class="wrap-item destacado-item">
                                            <a href="<?php echo esc_url($sf_permalink); ?>" class="job-item">
                                                <span class="icon"><?php echo $svg_icon; ?></span>
                                                <?php if ($sf_title): ?>
                                                    <span class="job-title-list"><strong><?php echo esc_html($sf_title); ?></strong></span>
                                                    <span class="job-separator"> - </span>
                                                <?php endif; ?>
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
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($activar_bloque_4): ?>
                                <div class="ciudad-bloque ciudad-listado job-offers">
                                    <h4>TODAS LAS OFERTAS DE <?php echo strtoupper(esc_html($title_area)); ?></h4>
                                    
                                    <?php if (!empty($ofertas_paginadas)): ?>
                                        <?php foreach ($ofertas_paginadas as $post_oferta): ?>
                                            <?php
                                            $sf_ID = $post_oferta->ID;
                                            $sf_title = $post_oferta->post_title;
                                            $sf_fecha = obtener_texto_acf(get_field('fecha_de_expiracion', $sf_ID));
                                            
                                            // Extracción segura de Empresa
                                            $sf_empresa = obtener_texto_acf(get_field('empresa', $sf_ID));
                                            if (empty($sf_empresa)) { $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID); }
                                            
                                            // Extracción segura de Ciudad
                                            $sf_ubicacion = obtener_texto_acf(get_field('ciudad', $sf_ID)); 
                                            
                                            $sf_permalink = get_permalink($sf_ID);
                                            ?>
                                            <div class="wrap-item">
                                                <a href="<?php echo esc_url($sf_permalink); ?>" class="job-item">
                                                    <span class="icon"><?php echo $svg_icon; ?></span>
                                                    <?php if ($sf_title): ?>
                                                        <span class="job-title-list"><?php echo esc_html($sf_title); ?></span>
                                                        <span class="job-separator"> - </span>
                                                    <?php endif; ?>
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
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Actualmente no hay ofertas vigentes para esta área.</p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($max_num_pages > 1): ?>
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
                                <?php endif; ?>
                            <?php endif; ?>

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
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>