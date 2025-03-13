<?php
/**
 * header-full-width
 *
 * @package NewsPlus
 * @since 1.0
 * @version 4.0.3
 */

$pls_logo_align = get_option( 'pls_logo_align', 'left' );
$logo_class = ( 'none' !== $pls_logo_align ) ? ' text-' . $pls_logo_align : ''; ?>

<div class="brand column full<?php echo esc_attr( $logo_class ); ?>">
	<?php
    if ( 'none' !== $pls_logo_align ) {
		newsplus_logo();
    }
    else {
		if ( is_active_sidebar( 'default-header-col-1' ) ) :
			dynamic_sidebar( 'default-header-col-1' );
		endif;
    } ?>
</div><!-- .column full -->