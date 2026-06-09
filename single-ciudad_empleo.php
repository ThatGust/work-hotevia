<?php
get_header(); 

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

        $page_id = get_the_ID();
        
        // 1. Obtener valores de la nueva estructura ACF
        $ciudad_value = get_field('ciudad_a_filtrar', $page_id);
        
        // Interruptores (Toggles)
        $b1_active = get_field('activar_bloque_1', $page_id);
        $b2_active = get_field('activar_bloque_2', $page_id);
        $b3_active = get_field('activar_bloque_3', $page_id);
        $b4_active = get_field('activar_bloque_4', $page_id);
        
        // Contenidos
        $b1_content = get_field('contenido_bloque_1', $page_id);
        $b3_posts   = get_field('empleos_destacados', $page_id);
        
        $banners_de_columna = get_field("banners_de_columna", "option");

        // 2. Limpieza de etiqueta de ciudad para el frontend
        $ciudad_label = $ciudad_value;
        if ( !empty($ciudad_label) && strpos($ciudad_label, '@') !== false ) {
            $partes = explode('@', $ciudad_label);
            $ciudad_label = end($partes); 
        }
        $ciudad_label = ucfirst(strtolower($ciudad_label));

        // 3. Consulta de BBDD con tu función a medida
        $job_count = 0;
        $rows_az = array();

        if ( !empty($ciudad_value) ) {
            $custom_field_array = array(
                array("meta_key" => "fecha_de_expiracion", "condition" => "AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()"),
                array("meta_key" => "ciudad", "condition" => "AND %meta_value% = '".$ciudad_value."' ")
            );

            $total_rows = 0;
            $rows_az = get_custom_posts(
                "empleo", false, false, $custom_field_array,
                array(0 => 'ORDER BY post_title ASC'), 
                1, 9999, $total_rows
            );
            $job_count = $total_rows;
        }

        // 4. Lógica estricta: ¿Hay algo que renderizar?
        $mostrar_b1 = ($b1_active && !empty($b1_content));
        $mostrar_b2 = ($b2_active && !empty($ciudad_value));
        $mostrar_b3 = ($b3_active && !empty($b3_posts) && is_array($b3_posts));
        $mostrar_b4 = ($b4_active && !empty($ciudad_value) && $job_count > 0);

        $hay_bloques_activos = $mostrar_b1 || $mostrar_b2 || $mostrar_b3 || $mostrar_b4;

        $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';

        // --- PANEL DE DIAGNÓSTICO (SOLO PARA ADMINS) ---
        if ( !$hay_bloques_activos && current_user_can('manage_options') ) {
            echo '<div style="background:#fff3cd; color:#856404; padding:20px; margin:20px; border:1px solid #ffeeba; border-radius:5px;">';
            echo '<strong>🛠️ PANEL DE DIAGNÓSTICO</strong><br><br>';
            echo 'Ningún bloque cumple las condiciones para mostrarse:<br><ul>';
            echo '<li><strong>Bloque 1 (Banner):</strong> ' . ($mostrar_b1 ? '✅ OK' : '❌ Apagado o Vacío') . '</li>';
            echo '<li><strong>Bloque 2 (Buscador):</strong> ' . ($mostrar_b2 ? '✅ OK' : '❌ Apagado o falta ciudad') . '</li>';
            echo '<li><strong>Bloque 3 (Destacados):</strong> ' . ($mostrar_b3 ? '✅ OK' : '❌ Apagado o sin empleos seleccionados') . '</li>';
            echo '<li><strong>Bloque 4 (Listado A-Z):</strong> ' . ($mostrar_b4 ? '✅ OK' : '❌ Apagado, falta ciudad o el <b>Contador dio 0</b>') . '</li>';
            echo '</ul>';
            echo '<em>Valor actual de ciudad en BBDD:</em> <b>' . (empty($ciudad_value) ? 'NADA' : $ciudad_value) . '</b><br>';
            echo '<em>Ofertas encontradas con esa ciudad:</em> <b>' . $job_count . '</b>';
            echo '</div>';
        }
        // ------------------------------------------------

        if( $hay_bloques_activos ):
        ?>
        <main id="main-content" class="page wrapper page-ofertas-laborales page-ciudad-empleos" role="main">
            <section class="section1 wrapper">
                <div class="container">
                    <div class="wrapper inner-container">
                        <div class="wrap-info"> 
                            <div class="row"> 
                                
                                <div class="col col-ofertas-laborales">
                                    <h1 class="job-title"><?php the_title(); ?></h1>

                                    <?php if( $mostrar_b1 ): ?>
                                        <div class="bloque-banner-header ad-long" style="margin-bottom: 30px;">
                                            <?php echo $b1_content; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $mostrar_b2 ): ?>
                                        <div class="search-bar" style="margin-bottom: 30px;">
                                            <form id="form-buscador-ciudad" method="GET" action="<?php echo get_bloginfo('url'); ?>/ofertas-laborales/">
                                                <div class="search-bar-inside">
                                                    <input name="se" type="text" class="search-input" placeholder="Buscar empleo en <?php echo esc_attr($ciudad_label); ?>...">
                                                    <button class="search-button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="white"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                                    </button>
                                                </div>
                                            </form>
                                            <p class="contador-ofertas" style="margin-top: 15px; font-weight: bold; color: #555;">
                                                Hay <?php echo $job_count; ?> ofertas de empleos disponibles en <?php echo esc_html(strtoupper($ciudad_label)); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $mostrar_b3 ): ?>
                                        <div class="bloque-destacados" style="margin-bottom: 40px;">
                                            <h3 style="margin-bottom: 15px;">Puestos Destacados</h3>
                                            <div class="job-listings">
                                                <?php 
                                                foreach( $b3_posts as $destacado ): 
                                                    $p_id = is_numeric($destacado) ? $destacado : (is_object($destacado) ? $destacado->ID : false);
                                                    if( $p_id ):
                                                ?>
                                                    <div class="wrap-item destacado-item" style="border-left: 4px solid #f39c12;">
                                                        <a href="<?php echo esc_url(get_permalink($p_id)); ?>" class="job-item">
                                                            <span class="icon"><?php echo $svg_icon; ?></span>
                                                            <span class="job-title-list"><?php echo esc_html(get_the_title($p_id)); ?></span>
                                                            <span class="job-separator"> - </span>
                                                            <span class="job-location"><?php echo esc_html(get_field('nombre_de_la_empresa', $p_id)); ?> /</span>
                                                            <span class="job-info"><?php echo esc_html(get_field('distrito', $p_id)); ?> - <?php echo esc_html(get_field('fecha_de_expiracion', $p_id)); ?></span>
                                                        </a>
                                                    </div>
                                                <?php 
                                                    endif;
                                                endforeach; 
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $mostrar_b4 ): ?>
                                        <div class="bloque-listado-az">
                                            <h3 style="margin-bottom: 15px;">Todas las ofertas en <?php echo esc_html($ciudad_label); ?></h3>
                                            <div class="job-listings">
                                                <?php foreach ($rows_az as $o_row): $sf_ID = $o_row->ID; ?>
                                                    <div class="wrap-item">
                                                        <a href="<?php echo esc_url(get_permalink($sf_ID)); ?>" class="job-item">
                                                            <span class="icon"><?php echo $svg_icon; ?></span>
                                                            <span class="job-title-list"><?php echo esc_html($o_row->post_title); ?></span>
                                                            <span class="job-separator"> - </span>
                                                            <span class="job-location"><?php echo esc_html(get_field('nombre_de_la_empresa', $sf_ID)); ?> /</span>
                                                            <span class="job-info"><?php echo esc_html(get_field('distrito', $sf_ID)); ?> - <?php echo esc_html(get_field('fecha_de_expiracion', $sf_ID)); ?></span>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="col col-ad-place">
                                    <?php if ($banners_de_columna): foreach ($banners_de_columna as $o_item): if ($o_item["html"]): ?>
                                        <div class="ad"><?php echo $o_item["html"]; ?></div>
                                    <?php endif; endforeach; endif; ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php endif; 

    endwhile;
endif;
get_footer(); 
?>