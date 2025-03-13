<?php
/**
* Template Name: Blog - List Style
*
* Description: A list style blog template with left aligned thumbnails.
*/

get_header(); ?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
		<?php show_breadcrumbs();
        if ( is_page() ) :
			$page_opts 		= get_post_meta( $posts[0]->ID, 'page_options', true );
			$category 			= ! empty( $page_opts['category'] ) ? $page_opts['category'] : -1;
			$post_per_page 	= empty( $page_opts['post_per_page'] ) ? '9' : $page_opts['post_per_page'];
			$hide_page_title = isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;
			
			if ( ! ( $hide_page_title || get_option( 'pls_hide_page_titles' ) ) ) {			
				echo '<header class="page-header"><h1 class="entry-title">' . get_the_title() . '</h1></header>';            
			}
			
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif; // have posts
        endif; // is page
        
		if ( $category ) :
        
			if ( get_query_var( 'paged' ) )
				$paged = get_query_var( 'paged' );
			elseif ( get_query_var( 'page' ) )
				$paged = get_query_var( 'page' );
			else
				$paged = 1;
			$args = array(
				'cat' 					=> $category,
				'orderby' 				=> 'date',
				'order' 				=> 'desc',
				'paged' 				=> $paged,
				'posts_per_page' 		=> $post_per_page
			);
			
			$custom_query = new WP_Query( $args );
			
			if ( $custom_query->have_posts() ) {
				$schema =  newsplus_schema( get_option( 'pls_schema' ) );
				while ( $custom_query->have_posts() ) :
					$custom_query->the_post();
					$post_opts = get_post_meta( get_the_id(), 'post_options', true );
					$ad_class = isset( $post_opts['sp_post'] ) ? ' sp-post' : '';
					$share_btns = get_option( 'pls_inline_social_btns', array() ) ;
					$meta_args = array(
						'date_format' => ( 'human' == get_option( 'pls_date_format' ) ) ? 'human' : get_option( 'date_format' ),
						'enable_schema' => get_option( 'pls_schema' ),
						'hide_cats' => get_option( 'pls_hide_cats' ),
						'hide_reviews' => get_option( 'pls_hide_reviews' ),
						'hide_date' => get_option( 'pls_hide_date' ),
						'hide_author' => get_option( 'pls_hide_author' ),
						'hide_excerpt' => get_option( 'pls_hide_excerpt' ),
						'show_avatar' => get_option( 'pls_show_avatar' ),
						'hide_views' => get_option( 'pls_hide_views' ),
						'hide_comments' => get_option( 'pls_hide_comments' ),
						'readmore' => get_option( 'pls_readmore' ),
						'publisher_logo' => '' != get_option( 'pls_logo' ) ? esc_url( get_option( 'pls_logo' ) ) : get_template_directory_uri() . '/images/logo.png',
						'ext_link' => get_option( 'pls_ext_links' ),
						'sharing'	=> get_option( 'pls_inline_sharing', false ),
						'share_btns' => is_array( $share_btns ) ? implode( ',', $share_btns ) : ''
					);
					
					$rows = newsplus_meta( $meta_args );

					if ( $ad_class ) {
					    echo '<span class="sp-label-archive">' . get_option( 'pls_sp_label', __( 'Advertisement', 'newsplus') ) . '</span>';
					}
					
					get_template_part( 'formats/list-format', get_post_format() );
					
						 printf( '%s', $rows['row_1'] ); ?>
						
						<h2<?php printf( '%s', $schema['heading'] ); ?> class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						
						<?php printf( '%s', $rows['row_2'] );
						
						if ( ! get_option( 'pls_hide_excerpt' ) ) { ?>
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
						
						 printf( '%s', $rows['row_3'] ); ?>
						
						</div><!-- .entry-list-right -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; // End the loop
				
				if ( $custom_query->max_num_pages > 1 ) { ?>
                    <nav class="navigation pagination">
                        <h2 class="screen-reader-text"><?php esc_attr_e( 'Posts navigation', 'newsplus' ); ?></h2>
                        <div class="nav-links">
                        <?php
							echo paginate_links( array(
								'current' => max( 1, $paged ),
								'total' => $custom_query->max_num_pages,
								'prev_text' => esc_attr__( 'Previous page', 'newsplus' ),
								'next_text' => esc_attr__( 'Next page', 'newsplus' ),	
							) );
                        ?>
                        </div><!-- /.nav-links -->
                    </nav><!-- /.navigation -->
				<?php
				}
			}
			
			else {
				newsplus_no_posts();
			} // if have posts
			
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
        
        endif;  // if category ?>
    </div><!-- #content -->
    <?php
	newsplus_sidebar_b();
    ?>
    </div><!--.primary-row -->
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	get_sidebar();
}
get_footer(); ?>