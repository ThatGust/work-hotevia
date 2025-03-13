<?php
/**
 * header-default
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$logo_class = '';
$widget_class = ' right last';

if ( 'right' == get_option( 'pls_logo_align' ) ) {
	$logo_class = ' right last';
	$widget_class = '';
}

if ( 'none' !== get_option( 'pls_logo_align' ) ) { ?>
    <div class="brand column one-fourth<?php echo esc_attr( $logo_class ); ?>">
        <?php newsplus_logo(); ?>
    </div><!-- .column one-third -->
<?php }
else {
	if ( is_active_sidebar( 'default-header-col-1' ) ) : ?>
		<div class="column one-fourth">
			<?php dynamic_sidebar( 'default-header-col-1' ); ?>
		</div><!-- .column one-fourth -->
	<?php endif;
}

if ( is_page() ) {
	$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
	$hwa_usage = isset( $page_opts['hwa_usage'] ) ? $page_opts['hwa_usage'] : 'default-headerbar';
}

elseif ( is_single() ) {
	$post_opts = get_post_meta( $posts[0]->ID, 'post_options', true );
	$hwa_usage = isset( $post_opts['hwa_usage'] ) ? $post_opts['hwa_usage'] : 'default-headerbar';
}

if ( is_page() || is_single() ) {
	if ( is_active_sidebar( $hwa_usage )) : ?>
        <div class="column header-widget-area<?php echo esc_attr( $widget_class ); ?>">
        <?php dynamic_sidebar( $hwa_usage ); ?>
        </div><!-- .header-widget-area -->
	<?php endif;
}

else {
	if ( is_active_sidebar( 'default-headerbar' ) ) : ?>
		<div class="column header-widget-area<?php echo esc_attr( $widget_class ); ?>">
		<?php dynamic_sidebar( 'default-headerbar' ); ?>
		</div><!-- .header-widget-area -->
	<?php endif;
} ?>