<?php
/**
 * Tempate part for standard post format in related posts
 *
 * @package NewsPlus
 * @since 3.0
 * @version 4.0.3
 */

$custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
$permalink   = get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() );

if ( has_post_thumbnail() ) {
    
    $schema = newsplus_schema( get_option( 'pls_schema' ), get_option( 'rp_width' ), get_option( 'rp_height' ) );
    echo '<div' . $schema['img_cont'] . ' class="post-thumb">';
    
	if ( function_exists( 'newsplus_image_resize' ) ) {
    	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        if ( isset( $img_src ) && is_array( $img_src ) ) {
            $img     = $img_src[0];
            $rp_crop = ( 'true' == get_option( 'rp_crop' ) ) ? true : false;
            $img     = newsplus_image_resize( $img, get_option( 'rp_width' ), get_option( 'rp_height' ), $rp_crop, get_option( 'rp_quality' ), '', '' );
        }
    }
	
	else {
        $img = get_the_post_thumbnail( 'full' );
    }
    
    $alt_text = basename( get_attached_file( get_post_thumbnail_id( get_the_ID() ) ) );
    
    $video_icon = '';
    
    if ( 'video' == get_post_format() || 'gallery' == get_post_format() ) {
        $video_icon = '<div class="' . get_post_format() . '-overlay"></div>';
    }
    
    if ( isset( $img ) ) {
        echo '<a href="' . $permalink . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">' . $video_icon . '</a>';
        printf( '%s', $schema['img_size'] );
    }
    echo '</div>';
}