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
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-ofertas-laborales" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-ofertas-laborales">

                            <ol class="breadcrumbs">
                                <li><a href="<?php echo $base_url; ?>">Home</a></li>
                                <li><span><?php echo $title_negocio; ?></span></li>
                            </ol>

                            <h2 class="job-title">
                                Ofertas de empleo hoteles y restaurantes Peru
                            </h2>

                            <?php
                                if (!empty($banners_de_contenido)) {
                                    $first_banner_html = $banners_de_contenido[0]["html"] ?? '';
                                    if (!empty($first_banner_html)) {
                                        echo '<div class="ad-long">' . $first_banner_html . '</div>';
                                    }
                                }
                            ?>

                            <div class="google-style-search-container">
                                <div class="search-input-wrapper" id="searchWrapper">
                                    <div id="searchTags" class="search-tags-container"></div>
                                    <input type="text" id="autocompleteSearch" placeholder="Busca por empresa, ciudad, distrito o palabra..." autocomplete="off">                                    
                                    <div id="searchSpinner" class="search-spinner" style="display: none;"></div>
                                </div>
                                <div id="autocompleteResults" class="autocomplete-suggestions-box" style="display:none;"></div>
                            </div>

                            <div id="lista-empleos-container">
                                <div id="mainSpinner" class="main-spinner-wrapper" style="display: none;">
                                    <div class="loader-wheel"></div>
                                </div>
                                <div id="lista-empleos" class="empleos-grid job-listings"></div>
                                <div id="paginacion-empleos" class="paginacion-container1 paginate-links"></div>
                            </div>

                            <div class="footer-html">
                              <?php
                                echo $html_pie_de_pagina;
                              ?>
                            </div>

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
    </section>
</main>
<?php get_footer(); ?>

<?php get_template_part('parts/page-ofertas-laborales-v2-js'); ?>