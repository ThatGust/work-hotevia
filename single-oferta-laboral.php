<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

$post_id = get_the_ID();
$empresa = get_field("empresa", $post_id);
$empresa_id = $empresa;
if (is_object($empresa)):
   $empresa_id = $empresa->ID;
endif;

$base_url = get_bloginfo("url");
$title_negocio = get_the_title($empresa_id);
$permalink_negocio = get_permalink($empresa_id);
$title_oferta = get_the_title($post_id);
$permalink_oferta = get_the_permalink();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["form-oferta-laboral"]) && $empresa):
   if ($_POST["form-oferta-laboral"] == "1"):
      $code_response = "0";

      $sf_nombre = $_POST["nombre"];
      $sf_apellidos = $_POST["apellidos"];
      $sf_telefono = $_POST["telefono"];
      $sf_email = $_POST["email"];
      $sf_linkedin = $_POST["linkedin"];
      $sf_mensaje = $_POST["mensaje"];
      //$sf_cv = $_FILES["cv"];

      $f_form_emails_destinatarios = get_field("form_emails_destinatarios", $empresa_id);
      $f_form_nombre_remitente = get_field("form_nombre_remitente", $empresa_id);
      $f_form_email_remitente = get_field("form_email_remitente", $empresa_id);
      $f_form_asunto = get_field("form_asunto", $empresa_id);
      $f_form_mensaje = get_field("form_mensaje", $empresa_id);

      if ($f_form_nombre_remitente && $f_form_email_remitente && $f_form_asunto && $f_form_mensaje):

         $email_from = $f_form_nombre_remitente . " <" . $f_form_email_remitente . ">";
         $email_subject = $f_form_asunto;

         $headers = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type: text/html;charset=utf-8" . "\r\n";
         $headers .= "Return-Path: " . $email_from . "\r\n";
         $headers .= "Reply-To: " . $email_from . "\r\n";
         $headers .= "Errors-To: " . $email_from . "\r\n";
         $headers .= "From: " . $email_from . "\r\n";

         $email_message = "<!DOCTYPE html><html><head><title>Oferta Laboral</title></head><body>";
         $email_message .= $f_form_mensaje;
         $email_message .= "<strong>Oferta laboral: </strong>" . $title_oferta . "<br />";
         $email_message .= "<strong>Nombre: </strong>" . $sf_nombre . "<br />";
         $email_message .= "<strong>Apellidos: </strong>" . $sf_apellidos . "<br />";
         $email_message .= "<strong>Teléfono: </strong>" . $sf_telefono . "<br />";
         $email_message .= "<strong>Email: </strong>" . $sf_email . "<br />";
         $email_message .= "<strong>LinkedIn: </strong>" . $sf_linkedin . "<br />";
         $email_message .= "<strong>Mensaje: </strong>" . $sf_mensaje . "<br />";
         $email_message .= "<strong>Enviado desde: </strong> <a target='_blank' href='" . $permalink_oferta . "'> " . $permalink_oferta . " <br />";

         $attachments = array();
         $upload_path = false;
         if (isset($_FILES['cv'])):
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['path'] . '/' . basename($_FILES['cv']['name']);
            if (move_uploaded_file($_FILES['cv']['tmp_name'], $upload_path)):
               $attachments = array($upload_path);
            else:
               //echo 'Error al subir el archivo.';
            endif;
         endif;

         //correos destinatarios
         if ($f_form_emails_destinatarios):
            $flag_send = false;
            foreach ($f_form_emails_destinatarios as $o_item):
               $sf_nombre = $o_item["nombre"];
               $sf_email = $o_item["email"];
               if ($sf_nombre && $sf_email):
                  $email_to = $sf_nombre . " <" . $sf_email . ">";
                  $flag_send = wp_mail($email_to, $email_subject, $email_message, $headers, $attachments);
               endif;
            endforeach;

            //falta copia al administrador
            $admin_email = get_option('admin_email');
            if (is_email($admin_email)):
               $flag_send = wp_mail($admin_email, $email_subject, $email_message, $headers, $attachments);
            endif;

            //falta correo al postulante
            if (is_email($sf_email)):
               $flag_send = wp_mail($sf_email, $email_subject, $email_message, $headers, $attachments);
            endif;


            if ($flag_send):
               $code_response = "1";
            else:
               $code_response = "0";
            endif;
         endif;

         if ($upload_path):
            unlink($upload_path);
         endif;
      else:
         $code_response = "2";

      endif;
      $redirect_url = $sf_permalink . "?success=" . $code_response;
      wp_redirect($redirect_url);
      exit;
   endif;
