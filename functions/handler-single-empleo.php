<?php

//refresh browser in save in backend
add_action('admin_footer', function() {
    global $post;
    
    if ( !isset($post) || $post->post_type !== 'empleo' ) {
        return;
    }

    ?>
    <script>
        (function() {
            // Usamos wp.domReady para asegurar que el DOM y los scripts de WP estén cargados
            wp.domReady(function() {
                let wasSaving = false;

                const unsubscribe = wp.data.subscribe(function() {
                    const editor = wp.data.select('core/editor');

                    // Verificamos que el selector 'core/editor' exista antes de usarlo
                    if (!editor) {
                        return;
                    }

                    const isSaving = editor.isSavingPost();
                    const isAutosaving = editor.isAutosavingPost();
                    const didSaveSucceed = editor.didPostSaveRequestSucceed();

                    // Detectamos la transición: antes estaba guardando y ahora ya no
                    if (wasSaving && !isSaving && !isAutosaving && didSaveSucceed) {
                        wasSaving = false;
                        // Unsubscribe para evitar bucles o múltiples recargas
                        unsubscribe(); 
                        window.location.reload();
                    }

                    // Actualizamos el estado para la siguiente comprobación
                    if (isSaving && !isAutosaving) {
                        wasSaving = true;
                    }
                });
            });
        })();
    </script>
    <?php
});