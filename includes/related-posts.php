<?php
/**
 * Related posts
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

$archive_template = get_option( 'pls_archive_template', 'grid' );
$args = NULL;
$related_posts_query = NULL;
$temp = ( isset( $post ) ) ? $post : '';
if ( 'tags' == get_option( 'pls_rp_taxonomy' ) ) {
	$tags = wp_get_post_tags( $post->ID );
	if ( $tags ) {
		$tag_ids = array();
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args = array(
			'tag__in' 				=> $tag_ids,
			'post__not_in' 			=> array( $post->ID ),
			'posts_per_page'		=> get_option( 'pls_rp_num' ),
			'orderby' 				=> apply_filters( 'newsplus_rp_order', 'rand' )
		);
	} // if tags
} // taxonomy tags
else {
	$categories = get_the_category( $post->ID );
	if ( $categories ) {
		$category_ids = array();
		foreach( $categories as $individual_category ) {
			$category_ids[] = $individual_category->term_id;
		}
		$args = array(
			'category__in' 			=> $category_ids,
			'post__not_in' 			=> array( $post->ID ),
			'posts_per_page'		=> get_option( 'pls_rp_num' ),
			'orderby'				=> apply_filters( 'newsplus_rp_order', 'rand' )
		);
	} // if categories
} // taxonomy categories

$schema =  newsplus_schema( get_option( 'pls_schema' ) );
$related_posts_query = new WP_Query( $args );	

if ( $related_posts_query->have_posts() ) :
?>

    <h3 class="related-posts-heading"><?php echo apply_filters( 'np_related_posts_heading', __( 'You may also like...', 'newsplus' ) ); ?></h3>
    <div class="related-posts grid-row<?php if ( get_option( 'pls_enable_masonry' ) ) echo ' masonry-enabled'; ?> clear">
		<?php
        /* Initialize counter and class variables */
        $col = get_option( 'pls_rp_grid_col', 2 );
        $count = 1;
        $thumbclass = '';
        $fclass = '';
        $lclass = '';
            while( $related_posts_query->have_posts() ) :
                $related_posts_query->the_post();
                $post_opts = get_post_meta( get_the_id(), 'post_options', true );
                $ad_class = isset( $post_opts['sp_post'] ) ? ' sp-post' : '';                
                $thumbnail = '';
    			$share_btns = get_option( 'pls_inline_social_btns', array() ) ;
                $meta_args = array(
                    'date_format' => ( 'human' == get_option( 'pls_date_format' ) ) ? 'human' : get_option( 'date_format' ),
                    'enable_schema' => get_option( 'pls_schema' ),
                    'hide_cats' => get_option( 'pls_rp_hide_cats' ),
                    'hide_reviews' => get_option( 'pls_rp_hide_reviews' ),
                    'hide_date' => get_option( 'pls_rp_hide_date' ),
                    'hide_author' => get_option( 'pls_rp_hide_author' ),
                    'hide_excerpt' => get_option( 'pls_rp_hide_excerpt' ),
                    'show_avatar' => get_option( 'pls_rp_show_avatar' ),
                    'hide_views' => get_option( 'pls_rp_hide_views' ),
                    'hide_comments' => get_option( 'pls_rp_hide_comments' ),
                    'readmore' => get_option( 'pls_readmore' ),
                    'publisher_logo' => '' != get_option( 'pls_logo' ) ? esc_url( get_option( 'pls_logo' ) ) : get_template_directory_uri() . '/images/logo.png',
                    'ext_links' => get_option( 'pls_ext_links' ),
					'sharing'	=> get_option( 'pls_inline_sharing', false ),
					'share_btns' => is_array( $share_btns ) ? implode( ',', $share_btns ) : ''
                );
                $rows = newsplus_meta( $meta_args );		
                                
                if ( has_post_thumbnail() ) {
                    $title = get_the_title();
                    $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'related_posts_thumb' );
                    if ( isset( $img_src ) && is_array( $img_src ) ) {
                        $img = $img_src[0];
                        if ( function_exists( 'newsplus_image_resize' ) ) {
                            $rp_crop = get_option( 'rp_crop', false ) ? true : false;
                            $img = newsplus_image_resize( $img, get_option( 'rp_width' ), get_option( 'rp_height' ), $rp_crop, get_option( 'rp_quality' ), '', '' );
                        }
                    }
                }
                
                /* Calculate appropriate class names for first and last grids */
                $fclass = ( 0 == ( ( $count - 1 ) % (int)$col ) ) ? ' first-grid' : '';
                $lclass = ( 0 == ( $count % (int)$col ) ) ? ' last-grid' : '';
				$card_class = '';
				$card_cont = 'entry-content';				
				if ( 'card' == $archive_template ) {
					$card_class = ' entry-card';
					$card_cont = 'card-content';
				}
				?>
                <article<?php printf( '%s', $schema['container'] ); ?> id="post-<?php the_ID();?>" <?php post_class( 'newsplus entry-grid col'. $col . $fclass . $lclass . $card_class . $ad_class ); ?>>
                    <?php
                    if ( $ad_class ) {
                        echo '<span class="sp-label-archive">' . get_option( 'pls_sp_label', __( 'Advertisement', 'newsplus') ) . '</span>';
                    } 
                    if ( 'card' == $archive_template ) {
						echo '<div class="card-wrap">';
					}
					
					if ( 'thumbnail' == get_option( 'pls_rp_style' ) ) {
                         get_template_part( 'formats/rp-format', get_post_format() );
                    }

                    echo '<div class="' . $card_cont . '">';

                        printf( '%s', $rows['row_1'] );
                        ?>
                        <h2<?php printf( '%s', $schema['heading'] ); ?> class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php printf( '%s', $rows['row_2'] );
                        if ( ! get_option( 'pls_rp_hide_excerpt' ) ) { ?>
                            <p<?php printf( '%s', $schema['text'] ); ?> class="post-excerpt">
                                <?php if ( 'true' == get_option( 'pls_use_word_length' ) ) {
                                    echo newsplus_short_by_word( get_the_excerpt(), get_option( 'pls_word_length', 20 ) );
                                }
                                else {
                                    echo newsplus_short( get_the_excerpt(), get_option( 'pls_char_length', 100 ) );
                                } ?>
                            </p>
                        <?php
                        }
                        printf( '%s', $rows['row_3'] );
						
						if ( 'card' == $archive_template ) {
							echo '</div>';
						}
					?>
                    </div><!-- /.entry-content -->
                </article>
            <?php $count++;
            endwhile; // while have posts ?>
		</div><!-- .related-posts -->
<?php endif; // if have posts
$post = $temp;
wp_reset_query();
wp_reset_postdata();
?>