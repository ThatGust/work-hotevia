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
        let wasSaving = false;

        const unsubscribe = wp.data.subscribe(function() {
            const editor = wp.data.select('core/editor');
            
            const isSaving = editor.isSavingPost();
            const isAutosaving = editor.isAutosavingPost();
            const didSaveSucceed = editor.didPostSaveRequestSucceed();

            // Detectamos la transición: antes estaba guardando y ahora ya no
            if (wasSaving && !isSaving && !isAutosaving && didSaveSucceed) {
                wasSaving = false;
                window.location.reload();
            }

            // Actualizamos el estado para la siguiente comprobación
            if (isSaving && !isAutosaving) {
                wasSaving = true;
            }
        });
    })();
    </script>
    <?php
});