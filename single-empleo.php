<?php

   $post_id = get_the_ID();
   $empresa = get_field("empresa", $post_id);
   
   $empresa_id = $empresa;
   if (is_object($empresa)):
      $empresa_id = $empresa->ID;
   endif;

   $permalink_home = get_bloginfo("url");
   $permalink_ofertas_laborales = $permalink_home."/ofertas-laborales";

   $base_url = get_bloginfo("url");
   $title_negocio = get_the_title($empresa_id);
   $permalink_negocio = get_permalink($empresa_id);
   $empresa_nombre = get_field("nombre_de_la_empresa", $empresa_id);
   $title_oferta = get_the_title($post_id);
   $permalink_oferta = get_the_permalink();

   $distrito = get_field("distrito", $post_id);
   $preguntas_personalizadas = get_field("preguntas_personalizadas", $post_id);
   

   $texto_default = 'Acepto a registrarme en la bbdd de oe2 by hotevia para recibir información personalizada sobre empleabilidad, desarrollo profesional y noticias y contenidos de Hotevia y abanza. oe2 by Hoteiva y Hotevia son marcas de abanZa consulting EIRL.';

   $mostrar_inclusion = get_field("mostrar_politica_inclusion", $post_id);
   $texto_inclusion = get_field("politica_inclusion_empresa", $empresa_id);

   $label_puesto = "";
   $puestos = get_the_terms($post_id, 'puesto');
   if (!is_wp_error($puestos) && !empty($puestos)):
      foreach ($puestos as $term):
         $label_puesto = $term->name;
         break;
      endforeach;
   endif;

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["form-oferta-laboral"]) && $empresa):
      if ($_POST["form-oferta-laboral"] == "1"):
         $code_response = "0";

         $sf_nombre = $_POST["nombre"];
         $sf_apellidos = $_POST["apellidos"];
         $sf_telefono = $_POST["telefono"];
         $sf_email = $_POST["email"];
         $sf_linkedin = $_POST["linkedin"];
         $sf_mensaje = $_POST["mensaje"];


         $array_pregunta = array();
         $array_respuesta = array();
         if($preguntas_personalizadas):
            $index = 1;
            foreach($preguntas_personalizadas as $o_item):
               //var_dump($o_item);
               $key = "field-".$index; 
               $pregunta_id = $o_item["pregunta_txt"];
               $question_txt = get_field("pregunta", $pregunta_id);
               $answer_txt = $_POST[$key];
               if($question_txt && $answer_txt):
                  $array_pregunta[] = $question_txt;
                  $array_respuesta[] = $answer_txt;
               endif;
               $index++;
            endforeach;
         endif;



         $f_form_emails_destinatarios = get_field("form_emails_destinatarios", $empresa_id);
         $f_form_nombre_remitente = get_field("form_nombre_remitente", $empresa_id);
         $f_form_email_remitente = get_field("form_email_remitente", $empresa_id);
         $f_form_asunto = get_field("form_asunto", $empresa_id);
         $sf_disclaimer = isset($_POST["disclaimer_cv"]) ? "Sí, aceptado" : "No";
         $f_form_mensaje = get_field("form_mensaje", $empresa_id);

         if ($f_form_nombre_remitente && $f_form_email_remitente && $f_form_asunto && $f_form_mensaje):

            $email_from = $f_form_nombre_remitente . " <" . $f_form_email_remitente . ">";
            $email_subject = $f_form_asunto.", ".$title_oferta.", ".$distrito;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html;charset=utf-8" . "\r\n";
            $headers .= "Return-Path: " . $email_from . "\r\n";
            $headers .= "Reply-To: " . $sf_email . "\r\n";
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

            if( count($array_pregunta) > 0 ):
               for($i=0 ; $i<count($array_pregunta) ; $i++):
                  $email_message .= "<strong>".$array_pregunta[$i].": </strong>" . $array_respuesta[$i] . "<br />";
               endfor;
            endif;
            $email_message .= "<br />";

            $email_message .= "<strong>Enviado desde: </strong> <a target='_blank' href='" . $permalink_oferta . "'> " . $permalink_oferta . " </a><br />";
            $email_message .= "<strong>Autorización BBDD y Newsletter: </strong>" . $sf_disclaimer . "<br />";
            $banner_email = get_field('banner_publicitario_email', 'option');
            if ( !empty($banner_email) ) {
                $email_message .= '<br><br><hr style="border:0; border-top:1px solid #ccc; margin: 20px 0;"><br>' . $banner_email;
            }

            $attachments = array();
            $upload_path = false;
            if (isset($_FILES['cv'])):
               $upload_dir = wp_upload_dir();
               $upload_path = $upload_dir['path'] . '/' . basename($_FILES['cv']['name']);
               if (move_uploaded_file($_FILES['cv']['tmp_name'], $upload_path)):
                  $attachments = array($upload_path);
               endif;
            endif;

            $nueva_postulacion = array(
                'post_title'    => $sf_nombre . ' ' . $sf_apellidos,
                'post_type'     => 'postulacion',
                'post_status'   => 'publish'
            );
            $post_id_nuevo = wp_insert_post( $nueva_postulacion );

            if ( $post_id_nuevo ) {
                update_post_meta($post_id_nuevo, 'nombre', $sf_nombre);
                update_post_meta($post_id_nuevo, 'apellidos', $sf_apellidos);
                update_post_meta($post_id_nuevo, 'email', $sf_email);
                update_post_meta($post_id_nuevo, 'telefono', $sf_telefono);
                update_post_meta($post_id_nuevo, 'linkedin', $sf_linkedin);
                update_post_meta($post_id_nuevo, 'mensaje', $sf_mensaje);
                update_post_meta($post_id_nuevo, 'puesto_postulado', $title_oferta);
                update_post_meta($post_id_nuevo, 'empresa', $title_negocio);
                
                if ($upload_path && file_exists($upload_path)) {
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    
                    $wp_filetype = wp_check_filetype(basename($upload_path), null );
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($upload_path) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );
                    
                    $attach_id = wp_insert_attachment( $attachment, $upload_path, $post_id_nuevo );
                    if ( ! is_wp_error( $attach_id ) ) {
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_path );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        update_post_meta($post_id_nuevo, 'cv', $attach_id);
                    }
                }
            }

            $emails_personalizados = get_field("emails_personalizados_oferta", $post_id);
            $flag_send = false;

            if (!empty($emails_personalizados)) {
                $lista_emails = array_map('trim', explode(',', $emails_personalizados));
                foreach ($lista_emails as $ssf_email_dest) {
                    if (is_email($ssf_email_dest)) {
                        $envio_ok = wp_mail($ssf_email_dest, $email_subject, $email_message, $headers, $attachments);
                        if ($envio_ok) { $flag_send = true; }
                    }
                }
            } else {
                if ($f_form_emails_destinatarios):
                   foreach ($f_form_emails_destinatarios as $o_item):
                      $ssf_nombre_dest = $o_item["nombre"];
                      $ssf_email_dest = $o_item["email"];
                      if ($ssf_nombre_dest && $ssf_email_dest):
                         $s_email_to = $ssf_nombre_dest . " <" . $ssf_email_dest . ">";
                         $envio_ok = wp_mail($s_email_to, $email_subject, $email_message, $headers, $attachments);
                         if ($envio_ok) { $flag_send = true; }
                      endif;
                   endforeach;
                endif;
            }

            if ($flag_send):
               $code_response = "1";
            else:
               $code_response = "0";
            endif;


         else:
            $code_response = "2";

         endif;
         $redirect_url = $permalink_oferta . "?success=" . $code_response;
         wp_redirect($redirect_url);
         exit;
      endif;
   endif;

   $nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
   $fecha_de_expiracion = get_field("fecha_de_expiracion", $post_id);
   
   $fecha_expiracion_raw = get_field("fecha_de_expiracion", $post_id, false);
   $oferta_finalizada = false;
   
   if (!empty($fecha_expiracion_raw)) {
      $hoy = current_time('Ymd');
      if ($hoy > $fecha_expiracion_raw) {
         $oferta_finalizada = true;
      }
   }

   $pais = get_field("pais", $post_id);
   $ciudad = get_field("ciudad", $post_id);
   $direccion = get_field("direccion", $post_id);

   $empr_trabaj = get_field("empr_trabaj", $post_id);
   $requisitos = get_field("requisitos", $post_id);
   $exp_conocimientos = get_field("exp_conocimientos", $post_id);
   $html_pie_de_pagina = get_field("html_pie_de_pagina", "option");

   $titulo_pagina = $title_oferta." - ".$empr_trabaj;

   $ubicacion_geografica = "";
   if( $distrito ):
      $ubicacion_geografica .= $distrito." / ";
   endif;
   
   if( $pais && $ciudad && strpos($ciudad, '@') !== false ):      
      $path_json_countries_states = get_template_directory()."/functions/php-countries/states.php";
      $array_states = include $path_json_countries_states;
      $array_keys = explode("@", $ciudad);
      $key_city = $array_keys[0];
      $key_province = $array_keys[1];
      if (isset($array_states[$key_city][$key_province])) {
         $label = $array_states[$key_city][$key_province];
         $ubicacion_geografica .= $label." / ";
      }
   endif;
   
   if( $pais ):
      $path_json_countries = get_template_directory()."/functions/php-countries/countries.php";
      $array_countries = include $path_json_countries;
      if (isset($array_countries[$pais])) {
         $label = $array_countries[$pais];
         $ubicacion_geografica .= $label." / ";
      }
   endif;
   
   $ubicacion_geografica = trim($ubicacion_geografica);
   $ubicacion_geografica = trim($ubicacion_geografica, "/");

   $banners_de_columna = get_field("banners_de_columna", "option");
   $botones_compartir = get_field("botones_compartir", "option");

   $mostrar_boton = get_field("mostrar_boton", $post_id);
   $texto_boton = get_field("texto_boton", $post_id);
   $url_boton = get_field("url_boton", $post_id);

   $form_msg = false;
   if (isset($_GET["success"])):
      if ($_GET["success"] == "0"):
         $form_msg = '<div id="form-message" style="margin:20px 0; color:#FF6B6B;line-height:1.4em;"> Ocurrió un error al enviar. Por favor, inténtelo de nuevo más tarde.</div>';
      elseif ($_GET["success"] == "2"):
         $form_msg = '<div id="form-message" style="margin:20px 0; color:#FF6B6B;line-height:1.4em;">La empresa no ha configurado los datos de envío. Por favor, espere o contacte al administrador.</div>';
      endif; 
      
      if ($_GET["success"] != "1"):
         $form_msg .= '<script> jQuery( document ).ready(function() { setTimeout(function() { window.scrollTo(0, jQuery("#form-message").offset().top+-250 ); }, 1000); }); </script>';
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

                     <div class="row custom-row">
                        <div class="col-12 col-lg-5 custom-col">
                           <ol class="breadcrumbs">
                              <li><a href="<?php echo $base_url; ?>">Home</a></li>
                              <li><a href="<?php echo $permalink_negocio; ?>"><?php echo $title_negocio; ?></a></li>
                              <li><span><?php echo $title_oferta; ?></span></li>
                           </ol>
                        </div>
                        <div class="col-12 col-lg-7 custom-col">
                           <div class="wrap-buttons">
                              <a href="<?php echo $permalink_negocio; ?>" class="btn-gray">Otras ofertas de la empresa</a>
                              <a href="<?php echo $permalink_ofertas_laborales; ?>" class="btn-red">Ir al listado de ofertas</a>
                           </div> 
                        </div>
                     </div>

                     <h1 class="job-title"> <?php echo $titulo_pagina; ?> </h1>

                     <div class="primary-offer-details">
                        <label class="label-details"><?php echo $label_puesto; ?></label>

                        <div class="label-details">
                           <label>EMPRESA QUE SELECCIONA:</label>
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

                     <?php if ($oferta_finalizada): ?>
                        <div class="oferta-finalizada-msg" style="background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 25px; text-align: center; margin: 40px 0; border-radius: 8px;">
                           <h3 style="color: #721c24; margin: 0; font-size: 24px; font-weight: bold;">OFERTA LABORAL FINALIZADA</h3>
                           <p style="color: #721c24; margin: 10px 0 0 0; font-size: 16px;">El plazo para postular a esta oferta ha terminado.</p>
                        </div>

                     <?php else: ?>

                        <?php if (!empty($mostrar_boton) && is_array($mostrar_boton) && in_array('1', $mostrar_boton)): ?>
                           <div class="button-apply">
                              <a href="<?php echo esc_url($url_boton); ?>" target="_blank" class="boton-personalizado">
                                 <?php echo esc_html($texto_boton); ?>
                              </a>
                           </div>
                        <?php else: ?>

                           <?php if ($mostrar_inclusion && $texto_inclusion): ?>
                              <div class="inclusion-policy" style="margin-bottom: 30px; padding: 20px; background-color: #f9f9f9; border-left: 4px solid #ccc;">
                                 <h3 style="margin-top: 0; font-size: 1.2em;">Inclusión y Cumplimiento Normativo</h3>
                                 <div class="policy-content" style="font-size: 14px; color: #555; line-height: 1.6;">
                                    <?php echo $texto_inclusion; ?>
                                 </div>
                              </div>
                           <?php endif; ?>

                           <div class="apply-form">
                              <h3>Postula a esta oferta aquí:</h3>
                              <form id="job-application-form" action="" method="post" enctype="multipart/form-data">
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
                                          <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" onchange="validateFile(this)" required="required" />
                                       </div>
                                       <div class="custom-col-3">
                                          <span class="notice desktop">Word - PDF con un peso de hasta 2 MB)</span>
                                          <span class="notice mobile">(Formatos admitidos: Word - PDF con un peso de hasta 2 MB)</span>
                                          <div id="cv-error-msg"></div>
                                       </div>
                                    </div>
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

                                 <?php if($preguntas_personalizadas): ?>
                                    <?php $index = 1; ?>
                                    <?php foreach($preguntas_personalizadas as $o_item): ?>
                                       <?php 
                                          //var_dump($o_item);
                                          $key = "field-".$index; 
                                          $pregunta_id = $o_item["pregunta_txt"];
                                          $question_txt = get_field("pregunta", $pregunta_id);
                                       ?>
                                       <?php if($question_txt): ?>
                                          <div class="label-details">
                                             <div class="row">
                                                <div class="custom-col-1">
                                                   <label for="<?php echo $key ?>" style="display:inline-block; line-height:1.3em;"><?php echo $question_txt; ?>:</label>
                                                </div>
                                                <div class="custom-col-2">
                                                   <input type="text" id="<?php echo $key ?>" name="<?php echo $key ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       <?php endif; ?>
                                       <?php $index++; ?>
                                    <?php endforeach; ?>
                                 <?php endif; ?>

                                 <div class="label-details disclaimer-checkbox" style="margin-top: 20px; margin-bottom: 30px;">
                                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                                       <input type="checkbox" id="disclaimer_cv" name="disclaimer_cv" value="Aceptado" checked required style="width: 24px; height: 24px; flex-shrink: 0; margin-top: 2px; cursor: pointer; accent-color: #555; filter: grayscale(1) contrast(2);" />
                                       <label for="disclaimer_cv" style="margin: 0; font-size: 15px; font-weight: 400; line-height: 1.5; color: #555; cursor: pointer;">
                                          <?php 
                                             $texto_disclaimer = get_field("texto_disclaimer_cv", $post_id);
                                             
                                             if(!$texto_disclaimer || trim((string)$texto_disclaimer) === '') {
                                                echo $texto_default;
                                             } else {
                                                echo $texto_disclaimer;
                                             }
                                          ?>
                                       </label>
                                    </div>
                                 </div>

                                 <div class="label-details">
                                    <button type="submit" id="btn-submit-cv">ENVIAR</button>
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

