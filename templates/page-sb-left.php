<?php
/**
 * Template Name: Page - Sidebar left
 *
 * Description: A page template with left aligned sidebar.
 */

get_header(); ?>
<div id="primary" class="site-content">
    <div id="content" role="main">
    <?php show_breadcrumbs();
		$page_opts 		= get_post_meta( $posts[0]->ID, 'page_options', true );
		$hide_page_title = isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;

        if ( have_posts() ) :
			while ( have_posts() ) :
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
                if ( ! ( $hide_page_title || get_option( 'pls_hide_page_titles' ) ) ) {			
				   echo '<header class="page-header"><h1 class="entry-title">' . get_the_title() . '</h1></header>';
				}
				?>            
				<div class="entry-content">
					<?php
                    the_content();
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'newsplus' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile;
        else : ?>
			<article id="post-0" class="post no-results not-found">
                <header class="page-header">
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'newsplus' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newsplus' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
			</article><!-- #post-0 -->
        <?php endif; ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_sidebar();
get_footer(); ?>