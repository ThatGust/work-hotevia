<?php
/**
 * Tempate part for standard post format
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

if ( has_post_thumbnail() ) {
    $crop = false;
    // Image size schema
    if ( ( is_single() || 'full-style' == get_option( 'pls_archive_template' ) ) || is_page_template( 'templates/blog-full.php' ) ) {
        $imgwidth  = get_option( 'sng_width' );
        $imgheight = get_option( 'sng_height' );
        $crop      = 'true' == get_option( 'sng_crop' ) ? true : false;
        $quality   = get_option( 'sng_quality' );
    }

    elseif ( ( ( is_home() || is_archive() ) && 'classic-style' == get_option( 'pls_archive_template' ) ) || is_page_template( 'templates/blog-classic.php' ) ) {
        $imgwidth  = get_option( 'classic_width' );
        $imgheight = get_option( 'classic_height' );
        $crop      = 'true' == get_option( 'classic_crop' ) ? true : false;
        $quality   = get_option( 'classic_quality' );
    }

    else {
        $imgwidth  = get_option( 'grid_width' );
        $imgheight = get_option( 'grid_height' );
        $crop      = 'true' == get_option( 'grid_crop' ) ? true : false;
        $quality   = get_option( 'grid_quality' );
    }

    $schema = newsplus_schema( get_option( 'pls_schema' ), $imgwidth, $imgheight );
    echo '<div' . $schema['img_cont'] . ' class="post-thumb">';
    if ( function_exists( 'newsplus_image_resize' ) ) {
        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        if ( isset( $img_src ) && is_array( $img_src ) ) {
            $img     = $img_src[0];
            $img     = newsplus_image_resize( $img, $imgwidth, $imgheight, $crop, $quality, '', '' );
        }
    } else {
        $img = get_the_post_thumbnail( 'full' );
    }

    $alt_text = basename( get_attached_file( get_post_thumbnail_id( get_the_ID() ) ) );

    $video_icon = '';

    if ( 'video' == get_post_format() || 'gallery' == get_post_format() ) {
        $video_icon = '<div class="' . get_post_format() . '-overlay"></div>';
    }

    $custom_link = get_post_meta( $post->ID, 'np_custom_link', true );

    if ( isset( $img ) ) :
        echo '<a href="' . ( get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() ) ) . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">' . $video_icon . '</a>';
        printf( '%s', $schema['img_size'] );
    endif;
    echo '</div>';
}