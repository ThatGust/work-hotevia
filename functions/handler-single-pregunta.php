<?php 


    /**
     * Ajustes para el CPT 'Pregunta' - Solo Backend y sin Editor
     */
    add_action('init', function() {
        // 1. Deshabilitar el editor y la imagen destacada al registrar o modificar el CPT
        // Cambia 'pregunta' por el slug exacto de tu CPT
        remove_post_type_support('pregunta', 'editor');
        remove_post_type_support('pregunta', 'thumbnail');
    }, 11);

    add_filter('register_post_type_args', function($args, $post_type) {
        if ($post_type === 'pregunta') {
            // 2. Hacer que no sea accesible desde el frontend (evita URLs individuales)
            $args['public']             = false;
            $args['show_ui']            = true; // Mantiene el menú en el panel de admin
            $args['publicly_queryable'] = false;
            $args['exclude_from_search'] = true;
            $args['has_archive']        = false;
            $args['rewrite']            = false;
        }
        return $args;
    }, 10, 2);

    // 3. Opcional: Ocultar el botón "Ver Pregunta" en la administración
    add_filter('post_row_actions', function($actions, $post) {
        if ($post->post_type === 'pregunta') {
            unset($actions['view']);
        }
        return $actions;
    }, 10, 2);

    
    //Preguntas Personalizadas (Admin)
    add_filter('acf/prepare_field/key=field_69fc1f3055d65', function($field) {
        global $post;
        if (!$post || $post->post_type !== 'empleo') {
            return $field;
        }
        if (!current_user_can('administrator')):
            return false; 
        endif;
        return $field;
    });

    //Preguntas Personalizadas
    add_filter('acf/prepare_field', function($field) {
        global $post;
        if (!$post || $post->post_type !== 'empleo') {
            return $field;
        }
        
        $keys_objetivo = ['field_69fc35ac586f3', 'field_69fc35c1586f4'];

        // Si el campo actual no está en nuestra lista, lo devolvemos tal cual
        if ( !in_array($field['key'], $keys_objetivo) ):
            return $field;
        endif;

        global $post;
        if (!$post) return $field;

        $fields_preguntas = get_field('preguntas', $post->ID);

        if ( !$fields_preguntas || count($fields_preguntas) === 0 ):
            return false;
        endif;

        return $field;
    });

    
    add_filter('acf/load_field/name=pregunta_txt', function($field) {
        global $post;
        if (!$post || $post->post_type !== 'empleo') {
            return $field;
        }

        $post_id = $post->ID;
        $fields_preguntas = get_field('preguntas', $post_id);
        if($fields_preguntas):
            $field['choices'] = [];
            foreach ($fields_preguntas as $row):
              $post_pregunta = $row["pregunta"];
              $post_pregunta_id = $post_pregunta->ID;
              $field['choices'][$post_pregunta_id] = strip_tags(get_field("pregunta", $post_pregunta_id));
            endforeach;
        else:
            return false;
        endif;

        return $field;
    });
