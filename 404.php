<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

get_header(); ?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
			<?php show_breadcrumbs(); ?>
            <article id="post-0" class="post error404 no-results not-found">
                <header class="page-header">
                    <h1 class="entry-title"><?php _e( 'Nothing found!', 'newsplus' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newsplus' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->
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