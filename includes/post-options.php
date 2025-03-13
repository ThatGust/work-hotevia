<?php
/**
 * Add post options array with custom option fields
 */

function newsplus_add_post_options() {

	$post_opts = array(
		'info1' 	=> array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Sidebar Options', 'newsplus' )
		),

		'sb_usage'	=> array(
			'id' 			=> 'sb_usage',
			'title' 		=> __( 'Available widget areas for Sidebar', 'newsplus' ),
			'type' 			=> 'custom_select_a',
			'description' 	=> __( 'Select a widget area to use on Sidebar', 'newsplus' )
		),

		'hwa_usage' => array(
			'id' 			=> 'hwa_usage',
			'title' 		=> __( 'Available widget areas for Header Section', 'newsplus' ),
			'type' 			=> 'custom_select_h',
			'description' 	=> __( 'Select a widget area to use on Header Section', 'newsplus' )
		),

		'hr1' 		=> array( 'type' => 'hr' ),

		'info2' 	=> array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Post Content Options', 'newsplus' )
		),
		
		'np_short_title' 	=> array(
			'id' 			=> 'np_short_title',
			'title' 		=> __( 'Optional Short Title', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'An optional short title which should be shown in archives and post shortcodes.', 'newsplus' )
		),
		
		'np_custom_link' 	=> array(
			'id' 			=> 'np_custom_link',
			'title' 		=> __( 'Custom Permalink', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'Custom or external permalink for this post.', 'newsplus' )
		),					

		'pf_video' 	=> array(
			'id' 			=> 'pf_video',
			'title' 		=> __( 'Video URL', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'URL of video for Video Post Format. Example: http://vimeo.com/41369274', 'newsplus' )
		),

		'hr2' 			=> array( 'type' => 'hr' ),

		'info3' 		=> array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Single Post Options', 'newsplus' )
		),
		
		'sng_layout'	=> array(
			'id' 			=> 'sng_layout',
			'title' 		=> __( 'Single post layout', 'newsplus' ),
			'type' 			=> 'select',
			'std'			=> 'default',
			'description' 	=> __( 'Choose a layout style for single post', 'newsplus' ),
			'options'	=> array(
							'Use global setting' => 'global',
							'Content + Sidebar A' => 'ca',
							'Sidebar A + Content' => 'ac',
							'Content + Sidebar B + Sidebar A' => 'cab',
							'Sidebar A + Content + Sidebar B' => 'acb',
							'Sidebar B + Content + Sidebar A' => 'bca',
							'Sidebar A + Sidebar B + Content' => 'abc',
						)
		),

		'cust_bg' => array(
			'id' 			=> 'cust_bg',
			'title' 		=> __( 'Custom background for content area', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'Use a background color or image url property. E.g. #f5f5f5', 'newsplus' )
		),


		'hide_image'	 	=> array(
			'id' 			=> 'hide_image',
			'title' 		=> __( 'Hide featured image on this post', 'newsplus' ),
			'type' 			=> 'checkbox'
		),
		
		'show_image'	 	=> array(
			'id' 			=> 'show_image',
			'title' 		=> __( 'Check to show featured image on this post. Useful when featured image is hidden globally', 'newsplus' ),
			'type' 			=> 'checkbox'
		),

		'hide_secondary' => array(
			'id' 			=> 'hide_secondary',
			'title' 		=> __( 'Hide secondary widget area on this post', 'newsplus' ),
			'type' 			=> 'checkbox'
		),
		
		'hide_related' => array(
			'id' 			=> 'hide_related',
			'title' 		=> __( 'Hide related posts on this post', 'newsplus' ),
			'type' 			=> 'checkbox'
		),
		
		'post_full_width' => array(
			'id' 			=> 'post_full_width',
			'title' 		=> __( 'Check to enable full width on this post', 'newsplus' ),
			'type' 			=> 'checkbox'
		),

		'hr3' 			=> array( 'type' => 'hr'),
			'info4' 		=> array( 'type' => 'heading',
			'description' 	=> __( 'Advertisement Settings for this post', 'newsplus' )
		),

		'ad_above' 		=> array(
			'id' 			=> 'ad_above',
			'title' 		=> __( 'Custom markup before the post', 'newsplus' ),
			'std' 			=> '',
			'type' 			=> 'textarea',
			'description' 	=> __( 'Enter an HTML markup or advertisement code that should appear above the post. (Short codes are supported).', 'newsplus' )
		),

		'ad_below' 		=> array(
			'id' 			=> 'ad_below',
			'title' 		=> __( 'Custom markup after the post', 'newsplus' ),
			'std' 			=> '',
			'type' 			=> 'textarea',
			'description' 	=> __( 'Enter an HTML markup or advertisement code that should appear after the post, below related posts section. (Short codes are supported).', 'newsplus' )
		),

		'ad_above_check' => array(
			'id' 			=> 'ad_above_check',
			'title' 		=> __( 'Hide advertisement above this post.', 'newsplus' ),
			'type' 			=> 'checkbox'
		),

		'ad_below_check' => array(
			'id' 			=> 'ad_below_check',
			'title' 		=> __( 'Hide advertisement below this post.', 'newsplus' ),
			'type' 			=> 'checkbox'
		),

		'sp_post' => array(
			'id' 			=> 'sp_post',
			'title' 		=> __( 'Set this post as advertisement post', 'newsplus' ),
			'type' 			=> 'checkbox',
			'description' 	=> __( 'If checked, the post will be treated as sponsored content with an advertisement label.', 'newsplus' )
		),

		'sp_label_single' 		=> array(
			'id' 			=> 'sp_label_single',
			'title' 		=> __( 'Advertisement label as shown on single post', 'newsplus' ),
			'std' 			=> '',
			'type' 			=> 'text',
			'description' 	=> __( 'Provide advertisement label to be shown on single post. E.g. Sponsored content from XYZ Site', 'newsplus' )
		)
	);

	return $post_opts;

}

function newsplus_add_post_options_key() {
	return 'post_options';
}

add_filter( 'pls_post_opts_array', 'newsplus_add_post_options' );
add_filter( 'pls_post_opts_key', 'newsplus_add_post_options_key' );