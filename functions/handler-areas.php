<?php
add_filter('acf/load_field/name=nombre_area', 'dinamizar_select_puestos');

function dinamizar_select_puestos( $field ) {
    $field['choices'] = array();

    $taxonomia = 'puesto'; 

    $terms = get_terms(array(
        'taxonomy'   => $taxonomia,
        'hide_empty' => false, // Muestra todos los puestos, incluso si aún no tienen empleos asignados
    ));

    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $field['choices'][$term->term_id] = $term->name;
        }
    }

    return $field;
}

add_filter('acf/load_field/name=ciudad_prioritaria', 'cargar_ciudades_bd_en_repetidor');

function cargar_ciudades_bd_en_repetidor( $field ) {
    $field['choices'] = array();
    global $wpdb;
    
    // 1. Consultamos a la BD solo las ciudades que tienen empleos publicados
    $ciudades_guardadas = $wpdb->get_col("
        SELECT DISTINCT meta_value 
        FROM {$wpdb->postmeta} pm
        JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = 'ciudad' 
        AND p.post_type = 'empleo' 
        AND p.post_status = 'publish'
        AND pm.meta_value != ''
        ORDER BY pm.meta_value ASC
    ");
    
    if( empty($ciudades_guardadas) ) return $field;

    // 2. Cargamos el diccionario de traducciones de códigos a nombres reales
    $path_states = get_template_directory() . "/functions/php-countries/states.php";
    $nombres_reales = array();
    
    if ( file_exists($path_states) ) {
        $array_countries_states = include $path_states;
        foreach ($array_countries_states as $key_country => $array_states) {
            foreach ($array_states as $key_state => $state_name) {
                $nombres_reales[$key_country . "@" . $key_state] = $state_name;
            }
        }
    }
    
    // 3. Llenamos las opciones del select en ACF
    foreach( $ciudades_guardadas as $codigo_ciudad ) {
        if ( isset($nombres_reales[$codigo_ciudad]) ) {
            // Muestra el nombre bonito, pero guarda el código (ej: PE@LIM)
            $field['choices'][ $codigo_ciudad ] = $nombres_reales[$codigo_ciudad]; 
        } else {
            // Fallback en caso de que el código no esté en el diccionario
            $field['choices'][ $codigo_ciudad ] = $codigo_ciudad;
        }
    }
    
    return $field;
}

add_filter('acf/prepare_field/name=ciudad_prioritaria', function($field) {
    $field['allow_custom'] = 1; 
    return $field;
});