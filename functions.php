<?php
/**
 * NewsPlus functions and definitions
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Sets up theme defaults and registers the various WordPress features that
 * NewsPlus supports.
 */
function newsplus_setup() {

	// Makes theme available for translation.
	load_theme_textdomain( 'newsplus', get_template_directory() . '/languages' );

	// Add visual editor stylesheet support
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Add post formats
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

	// Add support for html5 search form
	add_theme_support( 'html5', array( 'search-form' ) );

	add_theme_support( "title-tag" );

	// Add navigation menus
	register_nav_menus( array(
		'secondary'	=> __( 'Secondary Top Menu', 'newsplus' ),
		'primary'	=> __( 'Primary Menu', 'newsplus' )
	) );

	// Add support for custom background and set default color
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
		'default-image' => ''
	) );

	// Add suport for post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Declare theme as WooCommerce compatible
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
add_action( 'after_setup_theme', 'newsplus_setup' );


/**
 * Include widgets and theme option files
 */
require_once( 'includes/page-options.php' );
require_once( 'includes/post-options.php' );
require_once( 'includes/theme-admin-options.php' );
require_once( 'includes/breadcrumbs.php' );
require_once( 'includes/theme-customizer.php' );
require_once( 'includes/class-tgm-plugin-activation.php' );
require_once( 'woocommerce/woocommerce-hooks.php' );
require_once( 'includes/page-builder-layouts.php' );


/**
 * Enqueue scripts and styles for front-end.
 */
function newsplus_scripts_styles() {
	global $post, $wp_styles;

	/*
	 * Add JavaScript for threaded comments when required
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Add JavaScript plugins required by the theme
	 */
	wp_enqueue_script( 'jquery' );

	// For contact page template
	if( is_page_template( 'templates/page-contact.php' ) ) {
		wp_register_script( 'jq-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '', true );
		wp_enqueue_script( 'contact-form', get_template_directory_uri() . '/js/contact-form.js', array( 'jq-validate' ), '', true );
	}

	// Masonry
	if ( get_option( 'pls_enable_masonry' ) &&
			(
				( 	( is_home() || is_archive() || is_search() )
					&& 'grid' == get_option( 'pls_archive_template' )
				)
				|| is_page_template( 'templates/archive-2col.php' )
				|| is_page_template( 'templates/archive-3col.php' )
				|| is_page_template( 'templates/archive-4col.php' )
				|| is_page_template( 'templates/blog-grid.php' )
				|| ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'insert_posts') )
			)
		) {
			wp_enqueue_script( 'jquery-masonry' );
	}

	// Load social sharing scripts in footer
	if( is_single() && 'true' == get_option( 'pls_ss_sharing' ) ) {
		$protocol = is_ssl() ? 'https' : 'http';
		if( 'true' == get_option( 'pls_ss_tw' ) )
			wp_enqueue_script( 'twitter_share_script', $protocol . '://platform.twitter.com/widgets.js', '', '', true );
		if( 'true' == get_option( 'pls_ss_gp' ) )
			wp_enqueue_script( 'google_plus_script', $protocol . '://apis.google.com/js/plusone.js', '', '', true );
		if( 'true' == get_option( 'pls_ss_pint' ) )
			wp_enqueue_script( 'pinterest_script', $protocol . '://assets.pinterest.com/js/pinit.js', '', '', true );
		if( 'true' == get_option( 'pls_ss_ln' ) )
			wp_enqueue_script( 'linkedin_script', $protocol . '://platform.linkedin.com/in.js', '', '', true );
		if( 'true' == get_option( 'pls_ss_vk' ) )
			wp_enqueue_script( 'vk_script', $protocol . '://vkontakte.ru/js/api/share.js?9' );
		if( 'true' == get_option( 'pls_ss_yandex' ) )
			wp_enqueue_script( 'yandex_script', $protocol . '://yandex.st/share/share.js', '', '', true );
	}

	// Custom JavaScript file used to initialize plugins
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '', true );

	// Localize responsivene menu check for custom.js file
	$trans_arr = array(
		'top_bar_sticky'	=> get_option( 'pls_top_bar_sticky', false ),
		'main_bar_sticky'	=> get_option( 'pls_main_bar_sticky', false ),
		'expand_menu_text'	=> __( 'Expand or collapse submenu', 'newsplus' ),
		'header_style'		=> get_option( 'pls_header_style', false ),
		'mobile_sticky'		=> get_option( 'pls_disable_sticky_on_mobile', false ),
		'collapse_lists' 	=> get_option( 'pls_collapse_lists', false )
	);

	if ( 'true' !== get_option( 'pls_disable_resp_css' ) ) {
		if ( 'true' !== get_option( 'pls_disable_resp_menu' ) ) {
			$trans_arr[ 'enable_responsive_menu' ] = 'true';
		}
	}

	wp_localize_script( 'custom', 'ss_custom', $trans_arr );

	/*
	 * Google font CSS file
	 *
	 * The use of custom Google fonts can be configured inside Theme Options Panel.
	 */

	if ( 'true' !== get_option( 'pls_disable_custom_font', false ) && '' !== get_option( 'pls_font_family', '' ) ) {
		$query_args = array(
			'family' => get_option( 'pls_font_family' ),
			'subset' => get_option( 'pls_font_subset' ),
		);
		wp_enqueue_style( 'newsplus-fonts-deprecated', add_query_arg( $query_args, "https://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Load stylesheets required by the theme
	 */
	if ( ! class_exists( 'NewsPlus_Shortcodes' ) ) {
		if ( ! get_option( 'pls_fa', false ) ) {
			wp_enqueue_style( 'newsplus-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '' );
		}
		wp_enqueue_style( 'newsplus-shortcodes', get_template_directory_uri() . '/css/newsplus-shortcodes.css', array(), '' );
	}
	
	// Main stylesheet
	wp_enqueue_style( 'newsplus-style', get_stylesheet_uri() );

	// Internet Explorer specific stylesheet
	wp_enqueue_style( 'newsplus-ie', get_template_directory_uri() . '/css/ie.css', array(), '' );
	$wp_styles->add_data( 'newsplus-ie', 'conditional', 'lt IE 9' );

	// WooCommerce Custom stylesheet
	if ( class_exists( 'woocommerce' )  ) {
		wp_register_style( 'woocommerce-custom', get_template_directory_uri() . '/woocommerce/woocommerce-custom.css', array(), '' );
		wp_enqueue_style( 'woocommerce-custom' );
	}

	// RTL stylesheet
	if ( 'true' == get_option( 'pls_enable_rtl_css' ) || is_rtl() ) {
		wp_register_style( 'rtl', get_template_directory_uri() . '/rtl.css', array(), '' );
		wp_enqueue_style( 'rtl' );
	}

	// Responsive stylesheet
	if ( 'true' != get_option( 'pls_disable_resp_css' ) ) {
		wp_register_style( 'newsplus-responsive', get_template_directory_uri() . '/responsive.css', array(), '' );
		wp_enqueue_style( 'newsplus-responsive' );

		// Load RTL responsive only if RTL version enabled
		if ( 'true' == get_option( 'pls_enable_rtl_css' ) || is_rtl() ) {
			wp_register_style( 'newsplus-rtl-responsive', get_template_directory_uri() . '/rtl-responsive.css', array(), '' );
			wp_enqueue_style( 'newsplus-rtl-responsive' );
		}
	}

	// Color schemes
	if ( 'default' != get_option( 'pls_color_scheme', 'default' ) && 'customizer' != get_option( 'pls_color_scheme', 'default' ) ) {
		wp_register_style( 'newsplus-color-scheme', get_template_directory_uri() . '/css/schemes/' . get_option( 'pls_color_scheme', 'default' ) . '.css', array(), '' );
		wp_enqueue_style( 'newsplus-color-scheme' );
	}

	// User stylesheet
	if ( 'true' != get_option( 'pls_disable_user_css' )  ) {
		wp_register_style( 'newsplus-user', get_template_directory_uri() . '/user.css', array(), '' );
		wp_enqueue_style( 'newsplus-user' );
	}

}
add_action( 'wp_enqueue_scripts', 'newsplus_scripts_styles', '20' );

/**
 * Add layout width and additional CSS in head node
 */
function newsplus_custom_css() {
	global $posts;
	$width = floatval( get_option( 'pls_layout_width', 1160 ) );
	$gutter = floatval( get_option( 'pls_gutter', 24 ) );
	$font_size = floatval( get_option( 'pls_base_font_size', 13 ) );
	$shop_columns = floatval( get_option( 'woocommerce_catalog_columns', 3 ) );
	$cust_bg = '';
	if ( is_page() ) {
		$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
		$cust_bg = isset( $page_opts['cust_bg'] ) ? $page_opts['cust_bg'] : '';
	} elseif ( is_single() ) {
		$post_opts = get_post_meta( $posts[0]->ID, 'post_options', true );
		$cust_bg = isset( $post_opts['cust_bg'] ) ? $post_opts['cust_bg'] : '';
	}
	?>
		<style type="text/css">
		<?php
		echo '.sp-label-archive { color:' . get_option( 'pls_sp_label_clr', '#000000' ) . ';background:' . get_option( 'pls_sp_label_bg', '#ffffff' ) . ';}.sp-post .entry-content, .sp-post .card-content, .sp-post.entry-classic{background:' . get_option( 'pls_sp_bg', '#fff9e5' ) . ';}';
		if ( $cust_bg ) {
			echo '#main {background:' . esc_attr( $cust_bg ) . ';}';
		}
		if ( 3 != $shop_columns ) {
			echo '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width:' . floatval( 100 / $shop_columns ) . '%; }';
		}
		if ( '24' != $gutter ) {
			echo '.main-row,.two-sidebars .primary-row { margin: 0 -' . intval( $gutter / 2 ) . 'px; }';
			echo '#primary:not(.full-width), #container, #sidebar, .two-sidebars #content, .two-sidebars #sidebar-b, .entry-header.full-header, .ad-area-above-content { padding: 0 ' . intval( $gutter / 2 ) . 'px; }';
		}
		if ( $font_size >= 11 && $font_size <= 18 && $font_size != 13 ) { ?>
		body {
			font-size: <?php echo esc_attr( $font_size ) . 'px'; ?>;
		}
		<?php }
		if ( $width >= 800 && $width <= 1600 ) { ?>
		#page {
			max-width: <?php echo esc_attr( $width ) . 'px'; ?>;
		}
		.wrap,
		.primary-nav,
		.is-boxed .top-nav,
		.is-boxed .header-slim.site-header {
			max-width: <?php echo floatval( $width - 48 ) . 'px'; ?>;
		}
		@media only screen and (max-width: <?php echo floatval( $width + 48 ) . 'px'; ?>) {
			.wrap,
			.primary-nav,
			.is-boxed .top-nav,
			.is-boxed .header-slim.site-header,
			.is-stretched .top-nav .wrap {
				max-width: calc(100% - 48px);
			}
			.is-boxed .sticky-nav,
			.is-boxed .header-slim.sticky-nav,
			.is-boxed #responsive-menu.sticky-nav {
				max-width: calc(97.5% - 48px);
			}
		}
		<?php }
		if ( ( is_single() && has_post_thumbnail() && 'overlay' == get_option( 'pls_sng_header', 'inline' ) ) || ( is_page() && has_post_thumbnail() && 'overlay' == get_option( 'pls_page_header', 'inline' ) ) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
       		$img = isset( $img_src ) && is_array( $img_src ) ? $img_src[0] : '';
       		echo '.single-overlay-header {
       			background-image: url(' . $img . ');
       		}';
		}
		if ( get_option( 'pls_user_css', '' ) ) {
			echo stripslashes( strip_tags( get_option( 'pls_user_css', '' ) ) );
		}
		?>
		</style>
	<?php
}
add_action( 'wp_head', 'newsplus_custom_css' );

