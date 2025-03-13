<?php
/**
 * Tempate part for standard post format in list style posts
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$post_class = 'newsplus entry-list';
if ( ! has_post_thumbnail() ) {
	$post_class .= ' no-image';
}
$gallery_icon = '';
if ( 'gallery' == get_post_format() ) {
	$gallery_icon = '<div class="gallery-overlay"></div>';
}

$schema =  newsplus_schema( get_option( 'pls_schema' ), get_option( 'list_big_width' ), get_option( 'list_big_height' ) );

$post_opts = get_post_meta( get_the_id(), 'post_options', true );
$ad_class = isset( $post_opts['sp_post'] ) ? ' sp-post' : '';
?>

<article<?php printf( '%s', $schema['container'] ); ?> id="post-<?php the_ID(); ?>" <?php  post_class( $post_class . ' split-'. get_option( 'pls_list_split' ) . $ad_class ); ?>>

	<?php
	if ( has_post_thumbnail() ) {
		if ( function_exists( 'newsplus_image_resize' ) ) {
			$img_src  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			if ( isset( $img_src ) && is_array( $img_src ) ) {
				$img      = $img_src[0];
				$alt_text = basename( get_attached_file( get_post_thumbnail_id( get_the_ID() ) ) );
				$crop     = get_option( 'list_big_crop', false ) ? true : false;
				$img      = newsplus_image_resize( $img, get_option( 'list_big_width' ), get_option( 'list_big_height' ), $crop, get_option( 'list_big_quality' ), '', '' );
			}
		} else {
			$img = get_the_post_thumbnail( 'list_big_thumb' );
		}
		
		if ( isset( $img ) ) {
			$custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
			$permalink   = get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() );
			echo '<div class="post-img">';
			echo '<div' . $schema['img_cont'] . ' class="post-thumb"><a href="' . $permalink . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">' . $gallery_icon . '</a>' . $schema['img_size'] . '</div>';
			echo '</div>';
		}
	}
	?>
	
	<div class="entry-content">