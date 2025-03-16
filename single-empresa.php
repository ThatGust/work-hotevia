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
$imagenes = get_field("imagenes", $post_id);
$descripcion = get_field("descripcion", $post_id);
$convocatoria = get_field("convocatoria", $post_id);


//$temp = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>';
$paged = isset($_GET["pg"]) ? $_GET["pg"] : 1;
$rows = get_custom_posts($post_type = "oferta-laboral", $search = false, $taxonomies_array = false, $order = "3", $page = $paged, $posts_per_page = 1, $total_rows);
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
                    <div class="empr-details">

                        <nav>
                            <a href="#">Home</a> >
                            <a href="#">Accor Premium Brands</a> >
                            <a href="#">Ofertas de empleo - Perú</a>
                        </nav>

                        <h1><?php the_field('nombre_de_la_empresa'); ?></h1>

                        <div class="empresa-info">
                            <?php 
                            $imagenes = get_field('imagenes');
                            if( $imagenes ):
                                foreach( $imagenes as $imagen ): ?>
                                    <img src="<?php echo esc_url($imagen['url']); ?>" alt="<?php echo esc_attr($imagen['alt']); ?>" />
                                <?php endforeach;
                            endif; 
                            ?>
                        </div>

                        <p><?php the_field('descripcion'); ?></p>

                        <h2>CONVOCATORIAS VIGENTES</h2>

                        <div class="job-offers">
                            <?php if( have_rows('convocatoria') ): ?>
                                <?php while( have_rows('convocatoria') ): the_row(); ?>
                                    <div class="job-card">
                                        <h3><?php the_sub_field('titulo'); ?></h3>
                                        <p><?php the_sub_field('fecha'); ?></p>
                                        <p><?php the_sub_field('empresa'); ?></p>
                                        <p><?php the_sub_field('ubicacion'); ?></p>
                                        <button>Ver detalles >></button>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                        <div class="content">
                            <ul>
                                <?php foreach ($rows as $o_row): ?>
                                    <?php
                                    $sf_ID = $o_row->ID;
                                    $sf_title = $o_row->post_title;
                                    ?>
                                    <li><?php echo $sf_ID; ?> <?php echo $sf_title; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="page-simple-empresa"></div>

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

                <div class="html-pie-pagina">
                    <?php the_field('html_pie_de_pagina'); ?>
                </div>

            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>