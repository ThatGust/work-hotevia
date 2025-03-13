<?php
/**
 * The template for displaying all pages.
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

get_header();
// Full width title header
$exclude = get_option( 'pls_overlay_exclude', '' );
if ( '' !== $exclude ) {
    $exclude = explode( ',', $exclude );
}
if ( 'full' == get_option( 'pls_page_header', 'inline' ) ) {
?>
    <header class="entry-header newsplus full-header single-meta">
        <?php
        show_breadcrumbs();
        echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
        ?>
    </header>
    <?php
}
?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
			<?php
            if ( 'inline' == get_option( 'pls_page_header', 'inline' )  || ( 'overlay' == get_option( 'pls_page_header', 'inline' ) && ( is_array( $exclude ) && is_page( $exclude ) ) ) ) {
                show_breadcrumbs();
            }
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    $page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
                    $hide_page_title = isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
                        <?php
                        if ( 'inline' == get_option( 'pls_page_header', 'inline' ) || ( 'overlay' == get_option( 'pls_page_header', 'inline' ) && ( is_array( $exclude ) && is_page( $exclude ) ) ) ) {
                            $title = get_the_title();
                            if ( ! ( $hide_page_title || get_option( 'pls_hide_page_titles' ) ) && '' !== $title ) {
                               echo '<header class="page-header"><h1 class="entry-title">' . esc_html( $title ) . '</h1></header>';
                            }
                        }
                        ?>
                        <div class="entry-content">
                            <?php
                            the_content();
                            wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'newsplus' ), 'after' => '</div>' ) ); ?>
                        </div><!-- .entry-content -->
						<!-- Google DFP --><br>
						<!-- /22928866073/banner-final-articulo -->
<div id='div-gpt-ad-1686606309375-0' style='min-width: 728px; min-height: 90px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1686606309375-0'); });
  </script>
</div>
						<!-- Google DFP -->
                    </article><!-- #post -->
                    <?php
                    comments_template( '', true );
                endwhile;
            else :
                newsplus_no_posts();
            endif; ?>
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