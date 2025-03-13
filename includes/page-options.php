<?php
/**
 * Add page options array with custom option fields
 */

function newsplus_add_page_options() {

	$page_opts = array(
		'info1' 	=> array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Sidebar Options', 'newsplus' )
		),

		'sb_usage' 	=> array(
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

		'sidebar_a' => array(
			'id' 			=> 'sidebar_a',
			'title' 		=> __( 'Create an exclusive sidebar for this page.', 'newsplus' ),
			'type' 			=> 'checkbox',
			'description' 	=> __( 'Check to create exclusive sidebar for this page.', 'newsplus' )
		),

		'sidebar_h' => array(
			'id' 			=> 'sidebar_h',
			'title' 		=> __( 'Create an exclusive Header Widget Area for this page.', 'newsplus' ),
			'type' 			=> 'checkbox',
			'description' 	=> __( 'Check to create exclusive header widget area for this page. <br />On checking these options, a new Widget Area will be created in the name of this page. Once you publish or update the page, the new sidebar will appear inside dropdown menu. You can select that new sidebar and update the page again. You can remove the sidebar by unchecking these options.', 'newsplus' )
		),

		'hr1' 		=> array( 'type' => 'hr'),

		'info2' 	=> array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Archive and Blog Options', 'newsplus' )
		),

		'category' 	=> array(
			'id' 			=> 'category',
			'title' 		=> __( 'Category IDs to fetch Archive or Blog Posts', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'Enter a numeric category ID, or IDs separated by commas, from which you wish to show posts. Use this option if you are using an Archive or Blog template. Example: 3,4,7,12', 'newsplus' )
		),

		'post_per_page' => array(
			'id' 			=> 'post_per_page',
			'title' 		=> __( 'Posts per page', 'newsplus' ),
			'type' 			=> 'number_text',
			'description' 	=> __( 'The number of posts to show per page.', 'newsplus' )
		),
		
		'enable_masonry' => array(
			'id' 			=> 'enable_masonry',
			'title' 		=> __( 'Enable masonry layout', 'newsplus' ),
			'type' 			=> 'checkbox',
			'description' 	=> __( 'Check to enable masonry layout on this page.', 'newsplus' )
		),
		
		'card_style' => array(
			'id' 			=> 'card_style',
			'title' 		=> __( 'Enable card style layout', 'newsplus' ),
			'type' 			=> 'checkbox',
			'description' 	=> __( 'Check to enable card style layout on post items.', 'newsplus' )
		),

		'hr2' => array(	'type' => 'hr'),

		'info3' => array(
			'type' 			=> 'heading',
			'description' 	=> __( 'Other Settings', 'newsplus' )
		),

		'cust_bg' => array(
			'id' 			=> 'cust_bg',
			'title' 		=> __( 'Custom background for content area', 'newsplus' ),
			'type' 			=> 'text',
			'description' 	=> __( 'Use a background color or image url property. E.g. #f5f5f5', 'newsplus' )
		),

		'hide_crumbs' => array(
			'id' 			=> 'hide_crumbs',
			'title' 		=> __( 'Hide breadcrumbs on this page.', 'newsplus' ),
			'type' 			=> 'checkbox'
		),
		
		'hide_page_title' => array(
			'id' 			=> 'hide_page_title',
			'title' 		=> __( 'Hide page title on this page', 'newsplus' ),
			'type' 			=> 'checkbox'
		),

		'hide_secondary' => array(
			'id' 			=> 'hide_secondary',
			'title' 		=> __( 'Hide secondary widget area on this page.', 'newsplus' ),
			'type' 			=> 'checkbox'
		)
	);

	return $page_opts;
}

function newsplus_add_page_options_key() {
	return 'page_options';
}

add_filter( 'pls_page_opts_array', 'newsplus_add_page_options' );
add_filter( 'pls_page_opts_key', 'newsplus_add_page_options_key' );