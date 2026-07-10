<?php
/**
 * SISTEMA DE FILTROS AVANZADOS DE EMPLEOS (ESTILO GOOGLE)
 * ARCHIVO: functions.php (COMPLETO Y CORREGIDO)
 */

// 1. ENCOLA DE FORMA SEGURA EL JS Y CONFIGURA LA VARIABLE GLOBAL AJAX
function exploor_empleos_registrar_assets() {
    wp_enqueue_script(
        'exploor-buscador-empleos',
        get_stylesheet_directory_uri() . '/js/script.js',
        array('jquery'),
        '2.2.0',
        true
    );

    wp_localize_script('exploor-buscador-empleos', 'wp_ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'exploor_empleos_registrar_assets');


// 2. HOOKS PARA LAS ACCIONES AJAX DE WORDPRESS
add_action('wp_ajax_buscar_empleos_autocomplete', 'buscar_empleos_autocomplete_callback');
add_action('wp_ajax_nopriv_buscar_empleos_autocomplete', 'buscar_empleos_autocomplete_callback');

add_action('wp_ajax_filtrar_y_paginar_empleos', 'filtrar_y_paginar_empleos_callback');
add_action('wp_ajax_nopriv_filtrar_y_paginar_empleos', 'filtrar_y_paginar_empleos_callback');



function arrayLikeSearch(array $cities, string $city_label): array{
    $regex = '/^' .
        str_replace(
            ['%', '_'],
            ['.*', '.'],
            preg_quote($city_label, '/')
        ) .
        '$/iu';

    return array_keys(
        array_filter(
            $cities,
            fn($city_code) => preg_match($regex, $city_code)
        )
    );
}

function codeSearch(array $cities, string $city_label): string{
    $country_city_code = false;
    foreach ($cities as $a_country_city_code => $label) {
        if (
            mb_strtolower($label, 'UTF-8') ===
            mb_strtolower($city_label, 'UTF-8')
        ) {
            $country_city_code = $a_country_city_code;
            break;
        }
    }

    if ($country_city_code === false) {
        $array = arrayLikeSearch($cities, '%'.$city_label.'%');
        if (is_array($array) && count($array) > 0) {
            return $array[0];
        }
    }
    return $country_city_code;
}


/**
 * ENDPOINT 1: Autocompletado Segmentado con Prioridad de Ciudad y Opción Global Literal
 */
function buscar_empleos_autocomplete_callback() {
    global $wpdb;

    $original_term = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';
    $term = trim(strtolower($original_term));
    
    if (strlen($term) < 2) {
        wp_send_json_success([]);
    }

    $prefix = 'WordPress34127_wp_';
    $posts_table = $prefix . 'posts';
    $postmeta_table = $prefix . 'postmeta';
    $terms_table = $prefix . 'terms';
    $term_taxonomy_table = $prefix . 'term_taxonomy';
    $term_relationships_table = $prefix . 'term_relationships';
    
    $like_term = '%' . $wpdb->esc_like($term) . '%';

    // LOAD DATABASE CITIES
    $path_json_countries_states = get_template_directory() . "/functions/php-countries/states.php";
    $array_countries_states = include $path_json_countries_states;
    $ciudades = array();
    foreach ($array_countries_states as $key_country => $array_states):
        if($key_country == "PE"): //only peru
            foreach ($array_states as $key_state => $state_name):
                $ciudades[$key_country . "@" . $key_state] = $state_name;
            endforeach;
        endif;
    endforeach;
    $cities_result = arrayLikeSearch($ciudades, '%'.$term.'%');
    
    $suggestions = [];

    // OPTION PRIMARIA: Búsqueda exacta/literal por palabra clave ingresada (Estilo Google)
    $suggestions[] = [
        'label' => $original_term,
        'tipo'  => 'Buscar término',
        'key'   => 'palabra_clave'
    ];

    // NUEVA CONSULTA: TAXONOMÍA "PUESTO"
    $puestos = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT t.name 
        FROM $terms_table t
        INNER JOIN $term_taxonomy_table tt ON t.term_id = tt.term_id
        INNER JOIN $term_relationships_table tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
        INNER JOIN $posts_table p ON tr.object_id = p.ID
        WHERE p.post_type = 'empleo' 
          AND p.post_status = 'publish'
          AND tt.taxonomy = 'puesto' 
          AND LOWER(t.name) LIKE %s
        LIMIT 5
    ", $like_term));

    foreach ($puestos as $puesto) {
        if (!empty(trim($puesto))) {
            $suggestions[] = ['label' => trim($puesto), 'tipo' => 'Puesto', 'key' => 'puesto'];
        }
    }

    foreach($cities_result as $city_key){
        $city_label = $ciudades[$city_key];
        if (!empty(trim($city_label))) {
            $suggestions[] = ['label' => trim($city_label), 'tipo' => 'Ciudad', 'key' => 'ciudad'];
        }
    }
    
    // CONSULTA B: DISTRITOS
    $distritos = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT pm.meta_value 
        FROM $postmeta_table pm
        INNER JOIN $posts_table p ON pm.post_id = p.ID
        WHERE p.post_type = 'empleo' AND p.post_status = 'publish'
          AND pm.meta_key = 'distrito' AND LOWER(pm.meta_value) LIKE %s
        LIMIT 5
    ", $like_term));
    foreach ($distritos as $distrito) {
        if (empty(trim($distrito))) continue;
        $suggestions[] = ['label' => trim($distrito), 'tipo' => 'Distrito', 'key' => 'distrito'];
    }

    // CONSULTA D: EMPRESAS (Texto plano en ACF)
    $empresas_texto = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT pm.meta_value 
        FROM $postmeta_table pm
        INNER JOIN $posts_table p ON pm.post_id = p.ID
        WHERE p.post_type = 'empleo' AND p.post_status = 'publish'
          AND pm.meta_key = 'nombre_de_la_empresa' AND LOWER(pm.meta_value) LIKE %s
        LIMIT 5
    ", $like_term));

    foreach ($empresas_texto as $empresa) {
        if (!empty(trim($empresa))) {
            $suggestions[] = ['label' => trim($empresa), 'tipo' => 'Empresa', 'key' => 'empresa'];
        }
    }

    // CONSULTA E: EMPRESAS (Relacionales - Post Object)
    $empresas_obj = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT p_emp.post_title
        FROM $postmeta_table pm
        INNER JOIN $posts_table p ON pm.post_id = p.ID
        INNER JOIN $posts_table p_emp ON pm.meta_value = p_emp.ID
        WHERE p.post_type = 'empleo' AND p.post_status = 'publish'
          AND pm.meta_key = 'empresa' AND p_emp.post_status = 'publish'
          AND LOWER(p_emp.post_title) LIKE %s
        LIMIT 5
    ", $like_term));

    foreach ($empresas_obj as $empresa) {
        if (!empty(trim($empresa))) {
            $suggestions[] = ['label' => trim($empresa), 'tipo' => 'Empresa', 'key' => 'empresa'];
        }
    }

    // Filtrar posibles registros duplicados manteniendo intacto el elemento 0 (Palabra clave)
    $resultado_final = [];
    $vistos = [];
    
    foreach ($suggestions as $index => $sug) {
        if ($index === 0) {
            $resultado_final[] = $sug; 
            continue;
        }
        $hash_identificador = $sug['key'] . '|' . strtolower($sug['label']);
        if (!in_array($hash_identificador, $vistos)) {
            $vistos[] = $hash_identificador;
            $resultado_final[] = $sug;
        }
    }

    wp_send_json_success($resultado_final);
}


/**
 * ENDPOINT 2: Procesador de Consultas Avanzadas y Paginación
 */
function filtrar_y_paginar_empleos_callback() {
    global $wpdb;

    $post_id = isset($_GET['post_id']) ? absint($_GET['post_id']) : 0;
    $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;    

    $ofertas_num = get_field("ofertas_num", $post_id);
    if (!is_numeric($ofertas_num) || intval($ofertas_num) < 1) {
        $ofertas_num = get_field("ofertas_num", "option");
    }
    if (!is_numeric($ofertas_num) || intval($ofertas_num) < 1) {
        $ofertas_num = get_field("num_ofertas_ol", $post_id);
    }
    if (!is_numeric($ofertas_num) || intval($ofertas_num) < 1) {
        $ofertas_num = get_field("num_ofertas_ol", "option");
    }
    $per_page = 35;
    if( is_numeric($ofertas_num) ):
        $per_page = $ofertas_num;
    endif;
    
    $offset = ($paged - 1) * $per_page;
    $filtros = isset($_GET['filtros']) ? $_GET['filtros'] : [];

    $prefix = 'WordPress34127_wp_';
    $posts_table = $prefix . 'posts';
    $postmeta_table = $prefix . 'postmeta';
    $terms_table = $prefix . 'terms';
    $term_taxonomy_table = $prefix . 'term_taxonomy';
    $term_relationships_table = $prefix . 'term_relationships';

    $where_clauses = ["p.post_type = 'empleo'", "p.post_status = 'publish'"];
    $join_clauses = [];
    $keyword_clauses = [];
    $join_counter = 0;

    if (!empty($filtros) && is_array($filtros)) {
        foreach ($filtros as $f) {
            $key = sanitize_text_field($f['key']);
            $value = sanitize_text_field($f['value']);
            $join_counter++;

            if ($key === 'palabra_clave') {
                $like_val = '%' . $wpdb->esc_like(strtolower($value)) . '%';

                $join_clauses[] = "
                    LEFT JOIN $postmeta_table m_global_tag_{$join_counter}
                    ON (
                        p.ID = m_global_tag_{$join_counter}.post_id
                        AND m_global_tag_{$join_counter}.meta_key = 'etiquetas'
                    )
                ";

                $join_clauses[] = "
                    LEFT JOIN $postmeta_table m_global_emp_{$join_counter}
                    ON (
                        p.ID = m_global_emp_{$join_counter}.post_id
                        AND m_global_emp_{$join_counter}.meta_key = 'nombre_de_la_empresa'
                    )
                ";

                $keyword_clauses[] = $wpdb->prepare(
                    "(LOWER(p.post_title) LIKE %s
                    OR LOWER(m_global_tag_{$join_counter}.meta_value) LIKE %s
                    OR LOWER(m_global_emp_{$join_counter}.meta_value) LIKE %s)",
                    $like_val,
                    $like_val,
                    $like_val
                );

            } elseif ($key === 'empresa') {
                $join_clauses[] = "LEFT JOIN $postmeta_table m_tx_{$join_counter} ON (p.ID = m_tx_{$join_counter}.post_id AND m_tx_{$join_counter}.meta_key = 'nombre_de_la_empresa')";
                $join_clauses[] = "LEFT JOIN $postmeta_table m_obj_{$join_counter} ON (p.ID = m_obj_{$join_counter}.post_id AND m_obj_{$join_counter}.meta_key = 'empresa')";
                $join_clauses[] = "LEFT JOIN $posts_table p_emp_{$join_counter} ON (m_obj_{$join_counter}.meta_value = p_emp_{$join_counter}.ID)";
                
                $where_clauses[] = $wpdb->prepare(
                    "(m_tx_{$join_counter}.meta_value = %s OR p_emp_{$join_counter}.post_title = %s)", 
                    $value, $value
                );
            } elseif ($key === 'ciudad') {
                $path_json_countries_states = get_template_directory() . "/functions/php-countries/states.php";
                $array_countries_states = include $path_json_countries_states;
                $ciudades = array();
                foreach ($array_countries_states as $key_country => $array_states):
                    if($key_country == "PE"): //only peru
                        foreach ($array_states as $key_state => $state_name):
                            $ciudades[$key_country . "@" . $key_state] = $state_name;
                        endforeach;
                    endif;
                endforeach;
                $city_key_filter = codeSearch($ciudades, $value);
                $join_clauses[] = "INNER JOIN $postmeta_table m_{$join_counter} ON (p.ID = m_{$join_counter}.post_id AND m_{$join_counter}.meta_key = '$key')";
                $where_clauses[] = $wpdb->prepare("m_{$join_counter}.meta_value = %s", $city_key_filter);
                
            } elseif ($key === 'puesto') {
                $join_clauses[] = "INNER JOIN $term_relationships_table tr_{$join_counter} ON (p.ID = tr_{$join_counter}.object_id)";
                $join_clauses[] = "INNER JOIN $term_taxonomy_table tt_{$join_counter} ON (tr_{$join_counter}.term_taxonomy_id = tt_{$join_counter}.term_taxonomy_id AND tt_{$join_counter}.taxonomy = 'puesto')";
                $join_clauses[] = "INNER JOIN $terms_table t_{$join_counter} ON (tt_{$join_counter}.term_id = t_{$join_counter}.term_id)";
                
                $where_clauses[] = $wpdb->prepare("t_{$join_counter}.name = %s", $value);

            } else {
                $join_clauses[] = "INNER JOIN $postmeta_table m_{$join_counter} ON (p.ID = m_{$join_counter}.post_id AND m_{$join_counter}.meta_key = '$key')";
                $where_clauses[] = $wpdb->prepare("m_{$join_counter}.meta_value = %s", $value);
            }
        }
    }

    $joins = implode(' ', $join_clauses);

    if (!empty($keyword_clauses)) {
        $where_clauses[] = '(' . implode(' OR ', $keyword_clauses) . ')';
    }

    $where = implode(' AND ', $where_clauses);

    $hay_busqueda = !empty($filtros) && is_array($filtros);

    $total_query = "SELECT COUNT(DISTINCT p.ID) FROM $posts_table p $joins WHERE $where";
    $total_posts = $wpdb->get_var($total_query);
    $total_pages = ceil($total_posts / $per_page);

    /*if ($hay_busqueda) {
        $select_destacado = "CASE WHEN m_destacado.meta_value = '1' THEN 1 ELSE 0 END as es_destacado";
        $order_by = "ORDER BY es_destacado DESC, peso_valor DESC, p.post_date DESC, STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d' ) ASC";
    } else {
        //$select_destacado = "0 as es_destacado";
        $select_destacado = "CASE WHEN m_destacado.meta_value = '1' THEN 1 ELSE 0 END as es_destacado";
        $order_by = "ORDER BY p.post_date DESC, STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d' ) ASC";
    }*/

    $select_destacado = "CASE WHEN m_destacado.meta_value = '1' THEN 1 ELSE 0 END as es_destacado";
    $order_by = "ORDER BY es_destacado DESC, peso_valor DESC, p.post_date DESC, STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d' ) ASC";

    $query = "
        SELECT DISTINCT
            p.ID, p.post_title as titulo_empleo,
            {$select_destacado},
            CAST(COALESCE(m_peso.meta_value, 0) AS SIGNED) as peso_valor,
            STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d')
        FROM $posts_table p
        $joins
        INNER JOIN $postmeta_table m_exp ON (m_exp.post_id = p.ID AND m_exp.meta_key = 'fecha_de_expiracion') AND STR_TO_DATE(m_exp.meta_value, '%%Y%%m%%d') >= CURDATE()
        LEFT JOIN $postmeta_table m_destacado ON (p.ID = m_destacado.post_id AND m_destacado.meta_key = 'destacado')
        LEFT JOIN $postmeta_table m_peso ON (p.ID = m_peso.post_id AND m_peso.meta_key = 'peso')
        WHERE $where
        {$order_by}
        LIMIT %d OFFSET %d
    ";

    $query = $wpdb->prepare($query, $per_page, $offset);
    $results = $wpdb->get_results($query);

    $empleos = [];
    if ($results) {
        foreach ($results as $row) {
            $sf_ID = $row->ID;
            $sf_titulo = $row->titulo_empleo;
            $sf_fecha = get_field('fecha_de_expiracion', $sf_ID);
            $sf_empresa = get_field('nombre_de_la_empresa', $sf_ID);
            $sf_ubicacion = get_field('distrito', $sf_ID);

            $empresa_logo = '';
            $empresa_ref = get_field('empresa', $sf_ID);
            $empresa_id = 0;

            if (is_object($empresa_ref) && !empty($empresa_ref->ID)) {
                $empresa_id = (int) $empresa_ref->ID;
            } elseif (is_array($empresa_ref)) {
                $first_empresa = reset($empresa_ref);
                if (is_object($first_empresa) && !empty($first_empresa->ID)) {
                    $empresa_id = (int) $first_empresa->ID;
                } else {
                    $empresa_id = (int) $first_empresa;
                }
            } else {
                $empresa_id = (int) $empresa_ref;
            }

            if ($empresa_id > 0) {
                $logotipo_array = get_field('logotipo', $empresa_id);
                if (is_array($logotipo_array)) {
                    if (!empty($logotipo_array['sizes']['medium'])) {
                        $empresa_logo = $logotipo_array['sizes']['medium'];
                    } elseif (!empty($logotipo_array['url'])) {
                        $empresa_logo = $logotipo_array['url'];
                    }
                }
            }

            $empleos[] = [
                'id'           => $sf_ID,
                'titulo'       => $sf_titulo,
                'fecha'        => $sf_fecha,
                'empresa'      => $sf_empresa,
                'ubicacion'    => $sf_ubicacion,
                'empresa_logo' => $empresa_logo,
                'url'          => get_permalink($sf_ID),
                'es_destacado' => (bool) $row->es_destacado,
                'fecha_pub'    => human_time_diff(get_the_time('U', $sf_ID), current_time('timestamp'))
            ];
        }
    }

    wp_send_json_success([
        'empleos'      => $empleos,
        'total_pages'  => $total_pages,
        'current_page' => $paged,
        //"query"        => $query //222
    ]);
}