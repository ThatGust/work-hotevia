<?php
/**
 * The Template for displaying all single posts
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */


$post_id = get_the_ID();

//Header
$f_s1_background = get_field("s1_background", $post_id);

//Sites
$nombre_de_la_empresa = get_field("nombre_de_la_empresa", $post_id);
$email = get_field("email", $post_id);
$telefono = get_field("telefono", $post_id);
$direccion = get_field("direccion", $post_id);

$razon_social = get_field("razon_social", $post_id);

$logotipo = get_field("logotipo", $post_id);
$imagenes = get_field("imagenes", $post_id);
$descripcion = get_field("descripcion", $post_id);

$convocatoria = get_field("convocatoria", $post_id);
$html_pie_de_pagina = get_field("html_pie_de_pagina", $post_id);
$banners_de_columna = get_field("banners_de_columna", "option");
//$temp = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>';
$paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;
$rows = get_custom_posts($post_type = "oferta-laboral", $search = false, $taxonomies_array = false, $order = "3", $page = $paged, $posts_per_page = 5, $total_rows);
$max_num_pages = ceil($total_rows / $posts_per_page);




/*echo "<pre>";
var_dump(Array("row"=>$rows, "total_rows"=>$total_rows));
echo "</pre>";*/
?>

<?php get_header(); ?>

<main id="main-content" class="page wrapper page-single-empresa" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row">
                        <div class="col col-empr-details">

                            <div class="breadcrumbs">
                                Home > <?php echo esc_html($nombre_de_la_empresa); ?> – Ofertas de empleo – Perú
                            </div>

                            <h2 class="job-title">
                                <?php echo esc_html($nombre_de_la_empresa); ?>
                            </h2>

                            <div class="empresa-info">
                                <?php if ($logotipo): ?>
                                    <img class="logo" src="<?php echo esc_url($logotipo['url']); ?>"
                                        alt="<?php echo esc_attr($logotipo['alt']); ?>" />
                                <?php endif; ?>

                                <?php if ($imagenes): ?>
                                    <div class="gallery">
                                        <?php foreach ($imagenes as $index => $imagen): ?>
                                            <img class="gallery-img" src="<?php echo esc_url($imagen['url']); ?>"
                                                alt="<?php echo esc_attr($imagen['alt']); ?>" />
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="empresa-info">
                                <p><?php the_field('descripcion'); ?></p>
                            </div>

                            <div class="empresa-info-details">
                                <div>
                                    <label>Email:</label>
                                    <?php the_field('email'); ?>
                                </div>
                                <div>
                                    <label>Direccion:</label>
                                    <?php the_field('direccion'); ?>
                                </div>
                                <div>
                                    <label>Teléfono </label>
                                    <?php the_field('telefono'); ?>
                                </div>

                            </div>

                            <div class="job-offers">
                                <h4>CONVOCATORIAS VIGENTES</h4>
                                <?php foreach ($rows as $o_row): ?>
                                    <?php
                                    $sf_ID = $o_row->ID;
                                    $sf_title = $o_row->post_title;
                                    $sf_fecha = get_post_meta($sf_ID, 'fecha_de_expiracion', true);
                                    $sf_empresa = get_post_meta($sf_ID, 'nombre_de_la_empresa', true);
                                    $sf_ubicacion = get_post_meta($sf_ID, 'ubicacion_geografica', true);
                                    ?>

                                    <div class="job-card-main">
                                        <div class="job-card-sub">
                                            <div class="job-card">
                                                <div>
                                                    <h3><?php echo $sf_title; ?></h3>
                                                    <label><?php echo $sf_fecha; ?></label>
                                                    <label><?php echo $sf_empresa; ?></label>
                                                    <label><?php echo $sf_ubicacion; ?></label>
                                                </div>
                                                <div class="button-details">
                                                    <button>Ver detalles >></button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="interest">
                                <h4>También te puede interesar</h4>
                            </div>
                            <div class="html-insert">

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
                    </div>
                </div>
    </section>
</main>


<?php get_footer(); ?>