<?php
/**
 * Theme customizer
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

function newsplus_customize_register( $wp_customize ) {
	$colors = array(
		array(
			'slug'		=> 'nav_bg',
			'default'	=> '#fff',
			'label'		=> __( 'Nav Background Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'nav_link_color',
			'default'	=> '#757575',
			'label'		=> __( 'Nav Link Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'nav_link_hover_color',
			'default'	=> '#424242',
			'label'		=> __( 'Nav Link Hover Color', 'newsplus' ),
			'transport'	=> 'refresh'
		),
		array(
			'slug'		=> 'nav_link_hover_border_color',
			'default'	=> '#c2c2c2',
			'label'		=> __( 'Nav Link Hover Border Color', 'newsplus' ),
			'transport'	=> 'refresh'
		),
		array(
			'slug'		=> 'nav_current_link_color',
			'default'	=> '#424242',
			'label'		=> __( 'Nav Current Link Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),				
		array(
			'slug'		=> 'nav_current_link_border_color',
			'default'	=> '#f44336',
			'label'		=> __( 'Nav Current Link Border Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'submenu_bg',
			'default'	=> '#fff',
			'label'		=> __( 'SubMenu Background Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'submenu_link_color',
			'default'	=> '#757575',
			'label'		=> __( 'SubMenu Link Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'submenu_link_hover_color',
			'default'	=> '#424242',
			'label'		=> __( 'SubMenu Link Hover Color', 'newsplus' ),
			'transport'	=> 'refresh'
		),
		array(
			'slug'		=> 'submenu_link_hover_bg_color',
			'default'	=> '#eeeeee',
			'label'		=> __( 'SubMenu Link Hover BG Color', 'newsplus' ),
			'transport'	=> 'refresh'
		),
		array(
			'slug'		=> 'sidebar_heading_color',
			'default'	=> '#757575',
			'label'		=> __( 'Sidebar Headings Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'sec_bg_color',
			'default'	=> '#f5f5f5',
			'label'		=> __( 'Secondary Area BG Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'sec_heading_color',
			'default'	=> '#757575',
			'label'		=> __( 'Secondary Area Headings Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'sec_text_color',
			'default'	=> '#757575',
			'label'		=> __( 'Secondary Area Text Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'sec_link_color',
			'default'	=> '#757575',
			'label'		=> __( 'Secondary Area Link Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'sec_link_hover_color',
			'default'	=> '#424242',
			'label'		=> __( 'Secondary Area Link Hover Color', 'newsplus' ),
			'transport'	=> 'refresh'
		),
		array(
			'slug'		=> 'sec_widget_border_color',
			'default'	=> '#e0e0e0',
			'label'		=> __( 'Secondary Widget Border Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'footer_bg_color',
			'default'	=> '#fff',
			'label'		=> __( 'Footer BG Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'footer_text_color',
			'default'	=> '#757575',
			'label'		=> __( 'Footer Text Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'footer_link_color',
			'default'	=> '#424242',
			'label'		=> __( 'Footer Link Color', 'newsplus' ),
			'transport'	=> 'postMessage'
		),
		array(
			'slug'		=> 'footer_link_hover_color',
			'default'	=> '#757575',
			'label'		=> __( 'Footer Link Hover Color', 'newsplus' ),
			'transport'	=> 'refresh'
		)

	);

	$count = 20;

	foreach( $colors as $color ) {

		// Add Settings
		$wp_customize->add_setting(
			$color['slug'],
			array(
				'default'		=> $color['default'],
				'type'			=> 'option',
				'capability'	=> 'edit_theme_options',
				'transport'		=> $color['transport'],
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		// Add Controls
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'],
				array(
					'label'		=> $color['label'],
					'section'	=> 'colors',
					'settings'	=> $color['slug'],
					'priority'	=> $count
				)
			)
		);

		$count++;
	}
}
add_action( 'customize_register', 'newsplus_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function newsplus_customize_preview_js() {
	wp_enqueue_script( 'newsplus-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '', true );
}

add_action( 'customize_preview_init', 'newsplus_customize_preview_js' );

/* Output color styles in head */

function newsplus_customize_css() {

	if ( 'customizer' == get_option( 'pls_color_scheme', 'customizer' ) ) { 
		?>
		<style type="text/css">
			.primary-nav {
				background-color:<?php echo get_option( 'nav_bg' ); ?>;
			}
			ul.nav-menu > li > a {
				text-shadow: none;
				color:<?php echo get_option( 'nav_link_color' ); ?>;
			}
			.primary-nav li:hover > a {
				color:<?php echo get_option( 'nav_link_hover_color' ); ?>;
				border-bottom-color: <?php echo get_option( 'nav_link_hover_border_color' ); ?>;
			}
			ul.nav-menu > li.current-menu-item > a,
			ul.nav-menu > li.current-menu-ancestor > a,
			ul.nav-menu > li.current_page_item > a,
			ul.nav-menu > li.current_page_ancestor > a {
				border-bottom-color: <?php echo get_option( 'nav_current_link_border_color' ); ?>;
				color:  <?php echo get_option( 'nav_current_link_color' ); ?>;
			}
			.primary-nav li ul {
				background-color:<?php echo get_option( 'submenu_bg' ); ?>;
			}
			.primary-nav li ul li a {
				color:<?php echo get_option( 'submenu_link_color' ); ?>;
			}
			.primary-nav li ul li:hover > a {
				color:<?php echo get_option( 'submenu_link_hover_color' ); ?>;
				background-color:<?php echo get_option( 'submenu_link_hover_bg_color' ); ?>;
			}
			.sb-title {
				color:<?php echo get_option( 'sidebar_heading_color' ); ?>;
			}
			#secondary {
				color:<?php echo get_option( 'sec_text_color' ); ?>;
				background-color:<?php echo get_option( 'sec_bg_color' ); ?>;
			}
			#secondary .sep {
				color:<?php echo get_option( 'sec_text_color' ); ?>;
			}
			#secondary .widget a,
			#secondary .widget ul a {
				color:<?php echo get_option( 'sec_link_color' ); ?>;
			}
			#secondary .widget a:hover,
			#secondary .widget ul a:hover {
				color:<?php echo get_option( 'sec_link_hover_color' ); ?>;
			}
			.sc-title {
				color:<?php echo get_option( 'sec_heading_color' ); ?>;
			}
			#secondary .widget ul li,
			#secondary .post-list > li:after {
				border-bottom-color: <?php echo get_option( 'sec_widget_border_color' ); ?>;
			}
		
			#secondary .widget ul ul {
				border-top-color: <?php echo get_option( 'sec_widget_border_color' ); ?>;
			}
			#footer {
				color:<?php echo get_option( 'footer_text_color' ); ?>;
				background-color:<?php echo get_option( 'footer_bg_color' ); ?>;
			}
			body.is-stretched.custom-background {
				background-color:<?php echo get_option( 'footer_bg_color' ); ?>;
			}
			#footer a {
				color:<?php echo get_option( 'footer_link_color' ); ?>;
			}
			#footer a:hover {
				color:<?php echo get_option( 'footer_link_hover_color' ); ?>;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'newsplus_customize_css'); ?>