<?php
/**
 * Tempate part for gallery post format
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$images = get_children( array(
    'post_parent' => $post->ID,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'numberposts' => 999 
) );

if ( $images && ( ( is_single() || 'full-style' == get_option( 'pls_archive_template' ) ) || is_page_template( 'templates/blog-full.php' ) ) ) {
    
    $params = array(
        'items' => 1,
        'margin' => 0,
        'speed' => 400,
        'timeout' => 4000,
        'autoheight' => 'false',
        'dots' => is_single() || 'full-style' == get_option( 'pls_archive_template' ) || is_page_template( 'templates/blog-full.php' ) ? 'true' : 'false',
        'nav' => 'true',
        'loop' => 'true',
        'autoplay' => 'true',
        'animatein' => '',
        'animateout' => '' 
    );
    
    $json = json_encode( $params );
    
    $slides = '';
    
    $schema = newsplus_schema( get_option( 'pls_schema' ), get_option( 'sng_width' ), get_option( 'sng_height' ) );
    
    foreach ( $images as $image ) {
        $img_src = wp_get_attachment_image_src( $image->ID, 'full' );
        $img = isset( $img_src ) && is_array( $img_src ) ? $img_src[0] : '';
        if ( function_exists( 'newsplus_image_resize' ) ) {
            $sng_crop = ( 'true' == get_option( 'sng_crop' ) ) ? true : false;
            
            $img = newsplus_image_resize( $img, get_option( 'sng_width' ), get_option( 'sng_height' ), $sng_crop, get_option( 'sng_quality' ), '', '' );
            
        }
        
        $alt_text = basename( get_attached_file( $image->ID ) );
        
        $slides .= '<div' . $schema['img_cont'] . ' class="slide-thumb"><img' . $schema['img'] . ' src="' . $img . '" alt="' . $alt_text . '" />' . $schema['img_size'] . '</div>';
    }
	
    printf( '<div class="owl-wrap np-posts-slider" data-params=\'%s\'><div class="owl-carousel owl-loading" id="%s">%s</div></div>', $json, get_the_ID(), $slides );
}

else {
    get_template_part( 'formats/format' );
}
?>