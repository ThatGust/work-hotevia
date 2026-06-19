<?php

add_action('admin_footer', function() {
    global $post;

    if (!isset($post) || $post->post_type !== 'empleo') {
        return;
    }
    ?>
    <script>
        (function() {
            wp.domReady(function() {
                let wasSaving = false;

                const unsubscribe = wp.data.subscribe(function() {
                    const editor = wp.data.select('core/editor');

                    if (!editor) {
                        return;
                    }

                    const isSaving = editor.isSavingPost();
                    const isAutosaving = editor.isAutosavingPost();
                    const didSaveSucceed = editor.didPostSaveRequestSucceed();

                    if (wasSaving && !isSaving && !isAutosaving && didSaveSucceed) {
                        wasSaving = false;
                        unsubscribe();
                        window.location.reload();
                    }

                    if (isSaving && !isAutosaving) {
                        wasSaving = true;
                    }
                });
            });
        })();
    </script>
    <?php
});

if (!function_exists('ocultar_campos_relevancia_para_no_admin')) {
    function ocultar_campos_relevancia_para_no_admin($field) {
        global $post;

        if (!$post || $post->post_type !== 'empleo') {
            return $field;
        }

        if (!current_user_can('administrator')) {
            return false;
        }

        return $field;
    }
}


add_filter('acf/prepare_field/key=field_6a27a81a97dc8', 'ocultar_campos_relevancia_para_no_admin');
add_filter('acf/prepare_field/key=field_6a27a79843547', 'ocultar_campos_relevancia_para_no_admin');
add_filter('acf/prepare_field/key=field_6a27a7ba43548', 'ocultar_campos_relevancia_para_no_admin');

add_filter('acf/load_field/name=distrito', 'cargar_distritos_dinamicamente');

function cargar_distritos_dinamicamente($field) {
    $field['choices'] = array();
    global $wpdb;

    $distritos_guardados = $wpdb->get_col("\n        SELECT DISTINCT pm.meta_value\n        FROM {$wpdb->postmeta} pm\n        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id\n        WHERE pm.meta_key = 'distrito'\n        AND p.post_type = 'empleo'\n        AND p.post_status = 'publish'\n        AND pm.meta_value != ''\n        ORDER BY pm.meta_value ASC\n    ");

    if (empty($distritos_guardados)) {
        return $field;
    }

    foreach ($distritos_guardados as $distrito) {
        $distrito = trim((string) $distrito);
        if ($distrito === '') {
            continue;
        }

        $field['choices'][$distrito] = $distrito;
    }

    return $field;
}