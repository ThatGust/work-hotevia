<?php

add_filter('acf/update_value/name=fecha_de_expiracion', 'notificar_cambio_fecha_expiracion_hotevia', 10, 3);

function notificar_cambio_fecha_expiracion_hotevia($value, $post_id, $field) {
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return $value;
    }

    $old_value = get_post_meta($post_id, 'fecha_de_expiracion', true);

    if ($old_value !== $value && !empty($value)) {
        
        $post_title = get_the_title($post_id);
        $admin_email = get_option('admin_email');
        $extra_email = 'postulaciones@hotevia.info';
        
        $destinatarios = array($admin_email, $extra_email);
        $asunto = 'Alerta: Fecha de expiración modificada - ' . $post_title;
        
        $mensaje = "Hola,\n\n";
        $mensaje .= "Se ha detectado un cambio (reactivación/modificación) en la fecha de expiración de la siguiente oferta de empleo.\n\n";
        $mensaje .= "Oferta: " . $post_title . "\n";
        $mensaje .= "Fecha Anterior: " . ($old_value ? $old_value : 'No establecida') . "\n";
        $mensaje .= "Nueva Fecha: " . $value . "\n\n";
        $mensaje .= "Enlace a la oferta: " . get_permalink($post_id) . "\n";
        $mensaje .= "Editar oferta: " . get_edit_post_link($post_id) . "\n";

        $banner_email = get_field('banner_publicitario_email', 'option');
        if ( !empty($banner_email) ) {
            $mensaje .= "\n\n--------------------------------\n\n";
            $mensaje .= strip_tags($banner_email, '<a><img><br><p>'); 
        }

        $headers = array('Content-Type: text/plain; charset=UTF-8');

        wp_mail($destinatarios, $asunto, $mensaje, $headers);
    }

    return $value; 
}