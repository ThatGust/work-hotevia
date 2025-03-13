<?php
/**
 * Tempate part for video post format in related posts
 *
 * @package NewsPlus
 * @since 3.0
 * @version 4.0.3
 */

$post_opts = get_post_meta( $post->ID, 'post_options', true);
$pf_video = ! empty( $post_opts['pf_video'] ) ? $post_opts['pf_video'] : '';
$custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
$permalink = get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() );

$schema =  newsplus_schema( get_option( 'pls_schema' ), get_option( 'grid_width' ), get_option( 'grid_height' ) );
$img = array( 'url' => '', 'title' => '');
if ( function_exists( 'newsplus_video_thumb' ) && $pf_video != '' ) {
	$img = newsplus_video_thumb( $pf_video );
}

 if ( $pf_video && 'true' != get_option( 'pls_disable_video' ) ) {
	global $wp_embed;
	echo '<div' . $schema['img_cont'] . ' class="embed-wrap">';
	$post_embed = $wp_embed->run_shortcode( '[embed]' . $pf_video . '[/embed]' );
	printf( '%s', $post_embed );
	if ( get_option( 'pls_schema' ) ) {
		echo '<img class="hidden"' . $schema['img'] . ' src="' . $img['url'] . '" alt="' . $img['title'] . '">' . $schema['img_size'];
	}
	echo '</div>';
}

else {

	if ( 'false' != get_option( 'pls_disable_video' ) ) { 	
		if ( has_post_thumbnail() ) {
			get_template_part( 'formats/rp-format' );
		}
		else {
			if ( function_exists( 'newsplus_video_thumb' ) && $pf_video != '' ) {
				$img = newsplus_video_thumb( $pf_video );
				
				$video_icon = '<div class="video-overlay"></div>';
	
				echo '<div' . $schema['img_cont'] . ' class="post-thumb"><a href="' . $permalink . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img['url'] . '" class="attachment-post-thumbnail wp-post-image" alt="' . $img['title'] . '">' . $video_icon .'</a>' . $schema['img_size'];
			echo '</div>';
			}
		}
	}
}
?>