<?php
   /**
    * @package WordPress
    * @subpackage Default_Theme
    */

   if( isset($_POST["form-oferta-laboral"]) ):
      if( $_POST["form-oferta-laboral"] == "1" ):
         $sf_nombre = $_POST["nombre"];
         $sf_apellidos = $_POST["apellidos"];
         $sf_telefono = $_POST["telefono"];
         $sf_email = $_POST["email"];
         $sf_linkedin = $_POST["linkedin"];
         $sf_mensaje = $_POST["mensaje"];
         $sf_cv = $_POST["cv"];

         $sf_title = get_the_title();
         $sf_permalink = get_the_permalink();


         $general_form_senders_name = get_field("location_form_senders_name", "option");
         $general_form_senders_email = get_field("location_form_senders_email", "option");
         $general_form_subject = get_field("location_form_subject", "option");
         $general_form_message = get_field("location_form_message", "option". false);
         $general_form_subject_client = get_field("location_form_subject_client", "option");
         $general_form_message_client = get_field("location_form_message_client", "option");


         $email_from = $general_form_senders_name." <".$general_form_senders_email.">";


         $headers = "MIME-Version: 1.0"."\r\n";
         $headers .= "Content-type: text/html;charset=utf-8"."\r\n";
         $headers .= "Return-Path: ". $email_from . "\r\n";
         $headers .= "Reply-To: ". $email_from. "\r\n";
         $headers .= "Errors-To: ".$email_from."\r\n";
         $headers .= "From: ". $email_from . "\r\n";

         $email_message = "<!DOCTYPE html><html><head><title>Oferta Laboral</title></head><body>";
         $email_message .= "<strong>Oferta laboral: </strong>".$sf_title."<br />";
         $email_message .= "<strong>Nombre: </strong>".$sf_nombre."<br />";
         $email_message .= "<strong>Apellidos: </strong>".$sf_apellidos."<br />";
         $email_message .= "<strong>Teléfono: </strong>".$sf_telefono."<br />";
         $email_message .= "<strong>Email: </strong>".$sf_email."<br />";
         $email_message .= "<strong>LinkedIn: </strong>".$sf_linkedin."<br />";
         $email_message .= "<strong>Mensaje: </strong>".$sf_mensaje."<br />";
         $email_message .= "<strong>Enviado desde: </strong> <a target='_blank' href='".$sf_permalink."'> ".$sf_permalink." <br />";


         $additional = Array();

         // Client mail
         $email_to = $f_email;
         $email_subject = $general_form_subject_client;
         $email_message = $general_form_message_client;
         $flag = wp_mail($email_to, $email_subject, $email_message, $headers, $additional);

      endif;
   endif;


   $post_id = get_the_ID();

   $empresa = get_field("empresa", $post_id);
   $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
   $fecha_de_expiracion = get_field("fecha_de_expiracion", $post_id);
   $ubicacion_geografica = get_field("ubicacion_geografica", $post_id);
   $empr_trabaj = get_field("empr_trabaj", $post_id);
   $requisitos = get_field("requisitos", $post_id);
   $exp_conocimientos = get_field("exp_conocimientos", $post_id);
   $html_pie_de_pagina = get_field("html_pie_de_pagina", $post_id);

   //var_dump($html_pie_de_pagina); die();

   $banners_de_columna = get_field("banners_de_columna", "option");
   $botones_compartir = get_field("botones_compartir", "option");
   
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
                              <form action="" method="post" enctype="multipart/form-data">
                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="nombre">Nombres:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="text" id="nombre" name="nombre" required>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="apellidos">Apellidos:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="text" id="apellidos" name="apellidos" required>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="telefono">Teléfono / Celular:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="tel" id="telefono" name="telefono" required>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="email">Email:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="email" id="email" name="email" required>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="linkedin">LinkedIn:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="url" id="linkedin" name="linkedin">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="cv">Envía tu CV</label>
                                          <span class="notice desktop">(Formatos admitidos:</span>
                                       </div>
                                       <div class="custom-col-2">
                                          <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
                                       </div>
                                       <div class="custom-col-3">
                                          <span class="notice desktop">Word - PDF con un peso de hasta 2 MB)</span>
                                          <span class="notice mobile">(Formatos admitidos: Word - PDF con un peso de hasta 2 MB)</span>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <button type="button" class="upload-btn">Subir archivo</button>
                                 </div>

                                 <div class="label-details">
                                    <div class="row">
                                       <div class="custom-col-1">
                                          <label for="mensaje">Mensaje:</label>
                                       </div>
                                       <div class="custom-col-2">
                                          <textarea id="mensaje" name="mensaje" rows="4"></textarea>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <button type="submit">ENVIAR</button>
                                    <input type="hidden" name="form-oferta-laboral" value="1">
                                 </div>
                              </form>
                           </div>

                           <?php if($botones_compartir): ?>
                              <div class="share-buttons">
                                 <?php  echo $botones_compartir; ?>
                              </div>
                           <?php endif; ?>

                           <?php if($html_pie_de_pagina): ?>
                              <div class="footer-html">
                                 <?php  echo $html_pie_de_pagina;  ?>
                              </div>
                           <?php endif; ?>
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
</main>

<script>
   function validateFile() {
      const fileInput = document.getElementById("fileInput");
      const errorMsg = document.getElementById("errorMsg");
      
      if (fileInput.files.length === 0) {
         errorMsg.textContent = "Por favor, selecciona un archivo.";
         return false;
      }
      
      const file = fileInput.files[0];
      const allowedExtensions = ["doc", "docx", "pdf"];
      const maxSize = 2 * 1024 * 1024; // 2MB

      const fileExtension = file.name.split(".").pop().toLowerCase();

      if (!allowedExtensions.includes(fileExtension)) {
         errorMsg.textContent = "Solo se permiten archivos .doc, .docx y .pdf.";
         return false;
      }

      if (file.size > maxSize) {
         errorMsg.textContent = "El archivo no debe superar los 2MB.";
         return false;
      }

      errorMsg.textContent = "Archivo válido.";
      return true;
   }
</script>

<?php get_footer(); ?>

