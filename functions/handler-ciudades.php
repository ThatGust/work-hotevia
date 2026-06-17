<?php
add_filter('acf/load_field/name=nombre_ciudad', 'cargar_ciudades_dinamicamente');
function cargar_ciudades_dinamicamente( $field ) {
    $field['choices'] = array();
    global $wpdb;
    
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
    
    foreach( $ciudades_guardadas as $codigo_ciudad ) {
        if ( isset($nombres_reales[$codigo_ciudad]) ) {
            $field['choices'][ $codigo_ciudad ] = $nombres_reales[$codigo_ciudad]; 
        } else {
            $field['choices'][ $codigo_ciudad ] = $codigo_ciudad;
        }
    }
    
    return $field;
}