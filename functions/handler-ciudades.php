<?php
add_filter('acf/fields/relationship/result/name=bloque_3_destacados', 'mejorar_vista_destacados_acf', 10, 4);
function mejorar_vista_destacados_acf( $text, $post, $field, $post_id ) {
    $ciudad = get_post_meta($post->ID, 'ciudad', true);
    $empresa = get_post_meta($post->ID, 'nombre_de_la_empresa', true);
    
    if ( strpos($ciudad, '@') !== false ) {
        $partes = explode('@', $ciudad);
        $ciudad = ucfirst(end($partes));
    }
    
    if( !empty($ciudad) || !empty($empresa) ) {
        $text .= ' <span style="color:#888; font-size:12px; font-weight:normal;"> - (Ciudad: ' . $ciudad . ' | Empresa: ' . $empresa . ')</span>';
    }
    return $text;
}