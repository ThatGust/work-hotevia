<?php
/**
 * Tempate part for video post format in list style posts
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$post_opts   = get_post_meta( $post->ID, 'post_options', true );
$pf_video    = !empty( $post_opts['pf_video'] ) ? $post_opts['pf_video'] : false;
$custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
$permalink   = get_option( 'pls_ext_link' ) && $custom_link ? esc_url( $custom_link ) : esc_url( get_permalink() );

$post_class = 'newsplus entry-list';
if ( ! $pf_video ) {
    $post_class .= ' no-image';
}

$schema = newsplus_schema( get_option( 'pls_schema' ), get_option( 'list_big_width' ), get_option( 'list_big_height' ) );
$img    = array(
     'url' => '',
    'title' => '' 
);
if ( function_exists( 'newsplus_video_thumb' ) && $pf_video != '' ) {
    $img = newsplus_video_thumb( $pf_video );
}

$post_opts = get_post_meta( get_the_id(), 'post_options', true );
$ad_class = isset( $post_opts['sp_post'] ) ? ' sp-post' : '';
?>

<article<?php printf( '%s', $schema['container'] );?> id="post-<?php the_ID(); ?>" <?php post_class( $post_class . ' split-' . get_option( 'pls_list_split' ) . $ad_class ); ?>>

<?php
if ( 'true' !== get_option( 'pls_disable_video' ) ) {
    if ( $pf_video ) {
?>
		<div class="post-img">
			<?php
        global $wp_embed;
        echo '<div' . $schema['img_cont'] . ' class="embed-wrap">';
        $post_embed = $wp_embed->run_shortcode( '[embed]' . $pf_video . '[/embed]' );
        printf( '%s', $post_embed );
        if ( get_option( 'pls_schema' ) ) {
            echo '<img class="hidden"' . $schema['img'] . ' src="' . $img['url'] . '" alt="' . $img['title'] . '">' . $schema['img_size'];
        }
        echo '</div>';
?>
        </div><!-- .post-img-->
	<?php
    }
}

else {
   
    $video_icon = '<div class="video-overlay"></div>';
    
	if ( has_post_thumbnail() ) {
        
		if ( function_exists( 'newsplus_image_resize' ) ) {
            $img_src  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            if ( isset( $img_src ) && is_array( $img_src ) ) {
                $img      = $img_src[0];
                $alt_text = basename( get_attached_file( get_post_thumbnail_id( get_the_ID() ) ) );
                $crop     = get_option( 'list_big_crop', false ) ? true : false;
                $img      = newsplus_image_resize( $img, get_option( 'list_big_width' ), get_option( 'list_big_height' ), $crop, get_option( 'list_big_quality' ), '', '' );
            }
        }
		
		else {
            $img = get_the_post_thumbnail( 'list_big_thumb' );
        }
        
        if ( $img ) {
            echo '<div class="post-img">';
            echo '<div' . $schema['img_cont'] . ' class="post-thumb"><a href="' . esc_url( $permalink ) . '" title="' . get_the_title() . '"><img' . $schema['img'] . '  src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">' . $video_icon . '</a>' . $schema['img_size'] . '</div>';
            echo '</div>';
        }
    }
	
	else {
        if ( function_exists( 'newsplus_video_thumb' ) && $pf_video != '' ) {
            echo '<div class="post-img"><div' . $schema['img_cont'] . ' class="post-thumb"><a href="' . esc_url( $permalink ) . '" title="' . get_the_title() . '"><img' . $schema['img'] . ' src="' . $img['url'] . '" class="attachment-post-thumbnail wp-post-image" alt="' . $img['title'] . '">' . $video_icon . '</a>' . $schema['img_size'] . '</div>';
            echo '</div>';
        }
    }
}
?>

<div class="entry-content">