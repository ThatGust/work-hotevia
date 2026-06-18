<?php
// Enganchamos el filtro al campo ACF llamado 'nombre_area'
add_filter('acf/load_field/name=nombre_area', 'cargar_areas_dinamicamente');

function cargar_areas_dinamicamente( $field ) {
    $field['choices'] = array();
    global $wpdb;
    
    $meta_key_buscar = 'distrito'; 

    // Consultamos la base de datos
    $areas_guardadas = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT meta_value 
        FROM {$wpdb->postmeta} pm
        JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = %s 
        AND p.post_type = 'empleo' 
        AND p.post_status = 'publish'
        AND pm.meta_value != ''
    ", $meta_key_buscar));
    
    // Si no hay áreas, retornamos el campo vacío
    if( empty($areas_guardadas) ) return $field;

    $opciones_procesadas = array();

    // Procesamos los resultados (ACF a veces guarda arrays serializados)
    foreach( $areas_guardadas as $area_bd ) {
        if ( is_serialized( $area_bd ) ) {
            $valores = maybe_unserialize( $area_bd );
            if ( is_array( $valores ) ) {
                foreach ( $valores as $val ) {
                    $opciones_procesadas[] = $val;
                }
            }
        } else {
            $opciones_procesadas[] = $area_bd;
        }
    }

    $opciones_procesadas = array_unique($opciones_procesadas);
    sort($opciones_procesadas);

    // Llenamos el select de ACF
    foreach( $opciones_procesadas as $area_valor ) {
        $area_limpia = trim($area_valor);
        if ( empty($area_limpia) ) continue;

        // Si el valor guardado es un ID numérico (Post Object), obtenemos el nombre real
        if ( is_numeric($area_limpia) ) {
            $titulo_real = get_the_title( $area_limpia );
            if ( $titulo_real ) {
                // Guardamos el ID como value, pero mostramos el Título visualmente
                $field['choices'][$area_limpia] = $titulo_real;
            }
        } else {
            // Si es texto normal directo
            $field['choices'][$area_limpia] = $area_limpia;
        }
    }
    
    return $field;
}