/**
 * Enqueue html5 script in head section for old browsers
 */
function html5_js() {
	$protocol = is_ssl() ? 'https' : 'http'; ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_attr( $protocol ); ?>://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<?php
}
add_action( 'wp_head', 'html5_js' );

/**
 * Allow custom head markup to be inserted by user from Theme Options
 */
function custom_head_code() {
	$head_code = get_option( 'pls_custom_head_code', '' );
	if ( '' != $head_code ) {
		echo stripslashes( $head_code );
	}
}
add_action( 'wp_head', 'custom_head_code');


/**
 * Register theme widget areas
 */
function newsplus_widget_areas() {

	register_sidebar( array(
		'name' 			=> __( 'Default Sidebar A', 'newsplus' ),
		'id' 			=> 'default-sidebar',
		'description' 	=> __( 'The main sidebar', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</aside>",
		'before_title' 	=> '<h3 class="sb-title">',
		'after_title' 	=> '</h3>',
		'handler'		=> 'sidebar'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Default Sidebar B', 'newsplus' ),
		'id' 			=> 'sidebar-b',
		'description' 	=> __( 'Additional sidebar for two sidebar layouts', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</aside>",
		'before_title' 	=> '<h3 class="sb-title">',
		'after_title' 	=> '</h3>',
		'handler'		=> 'sidebar'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Top widget area', 'newsplus' ),
		'id' 			=> 'top-widget-area',
		'description' 	=> __( 'Top widget area', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="twa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="twa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Fixed widget area left', 'newsplus' ),
		'id' 			=> 'fixed-widget-bar-left',
		'description' 	=> __( 'Fixed widget area on left side', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="fwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="fwa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Fixed widget area right', 'newsplus' ),
		'id' 			=> 'fixed-widget-bar-right',
		'description' 	=> __( 'Fixed widget area on right side', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="fwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="fwa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Default Header Bar', 'newsplus' ),
		'id' 			=> 'default-headerbar',
		'description' 	=> __( 'Header Bar', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="hwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="hwa-title">',
		'after_title' 	=> '</h3>',
		'handler'		=> 'headerbar'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Default Header Column 1', 'newsplus' ),
		'id' 			=> 'default-header-col-1',
		'description' 	=> __( 'Header column 1', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="hwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="hwa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Default Header Column 2', 'newsplus' ),
		'id' 			=> 'default-header-col-2',
		'description' 	=> __( 'Header column 2', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="hwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="hwa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Default Header Column 3', 'newsplus' ),
		'id' 			=> 'default-header-col-3',
		'description' 	=> __( 'Header column 3', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="hwa-wrap %2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="hwa-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Widget area before content', 'newsplus' ),
		'id' 			=> 'widget-area-before-content',
		'description' 	=> __( 'Widget area before content', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="%2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Widget area after content', 'newsplus' ),
		'id' 			=> 'widget-area-after-content',
		'description' 	=> __( 'Widget area after content', 'newsplus' ),
		'before_widget' => '<aside id="%1$s" class="%2$s">',
		'after_widget'	=> "</aside>",
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>'
	) );

	$cols = get_option( 'pls_footer_cols', 4 );
	for( $i = 1; $i <= $cols; $i++ ) {
		register_sidebar( array(
			'name' 			=> sprintf( __( 'Default Secondary Column %s', 'newsplus' ), $i ),
			'id' 			=> 'secondary-column-' . $i,
			'description' 	=> __( 'Secondary Column', 'newsplus' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> "</aside>",
			'before_title' 	=> '<h3 class="sc-title">',
			'after_title' 	=> '</h3>',
		) );
	}

	// Register exclusive widget areas for each page
	$mypages = get_pages();
	foreach ( $mypages as $pp ) {
		$page_opts = get_post_meta( $pp->ID, 'page_options', true );
		$sidebar_a = isset( $page_opts['sidebar_a'] ) ? $page_opts['sidebar_a'] : '';
		$sidebar_h = isset( $page_opts['sidebar_h'] ) ? $page_opts['sidebar_h'] : '';

		if ( 'true' == $sidebar_h ){
			register_sidebar( array(
				'name' 			=> sprintf( __( '%1$s Header Bar', 'newsplus' ), $pp->post_title ),
				'id' 			=> $pp->ID . '-headerbar',
				'description' 	=> 'Header Bar',
				'before_widget' => '<aside id="%1$s" class="hwa-wrap %2$s">',
				'after_widget' 	=> "</aside>",
				'before_title' 	=> '<h3 class="hwa-title">',
				'after_title' 	=> '</h3>',
				'handler'		=> 'headerbar'
			) );
		};
		if ( 'true' == $sidebar_a ){
			register_sidebar( array(
				'name' 			=> sprintf( __( '%1$s Sidebar', 'newsplus' ), $pp->post_title ),
				'id' 			=> $pp->ID . '-sidebar',
				'description' 	=> 'Sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> "</aside>",
				'before_title' 	=> '<h3 class="sb-title">',
				'after_title' 	=> '</h3>',
				'handler'		=> 'sidebar'
			) );
		}
	} // foreach
}
add_action( 'widgets_init', 'newsplus_widget_areas' );


/**
 * Add body class to the theme depending upon options and templates
 */
function newsplus_body_class( $classes ) {

	if ( ( 'ac' == get_option( 'pls_sb_pos', 'ca' ) || is_page_template( 'templates/page-sb-left.php' ) ) && ! ( is_page_template( 'templates/page-sb-right.php' ) || is_page_template( 'templates/page-full.php' )  ) ) {
		$classes[] = 'layout-ac';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'newsplus-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( 'stretched' == get_option( 'pls_layout' ) ) {
		$classes[] = 'is-stretched';
	}
	else {
		$classes[] = 'is-boxed';
	}

	if ( 'true' == get_option( 'pls_enable_rtl_css' ) || is_rtl() ) {
		$classes[] = 'rtl rtl-enabled';
	}

	if ( 'true' == get_option( 'pls_social_sticky' ) ) {
		$classes[] = 'np-social-sticky';
	}

	$classes[] = 'split-' . esc_attr( get_option( 'pls_sb_ratio', '70-30' ) );

	// Sidebar layout classes
	if ( is_single() && 'post' == get_post_type() ) {
		global $post;
		$post_opts = get_post_meta( $post->ID, 'post_options', true );
		$sng_layout = ( isset( $post_opts['sng_layout'] ) && 'global' != $post_opts['sng_layout'] ) ? $post_opts['sng_layout'] : get_option( 'pls_sb_pos', 'ca' );
		$post_full_width 	= ( isset( $post_opts['post_full_width'] ) ) ? $post_opts['post_full_width'] : '';

		if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
			if ( ! $post_full_width ) {
				if ( ! ( $sng_layout == 'ac' || $sng_layout == 'ca' ) ) {
					$classes[] = 'two-sidebars';
				}
			}
		}

		$classes[] = 'layout-' . esc_attr( $sng_layout );
	}

	else {
		if ( ! ( is_single() || is_post_type_archive( 'product' ) || is_tax( get_object_taxonomies( 'product' ) ) || is_page_template( 'templates/archive-3col.php' ) || is_page_template( 'templates/archive-4col.php' ) || is_page_template( 'templates/page-full.php' ) || is_page_template( 'templates/page-sb-left.php' ) || is_page_template( 'templates/page-sb-right.php' ) ) ) {
			$pls_sb_pos = get_option( 'pls_sb_pos', 'ca' );
			if ( ! ( $pls_sb_pos == 'ac' || $pls_sb_pos == 'ca' || $pls_sb_pos == 'no-sb' ) ) {
				$classes[] = 'two-sidebars';
			}
			$classes[] = 'layout-' . esc_attr( get_option( 'pls_sb_pos', 'ca' ) );
		}
	}

	// Color scheme class
	$classes[] = 'scheme-' . get_option( 'pls_color_scheme', 'customizer' );

	return $classes;
}
add_filter( 'body_class', 'newsplus_body_class' );

/**
 * next/previous navigation for pages and archives
 */
if ( ! function_exists( 'newsplus_content_nav' ) ) :
function newsplus_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
	else {
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'newsplus' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'newsplus' ) ); ?></div>
		</nav><!-- #<?php echo esc_attr( $html_id ); ?> .navigation -->
	<?php endif;
	}
}
endif;

/**
 * Social Sharing feature on single posts
 */
if ( ! function_exists( 'ss_sharing' ) ) :
	function ss_sharing() {

		$protocol = is_ssl() ? 'https' : 'http';
		$share_link = get_permalink();
		$share_title = get_the_title();
		$out = '';
		if ( 'true' == get_option( 'pls_ss_fb' ) ) {
			echo '<div class="fb-share-button" data-href="' . esc_url( $share_link ) . '" data-layout="button_count"></div>';
		}
		if ( 'true' == get_option( 'pls_ss_tw' ) ) {
			if ( get_option( 'pls_ss_tw_usrname', false ) ) {
				echo '<div class="ss-sharing-btn"><a href="' . $protocol . '://twitter.com/share" class="twitter-share-button" data-url="' . esc_url( $share_link ) . '"  data-text="' . esc_attr( $share_title ) . '" data-via="' . get_option( 'pls_ss_tw_usrname' ) . '">Tweet</a></div>';
			}
			else {
				echo '<div class="ss-sharing-btn"><a href="' . $protocol . '://twitter.com/share" class="twitter-share-button" data-url="' . esc_url( $share_link ) . '"  data-text="' . esc_attr( $share_title ) . '">Tweet</a></div>';
			}
		}
		if ( 'true' == get_option( 'pls_ss_gp' ) ) {
			echo '<div class="ss-sharing-btn"><div class="g-plusone" data-size="medium" data-href="' . esc_url( $share_link ) . '"></div></div>';
		}
		if ( 'true' == get_option( 'pls_ss_pint' ) ) {
			global $post;
			setup_postdata( $post );
			if ( has_post_thumbnail( $post->ID ) ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '', '' );
				$image = isset( $src ) && is_array( $src ) ? $src[0] : '';
			}
			else
				$image = '';
			$description = 'Next%20stop%3A%20Pinterest';
			$share_link = get_permalink();
			echo '<div class="ss-sharing-btn"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/?url=' . esc_url( $share_link ) . '&amp;media=' . $image . '&amp;description=' . $description . '" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="PinIt" /></a></div>';
			wp_reset_postdata();
		}
		if ( 'true' == get_option( 'pls_ss_ln' ) ) {
			echo '<div class="ss-sharing-btn"><script type="IN/Share" data-url="' . esc_url( $share_link ) . '" data-counter="right"></script></div>';
		}
		if ( 'true' == get_option( 'pls_ss_vk' ) ) {
			global $post;
			setup_postdata( $post );
			if ( has_post_thumbnail( $post->ID ) ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '', '' );
				$image = isset( $src ) && is_array( $src ) ? $src[0] : '';
			}
			else
				$image = '';
			$description = strip_tags( get_the_excerpt() );
			echo '<div class="ss-sharing-btn">
						<script type="text/javascript">
						document.write(VK.Share.button({
						url: "' . esc_url( $share_link ) . '",
						title: "' . esc_attr( $share_title ) . '",
						description: "' . $description . '",
						image: "' . $image . '",
						noparse: true
						}));
						</script>
                    </div>';
		}
		if ( 'true' == get_option( 'pls_ss_yandex' ) ) {
			echo '<div class="ss-sharing-btn"><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru" data-yashareTheme="counter"></div></div>';
		}

		if ( 'true' == get_option( 'pls_ss_reddit' ) ) {
			echo "<a href=\"//www.reddit.com/submit\" onclick=\"window.location = '//www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false\"> <img src=\"//www.redditstatic.com/spreddit7.gif\" alt=\"submit to reddit\" border=\"0\" /> </a>";
		}
	}
endif;

/**
 * Load FaceBook script in footer
 */
function ss_fb_script() {

	if ( is_single() && ( 'true' == get_option( 'pls_ss_sharing' ) ) && ( 'true' == get_option( 'pls_ss_fb' ) ) ) { ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php }
}
add_action( 'wp_footer', 'ss_fb_script' );

/**
 * Add FaceBook Open Graph Meta Tags on single post
 */
function add_facebook_open_graph_tags() {

	if ( ( is_single() && get_option( 'pls_ss_sharing', false ) && get_option( 'pls_ss_fb', false ) ) || ( is_single() && get_option( 'pls_show_social_btns', false ) && in_array( 'facebook', get_option( 'pls_social_btns' ) ) ) ) {
		global $post;
		setup_postdata( $post );
		if ( has_post_thumbnail( $post->ID ) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '', '' );
			$image = isset( $src ) && is_array( $src ) ? $src[0] : '';
		}
		else
			$image = '';
		?>
		<meta property="og:title" content="<?php echo strip_tags( get_the_title() ); ?>"/>
		<meta property="og:type" content="article"/>
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>"/>
		<meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>"/>
		<meta property="og:description" content="<?php echo strip_tags( get_the_excerpt() ); ?>"/>
		<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
		<?php wp_reset_postdata();
	}
}
add_action( 'wp_head', 'add_facebook_open_graph_tags', 99 );

/**
 * Add FaceBook OG xmlns in html tag
 */
function add_og_xml_ns( $out ) {

	$protocol = is_ssl() ? 'https' : 'http';
	if ( ( is_single() && get_option( 'pls_ss_sharing', false ) && get_option( 'pls_ss_fb', false ) ) || ( is_single() && get_option( 'pls_show_social_btns', false ) && in_array( 'facebook', get_option( 'pls_social_btns' ) ) ) ) {
		return $out . ' xmlns:og="' . $protocol . '://ogp.me/ns#" xmlns:fb="' . $protocol . '://www.facebook.com/2008/fbml"';
	}
	else
		return $out;
}
add_filter( 'language_attributes', 'add_og_xml_ns' );

/**
 * Enable short codes inside Widgets
 */
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');


/**
 * Add span tag to post count of categories and archives widget
 */
function cats_widget_postcount_filter( $out ) {
	$out = str_replace( ' (', '<span class="count">(', $out );
	$out = str_replace( ')', ')</span>', $out );
	return $out;
}
add_filter( 'wp_list_categories', 'cats_widget_postcount_filter' );

function archives_widget_postcount_filter( $out ) {
	$out = str_replace( '&nbsp;(', '<span class="count">(', $out );
	$out = str_replace( ')', ')</span>', $out );
	return $out;
}
add_filter('get_archives_link', 'archives_widget_postcount_filter');

/**
 * Assign appropriate heading tag for blog name (SEO improvement)
 */
if ( ! function_exists( 'site_header_tag' ) ) :
	function site_header_tag( $tag_type ) {
		if ( is_front_page() ) {
			$open_tag = '<h1 class="site-title">';
			$close_tag = '</h1>';
		}
		elseif ( is_archive() || is_page_template( 'templates/archive-2col.php' ) || is_page_template( 'templates/archive-3col.php' ) || is_page_template( 'templates/archive-4col.php' ) || is_page_template( 'templates/blog-classic.php' ) || is_page_template( 'templates/blog-list.php' ) || is_page_template( 'templates/blog-grid.php' ) ) {
			$open_tag = '<h3 class="site-title">';
			$close_tag = '</h3>';
		}
		else {
			$open_tag = '<h4 class="site-title">';
			$close_tag = '</h4>';
		}
		if ( 'open' == $tag_type )
			printf( '%s', $open_tag );
		if ( 'close' == $tag_type )
			printf( '%s', $close_tag );
	}
endif;


/**
 * Generate site name and logo in header area
 */
if ( ! function_exists( 'newsplus_logo' ) ) :
	function newsplus_logo() {

		$schema = newsplus_schema( get_option( 'pls_schema' ) );

		if ( ! get_option( 'pls_logo_check', false ) ) {

			site_header_tag( 'open' );
			printf( '<a%s href="%s" title="%s" rel="home">%s</a>',
				$schema['url'],
				esc_url( home_url( '/' ) ),
				esc_attr( get_bloginfo( 'name' ) ),
				'' != get_option( 'pls_custom_title' ) ? get_option( 'pls_custom_title' ) : get_bloginfo( 'name' )
			);
			site_header_tag( 'close' );

			if ( ! get_option( 'pls_hide_desc', false ) ) {
				echo '<span class="site-description">' . get_bloginfo( 'description' ) . '</span>';
			}
		}

		else {
			$logo_1x = get_option( 'pls_logo', get_template_directory_uri() . '/images/logo.png' );
			$logo_2x = get_option( 'pls_logo_retina', get_template_directory_uri() . '/images/logo@2x.png' );
			site_header_tag( 'open' );
			printf( '<a%1$s href="%2$s" title="%3$s" rel="home"><img src="%4$s" srcset="%5$s" alt="%3$s" /></a>',
				$schema['url'],
				esc_url( home_url( '/' ) ),
				esc_attr( get_bloginfo( 'name' ) ),
				esc_url( $logo_1x ),
				esc_url( $logo_1x ) . ' 1x, ' . esc_url( $logo_2x ) . ' 2x'
			);
			site_header_tag( 'close' );
		}
	}
endif;

/**
 * Funtion to shorten any text by characters
 */
if ( ! function_exists( 'newsplus_short' ) ) :
	function newsplus_short( $text, $limit ) {
		$chars_limit = intval( $limit );
		$chars_text = strlen( $text );
		if ( $chars_text > $chars_limit ) {
			$text = strip_tags( $text );
			$text = $text . " ";
			$text = substr( $text, 0, $chars_limit );
			$text = substr( $text, 0, strrpos( $text, ' ' ) );
			return $text . "&hellip;";
		}
		else {
			return $text;
		}
	}
endif;

/**
 * Funtion to shorten any text by characters
 */
if ( ! function_exists( 'newsplus_short_by_word' ) ) :
	function newsplus_short_by_word( $phrase, $max_words ) {
		if ( '' == $max_words ) {
			$max_words = 20;
		}
		$phrase_array = explode( ' ', $phrase );
		if ( count( $phrase_array ) > $max_words && $max_words > 0 ) {
			$phrase = implode( ' ', array_slice( $phrase_array, 0, $max_words ) ) . '&hellip;';
		}
		return $phrase;
	}
endif;

/**
 * Get post thumbnail caption
 */

if ( ! function_exists( 'newsplus_post_thumbnail_caption' ) ) {
	function newsplus_post_thumbnail_caption() {
	  global $post;

	  $thumbnail_id    = get_post_thumbnail_id( $post->ID );
	  $thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment' ) );

	  if ( $thumbnail_image && isset( $thumbnail_image[0] ) && ! empty( $thumbnail_image[0]->post_excerpt ) ) {
		return '<p class="feat-caption">' . $thumbnail_image[0]->post_excerpt . '</p>';
	  }
	}
}

/**
 * Retrieve the archive title based on the queried object.
 *
 * @since 2.0.0
 * @return string Archive title.
 */
function newsplus_get_the_archive_title() {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'newsplus' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'newsplus' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'newsplus' ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery', 'newsplus' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-image', 'newsplus' ) ) {
			$title = _x( 'Images', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-video', 'newsplus' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-quote', 'newsplus' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-link', 'newsplus' ) ) {
			$title = _x( 'Links', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-status', 'newsplus' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-audio', 'newsplus' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'newsplus' );
		} elseif ( is_tax( 'post_format', 'post-format-chat', 'newsplus' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'newsplus' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'newsplus' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'newsplus' );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'newsplus_get_the_archive_title' );

/**
 * News Ticker
 */

if ( ! function_exists( 'newsplus_ticker_output' ) ) :
	function newsplus_ticker_output() {
		return do_shortcode( sprintf( '[newsplus_news_ticker%s%s%s]',
			get_option( 'pls_ticker_cats' ) ? ' ' . 'cats="' . esc_attr( get_option( 'pls_ticker_cats' ) ) . '"' : '',
			get_option( 'pls_ticker_num' ) ? ' ' . 'num="' . esc_attr( get_option( 'pls_ticker_num' ) ) . '"' : '',
			get_option( 'pls_ticker_label' ) ? ' ' . 'ticker_label="' . esc_html( get_option( 'pls_ticker_label' ) ) . '"' : ''
		) );
	}
endif;

if ( ! function_exists( 'newsplus_schema' ) ) :

	function newsplus_schema( $enable_schema, $imgwidth = 200, $imgheight = 200 ) {

		$sc_arr = array(
			'html'	=> '',
			'container' => '',
			'heading' => '',
			'heading_alt' => '',
			'text' => '',
			'img_cont' => '',
			'img' => '',
			'img_size' => '',
			'url' => ''	,
			'nav' => '',
			'bclist' => '',
			'bcelement' => '',
			'item' => '',
			'name' => '',
			'position' => ''
		);

		 // Is single post
		if ( is_single() || is_home() || is_archive() || is_category() ) {
			$html_type = "Blog";
		}
		// Is static front page
		else if (is_front_page()) {
			$html_type = "Website";
		}
		// Is a general page
		 else {
			$html_type = 'WebPage';
		}

		if ( 'true' == $enable_schema ) {
			$protocol = is_ssl() ? 'https' : 'http';
			$schema = $protocol . '://schema.org/';

			$sc_arr['html'] = 'itemscope="itemscope" itemtype="' . $schema . $html_type . '" ';
			$sc_arr['container'] = ' itemscope="" itemtype="' . $schema . 'BlogPosting" itemprop="blogPost"';
			$sc_arr['heading'] = ' itemprop="headline mainEntityOfPage"';
			$sc_arr['heading_alt'] = ' itemprop="headline"';
			$sc_arr['text'] = ' itemprop="text"';

			$sc_arr['img_cont'] = ' itemprop="image" itemscope="" itemtype="' . $schema . 'ImageObject"';
			$sc_arr['img'] = ' itemprop="url"';

			$sc_arr['img_size'] = sprintf( ' <meta itemprop="width" content="%s"><meta itemprop="height" content="%s">', $imgwidth, $imgheight );
			$sc_arr['url'] = ' itemprop="url"';
			$sc_arr['nav'] = ' itemscope="itemscope" itemtype="' . $schema . 'SiteNavigationElement"';

			$sc_arr['bclist'] = ' itemscope="itemscope" itemtype="' . $schema . 'BreadcrumbList"';
			$sc_arr['bcelement'] = ' itemscope="itemscope" itemtype="' . $schema . 'ListItem" itemprop="itemListElement"';
			$sc_arr['item'] = ' itemprop="item"';
			$sc_arr['name'] = ' itemprop="name"';
			$sc_arr['position'] = ' itemprop="position"';

		}

		return $sc_arr;

	}

endif;

// Post meta for post modules
if ( ! function_exists( 'newsplus_meta' ) ) :
	function newsplus_meta( $args = array() ) {
		global $post;
		$custom_link = get_post_meta( $post->ID, 'np_custom_link', true );
			$defaults = array(
				'template'	=> 'grid',
				'date_format' => get_option( 'date_format' ),
				'enable_schema' => false,
				'hide_cats' => false,
				'hide_reviews' => false,
				'show_cats' => false,
				'show_reviews' => false,
				'hide_date' => false,
				'hide_author' => false,
				'show_avatar' => false,
				'hide_views' => false,
				'hide_comments' => false,
				'readmore' => false,
				'ext_link' => false,
				'readmore_text' => esc_attr__( 'Read more', 'newsplus' ),
				'publisher_logo' => get_template_directory_uri() . '/images/logo.png',
				'sharing'	=> false,
				'share_btns' => ''
			);

			$args = wp_parse_args( $args, $defaults );

			extract( $args );

			$protocol = is_ssl() ? 'https' : 'http';
			$schema = $protocol . '://schema.org/';
			// Date format
			$date = get_the_time( get_option( 'date_format' ) );

			if ( ! empty( $date_format ) ) {
				if ( $date_format == 'human' ) {
					$date = sprintf( _x( '%s ago', 'human time difference. E.g. 10 days ago', 'newsplus' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
				}
				else {
					$date = sprintf( _x( '%s<span class="sep time-sep"></span><span class="publish-time">%s</span>', 'date - separator - time', 'newsplus' ),
						get_the_time( esc_attr( $date_format ) ),
						get_the_time( get_option( 'time_format' ) )
					);
				}
			}

			$post_id = get_the_ID();

			$post_class_obj = get_post_class( $post_id );
			$post_classes = '';

			// Post classes
			if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
				$post_classes = implode( ' ', $post_class_obj );
			}

			// Category and review stars
			$review_meta = '';

			// Create category list
			$cat_list = '<ul class="post-categories">';
			$hasmore = false;
			$i = 0;
			$cats = get_the_category();
			$cat_limit = apply_filters( 'newsplus_cat_list_limit', 3 );
			$cat_count = intval( count( $cats ) - $cat_limit );
			if ( isset( $cats ) ) {
				foreach( $cats as $cat ) {
					if ( $i == $cat_limit ) {
						$hasmore = true;
						$cat_list .= '<li class="submenu-parent"><a class="cat-toggle" href="#">' . sprintf( esc_attr_x( '+ %d more', 'more count for category list', 'newsplus' ), number_format_i18n( $cat_count ) ) . '</a><ul class="cat-sub submenu">';
					}
					$cat_list .= '<li><a href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a></li>';
					$i++;
				}
				$cat_list .= $hasmore ? '</ul></li></ul>' : '</ul>';
			}

			if ( 'list-small' == $template ) {
				$cat_meta = ( 'true' == $show_cats ) ? $cat_list : '';

				/**
				 * Post reviews
				 * Requires https://wordpress.org/plugins/wp-review/
				 */
				$review_meta = ( function_exists( 'wp_review_show_total' ) && 'true' == $show_reviews ) ? wp_review_show_total( $echo = false ) : '';
			} else {
				$cat_meta = ( 'true' != $hide_cats ) ? $cat_list : '';
				if ( function_exists( 'wp_review_show_total' ) && 'true' !== $hide_reviews ) {
					$review_meta = wp_review_show_total( $echo = false );
				}
			}

			// Author and date meta
			$meta_data = '';

			//if ( ! $hide_author || ! $hide_date ) {
				$author = get_the_author();
				$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
				if ( '' == $author || ! isset( $author ) ) {
					global $post;
					$author_id = $post->post_author;
					$author = get_the_author_meta( 'display_name', $author_id );
					$author_url = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
				}
				if ( $show_avatar ) {
					$meta_data .= sprintf( '<div%s%s class="author-avatar-32%s"><a%s href="%s" title="%s">%s%s</a></div>',
						$enable_schema ? ' itemscope itemtype="' . $schema . 'Person"' : '',
						$enable_schema ? ' itemprop="author"' : '',
						$hide_author && $hide_date ? ' avatar-only' : '',
						$enable_schema ? ' itemprop="name"' : '',
						esc_url( $author_url ),
						sprintf( esc_html__( 'More posts by %s', 'newsplus' ), esc_attr( $author ) ),
						$enable_schema ? '<span itemprop="image">' . get_avatar( get_the_author_meta( 'user_email' ), 32 ) . '</span>' : get_avatar( get_the_author_meta( 'user_email' ), 32 ),
						$enable_schema ? '<span class="hidden" itemprop="name">' . esc_attr( $author ) . '</span>' : ''

					);
				}

				$meta_data .= sprintf( '<ul class="entry-meta%s">',
					$show_avatar ? ' avatar-enabled' : ''
				);

				// Publisher Schema
				if ( $enable_schema ) {
					$meta_data .= '<li class="publisher-schema" itemscope itemtype="' . $schema . 'Organization" itemprop="publisher"><meta itemprop="name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '"/><div itemprop="logo" itemscope itemtype="' . $protocol . '://schema.org/ImageObject"><img itemprop="url" src="' . esc_url( $publisher_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/></div></li>';
				}

				//if ( ! $hide_date ) {
					$modified_date_format = 'human' == $date_format ? get_option( 'date_format' ) : $date_format;
					$meta_data .= sprintf( '<li class="post-time%1$s"><span class="published-label">%2$s</span><span class="posted-on"><time%3$s class="entry-date" datetime="%4$s">%5$s</time></span>%6$s</li>',
						$hide_date ? ' hidden' : '',
						_x( 'Published: ', 'post published date label', 'newsplus' ),
						$enable_schema ? ' itemprop="datePublished"' : '',
						esc_attr( get_the_date( 'c' ) ),
						$date,
						is_single() && get_the_date('H:i') != get_the_modified_date('H:i') ?
							sprintf( '<span class="sep updated-sep"></span><span class="updated-on"><meta itemprop="dateModified" content="%s">%s</span>',
							get_the_modified_date( DATE_W3C ),
							sprintf( _x( 'Updated: %s<span class="sep time-sep"></span><span class="updated-time">%s</a>', 'updated on date, time', 'newsplus' ),
								get_the_date() != get_the_modified_date() ? get_the_modified_date( get_option('date_format') ) : '',
								get_the_modified_date( get_option('time_format') )
							)
						) : ''
					);
				//}

				//if ( ! $hide_author ) {
					$meta_data .= sprintf( '<li%1$s%2$s class="post-author%3$s"><span class="screen-reader-text">%4$s </span><a href="%5$s">%6$s</a></li>',
						$enable_schema ? ' itemscope itemtype="' . $schema . 'Person"' : '',
						$enable_schema ? ' itemprop="author"' : '',
						$hide_author ? ' hidden' : '',
						esc_html_x( 'Author', 'Used before post author name.', 'newsplus' ),
						get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ),
						$enable_schema ? '<span itemprop="name">' . esc_attr( $author ) . '</span>' : esc_attr( $author )
					);
				//}

				$meta_data .= '</ul>';
			//}

			/**
			 * Social share buttons
			 * Uses newsplus_share_btns() function
			 */
			$share_btns_output =  $sharing && method_exists( 'NewsPlus_Shortcodes', 'newsplus_share_btns') ? NewsPlus_Shortcodes::newsplus_share_btns( $share_btns ) : '';

			// Comment link
			$num_comments = get_comments_number();
			$comment_meta = '';
			if ( comments_open() && ( $num_comments >= 1 ) && ! $hide_comments ) {
				$comment_meta = sprintf( '<a href="%1$s" class="post-comment" title="%2$s">%3$s%4$s</a>',
					esc_url( get_comments_link() ),
					sprintf( __( 'Comment on %s', 'newsplus' ), get_the_title() ),
					$enable_schema ? '<meta itemprop="discussionUrl" content="' . esc_url( get_comments_link() ) . '" />' : '',
					$enable_schema ? '<span itemprop="commentCount">' . $num_comments . '</span>' : $num_comments
				);
			}

			/**
			 * Post views
			 * Requires Plugin https://wordpress.org/plugins/post-views-counter/
			 */
			$views_meta = '';
			if ( function_exists( 'pvc_get_post_views' ) && ! $hide_views ) {
				$views_meta = sprintf( '<span class="post-views">%s</span>',
					pvc_get_post_views()
				);
			}

			// Generate rows of content
			$row_1 = '';
			$row_2 = '';
			$row_3 = '';
			$row_4 = '';
			if ( $review_meta != '' || $cat_meta != '' ) {
				$row_1 .= '<aside class="meta-row cat-row">';
				if ( $cat_meta != '' ) {
					$row_1 .= sprintf( '<div%s class="meta-col%s">%s</div>',
						$enable_schema ? ' itemprop="about"' : '',
						$review_meta != '' ? ' col-60' : '',
						$cat_meta
					);
				}

				if ( $review_meta != '' ) {
					$row_1 .= sprintf( '<div class="meta-col%s">%s</div>',
						$cat_meta != '' ? ' col-40 text-right' : '',
						$review_meta
					);
				}
				$row_1 .= '</aside>';
			}

			//if ( $meta_data || $views_meta || $comment_meta ) {
				$row_4 .= sprintf( '<aside class="meta-row row-3%s">',
					( $hide_date && $hide_author && $hide_views && $hide_comments && 'true' !== $sharing ) ? ' hidden' : ''
				);

				if ( '' == $views_meta && '' == $comment_meta && 'true' !== $sharing ) {
					$row_4 .= sprintf( '<div class="meta-col">%s</div>', $meta_data );
				}

				elseif ( '' == $meta_data ) {
					$row_4 .= sprintf( '<div class="meta-col">%s%s%s</div>', $views_meta, $comment_meta, $share_btns_output );
				}

				else {
					$row_4 .= sprintf( '<div class="meta-col col-60">%s</div><div class="meta-col col-40 text-right">%s%s%s</div>', $meta_data, $views_meta, $comment_meta, $share_btns_output );
				}
				$row_4 .= '</aside>';
			//}

			if ( $readmore ) {
				if ( $meta_data ) {
					$row_2 = sprintf( '<aside class="meta-row row-2%s"><div class="meta-col">%s</div></aside>',
						( $hide_date && $hide_author && $hide_views && $hide_comments && 'true' !== $sharing ) ? ' hidden' : '',
						$meta_data
					);
				}

				if ( $readmore || $views_meta || $comment_meta || $sharing ) {
					$row_3 = sprintf( '<aside class="meta-row row-3"><div class="meta-col col-50"><a class="readmore-link" href="%s">%s</a></div><div class="meta-col col-50 text-right">%s%s%s</div></aside>',
						$ext_link && $custom_link ? esc_url( $custom_link) : esc_url( get_permalink() ),
						esc_attr( $readmore_text ),
						$views_meta,
						$comment_meta,
						$share_btns_output
					);
				}
			}

			else {
				$row_3 = $row_4;
			}

		$meta_arr = array();
		$meta_arr['row_1'] = $row_1;
		$meta_arr['row_2'] = $row_2;
		$meta_arr['row_3'] = $row_3;
		$meta_arr['row_4'] = $row_4;
		return $meta_arr;
	}
endif;

/**
 * Modify title tag to show itemprop="name"
 */

function newsplus_title_tag_with_schema() {

	global $page, $paged;

	$sep = '&#8211;';
	$title = wp_title( $sep, false, 'right' );

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'newsplus' ), max( $paged, $page ) );
	}

	printf( '<title%s>%s</title>' . PHP_EOL,
		get_option( 'pls_schema' ) ?  ' itemprop="name"' : '',
		$title
	);
}

//add_action( 'wp_head', 'newsplus_title_tag_with_schema', 1 );


// Adds itemprop="url" attribute to nav menu links
function newsplus_add_attribute( $atts, $item, $args ) {
	if ( get_option( 'pls_schema' ) ) {
		$atts['itemprop'] = 'url';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'newsplus_add_attribute', 10, 3 );


/**
 * Posts not found message
 */

 if ( ! function_exists( 'newsplus_no_posts' ) ) :
 	function newsplus_no_posts() {
	?>
        <article id="post-0" class="post no-results not-found">
            <header class="page-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'newsplus' ); ?></h1>
            </header>
            <div class="entry-content">
                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newsplus' ); ?></p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->
	<?php
    }
endif;

if ( ! function_exists( 'newsplus_author_bio' ) ) :
	function newsplus_author_bio() {

		$protocol = is_ssl() ? 'https' : 'http';
		$schema_url = $protocol . '://schema.org/';
		if ( get_the_author_meta( 'description' ) ) :
			printf( '<div class="author-info"%s%s>',
				get_option( 'pls_schema' ) ? ' itemscope itemtype="' . $schema_url . 'Person"' : '',
				get_option( 'pls_schema' ) ? ' itemprop="author"' : ''
			);

				printf( '<div class="author-avatar author-avatar-64"><img%s src="%s" alt="%s"/></div>',
					get_option( 'pls_schema' ) ? ' itemprop="image"' : '',
					get_avatar_url( get_the_author_meta( 'user_email' ), 64 ),
					get_the_author()
				);

				printf( '<div class="author-description">' );

					if ( is_single() ) {
						printf( '<h3%s class="author-title">%s</h3>',
							get_option( 'pls_schema' ) ? ' itemprop="name"' : '',
							get_the_author()
						);
					}

					printf( '<p%s>%s</p>',
					get_option( 'pls_schema' ) ? ' itemprop="description"' : '',
					get_the_author_meta( 'description' )
					);
					if ( is_single() ) {
					?>
						<p class="author-link">
							<a class="more-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'newsplus' ), get_the_author() ); ?>
							</a>
						</p><!-- .author-link	-->
					<?php
					}
					?>
				</div><!-- .author-description -->
			</div><!-- .author-info -->
		<?php endif; // has description
	}
endif;

if ( ! function_exists ( 'newsplus_video_thumb' ) ) :
	function newsplus_video_thumb( $url = '' ) {
		require_once( ABSPATH . 'wp-includes/class-wp-oembed.php' );
		$oembed = new WP_oEmbed;

		$provider = $oembed->discover( $url );
		//$provider = 'http://www.youtube.com/oembed';
		$video = $oembed->fetch( $provider, $url, array() );
		if ( $video ) {
			$title = $video->title;
			$thumb = $video->thumbnail_url;
			return array( 'url' => $thumb, 'title' => $title );
		}
	}
endif;

/**
 * Social Sharing feature on single posts
 */
if ( ! function_exists( 'newsplus_social_sharing' ) ) :
	function newsplus_social_sharing( $sharing_buttons ) {
		global $post;

		setup_postdata( $post );

		// Set variables
		$out = '';
		$list = '';
		$share_image = '';
		$protocol = is_ssl() ? 'https' : 'http';

		if ( has_post_thumbnail( $post->ID ) ) {
			$share_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		}

		$share_content = strip_tags( get_the_excerpt() );
		$btn_count = count( $sharing_buttons );

		if ( in_array( 'whatsapp', $sharing_buttons ) ) {
			if ( ! wp_is_mobile() ) {
				$btn_count--;
			}
		}

		$out .= '<div id="newsplus-social-sharing" class="ss-sharing-container btns-' . $btn_count . '">';

		$out .= '<ul class="np-sharing clearfix">';

		foreach ( $sharing_buttons as $button ) {

			switch( $button ) {

				case 'twitter':
					$list .= sprintf( '<li class="ss-twitter"><a href="%s://twitter.com/home?status=%s" target="_blank" title="%s"><i class="fa fa-twitter"></i><span class="sr-only">twitter</span></a></li>', esc_attr( $protocol ), urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Share on twitter', 'newsplus' ) );
				break;

				case 'facebook':
					$list .= sprintf( '<li class="ss-facebook"><a href="%s://www.facebook.com/sharer/sharer.php?u=%s" target="_blank" title="%s"><i class="fa fa-facebook"></i><span class="sr-only">facebook</span></a></li>', esc_attr( $protocol ), urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Share on facebook', 'newsplus' ) );
				break;

				case 'whatsapp':
					if ( wp_is_mobile() ) {
						$list .= sprintf( '<li class="ss-whatsapp"><a href="whatsapp://send?text=%s" title="%s" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i><span class="sr-only">whatsapp</span></a></li>', urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Whatsapp', 'newsplus' ) );
					}
				break;

				case 'googleplus':
					$list .= sprintf( '<li class="ss-gplus"><a href="%s://plus.google.com/share?url=%s" target="_blank" title="%s"><i class="fa fa-google-plus"></i><span class="sr-only">google+</span></a></li>', esc_attr( $protocol ), urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Share on Google+', 'newsplus' ) );
				break;

				case 'linkedin':
					$list .= sprintf( '<li class="ss-linkedin"><a href="%s://www.linkedin.com/shareArticle?mini=true&amp;url=%s" target="_blank" title="%s"><i class="fa fa-linkedin"></i><span class="sr-only">linkedin</span></a></li>', esc_attr( $protocol ), urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Share on LinkedIn', 'newsplus' ) );
				break;

				case 'pinterest':
					$list .= sprintf( '<li class="ss-pint"><a href="%s://pinterest.com/pin/create/button/?url=%s&amp;media=%s" target="_blank" title="%s"><i class="fa fa-pinterest"></i><span class="sr-only">pinterest</span></a></li>',
						esc_attr( $protocol ),
						urlencode( esc_url( get_permalink() ) ),
						esc_url( $share_image ),
						esc_attr__( 'Pin it', 'newsplus' )
					);
				break;

				case 'vkontakte':
					$list .= sprintf( '<li class="ss-vk"><a href="%s://vkontakte.ru/share.php?url=%s" target="_blank" title="%s"><i class="fa fa-vk"></i><span class="sr-only">vkontakte</span></a></li>', esc_attr( $protocol ), urlencode( esc_url( get_permalink() ) ), esc_attr__( 'Share via VK', 'newsplus' ) );
				break;

				case 'email':
					$list .= sprintf( '<li class="ss-mail"><a href="mailto:someone@example.com?Subject=%s" title="%s"><i class="fa fa-envelope"></i><span class="sr-only">email</span></a></li>', urlencode( get_the_title() ), esc_attr__( 'Email this', 'newsplus' ) );

				break;

				case 'print':
					$list .= sprintf( '<li class="ss-print"><a href="#" title="%s"><i class="fa fa-print"></i><span class="sr-only">print</span></a></li>', esc_attr__( 'Print', 'newsplus' ) );
				break;

				case 'reddit':
					$list .= sprintf( '<li class="ss-reddit"><a href="//www.reddit.com/submit" onclick="window.location = \'//www.reddit.com/submit?url=\' + encodeURIComponent(window.location); return false" title="%s"><i class="fa fa-reddit-square"></i><span class="sr-only">reddit</span><span class="sr-only">reddit</span></a></li>', esc_attr__( 'Reddit', 'newsplus' ) );
				break;
			} // switch

		} // foreach

		// Support extra meta items via action hook
		ob_start();
		do_action( 'newsplus_sharing_buttons_li' );
		$out .= ob_get_contents();
		ob_end_clean();

		$out .= $list . '</ul></div>';

		return $out;
	}
endif;

if ( ! function_exists( 'newsplus_sidebar_b' ) ) :

	function newsplus_sidebar_b() {

		$flag = false;

		if ( is_single() ) {
			global $post;
			$post_opts = get_post_meta( $post->ID, 'post_options', true );
			$sng_layout = ( isset( $post_opts['sng_layout'] ) && 'global' != $post_opts['sng_layout'] ) ? $post_opts['sng_layout'] : get_option( 'pls_sb_pos', 'ca' );
			$post_full_width 	= ( isset( $post_opts['post_full_width'] ) ) ? $post_opts['post_full_width'] : '';

			if ( $sng_layout == 'ac' || $sng_layout == 'ca' || $post_full_width ) {
				$flag = false;
			}
			else {
				$flag = 'true';
			}

		}

		else {
			if ( get_option( 'pls_sb_pos', 'ca' ) == 'ac' || get_option( 'pls_sb_pos', 'ca' ) == 'ca' ) {
				$flag = false;
			}
			else {
				$flag = 'true';
			}
		}

		if ( $flag && ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) ) {
			if ( is_active_sidebar( 'sidebar-b' ) ) {
				echo '<div id="sidebar-b" clas="widget-area">';
				dynamic_sidebar( 'sidebar-b' );
				echo '</div><!-- /#sidebar-b -->';
			} else {
				echo '<div class="sb_notifier">';
				_e('<p>Sidebar not configured yet. You can place widgets by navigating to WordPress Appearance > Widgets.</p>', 'newsplus');
				echo '</div>';
			}
		}
	}
endif;

/**
 * Limit category links to xx number
 */
function newsplus_cat_links_limit() {
	if ( is_single() ) {
		return 4;
	}
	else {
		return 2;
	}
}

add_filter( 'newsplus_cat_list_limit', 'newsplus_cat_links_limit' );

function newsplus_make_css() {
	if ( get_option( 'pls_disable_custom_font', false ) ) {
		return;
	}
	$css = '';
	$global_font = get_option( 'pls_global_font', '' );
	$heading_font = get_option( 'pls_heading_font', '' );
	$menu_font = get_option( 'pls_menu_font', '' );

	// Font CSS
	if ( '' != $global_font ) {
		newsplus_enqueue_fonts( $global_font );
		$global_style = newsplus_create_font_style( $global_font );
		$css .= 'body,body.custom-font-enabled{' . $global_style . '}';
	}

	if ( '' != $heading_font ) {
		newsplus_enqueue_fonts( $heading_font );
		$heading_style = newsplus_create_font_style( $heading_font );
		$css .= 'h1,h2,h3,h4,h5,h6{' . $heading_style . '}';
	}

	if ( '' != $menu_font ) {
		newsplus_enqueue_fonts( $menu_font );
		$heading_style = newsplus_create_font_style( $menu_font );
		$css .= '.primary-nav{' . $heading_style . '}';
	}

	if ( '' !== $css ) {
		echo '<style type="text/css">' . strip_tags( $css ) . '</style>';
	}
}

add_action( 'wp_head', 'newsplus_make_css' );

if ( ! function_exists( 'newsplus_enqueue_fonts' ) ) :
	function newsplus_enqueue_fonts( $fontsData ) {
		$subset = get_option( 'pls_font_subset', '' );
		// Enqueue font
		if ( isset( $fontsData ) ) {
			wp_enqueue_style( 'newsplus_google_fonts_' . newsplus_create_safe_class( $fontsData ), '//fonts.googleapis.com/css?family=' . $fontsData . $subset );
		}
	}
endif;

if ( ! function_exists( 'newsplus_create_font_style' ) ) :
	function newsplus_create_font_style( $fontsData ) {
        $inline_style = '';
		if ( isset( $fontsData ) ) {
			$fontFamily = explode( ':', $fontsData );
			$styles[] = isset( $fontFamily[0] ) ? 'font-family:\'' . $fontFamily[0] . '\'': '';

			if ( isset( $styles ) && is_array( $styles ) ) {
				foreach( $styles as $attribute ){
					$inline_style .= $attribute.'; ';
				}
			}
		}
        return $inline_style;
    }
endif;

if ( ! function_exists( 'newsplus_create_safe_class' ) ) :
	function newsplus_create_safe_class( $class ) {
		return preg_replace( '/\W+/', '', strtolower( str_replace( ' ', '_', strip_tags( $class ) ) ) );
	}
endif;


/**
 * Register the required plugins for this theme.
 */
function newsplus_register_required_plugins() {

	$plugins = array(

        array(
            'name'               => 'NewsPlus Shortcodes',
            'slug'               => 'newsplus-shortcodes',
            'source'             => get_template_directory() . '/plugins/newsplus-shortcodes.zip',
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '3.9.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

		// Kingcomposer Page Builder Plugin
		array(
            'name'               => 'King Composer',
            'slug'               => 'kingcomposer',
            'source'             => get_template_directory() . '/plugins/kingcomposer.zip',
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '2.9.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

		// Contact form 7
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

		// WP Review
		array(
            'name'      => 'WP Review',
            'slug'      => 'wp-review',
            'required'  => false,
        ),

		// Post views
		array(
            'name'      => 'Post Views Counter',
            'slug'      => 'post-views-counter',
            'required'  => false,
        )
    );

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'newsplus',             // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'newsplus_register_required_plugins' );

// Remove default gallery styles of WordPress
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Create overlay style single post header
 * Hooked to 'newsplus_before_main'
 */
function newsplus_single_overlay_header() {
	$exclude = get_option( 'pls_overlay_exclude', '' );
	if ( '' !== $exclude ) {
	    $exclude = explode( ',', $exclude );
	}
	if ( ( is_single() && 'overlay' == get_option( 'pls_sng_header', 'inline' ) ) || ( is_page() && 'overlay' == get_option( 'pls_page_header', 'inline' ) ) ) {
		if ( is_single() && ! is_page() ) {
		global $posts;
		$post_opts 			= get_post_meta( $posts[0]->ID, 'post_options', true );
		$sp_post_check      = isset( $post_opts['sp_post'] ) ? $post_opts['sp_post'] : '';
		$sp_label_single    = ( isset( $post_opts['sp_label_single'] ) ) ? $post_opts['sp_label_single'] : '';
		$enable_schema 		= get_option( 'pls_schema', false );
		$share_btns = get_option( 'pls_inline_social_btns', '' );
		$share_btns = ( '' != $share_btns ) ? $share_btns : array();
		$meta_args = array(
		    'date_format' => get_option( 'date_format' ),
		    'enable_schema' => $enable_schema,
		    'hide_cats' => get_option( 'pls_sng_hide_cats' ),
		    'hide_reviews' => get_option( 'pls_sng_hide_reviews' ),
		    'hide_date' => get_option( 'pls_sng_hide_date' ),
		    'hide_author' => get_option( 'pls_sng_hide_author' ),
		    'show_avatar' => get_option( 'pls_sng_show_avatar' ),
		    'hide_views' => get_option( 'pls_sng_hide_views' ),
		    'hide_comments' => get_option( 'pls_sng_hide_comments' ),
		    'publisher_logo' => '' != get_option( 'pls_logo' ) ? esc_url( get_option( 'pls_logo' ) ) : get_template_directory_uri() . '/images/logo.png',
		    'sharing'   => get_option( 'pls_inline_sharing', false ),
		    'share_btns' => is_array( $share_btns ) ? implode( ',', $share_btns ) : ''
		);

		$rows = newsplus_meta( $meta_args );
		echo '<div class="single-overlay-header"><div class="wrap single-overlay-wrap">';
		echo '<header class="entry-header newsplus full-header single-meta">';
        //show_breadcrumbs();
        if ( $sp_post_check && $sp_label_single ) {
            echo '<span class="sp-label-single">' . esc_attr( $sp_label_single ) . '</span>';
        }
        printf( '%s', $rows['row_1'] );
        echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
        printf( '%s', $rows['row_4'] );
    } elseif ( is_page() && ! ( is_array( $exclude ) && is_page( $exclude ) ) ) {
		echo '<div class="single-overlay-header"><div class="wrap single-overlay-wrap">';
		echo '<header class="entry-header newsplus full-header single-meta">';
		show_breadcrumbs();
		echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
    }
    echo '</header></div></div>';
	}
}

add_action( 'newsplus_before_main', 'newsplus_single_overlay_header', 20 );


// Image resize using BFI Thumb
if ( ! function_exists( 'newsplus_image_resize' ) ) :
	function newsplus_image_resize( $src, $imgwidth, $imgheight, $imgcrop, $imgquality, $imgcolor, $imggrayscale ) {
		$params = array();

		// Validate boolean params
		$crop = ( '' == $imgcrop || 'false' == $imgcrop ) ? false : true;
		$grayscale = ( '' == $imggrayscale || 'false' == $imggrayscale ) ? false : true;

		// Params array
		if ( $crop ) {
			$params['crop'] = true;
		}

		if ( $grayscale ) {
			$params['grayscale'] = true;
		}

		if ( '' != $imgquality ) {
			if ( (int)$imgquality < 1 ) {
				$quality = 1;
			} elseif ( (int)$imgquality > 100 ) {
				$quality = 100;
			} else {
				$quality = $imgquality;
			}
			$params['quality'] = (int)$quality;
		}

		if ( '' != $imgcolor ) {
			$color = preg_match( '/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $imgcolor ) ? $imgcolor : '';
			$params['color'] = $color;
		}

		// Validate width and height
		if ( isset( $imgwidth ) && (int)$imgwidth > 4 && '' != $imgwidth ) {
			$params['width'] = $imgwidth;
		}

		if ( isset( $imgheight ) && (int)$imgheight > 4 && '' != $imgheight ) {
			$params['height'] = $imgheight;
		}

		if ( function_exists( 'bfi_thumb' ) && ! empty( $params ) ) {
			return bfi_thumb( $src, $params );
		} else {
			return $src;
		}
	}
endif;


// 7devlab
wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/styles.css', 10 );
wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/main.min.js', array('jquery'), '1.0.0', true );

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Banners para listado de ofertas',
		'menu_title'	=> 'Banners para listado de ofertas',
		'menu_slug' 	=> 'banners-ofertas',
		'redirect'		=> false,
		//'capability'=>'edit_posts',
		//'icon_url'=> get_template_directory_uri().'/images/logo.png',
	));
}

foreach(glob(get_template_directory().'/functions/*.php') as $filename):
	require_once($filename);
 endforeach;