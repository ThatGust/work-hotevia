<?php
/**
 * header-slim
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

$schema = newsplus_schema( get_option( 'pls_schema' ) );
$pls_disable_resp_css = get_option( 'pls_disable_resp_css' );
?>
<div class="site-header header-slim">
    <div class="wrap clearfix">
        <div class="brand">
			<?php
            newsplus_logo();
            ?>
        </div><!-- .brand -->
        
        <nav<?php printf( '%s', $schema['nav'] ); ?>  id="main-nav" class="primary-nav inline-nav<?php if ( 'true' == get_option( 'pls_disable_resp_menu' ) ) echo ' do-not-hide'; ?>">
			
			<?php
			$pls_html_main_menu = get_option( 'pls_html_main_menu' );
            if ( '' != $pls_html_main_menu ) {
				echo do_shortcode( stripslashes( $pls_html_main_menu ) );
			}
			else {
				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu clearfix', 'container' => false,'fallback_cb' => 'menu_reminder' ) );
			}
            
            if ( 'true' != $pls_disable_resp_css ) {
				if ( 'true' != get_option( 'pls_disable_resp_menu' ) ) { ?>
                    <h3 class="menu-button-2"><span class="screen-reader-text"><?php esc_attr_e( 'Menu', 'newsplus' ); ?></span><span class="toggle-icon"><span class="bar-1"></span><span class="bar-2"></span><span class="bar-3"></span></span></h3>
                    <?php
				}
            } ?> 
                       
        </nav><!-- #main-nav -->        
    </div><!-- .wrap -->
</div><!-- .header-slim -->

<?php
if ( 'true' != $pls_disable_resp_css ) {
	if ( 'true' != get_option( 'pls_disable_resp_menu' ) ) { ?>
        <div id="responsive-menu">
            <nav<?php printf( '%s', $schema['nav'] ); ?> class="menu-drop"></nav><!-- /.menu-drop --> 
        </div>
        <?php
	}
}
?>