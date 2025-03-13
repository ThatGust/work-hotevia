<?php
/**
 * The template for displaying Search Results pages
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3 
 */

get_header();
$archive_template = get_option( 'pls_archive_template', 'grid' );
?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
		<?php
        show_breadcrumbs();
		get_template_part( 'content', $archive_template );
		?>
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