endif;

$nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
$fecha_de_expiracion = get_field("fecha_de_expiracion", $post_id);
$ubicacion_geografica = get_field("distrito", $post_id);
$empr_trabaj = get_field("empr_trabaj", $post_id);
$requisitos = get_field("requisitos", $post_id);
$exp_conocimientos = get_field("exp_conocimientos", $post_id);
$html_pie_de_pagina = get_field("html_pie_de_pagina", $post_id);

//var_dump($html_pie_de_pagina); die();

$banners_de_columna = get_field("banners_de_columna", "option");
$botones_compartir = get_field("botones_compartir", "option");

$mostrar_boton = get_field("mostrar_boton", $post_id);
$texto_boton = get_field("texto_boton", $post_id);
$url_boton = get_field("url_boton", $post_id);

$form_msg = false;
if (isset($_GET["success"])):
   if ($_GET["success"] == "0"):
      $form_msg = '<div style="color:#FF6B6B;line-height:1.4em;">Ocurrió un error. Por favor, inténtelo de nuevo más tarde.</div>';
   elseif ($_GET["success"] == "1"):
      $form_msg = '<div style="color:#28a745;line-height:1.4em;">Tu mensaje ha sido enviado con éxito.</div>';
   elseif ($_GET["success"] == "2"):
      $form_msg = '<div style="color:#FF6B6B;line-height:1.4em;">La empresa no ha configurado los datos de envío. Por favor, espere o contacte al administrador.</div>';
   endif;
