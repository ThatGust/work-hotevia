<?php
/**
 * Template Name: Página de Área (Empleos)
 * The Template for displaying all single posts for "area"
 *
 * @package NewsPlus
 */

$post_id = get_the_ID();
$base_url = get_bloginfo("url");
$permalink_ofertas_laborales = get_bloginfo("url")."/ofertas-laborales";

if (!function_exists('obtener_texto_acf')) {
    function obtener_texto_acf($valor_acf) {
        if (empty($valor_acf)) return '';
        if (is_object($valor_acf)) return get_the_title($valor_acf->ID);
        if (is_numeric($valor_acf)) return get_the_title($valor_acf);
        if (is_array($valor_acf) && isset($valor_acf[0])) return (is_object($valor_acf[0]) ? get_the_title($valor_acf[0]->ID) : get_the_title($valor_acf[0]));
        return (string) $valor_acf;
    }
}

if (!function_exists('formatear_empresa_destacada_puesto')) {
    function formatear_empresa_destacada_puesto($value, $post_id, $field) {
        return obtener_texto_acf($value);
    }
}

$nombre_area_raw = get_field("nombre_area", $post_id, false);
$nombre_visual = get_the_title($post_id);
$puesto_term_id = 0;

if (is_object($nombre_area_raw) && isset($nombre_area_raw->term_id)) {
    $puesto_term_id = intval($nombre_area_raw->term_id);
    $nombre_visual = $nombre_area_raw->name;
} elseif (is_numeric($nombre_area_raw) && intval($nombre_area_raw) > 0) {
    $puesto_term_id = intval($nombre_area_raw);
    $term_from_id = get_term_by('id', $puesto_term_id, 'puesto');
    if ($term_from_id && !is_wp_error($term_from_id)) {
        $nombre_visual = $term_from_id->name;
    }
} elseif (is_string($nombre_area_raw) && trim($nombre_area_raw) !== '') {
    $nombre_visual = trim($nombre_area_raw);
    $term_from_name = get_term_by('name', $nombre_visual, 'puesto');
    if ($term_from_name && !is_wp_error($term_from_name)) {
        $puesto_term_id = intval($term_from_name->term_id);
        $nombre_visual = $term_from_name->name;
    }
}

$queried_object = get_queried_object();
if (is_object($queried_object) && isset($queried_object->term_id) && isset($queried_object->taxonomy) && $queried_object->taxonomy === 'puesto') {
    $puesto_term_id = intval($queried_object->term_id);
    $nombre_visual = $queried_object->name;
}

$activar_bloque_1   = get_field("activar_bloque_1_a", $post_id);
$contenido_bloque_1 = get_field("contenido_bloque_1_a", $post_id);

$activar_bloque_2   = get_field("activar_bloque_2_a", $post_id);
$texto_contador     = get_field("texto_contador_bloque_2_a", $post_id);

$activar_bloque_3   = get_field("activar_bloque_3_a", $post_id);

$banners_de_columna = get_field("banners_de_columna", "option");

$svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
$posts_per_page = 20;
$paged = isset($_GET["pg"]) ? max(1, intval($_GET["pg"])) : 1;
global $wpdb;

$total_rows = 0;
$rows = array();
$total_rows_destacados = 0;
$rows_destacados = array();

$taxonomies_array = false;
if ($puesto_term_id > 0) {
    $taxonomies_array = array(
        array(
            'taxonomy' => 'puesto',
            'term_id' => $puesto_term_id,
        )
    );
}

if ($taxonomies_array) {
    $rows = get_custom_posts(
        $post_type = "empleo",
        $search_text = false,
        $taxonomies_array,
        $custom_fields_array = array(
            array("meta_key" => "fecha_de_expiracion", "condition" => "AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()")
        ),
        $order = array(0 => 'ORDER BY wp.post_title ASC'),
        $page = $paged,
        $posts_per_page,
        $total_rows
    );

    $rows_destacados = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT p.ID, p.post_title
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->term_relationships} tr ON tr.object_id = p.ID
        INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
        INNER JOIN {$wpdb->postmeta} m_exp ON (p.ID = m_exp.post_id AND m_exp.meta_key = 'fecha_de_expiracion')
        INNER JOIN {$wpdb->postmeta} m_destacado ON (p.ID = m_destacado.post_id AND m_destacado.meta_key = 'destacado')
        LEFT JOIN {$wpdb->postmeta} m_peso ON (p.ID = m_peso.post_id AND m_peso.meta_key = 'peso')
        WHERE p.post_type = 'empleo'
        AND p.post_status = 'publish'
        AND tt.taxonomy = 'puesto'
        AND tt.term_id = %d
        AND STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') >= CURDATE()
        AND m_destacado.meta_value = '1'
        ORDER BY CAST(COALESCE(NULLIF(m_peso.meta_value, ''), 0) AS SIGNED) DESC, p.post_date DESC, STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') ASC",
        $puesto_term_id
    ));

    $total_rows_destacados = count($rows_destacados);
}

$max_num_pages = ceil($total_rows / $posts_per_page);

get_header(); 
?>

