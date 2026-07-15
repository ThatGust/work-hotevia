<?php
    function get_html_list_empleo($empleo_id){
        $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
        $title = get_the_title($empleo_id);
        $permalink = get_permalink($empleo_id);
        $destacado = get_field("destacado", $empleo_id); 
        $empresa = get_field("empresa", $empleo_id, false, false);
        $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $empleo_id);
        $fecha_de_expiracion = get_field("fecha_de_expiracion", $empleo_id);
        $empr_trabaj = get_field("empr_trabaj", $empleo_id);
        $pais = get_field("pais", $empleo_id);
        $codigo_ciudad_raw = get_field("ciudad", $empleo_id);
        $distrito = get_field("distrito", $empleo_id);
        $direccion = get_field("direccion", $empleo_id);

        $ubicacion = false;
        if (strpos($codigo_ciudad_raw, '@') !== false) {
            $path_states = get_template_directory() . "/functions/php-countries/states.php";
            if (file_exists($path_states)) {
                $array_states = include $path_states;
                $parts = explode("@", $codigo_ciudad_raw);
                if (isset($array_states[$parts[0]][$parts[1]])) {
                    $ubicacion = $array_states[$parts[0]][$parts[1]];
                }
            }
        }

        
        $empresa_id = false;
        $empresa_logo = false;
        if( is_object($empresa)):
            $empresa_id = $empresa->ID;
        else:
            $empresa_id = (int)$empresa;     
        endif;

        $empresa_nombre = get_the_title($empresa_id);
        /*
        echo "<pre>";
        var_dump(array("empleo_id"=>$empleo_id, "empresa_id"=>$empresa_id, "empresa"=>$empresa));
        echo "</pre>";
        */

        if($empresa_id):
            $logotipo = get_field('logotipo', $empresa_id);
            if($logotipo):
               $empresa_logo = $logotipo['url'];
            endif;
        endif;

        $title = esc_html($title);
        $empresa = esc_html($empresa);
        $ciudad = esc_html($ciudad);
        $permalink = esc_url($permalink);

        $fecha_publicacion = "Hace ".human_time_diff(get_the_time('U', $empleo_id), current_time('timestamp')) . ' atrás';

        $html_empresa = '';
        if($empresa):
            $html_empresa = '<span class="job-location">'.$empresa.' /</span>';
        endif;

        $html_ubicacion_fecha = '';
        if ($ubicacion || $fecha_de_expiracion):
            $html_ubicacion_fecha = '<span class="job-info">'.$ubicacion.' - '.$fecha_de_expiracion.'</span>';
        endif;

        $html = '';
        if( $destacado ):
            $html = '
                <div class="card-destacado post-'.$empleo_id.'">
                    <a href="'.$permalink.'">
                        <div class="card-destacado-content">
                            <div class="card-destacado-main">
                                <div class="card-destacado-header">
                                    <span class="etiqueta-gold">Empleo destacado</span>
                                </div>
                                <h3 class="card-destacado-title">'.$title.'</h3>
                                <p class="card-destacado-empresa">'.$empresa_nombre.'</p>
                                <p class="card-destacado-ubicacion">'.$ubicacion.'</p>
                                <p class="card-destacado-expira">Expira el '.$fecha_de_expiracion.'</p>
                            </div>
                            <div class="card-destacado-logo">
                                <img src="'.$empresa_logo.'" alt="Logo de '.$empresa_nombre.'">
                            </div>
                        </div>
                    </a>
                </div>';
        else:
            $html = '
                <div class="wrap-item">
                    <a href="'.$permalink.'" class="job-item">
                        <span class="icon">'.$svg_icon.'</span>
                        <span class="job-title-list">'.$title.'</span>
                        <span class="job-separator"> - </span>
                        '.$html_empresa.'
                        '.$html_ubicacion_fecha.'
                    </a>
                </div>';
        endif;

        return $html;
    }