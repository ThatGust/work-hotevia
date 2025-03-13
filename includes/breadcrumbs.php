<?php
/**
 * Breadcrumbs
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

if ( !function_exists( 'ss_breadcrumbs' ) ):
    function ss_breadcrumbs() {
        if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() ) )
            return;

        $delimiter  = apply_filters( 'newsplus_breadcrumb_sep', '<span class="sep"></span>' );
        $home       = esc_html__( 'Home', 'newsplus' );
        $before     = '<span class="current">';
        $after      = '</span>';
        $paged      = '';

        if ( ( ! is_home() && ! is_front_page() && ! ( is_single() && ! is_singular( 'post' ) ) ) ) {
            echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumbs">';
            global $post;
            $home_link = home_url();

            if ( get_query_var( 'paged' ) ) {
                $paged = sprintf( esc_html__( ' (Page %s)', 'newsplus' ), get_query_var( 'paged' ) );
            }

            // Home
            printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( $home_link ), ' itemprop="name"', esc_html__( 'Home', 'newsplus' ), '<meta itemprop="position" content="1" />',
                ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
            );

            // Category
            if ( is_category() ) {
                global $post;
                $pos      = 2;
                $curr_cat = get_category( get_query_var( 'cat' ) );
                $parents  = get_ancestors( $curr_cat->term_id, $curr_cat->taxonomy );
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;

                        printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( $link ), ' itemprop="name"', esc_html( $name ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                            ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                        );
                        $pos++;
                    }
                }

                // Current category name
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( $curr_cat->name ) .esc_attr( $paged ),
                    '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );
            }

            elseif ( is_day() ) {

                // Current year
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_year_link( get_the_time( 'Y' ) ) ), ' itemprop="name"', get_the_time( 'Y' ), '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current month
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), ' itemprop="name"', get_the_time( 'm' ), '<meta itemprop="position" content="3" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current day
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    get_the_time( 'd' ) . esc_attr( $paged ),
                    '<meta itemprop="position" content="4" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

            } elseif ( is_month() ) {

                // Current year
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_year_link( get_the_time( 'Y' ) ) ), ' itemprop="name"', get_the_time( 'Y' ), '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current month
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    get_the_time( 'm' ) . esc_attr( $paged ),
                    '<meta itemprop="position" content="3" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

            } elseif ( is_year() ) {
                // Current year
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    get_the_time( 'Y' ) . esc_attr( $paged ),
                    '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );
            }

            elseif ( is_single() && ! is_attachment() ) {
                $curr_cat = get_the_category( $post->id );
                $parents  = get_ancestors( $curr_cat[0]->term_id, $curr_cat[0]->taxonomy );
                $pos     = 2;
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;
                        printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( $link ), ' itemprop="name"', esc_html( $name ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                            ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                        );
                        $pos++;
                    }
                }

                // Current category link
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_category_link( $curr_cat[0]->term_id ) ), ' itemprop="name"', esc_html( $curr_cat[0]->name ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current post name
                $title = '' !== get_the_title() ? get_the_title() : get_the_id();
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    wp_strip_all_tags( $title ),
                    '<meta itemprop="position" content="' . ( $pos + 1 ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );
            } elseif ( is_attachment() ) {

                $post_parent = get_post( $post->post_parent );
                $curr_cat    = get_the_category( $post_parent->ID );
                $parents = get_ancestors( $curr_cat[0]->term_id, $curr_cat[0]->taxonomy );
                $pos     = 2;
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;

                        printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', es_url( $link ), ' itemprop="name"', esc_attr( $name ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                            ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                        );
                        $pos++;
                    }
                }

                // Current category link
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_category_link( $curr_cat[0]->term_id ) ), ' itemprop="name"', es_attr( $curr_cat[0]->name ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current post link
                printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_permalink( $post_parent ) ), ' itemprop="name"', wp_strip_all_tags( $post_parent->post_title ), '<meta itemprop="position" content="' . ( $pos + 1 ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

                // Current attachment name
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    wp_strip_all_tags( get_the_title() ),
                    '<meta itemprop="position" content="' . ( $pos + 1 ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

            } elseif ( is_page() && ! $post->post_parent ) {
                // Current page name
                $title = '' !== get_the_title() ? get_the_title() : get_the_id();
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( $title ),
                    '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );
            } elseif ( is_page() && $post->post_parent ) {
                $parent_id = $post->post_parent;
                $items     = array();
                $pos       = 2;
                while ( $parent_id ) {
                    $page      = get_page( $parent_id );
                    $parent_id = $page->post_parent;
                    $items[]   = $page;
                }

                $items = array_reverse( $items );

                if ( !empty( $items ) && is_array( $items ) ) {
                    foreach ( $items as $item ) {
                        printf( '<li%6$s><a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s</li>', ' itemprop="item"', esc_url( get_permalink( $item->ID ) ), ' itemprop="name"', esc_html( get_the_title( $item->ID ) ), '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                            ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                        );
                        $pos++;
                    }
                }

                // Current page name
                $title = ( '' !== get_the_title() ) ? get_the_title() : get_the_id();
                printf( '<li%4$s><span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( $title ),
                    '<meta itemprop="position" content="' . esc_attr( $pos ) . '" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'
                );

            } elseif ( is_search() ) {
                printf( '<li%4$s>%5$s<span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( get_search_query() ),
                    '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"',
                    esc_html__( 'Search results for: ', 'newsplus' )
                );
            } elseif ( is_tag() ) {
                $tag_obj = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' );
                printf( '<li%4$s>%5$s<span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( single_tag_title( '', false ) . $paged ),
                    '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"',
                    esc_html__( 'Posts tagged: ', 'newsplus' )
                );
            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata( $author );

                printf( '<li%4$s>%5$s<span%1$s>%2$s</span>%3$s',
                    ' itemprop="name"',
                    esc_html( $userdata->display_name  . $paged ),
                    '<meta itemprop="position" content="2" />',
                    ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"',
                    esc_html__( 'Articles posted by: ', 'newsplus' )
                );

            } elseif ( is_404() ) {
                printf( '<li>%s</li>', esc_html__( 'Error 404', 'newsplus' ) );
            }

            echo '</ol>';
        }
    } // end ss_breadcrumbs()
endif;

/* Function to show breadcrumbs as required */
if ( !function_exists( 'show_breadcrumbs' ) ):
    function show_breadcrumbs() {
        global $post;

        if ( !is_home() && !is_front_page() ) {
            if ( is_page() ) {
                $page_opts   = get_post_meta( $post->ID, 'page_options', true );
                $hide_crumbs = isset( $page_opts['hide_crumbs'] ) ? $page_opts['hide_crumbs'] : '';
                if ( 'true' != $hide_crumbs ) { // If not opted to hide breadcrumbs
                    if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                        ss_breadcrumbs();
                    }
                } // Hide breadcrumbs
                elseif ( !isset( $page_opts ) ) {
                    if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                        ss_breadcrumbs();
                    }
                } // Default Fallback when no options are set
            } // is_page
            else {
                if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                    ss_breadcrumbs();
                }
            }
        }
    }
endif;
?>