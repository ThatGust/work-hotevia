<?php

add_action('admin_footer', function() {
    global $post;
    
    if ( !isset($post) || $post->post_type !== 'empleo' ) {
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