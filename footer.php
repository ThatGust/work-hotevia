<?php
/**
 * The template for displaying footer.
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

global $post; ?>
            </div><!-- .row -->
        </div><!-- #main .wrap -->
    </div><!-- #main -->
    <?php
    if ( is_active_sidebar( 'widget-area-after-content' ) ) : ?>
        <div id="widget-area-after-content">
            <div class="wrap">
                <?php dynamic_sidebar( 'widget-area-after-content' ); ?>
            </div><!--.wrap -->
        </div><!-- #widget-area-before-content -->
    <?php endif;
    
    /* Check if the user has opted to hide widget area */
    if ( is_page() ) {
        $page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
        $hide_secondary = isset( $page_opts[ 'hide_secondary' ] ) ? $page_opts[ 'hide_secondary' ] : '';
    } // is page
    
    elseif ( is_single() ) {
        $post_opts = get_post_meta( $posts[0]->ID, 'post_options', true );
        $hide_secondary = isset( $post_opts[ 'hide_secondary' ] ) ? $post_opts[ 'hide_secondary' ] : '';
    } // is single
    
    else {
        $hide_secondary = get_option( 'pls_hide_secondary' );
    }
    
    if ( 'true' != $hide_secondary ) :
        $cols = get_option( 'pls_footer_cols', 4 );
        ?>
        <div id="secondary" class="columns-<?php echo esc_attr( $cols ); ?>" role="complementary">
            <div class="wrap clearfix">
                <div class="row">
                <?php				
                    for( $i = 1; $i <= $cols; $i++ ) {
                        if ( is_active_sidebar( 'secondary-column-' . $i ) ) {
                            dynamic_sidebar( 'secondary-column-' . $i );
                        }
                    }						
                ?>
                </div><!-- /.row -->
            </div><!-- #secondary .wrap -->
        </div><!-- #secondary -->
    <?php endif; // hide secondary
    ?>
    <footer id="footer">
        <div class="wrap clear">
            <div class="notes-left"><?php echo stripslashes( get_option( 'pls_footer_left', esc_attr__( 'Footer notes left', 'newsplus' ) ) ); ?></div><!-- .notes-left -->
            <div class="notes-right"><?php echo stripslashes( get_option( 'pls_footer_right', esc_attr__( 'Footer notes right', 'newsplus' ) ) ); ?></div><!-- .notes-right -->
        </div><!-- #footer wrap -->
    </footer><!-- #footer -->
    
    <div class="fixed-widget-bar fixed-left">
        <?php
        if ( is_active_sidebar( 'fixed-widget-bar-left' ) ) {
            dynamic_sidebar( 'fixed-widget-bar-left' );
        }
        ?>
    </div><!-- /.fixed-left -->
    
    <div class="fixed-widget-bar fixed-right">
        <?php
        if ( is_active_sidebar( 'fixed-widget-bar-right' ) ) {
            dynamic_sidebar( 'fixed-widget-bar-right' );
        }
        ?>
    </div><!-- /.fixed-right -->

</div> <!-- #page -->

<div class="scroll-to-top"><a href="#" title="<?php _e( 'Scroll to top', 'newsplus' ); ?>"><span class="sr-only"><?php _e( 'scroll to top', 'newsplus' ); ?></span></a></div><!-- .scroll-to-top -->
<?php wp_footer(); ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-65422050-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-65422050-1');
</script>


</body>
</html>