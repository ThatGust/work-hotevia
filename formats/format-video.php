<?php
/**
 * Tempate part for video post format
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$post_opts        = get_post_meta( $post->ID, 'post_options', true );
$pf_video         = ! empty( $post_opts['pf_video'] ) ? $post_opts['pf_video'] : '';
$img              = array( 'url' => '', 'title' => '' );
					
$archive_template = get_option( 'pls_archive_template', 'grid' );
$is_page_template = is_page_template( 'templates/blog-full.php' );
$pls_schema       = get_option( 'pls_schema' );

// Image size schema
if ( is_single() || 'full-style' == $archive_template || $is_page_template ) {    
    $imgwidth  = get_option( 'sng_width' );
    $imgheight = get_option( 'sng_height' );    
}

elseif ( $is_page_template || ( ( is_archive() || is_home() ) && 'classic-style' == $archive_template ) ) {    
    $imgwidth  = get_option( 'classic_width' );
    $imgheight = get_option( 'classic_height' );    
}

else {
    $imgwidth  = get_option( 'grid_width' );
    $imgheight = get_option( 'grid_height' );
}

$schema = newsplus_schema( $pls_schema, $imgwidth, $imgheight );

if ( $pf_video && ( is_single() && 'true' != get_option( 'pls_disable_single_video' ) ) || ( ( is_archive() || is_home() ) && 'true' != get_option( 'pls_disable_video' ) ) ) {
    global $wp_embed;
    echo '<div' . $schema['img_cont'] . ' class="embed-wrap">';
    $post_embed = $wp_embed->run_shortcode( '[embed]' . $pf_video . '[/embed]' );
    printf( '%s', $post_embed );
    if ( $pls_schema ) {
        $img = newsplus_video_thumb( $pf_video );
        echo '<img class="hidden"' . $schema['img'] . ' src="' . $img['url'] . '" alt="' . $img['title'] . '">' . $schema['img_size'];
    }
    echo '</div>';
}

elseif ( get_option( 'pls_disable_video' ) ) {
    
    if ( has_post_thumbnail() ) {
        get_template_part( 'formats/format' );
    }
	
	else {
        if ( function_exists( 'newsplus_video_thumb' ) && $pf_video != '' ) {
            $img         = newsplus_video_thumb( $pf_video );
            $video_icon  = '<div class="video-overlay"></div>';
            $custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
            echo '<div' . $schema['img_cont'] . ' class="post-thumb"><a href="' . ( get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() ) ) . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img['url'] . '" class="attachment-post-thumbnail wp-post-image" alt="' . $img['title'] . '">' . $video_icon . '</a>';
            printf( '%s', $schema['img_size'] );
            echo '</div>';
        }
    }
}
?>