<?php
/**
 * Template Name: Página de Ciudad (Empleos)
 * The Template for displaying all single posts for "ciudad_empleo"
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

if (!function_exists('formatear_empresa_destacada_ciudad')) {
    function formatear_empresa_destacada_ciudad($value, $post_id, $field) {
        return obtener_texto_acf($value);
    }
}

if (!function_exists('obtener_datos_item_empleo_ciudad')) {
    function obtener_datos_item_empleo_ciudad($empleo_id) {
        $sf_title = get_the_title($empleo_id);
        $sf_fecha = obtener_texto_acf(get_field('fecha_de_expiracion', $empleo_id));

        $sf_empresa = obtener_texto_acf(get_field('empresa', $empleo_id));
        if (empty($sf_empresa)) {
            $sf_empresa = get_field('nombre_de_la_empresa', $empleo_id);
        }

        $sf_ubicacion = obtener_texto_acf(get_field('distrito', $empleo_id));
        $sf_permalink = get_permalink($empleo_id);

        return array(
            'title' => $sf_title,
            'fecha' => $sf_fecha,
            'empresa' => $sf_empresa,
            'ubicacion' => $sf_ubicacion,
            'permalink' => $sf_permalink,
        );
    }
}

$nombre_ciudad = get_field("nombre_ciudad", $post_id);
$valor_real_acf = get_field("nombre_ciudad", $post_id, false); // 'false' nos da el valor raw (PE@LIM)
$codigo_busqueda = esc_sql($valor_real_acf);

$nombre_visual = $valor_real_acf; // Por defecto
$path_states = get_template_directory() . "/functions/php-countries/states.php";
if (file_exists($path_states)) {
    $array_states = include $path_states;
    if (strpos($valor_real_acf, '@') !== false) {
        $parts = explode("@", $valor_real_acf);
        if (isset($array_states[$parts[0]][$parts[1]])) {
            $nombre_visual = $array_states[$parts[0]][$parts[1]];
        }
    }
}

$activar_bloque_1_c   = get_field("activar_bloque_1_c", $post_id);
$contenido_bloque_1_c = get_field("contenido_bloque_1_c", $post_id);

$activar_bloque_2_c   = get_field("activar_bloque_2_c", $post_id);
$texto_contador     = get_field("texto_contador_bloque_2", $post_id);

$activar_bloque_3_c   = get_field("activar_bloque_3_c", $post_id);
$activar_bloque_4_c   = get_field("activar_bloque_4_c", $post_id);

$banners_de_columna = get_field("banners_de_columna", "option");

$svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
$posts_per_page = 20;
$paged = isset($_GET["pg"]) ? max(1, intval($_GET["pg"])) : 1;
$total_rows = 0;
global $wpdb;


$rows = get_custom_posts( 
      $post_type = "empleo", 
      $search = false, 
      $taxonomies_array = false, 
      $custom_field_array = array( 
          array( "meta_key"=>"fecha_de_expiracion", "condition"=>"AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()"), 
          array( "meta_key"=>"ciudad", "condition"=>"AND %meta_value% = '".$codigo_busqueda."'")
      ),  
      $order = array( 0=>'ORDER BY post_title ASC'), 
      $page = $paged, 
      $posts_per_page, 
      $total_rows 
);
$max_num_pages = ceil($total_rows / $posts_per_page);

$total_rows_destacados = 0;
$rows_destacados = array();

if (!empty($valor_real_acf)) {
    $rows_destacados = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT p.ID, p.post_title
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} m_exp ON (p.ID = m_exp.post_id AND m_exp.meta_key = 'fecha_de_expiracion')
        INNER JOIN {$wpdb->postmeta} m_city ON (p.ID = m_city.post_id AND m_city.meta_key = 'ciudad')
        INNER JOIN {$wpdb->postmeta} m_destacado ON (p.ID = m_destacado.post_id AND m_destacado.meta_key = 'destacado')
        LEFT JOIN {$wpdb->postmeta} m_peso ON (p.ID = m_peso.post_id AND m_peso.meta_key = 'peso')
        WHERE p.post_type = 'empleo'
        AND p.post_status = 'publish'
        AND STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') >= CURDATE()
        AND m_city.meta_value = %s
        AND m_destacado.meta_value = '1'
        ORDER BY CAST(COALESCE(NULLIF(m_peso.meta_value, ''), 0) AS SIGNED) DESC, p.post_date DESC, STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') ASC",
        $valor_real_acf
    ));

    $total_rows_destacados = count($rows_destacados);
}


get_header(); 
?>

<main id="main-content" class="page wrapper page-single-empresa page-single-ciudad" role="main">
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

                            <?php if ($activar_bloque_1_c && !empty($contenido_bloque_1_c)): ?>
                                <div class="ciudad-bloque ciudad-banner">
                                    <?php echo wp_kses_post($contenido_bloque_1_c); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($activar_bloque_2_c): ?>
                                <?php if(false): ?>
                                <div class="ciudad-bloque search-bar">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                        <div class="search-bar-inside">
                                            <input type="text" class="search-input" placeholder="Buscar puesto en <?php echo esc_attr($nombre_visual); ?>..." value="<?php echo get_search_query(); ?>" name="s" />
                                            <input type="hidden" name="post_type" value="empleo" />
                                            <input type="hidden" name="meta_key" value="ciudad" />
                                            <input type="hidden" name="meta_value" value="<?php echo esc_attr($valor_real_acf); ?>" />
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>
                                    <div class="ciudad-bloque search-bar">
                                        <form role="search" method="get" action="<?php echo esc_url(home_url('/ofertas-empleos/')); ?>" id="form-busqueda-ciudad">
                                            <div class="search-bar-inside">
                                                <input 
                                                    type="text" 
                                                    class="search-input" 
                                                    placeholder="Buscar puesto en <?php echo esc_attr($nombre_visual); ?>..."
                                                    id="termino-busqueda"
                                                />
                                                <input type="hidden" name="filtros" id="filtros-json" />

                                            </div>
                                        </form>
                                    </div>

                                    <script>
                                        document.getElementById('form-busqueda-ciudad').addEventListener('submit', function(e) {
                                            e.preventDefault();
                                            const ciudad  = "<?php echo esc_js($nombre_visual); ?>";
                                            const termino = document.getElementById('termino-busqueda').value.trim();

                                            const filtros = [
                                                { key: "ciudad", value: ciudad, tipoLabel: "Ciudad" }
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
                                    $texto_mostrar = str_replace('{ciudad}', '<strong>' . esc_html($nombre_visual) . '</strong>', $texto_mostrar);
                                    echo '<p class="contador-ofertas" style="font-size: 1.1em;">' . wp_kses_post($texto_mostrar) . '</p>';
                                }
                                ?>
                            <?php endif; ?>

                            <?php if ($activar_bloque_3_c && !empty($rows_destacados)): ?>
                                <div class="ciudad-bloque ciudad-destacados job-offers">
                                    <h4>PUESTOS DESTACADOS EN <?php echo strtoupper(esc_html($nombre_visual)); ?></h4>

                                    <?php add_filter('acf/format_value/name=empresa', 'formatear_empresa_destacada_ciudad', 20, 3); ?>
                                    
                                    <?php foreach ($rows_destacados as $o_row): ?>
                                        <?php
                                        if (function_exists('get_html_list_empleo')) {
                                            echo get_html_list_empleo($o_row->ID);
                                        }
                                        ?>
                                    <?php endforeach; ?>

                                    <?php remove_filter('acf/format_value/name=empresa', 'formatear_empresa_destacada_ciudad', 20); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($activar_bloque_4_c): ?>
                                <div class="ciudad-bloque ciudad-listado job-offers">
                                    <h4>TODOS LOS PUESTOS EN <?php echo strtoupper(esc_html($nombre_visual)); ?> (A-Z)</h4>
                                    
                                    <?php if (!empty($rows)): ?>
                                        <?php foreach ($rows as $o_row): ?>
                                            <?php
                                            $sf_data = obtener_datos_item_empleo_ciudad($o_row->ID);
                                            ?>
                                            
                                            <div class="wrap-item post-<?php echo $o_row->ID; ?>">
                                                <a href="<?php echo esc_url($sf_data['permalink']); ?>" class="job-item">
                                                    <span class="icon"><?php echo $svg_icon; ?></span>

                                                    <?php if ($sf_data['title']): ?>
                                                        <span class="job-title-list"><?php echo esc_html($sf_data['title']); ?></span>
                                                        <span class="job-separator"> - </span>
                                                    <?php endif; ?>

                                                    <?php if ($sf_data['empresa']): ?>
                                                        <span class="job-location"><?php echo esc_html($sf_data['empresa']); ?> /</span>
                                                    <?php endif; ?>

                                                    <?php if ($sf_data['ubicacion'] || $sf_data['fecha']): ?>
                                                        <span class="job-info">
                                                            <?php echo esc_html($sf_data['ubicacion']); ?> - <?php echo esc_html($sf_data['fecha']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Actualmente no hay ofertas vigentes para esta ciudad.</p>
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