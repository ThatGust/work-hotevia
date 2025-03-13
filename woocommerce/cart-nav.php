<?php
/**
 * WooCommerce cart nav in header
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

global $woocommerce; ?>
<ul class="cart-nav">
    <li class="welcome">
	<?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();

			if ( ! ( $current_user instanceof WP_User ) )
			 return;

			if ( $current_user->user_firstname )
				printf( __( 'Welcome, %s', 'newsplus' ), $current_user->user_firstname );

			elseif ( $current_user->display_name )
				printf( __( 'Welcome, %s', 'newsplus' ), $current_user->display_name );

			else
			 printf( __( 'Welcome, %s', 'newsplus' ), $current_user->user_login );
		}

		else {
			_e( 'Welcome, Guest', 'newsplus' );
		}
    ?>
    </li>
    <?php
    if ( is_user_logged_in() ) { ?>
        <li><a class="log-out" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e( 'Log out of your account', 'newsplus' ); ?>"><?php _e( 'Logout', 'newsplus' ); ?></a></li>
    <?php
    }

    else { ?>
        <li><a class="log-in" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id') ); ?>" title="<?php _e( 'Login or register for a new account', 'newsplus' ); ?>"><?php _e( 'Login / Register', 'newsplus' ); ?></a></li>
    <?php
    } ?>
    <li class="cart-status"><a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'newsplus' ); ?>"><?php printf( _n( '%d item - ', '%d items - ', 'newsplus', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); echo WC()->cart->get_cart_total(); ?></a></li>
</ul><!-- .account-nav -->