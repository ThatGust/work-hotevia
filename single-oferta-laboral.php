<?php
   /**
    * @package WordPress
    * @subpackage Default_Theme
    */

   $post_id = get_the_ID();

   $empresa = get_field("empresa", $post_id);
   $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
   $fecha_de_expiracion = get_field("fecha_de_expiracion", $post_id);
   $ubicacion_geografica = get_field("ubicacion_geografica", $post_id);
   $empr_trabaj = get_field("empr_trabaj", $post_id);
   $requisitos = get_field("requisitos", $post_id);
   $exp_conocimientos = get_field("exp_conocimientos", $post_id);
   $html_pie_de_pagina = get_field("html_pie_de_pagina", $post_id);

   $banners_de_columna = get_field("banners_de_columna", "option");
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-single-oferta-laboral" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                     <div class="row">
                        <div class="col col-offer-details">
                           <div class="breadcrumbs">
                              Home > <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                           </div>

                           <h2 class="job-title">
                              <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                           </h2>

                           <div class="primary-offer-details">
                              <label class="label-details"><?php echo esc_html($nombre_de_la_empresa); ?></label>

                              <div class="label-details">
                                 <label>EMPRESA:</label>
                                 <p><?php echo esc_html($nombre_de_la_empresa); ?></p>
                              </div>

                              <div class="label-details">
                                 <label>FECHA DE EXPIRACIÓN:</label>
                                 <p><?php echo esc_html($fecha_de_expiracion); ?></p>
                              </div>

                              <div class="label-details">
                                 <label>UBICACIÓN GEOGRÁFICA:</label>
                                 <p><?php echo esc_html($ubicacion_geografica); ?></p>
                              </div>

                              <div class="label-details">
                                 <label>EMPRESA EN LA QUE SE VA A TRABAJAR:</label>
                                 <p><?php echo esc_html($empr_trabaj); ?></p>
                              </div>

                           </div>


                           <div class="requirements">
                              <h3>REQUISITOS</h3>
                              <div><?php echo wp_kses_post($requisitos); ?></div>

                              <h3>Experiencia y Conocimientos</h3>
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
                                       <label for="cv">Envía tu CV</label>

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
                        <?php
                           //var_dump($banners_de_columna);
                        ?>
                        <?php if($banners_de_columna): ?>
                           <div class="col col-ad-place">
                              <?php foreach($banners_de_columna as $o_item): ?>
                                 <?php
                                    $sf_html = $o_item["html"];
                                    if($sf_html):
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
    </section>

    <section class="footer-html">
        <div class="container">
            <?php 
               //echo wp_kses_post($html_pie_de_pagina); 
               echo $html_pie_de_pagina; 
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

