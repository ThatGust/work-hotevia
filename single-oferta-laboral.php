<?php
    /**
     * @package WordPress
     * @subpackage Default_Theme
     * Template Name: Oferta Laboral
     */

   $page_id = get_the_ID();
    
   $empresa = get_field("empresa", $page_id);
   $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $page_id);
   $fecha_de_expiracion = get_field("fecha_de_expiracion", $page_id);
   $ubicacion_geografica = get_field("ubicacion_geografica", $page_id);
   $empr_trabaj = get_field("empr_trabaj", $page_id);
   $requisitos = get_field("requisitos", $page_id);
   $exp_conocimientos = get_field("exp_conocimientos", $page_id);
   $html_pie_de_pagina = get_field("html_pie_de_pagina", $page_id);
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-single-oferta-laboral" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="offer-details">
                    <div class="breadcrumbs">
                        Home > <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                    </div>

                    <h1 class="job-title">
                        <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                    </h1>

                    <div class="primary-offer-details">
                        <label class="label-details"><?php echo esc_html($nombre_de_la_empresa); ?></label>

                        <div class="label-details">
                            <label>Empresa:</label>
                            <p><?php echo esc_html($nombre_de_la_empresa); ?></p>
                        </div>

                        <div class="label-details">
                            <label>Fecha de Expiración:</label>
                            <p><?php echo esc_html($fecha_de_expiracion); ?></p>
                        </div>

                        <div class="label-details">
                            <label>Ubicación Geográfica:</label>
                            <p><?php echo esc_html($ubicacion_geografica); ?></p>
                        </div>

                        <div class="label-details">
                            <label>Empresa en la que se va a trabajar:</label>
                            <p><?php echo esc_html($empr_trabaj); ?></p>
                        </div>
                    </div>


                    <div class="requirements">
                        <h3>Requisitos</h3>
                        <div><?php echo wp_kses_post($requisitos); ?></div>

                        <h3>Comentarios</h3>
                        <div><?php echo wp_kses_post($exp_conocimientos); ?></div>
                    </div>

                    <div class="apply-form">
                        <h3>Postula a esta oferta aquí:</h3>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="label-details">
                                <label for="nombre">Nombres:</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>

                            <div class="label-details">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" required>
                            </div>

                            <div class="label-details">
                                <label for="telefono">Teléfono / Celular:</label>
                                <input type="tel" id="telefono" name="telefono" required>
                            </div>

                            <div class="label-details">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="label-details">
                                <label for="linkedin">LinkedIn:</label>
                                <input type="url" id="linkedin" name="linkedin">
                            </div>

                            <div class="label-details">
                                <label for="cv">Envía tu CV (Formatos admitidos: Word - PDF con un peso de hasta 2 MB):</label>
                                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
                            </div>

                            <div class="label-details">
                                <button type="button" class="upload-btn">Subir archivo</button>
                            </div>

                            <div class="label-details">
                                <label for="mensaje">Mensaje:</label>
                                <textarea id="mensaje" name="mensaje" rows="4"></textarea>
                            </div>

                            <div class="label-details">
                                <button type="submit">ENVIAR</button>
                            </div>
                        </form>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer-html">
        <div class="container">
            <?php echo wp_kses_post($html_pie_de_pagina); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
