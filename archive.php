<?php
/**
 * The template for displaying Archive pages
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

get_header();
$full_width = get_option( 'pls_archive_fw' );
$archive_template = get_option( 'pls_archive_template', 'grid' );
?>
<div id="primary" class="site-content<?php if ( $full_width ) echo ' full-width'; ?>">
	<div class="primary-row">
        <div id="content" role="main">
			<?php show_breadcrumbs();

            if ( have_posts() ) : ?>

                <header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    if ( ! is_author() ) {
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    }
                ?>
                </header><!-- .page-header -->
                <?php
                if ( is_author() ) {
                    newsplus_author_bio();
                }
                get_template_part( 'content', $archive_template );

			endif; ?>

        </div><!-- #content -->
        <?php
        if ( 'true' != $full_width ) {
            newsplus_sidebar_b();
        }
        ?>
    </div><!-- .primary-row -->
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	if ( 'true' != $full_width ) {
		get_sidebar();
	}
}
get_footer(); ?>