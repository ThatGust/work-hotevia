<?php
    /**
     * @package WordPress
     * @subpackage Default_Theme
     * Template Name: Ofertas Laborales v2
     */

    $page_id = get_the_ID();

    $html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
    $ofertas_num = get_field("ofertas_num", $page_id);
    $banners_de_columna = get_field("banners_de_columna", "option");
    $banners_de_contenido = get_field("banners_de_contenido", "option");
    $empresas_destacadas = get_field('empresas_seleccionadas', 'option'); //grilla
    $ciudades_destacadas = get_field('ciudades_seleccionadas_distritos', 'option'); //grilla
    $mostrar_banner_header = get_field('mostrar_banner_header', 'option');
    $contenido_banner_top = get_field('contenido_banner_top', 'option');
    $contenido_banner_bottom = get_field('contenido_banner_bottom', 'option');

    $base_url = get_bloginfo("url");
    $title_negocio = get_the_title($page_id);
    $permalink_ofertas_laborales = home_url('/ofertas-empleos/');

    //$show_additional_info = false;
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-ofertas-laborales" role="main">
    <div class="wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-ofertas-laborales">

                            <ol class="breadcrumbs">
                                <li><a href="<?php echo $base_url; ?>">Home</a></li>
                                <li><span><?php echo $title_negocio; ?></span></li>
                            </ol>


                            <?php
                                if (!empty($banners_de_contenido)):
                                    $first_banner_html = $banners_de_contenido[0]["html"] ?? '';
                                    if (!empty($first_banner_html)):
                            ?>
                                <section class="section-1"><div class="ad-long"><?php echo $first_banner_html; ?></div></section> 
                            <?php            
                                    endif;
                                endif;
                            ?>

                            <h1 class="job-title">
                                Ofertas de empleo hoteles y restaurantes Peru
                            </h1>

                            <section class="section-2">
                                <div class="google-style-search-container">
                                    <form role="search" method="get" action="<?php echo esc_url($permalink_ofertas_laborales); ?>">
                                        <div class="search-input-wrapper" id="searchWrapper">
                                            <div id="searchTags" class="search-tags-container"></div>
                                            <input type="text" name="s" id="autocompleteSearch" placeholder="Busca por empresa, ciudad, distrito o palabra..." autocomplete="off">                                    
                                            <div id="searchSpinner" class="search-spinner" style="display: none;"></div>
                                            <button type="submit" style="display:none;"></button>
                                        </div>
                                        <div id="autocompleteResults" class="autocomplete-suggestions-box" style="display:none;"></div>
                                    </form>
                                </div>
                            </section>

                            <section class="section-3">
                                <div class="logo-grid-container">
                                    <div class="wrap">
                                        <div class="container">
                                            <div class="logo-grid swiper"> 
                                                
                                                <div class="swiper-wrapper">
                                                    <?php 
                                                    if (!empty($empresas_destacadas)) :
                                                        foreach ($empresas_destacadas as $row) : 
                                                            
                                                            $empresa_obj = $row["empresa"];
                                                            $empresa_id = $empresa_obj->ID;
                                                            
                                                            $permalink = get_permalink($empresa_id);
                                                            $title = get_the_title($empresa_id);
                                                            
                                                            $logotipo_array = get_field('logotipo', $empresa_id);
                                                            $logo_url = '';
                                                            
                                                            if ($logotipo_array && is_array($logotipo_array)) {
                                                                $logo_url = isset($logotipo_array['sizes']['medium']) ? $logotipo_array['sizes']['medium'] : $logotipo_array['url'];
                                                            }
                                                            ?>
                                                            
                                                            <a href="<?php echo esc_url($permalink); ?>" class="logo-item swiper-slide" title="<?php echo esc_attr($title); ?>">
                                                                <?php if ($logo_url): ?>
                                                                    <img src="<?php echo esc_url($logo_url); ?>" alt="Logo de <?php echo esc_attr($title); ?>">
                                                                <?php else: ?>
                                                                    <span class="logo-text"><?php echo esc_html($title); ?></span>
                                                                <?php endif; ?>
                                                            </a>

                                                        <?php endforeach; 
                                                    endif;
                                                    ?>
                                                </div> </div> </div>
                                    </div>
                                </div>
                            </section>

                            <section class="section-4">
                                <?php if ($mostrar_banner_header && !empty($contenido_banner_top)): ?>
                                    <div class="ad-long ad-long-top">
                                        <?php echo wp_kses_post($contenido_banner_top); ?>
                                    </div>
                                <?php endif; ?>
                            </section>

                            <section class="section-5">
                                <div class="city-districts-grid-container">
                                    <div class="wrap">
                                        <div class="container">
                                            <div class="city-districts-grid">
                                                <?php if (!empty($ciudades_destacadas) && is_array($ciudades_destacadas)): ?>
                                                    <?php foreach ($ciudades_destacadas as $row): ?>
                                                        <?php
                                                            $ciudad_obj = $row["ciudad"];
                                                            $ciudad_id = is_object($ciudad_obj) ? $ciudad_obj->ID : intval($ciudad_obj);
                                                            if (!$ciudad_id) {
                                                                continue;
                                                            }

                                                            $ciudad_title     = get_the_title($ciudad_id);
                                                            $ciudad_permalink = get_permalink($ciudad_id);

                                                            $enlaces_manuales = !empty($row['enlaces']) ? $row['enlaces'] : array();
                                                        ?>
                                                        <div class="city-column">
                                                            <a href="<?php echo esc_url($ciudad_permalink); ?>" class="city-column-title"><?php echo esc_html('Empleos en ' . $ciudad_title); ?></a>
                                                            <?php if (!empty($enlaces_manuales)): ?>
                                                                <ul class="district-list">
                                                                    <?php foreach ($enlaces_manuales as $enlace): ?>
                                                                        <li>
                                                                            <a href="<?php echo esc_url($enlace['url']); ?>"><?php echo esc_html($enlace['nombre']); ?></a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="section-6">
                                <?php if ($mostrar_banner_header && !empty($contenido_banner_bottom)): ?>
                                    <div class="ad-long ad-long-bottom">
                                        <?php echo wp_kses_post($contenido_banner_bottom); ?>
                                    </div>
                                <?php endif; ?>
                            </section>

                            <section class="section-7">
                                <div id="lista-empleos-container">
                                    <div id="mainSpinner" class="main-spinner-wrapper" style="display: none;">
                                        <div class="loader-wheel"></div>
                                    </div>
                                    <div id="lista-empleos" class="empleos-grid job-listings"></div>
                                    <div id="paginacion-empleos" class="paginacion-container1 paginate-links"></div>
                                </div>
                            </section>
                            

                            <section class="section-8">
                                <?php if($html_pie_de_pagina): ?>
                                    <div class="footer-html">
                                        <?php
                                            echo $html_pie_de_pagina;
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </section>

                        </div>

                        <?php if ($banners_de_columna): ?>
                            <div class="col col-ad-place">
                                <?php foreach ($banners_de_columna as $o_item): ?>
                                    <?php
                                    $sf_html = $o_item["html"];
                                    if ($sf_html):
                                        ?>
                                        <div class="ad">
                                            <?php echo $sf_html; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>

<?php get_template_part('parts/page-ofertas-laborales-v2-js'); ?>