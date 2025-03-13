<?php
/**
 * Template Name: Archive - 3 Col full width
 *
 * Description: A two columnar grid archive template.
 */

get_header(); ?>
<div id="primary" class="site-content full-width">
    <div id="content" role="main">
		<?php
        show_breadcrumbs();
        if ( is_page() ) :
			$page_opts 			= get_post_meta( $posts[0]->ID, 'page_options', true );
			$category 			= ! empty( $page_opts['category'] ) ? $page_opts['category'] : -1;
			$post_per_page 		= empty( $page_opts['post_per_page'] ) ? '9' : $page_opts['post_per_page'];
			$enable_masonry 	= isset( $page_opts['enable_masonry'] ) ? $page_opts['enable_masonry'] : false;
			$hide_page_title 	= isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;
			$card_style		 	= isset( $page_opts['card_style'] ) ? $page_opts['card_style'] : false;
			
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
			$grid_class = 'grid-row clearfix';
			$grid_class .= $enable_masonry ? ' masonry-enabled' : '';
			
			if ( $custom_query->have_posts() ) { ?>
                <div class="<?php echo esc_attr( $grid_class ); ?>">
                <?php
                $schema =  newsplus_schema( get_option( 'pls_schema' ) );
                
                /* Initialize counter and class variables */
                $col = 3;
                $count = 1;
                $thumbclass = '';
                $fclass = '';
                $lclass = '';
				$classes = 'newsplus entry-grid col' . $col;
				$classes .= $card_style ? ' entry-card ' : ' ';
				$content_class = $card_style ? 'card-content' : 'entry-content';	
								
                while ( $custom_query->have_posts() ) :
					$custom_query->the_post();
					/* Calculate appropriate class names for first and last grids */
					$fclass = ( 0 == ( ( $count - 1 ) % (int)$col ) ) ? ' first-grid' : '';
					$lclass = ( 0 == ( $count % (int)$col ) ) ? ' last-grid' : '';
					$post_opts = get_post_meta( get_the_id(), 'post_options', true );
					$ad_class = isset( $post_opts['sp_post'] ) ? ' sp-post' : '';
					?>
					<article<?php printf( '%s', $schema['container'] ); ?> id="post-<?php the_ID();?>" <?php post_class( $classes . $fclass . $lclass . $ad_class ); ?>>
                    <?php
	                    if ( $ad_class ) {
						    echo '<span class="sp-label-archive">' . get_option( 'pls_sp_label', __( 'Advertisement', 'newsplus') ) . '</span>';
						}
                    	if ( $card_style ) {
							echo '<div class="card-wrap">';
						}
						
						get_template_part( 'formats/format', get_post_format() );
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
						?>
						
						<div class="<?php echo esc_attr( $content_class ); ?>">
							<?php printf( '%s', $rows['row_1'] ); ?>
							
							<h2<?php printf( '%s', $schema['heading'] ); ?> class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							
							<?php printf( '%s', $rows['row_2'] );
							
							if ( ! get_option( 'pls_hide_excerpt' ) ) { ?>
								<p<?php printf( '%s', $schema['text'] ); ?> class="post-excerpt">
								<?php
								if ( 'true' == get_option( 'pls_use_word_length' ) ) {
									echo newsplus_short_by_word( get_the_excerpt(), get_option( 'pls_word_length', 20 ) );
								}
								else {
									echo newsplus_short( get_the_excerpt(), get_option( 'pls_char_length', 100 ) );
								} ?>
								</p>
							<?php
							}
							
							 printf( '%s', $rows['row_3'] );
							
							if ( $card_style ) {
								echo '</div>';
							}
						?>
					   
						</div><!-- /.entry-content -->
						
						</article><!-- #post-<?php the_ID();?> -->
					   
						<?php $count++;
                    
					endwhile; ?>
               
                </div><!-- .clear -->
                
				<?php
                if ( $custom_query->max_num_pages > 1 ) {
                ?>
                    <nav class="navigation pagination">
                        <h2 class="screen-reader-text"><?php esc_attr_e( 'Posts navigation', 'newsplus' ); ?></h2>
                        <div class="nav-links">
                        <?php
							echo paginate_links( array(
									'current' => max( 1, $paged ),
									'total' => $custom_query->max_num_pages,
									'prev_text' => esc_attr__( 'Previous page', 'newsplus' ),
									'next_text' => esc_attr__( 'Next page', 'newsplus' ),	
							));
                        ?>
                        </div><!-- /.nav-links -->
                    </nav><!-- /.navigation -->
                <?php
                }
			} // if have posts
			
			else {
				newsplus_no_posts();
			}
			
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
        
        endif;  // if category ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>