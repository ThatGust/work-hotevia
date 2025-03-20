<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 * Template Name: Ofertas Laborales
 */

$page_id = get_the_ID();

//Header
$f_s1_background = get_field("s1_background", $page_id);

//Sites
$f_s2_title = get_field("s2_title", $page_id);
?>
<?php get_header(); ?>

<main id="main-content" class="page wrapper page-ofertas-laborales" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-ofertas-laborales">

                            <div class="breadcrumbs">
                                Home > <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                            </div>

                            <h2 class="job-title">
                                Ofertas de empleo hoteles y restaurantes Peru
                            </h2>


                            <div class="filters">
                                <label for="filter-by">Filtrar por:</label>
                                <select id="filter-by-puesto">
                                    <option value="">Puesto</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="asistente-limpieza">Asistente de Limpieza</option>
                                    <option value="ejecutivo-cuentas">Ejecutivo de Cuentas</option>
                                    <option value="gerente-general">Gerente General</option>
                                    <option value="recepcionista">Recepcionista</option>
                                    <option value="supervisor">Supervisor</option>
                                </select>
                                <select id="filter-by-lugar">
                                    <option value="">Lugar</option>
                                </select>
                                <button class="filter-btn">Filtrar >></button>
                            </div>

                            <div class="job-listings">
                                <div class="job-item">
                                    <h2 class="job-title">RECEPCIONISTA - PARIWANA HOSTEL</h2>
                                    <p class="job-location">Miraflores - 15 marzo, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">SUPERVISOR DE MANTENIMIENTOs - SOUMA HOTEL LIMA A VIGNETTE
                                        COLLECTION</h2>
                                    <p class="job-location">Miraflores - 31 marzo, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">AUXILIAR DE AREAS PÚBLICAS - BEST WESTERN URBAN LARCO HOTEL
                                    </h2>
                                    <p class="job-location">Miraflores - 2 abril, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">RECEPCIONISTA - HOTEL BRITANIA MIRAFLORES</h2>
                                    <p class="job-location">Miraflores - 3 abril, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">SENIOR SALES MANAGER - HOTEL BRITANIA MIRAFLORES</h2>
                                    <p class="job-location">Miraflores - 3 abril, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">PERSONAL PARA HK - CUARTELEROS - JW MARRIOTT LIMA HOTEL</h2>
                                    <p class="job-location">Miraflores - 4 abril, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">CAMAREROS DE HOUSEKEEPING - HOTEL BRITANIA MIRAFLORES</h2>
                                    <p class="job-location">Miraflores - 5 abril, 2025</p>
                                </div>
                                <div class="job-item">
                                    <h2 class="job-title">RECEPCIONISTA - HOTEL BRITANIA MIRAFLORES</h2>
                                    <p class="job-location">Miraflores - 5 abril, 2025</p>
                                </div>
                            </div>

                            <div>
                                <?php
                                echo paginate_links(array(
                                    'base' => add_query_arg('pg', '%#%'),
                                    'format' => '?pg=%#%',
                                    'current' => $paged,
                                    'total' => $max_num_pages,
                                    'prev_text' => ('« Anterior'),
                                    'next_text' => ('Siguiente »'),
                                ));
                                ?>
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
    </section>
</main>


<?php get_footer(); ?>