<?php if (isset($_GET["success"]) && $_GET["success"] == "1"): ?>
<div id="popup-exito-cv" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0, 0, 0, 0.6); display: flex; align-items: center; justify-content: center; z-index: 99999;">
   <div style="background-color: #ffffff; padding: 40px 50px; border: 1px solid #cccccc; text-align: center; max-width: 400px; width: 90%;">
      <div style="color: #22c55e; font-size: 55px; line-height: 1; margin-bottom: 15px;">&#10004;</div>
      <p style="font-size: 18px; color: #333333; margin: 0; font-family: sans-serif;">
         ¡Se ha enviado su postulación con <strong>éxito</strong>!
      </p>
   </div>
</div>
<?php endif; ?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const popupExito = document.getElementById("popup-exito-cv");
      if (popupExito) {
         setTimeout(function() {
            popupExito.style.display = "none";
         }, 2000);
      }
   });
</script>
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
      const maxSize = 2 * 1024 * 1024; 

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

   document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById("job-application-form");
      const btnSubmit = document.getElementById("btn-submit-cv");

      if (form && btnSubmit) {
         form.addEventListener("submit", function(e) {
            btnSubmit.disabled = true;
            btnSubmit.style.backgroundColor = "#888";
            btnSubmit.style.borderColor = "#888";
            btnSubmit.style.cursor = "not-allowed";
            btnSubmit.innerHTML = "Enviando...";
         });
      }
   });
</script>

<?php get_footer(); ?>