<main id="main-content" class="page wrapper page-single-empresa page-single-area page-single-ciudad" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-empr-details">

                            <div class="row custom-row mb-3">
                                <div class="col-12 col-lg-6 custom-col">
                                    <ol class="breadcrumbs">
                                        <li><a href="<?php echo esc_url($base_url); ?>">Home</a></li>
                                        <li><a href="<?php echo esc_url($permalink_ofertas_laborales); ?>">Empleos</a></li>
                                        <li><span><?php echo esc_html($nombre_visual); ?></span></li>
                                    </ol>
                                </div>
                                <div class="col-12 col-lg-6 custom-col text-lg-end">
                                    <div class="wrap-buttons">
                                        <a href="<?php echo esc_url($permalink_ofertas_laborales); ?>" class="btn-gray">Volver al listado general</a>
                                    </div>
                                </div>
                            </div>


                            <?php if ($activar_bloque_1 && !empty($contenido_bloque_1)): ?>
                                <div class="ciudad-bloque ciudad-banner mb-4">
                                    <?php echo wp_kses_post($contenido_bloque_1); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($activar_bloque_2): ?>
                                <?php if(false): ?>
                                <div class="ciudad-bloque search-bar">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                        <div class="search-bar-inside">
                                            <input type="text" class="search-input" placeholder="Buscar puesto en <?php echo esc_attr($nombre_visual); ?>..." value="<?php echo get_search_query(); ?>" name="s" />
                                            <input type="hidden" name="post_type" value="empleo" />
                                            <button type="submit" class="search-button">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>
                                <div class="ciudad-bloque search-bar">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/ofertas-empleos/')); ?>" id="form-busqueda-puesto">
                                        <div class="search-bar-inside">
                                            <input 
                                                type="text" 
                                                class="search-input" 
                                                placeholder="Buscar en <?php echo esc_attr($nombre_visual); ?>..."
                                                id="termino-busqueda"
                                            />
                                            <input type="hidden" name="filtros" id="filtros-json" />
                                        </div>
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('form-busqueda-puesto').addEventListener('submit', function(e) {
                                        e.preventDefault();

                                        const puesto  = "<?php echo esc_js($nombre_visual); ?>";
                                        const termino = document.getElementById('termino-busqueda').value.trim();

                                        const filtros = [
                                            { key: "puesto", value: puesto, tipoLabel: "Puesto" }
                                        ];

                                        if (termino !== '') {
                                            filtros.push({ key: "palabra_clave", value: termino, tipoLabel: "Buscar término" });
                                        }

                                        document.getElementById('filtros-json').value = JSON.stringify(filtros);
                                        this.submit();
                                    });
                                </script>
                                <?php
                                if (!empty($texto_contador)) {
                                    $texto_mostrar = str_replace('{count}', '<strong>' . $total_rows . '</strong>', $texto_contador);
                                    $texto_mostrar = str_replace('{area}', '<strong>' . esc_html($nombre_visual) . '</strong>', $texto_mostrar);
                                    echo '<p class="contador-ofertas" style="font-size: 1.1em;">' . wp_kses_post($texto_mostrar) . '</p>';
                                }
                                ?>
                            <?php endif; ?>

                            <?php if ($activar_bloque_3 && !empty($rows_destacados)): ?>
                                <div class="ciudad-bloque ciudad-destacados job-offers">
                                    <h4>PUESTOS DESTACADOS EN <?php echo strtoupper(esc_html($nombre_visual)); ?></h4>

                                    <?php add_filter('acf/format_value/name=empresa', 'formatear_empresa_destacada_puesto', 20, 3); ?>

                                    <?php foreach ($rows_destacados as $o_row): ?>
                                        <?php
                                        if (function_exists('get_html_list_empleo')) {
                                            echo get_html_list_empleo($o_row->ID);
                                        }
                                        ?>
                                    <?php endforeach; ?>

                                    <?php remove_filter('acf/format_value/name=empresa', 'formatear_empresa_destacada_puesto', 20); ?>
                                </div>
                            <?php endif; ?>

                                <div class="ciudad-bloque ciudad-listado job-offers">
                                    <h4>TODOS LOS PUESTOS EN <?php echo strtoupper(esc_html($nombre_visual)); ?> (A-Z)</h4>
                                    
                                    <?php 
                                    if (!empty($rows)):
                                            foreach ($rows as $o_row):
                                                $sf_ID = $o_row->ID;
                                                $sf_title = $o_row->post_title;
                                                $sf_fecha = obtener_texto_acf(get_field('fecha_de_expiracion', $sf_ID));
                                                
                                                $sf_empresa = obtener_texto_acf(get_field('empresa', $sf_ID));
                                                if (empty($sf_empresa)) { $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID); }
                                                
                                                $sf_ubicacion = obtener_texto_acf(get_field('distrito', $sf_ID)); 
                                                
                                                $sf_permalink = get_permalink($sf_ID);
                                                ?>
                                                
                                                <div class="wrap-item post-<?php echo $sf_ID; ?>">
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
                                                <?php
                                            endforeach;
                                    else: ?>
                                        <p>Actualmente no hay ofertas vigentes para esta área.</p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($max_num_pages > 1): ?>
                                    <div class="paginate-links">
                                        <?php
                                        echo paginate_links(array(
                                            'base'      => add_query_arg('pg', '%#%'),
                                            'format'    => '?pg=%#%',
                                            'current'   => $paged,
                                            'total'     => $max_num_pages,
                                            'prev_text' => ('« Anterior'),
                                            'next_text' => ('Siguiente »'),
                                        ));
                                        ?>
                                    </div>
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