endif;
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-single-oferta-laboral" role="main">
   <section class="section1 wrapper">
      <div class="container">
         <div class="wrapper inner-container">
            <div class="wrap-info">
               <div class="row">
                  <div class="col col-offer-details">

                     <ol class="breadcrumbs">
                        <li><a href="<?php echo $base_url; ?>">Home</a></li>
                        <li><a href="<?php echo $permalink_negocio; ?>"><?php echo $title_negocio; ?></a></li>
                        <li><span><?php echo $title_oferta; ?></span></li>
                     </ol>

                     <h1 class="job-title"> <?php echo $nombre_de_la_empresa; ?> </h1>

                     <div class="primary-offer-details">
                        <label class="label-details"><?php echo $nombre_de_la_empresa; ?></label>

                        <div class="label-details">
                           <label>EMPRESA:</label>
                           <p><?php echo $nombre_de_la_empresa; ?></p>
                        </div>

                        <div class="label-details">
                           <label>FECHA DE EXPIRACIÓN:</label>
                           <p><?php echo $fecha_de_expiracion; ?></p>
                        </div>

                        <div class="label-details">
                           <label>UBICACIÓN GEOGRÁFICA:</label>
                           <p><?php echo $ubicacion_geografica; ?></p>
                        </div>

                        <div class="label-details">
                           <label>EMPRESA EN LA QUE SE VA A TRABAJAR:</label>
                           <p><?php echo $empr_trabaj; ?></p>
                        </div>

                     </div>


                     <div class="requirements">
                        <h3>REQUISITOS</h3>
                        <div><?php echo $requisitos; ?></div>

                        <h3>Experiencia y Conocimientos</h3>
                        <div><?php echo $exp_conocimientos; ?></div>
                     </div>

                     <?php if ($mostrar_boton && in_array('1', $mostrar_boton)): ?>
                        <div class="button-apply">
                           <a href="<?php echo esc_url($url_boton); ?>" class="boton-personalizado">
                              <?php echo esc_html($texto_boton); ?>
                           </a>
                        </div>
                     <?php else: ?>

                        <div class="apply-form">
                           <h3>Postula a esta oferta aquí:</h3>
                           <form action="" method="post" enctype="multipart/form-data">
                              <div class="label-details">
                                 <div class="row">
                                    <div class="custom-col-1">
                                       <label for="nombre">Nombres:</label>
                                    </div>
                                    <div class="custom-col-2">
                                       <input type="text" id="nombre" name="nombre" required />
                                    </div>
                                 </div>
                              </div>

                              <div class="label-details">
                                 <div class="row">
                                    <div class="custom-col-1">
                                       <label for="apellidos">Apellidos:</label>
                                    </div>
                                    <div class="custom-col-2">
                                       <input type="text" id="apellidos" name="apellidos" required />
                                    </div>
                                 </div>
                              </div>

                              <div class="label-details">
                                 <div class="row">
                                    <div class="custom-col-1">
                                       <label for="telefono">Teléfono / Celular:</label>
                                    </div>
                                    <div class="custom-col-2">
                                       <input type="tel" id="telefono" name="telefono" required />
                                    </div>
                                 </div>
                              </div>

                              <div class="label-details">
                                 <div class="row">
                                    <div class="custom-col-1">
                                       <label for="email">Email:</label>
                                    </div>
                                    <div class="custom-col-2">
                                       <input type="email" id="email" name="email" required />
                                    </div>
                                 </div>
                              </div>

                              <div class="label-details">
                                 <div class="row">
                                    <div class="custom-col-1">
                                       <label for="linkedin">LinkedIn:</label>
                                    </div>
                                    <div class="custom-col-2">
                                       <input type="url" id="linkedin" name="linkedin" />
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
                                       <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx"
                                          onchange="validateFile(this)" required="required" />
                                    </div>
                                    <div class="custom-col-3">
                                       <span class="notice desktop">Word - PDF con un peso de hasta 2 MB)</span>
                                       <span class="notice mobile">(Formatos admitidos: Word - PDF con un peso de hasta 2
                                          MB)</span>
                                       <div id="cv-error-msg"></div>
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
                                       <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
                                    </div>
                                 </div>
                              </div>

                              <div class="label-details">
                                 <button type="submit">ENVIAR</button>
                                 <input type="hidden" name="form-oferta-laboral" value="1">
                                 <?php
                                 if ($form_msg):
                                    echo $form_msg;
                                 endif;
                                 ?>
                              </div>
                           </form>
                        </div>
                     <?php endif; ?>

                     <?php if ($botones_compartir): ?>
                        <div class="share-buttons">
                           <?php echo $botones_compartir; ?>
                        </div>
                     <?php endif; ?>

                     <?php if ($html_pie_de_pagina): ?>
                        <div class="footer-html">
                           <?php echo $html_pie_de_pagina; ?>
                        </div>
                     <?php endif; ?>
                  </div>
                  <?php
                  //var_dump($banners_de_columna);
                  ?>
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
   </section>
</main>

<script>
   function validateFile() {
      const fileInput = document.getElementById("cv");
      const errorMsg = document.getElementById("cv-error-msg");

      if (fileInput.files.length === 0) {
         errorMsg.textContent = "Por favor, selecciona un archivo.";
         errorMsg.style.color = "#FF6B6B";
         return false;
      }

      const file = fileInput.files[0];
      const allowedExtensions = ["doc", "docx", "pdf"];
      const maxSize = 2 * 1024 * 1024; // 2MB

      const fileExtension = file.name.split(".").pop().toLowerCase();

      if (!allowedExtensions.includes(fileExtension)) {
         errorMsg.textContent = "Solo se permiten archivos .doc, .docx y .pdf.";
         errorMsg.style.color = "#FF6B6B";
         return false;
      }

      if (file.size > maxSize) {
         errorMsg.textContent = "El archivo no debe superar los 2MB.";
         errorMsg.style.color = "#FF6B6B";
         return false;
      }

      errorMsg.textContent = "Archivo válido.";
      errorMsg.style.color = "#28a745";
      return true;
   }
</script>

<?php get_footer(); ?>