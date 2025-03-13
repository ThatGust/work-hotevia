<?php
/**
 * The Template for displaying all single posts
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

get_header();

// Fetch post option custom fields
$post_opts 			= get_post_meta( $posts[0]->ID, 'post_options', true );
$sp_post_check      = isset( $post_opts['sp_post'] ) ? $post_opts['sp_post'] : '';
$ad_above 			= ( isset( $post_opts['ad_above'] ) ) ? $post_opts['ad_above'] : '';
$ad_below 			= ( isset( $post_opts['ad_below'] ) ) ? $post_opts['ad_below'] : '';
$ad_above_check 	= ( isset( $post_opts['ad_above_check'] ) ) ? $post_opts['ad_above_check'] : '';
$ad_below_check 	= ( isset( $post_opts['ad_below_check'] ) ) ? $post_opts['ad_below_check'] : '';
$hide_image 		= ( isset( $post_opts['hide_image'] ) ) ? $post_opts['hide_image'] : '';
$show_image 		= ( isset( $post_opts['show_image'] ) ) ? $post_opts['show_image'] : '';
$hide_related 		= ( isset( $post_opts['hide_related'] ) ) ? $post_opts['hide_related'] : '';
$post_full_width 	= ( isset( $post_opts['post_full_width'] ) ) ? $post_opts['post_full_width'] : '';
$post_class 		= ( 'true' == $post_full_width ) ? ' full-width' : '';
$sp_label_single    = ( isset( $post_opts['sp_label_single'] ) ) ? $post_opts['sp_label_single'] : '';
$enable_schema 		= get_option( 'pls_schema', false );
$sng_header         = get_option( 'pls_sng_header', 'inline' );

$thumbnail = '';
$sng_width = get_option( 'sng_width' );
$sng_height = get_option( 'sng_height' );
$sng_quality = get_option( 'sng_quality' );
$sng_crop = get_option( 'sng_crop' );

$schema =  newsplus_schema( $enable_schema, $sng_width, $sng_height );
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
$sng_feat_img_style = get_option( 'pls_sng_header', 'inline' );

// Full width title header
if ( 'full' == $sng_header ) {
?>
    <div class="ad-area-above-content">
    <?php
    if ( '' == $ad_above_check ) :
        if ( get_option( 'pls_ad_above', false ) && '' == $ad_above ) : ?>
            <div class="marketing-area">
            <?php echo do_shortcode( stripslashes( get_option( 'pls_ad_above' ) ) ); ?>
            </div>
            <?php
        elseif ( ! empty( $ad_above ) ) : ?>
            <div class="marketing-area">
            <?php echo do_shortcode( stripslashes( $ad_above ) ); ?>
            </div>
        <?php
        endif; // if ad not empty
    endif; // Single post show-ad-above check
    ?>
    </div><!-- /.ad-area-above-content -->
    <?php
    if ( 'overlay' !== $sng_feat_img_style ) {
    ?>
     <header class="entry-header newsplus full-header single-meta">
        <?php
        show_breadcrumbs();
        if ( $sp_post_check && $sp_label_single ) {
            echo '<span class="sp-label-single">' . esc_attr( $sp_label_single ) . '</span>';
        }
        printf( '%s', $rows['row_1'] );
        echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
        printf( '%s', $rows['row_4'] );
    ?>
    </header>
    <?php
    }
}
?>
<div id="primary" class="site-content<?php echo esc_attr( $post_class ); ?>">
	<div class="primary-row">
        <div id="content" role="main">
			<?php
            if ( 'full' !== $sng_header && 'overlay' !== $sng_feat_img_style ) {
                show_breadcrumbs();

                if ( $sp_post_check && $sp_label_single ) {
                    echo '<span class="sp-label-single">' . esc_attr( $sp_label_single ) . '</span>';
                }
            }

            // Advertisement above post
            if ( '' == $ad_above_check ) :
                if ( get_option( 'pls_ad_above', false ) && '' == $ad_above ) : ?>
                    <div class="marketing-area">
                    <?php echo do_shortcode( stripslashes( get_option( 'pls_ad_above' ) ) ); ?>
                    </div>
                    <?php
                elseif ( ! empty( $ad_above ) ) : ?>
                    <div class="marketing-area">
                    <?php echo do_shortcode( stripslashes( $ad_above ) ); ?>
                    </div>
                <?php
                endif; // if ad not empty
            endif; // Single post show-ad-above check

            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>

                    <article<?php printf( '%s', $schema['container'] ); ?>  id="post-<?php the_ID(); ?>" <?php post_class( 'newsplus main-article' ); ?>>
                    <?php
                        if ( 'full' == $sng_header || 'overlay' == $sng_feat_img_style ) {
                            // Show hidden meta for heading itemprop
                            if ( $enable_schema ) {
                                echo '<meta' . $schema['heading'] . ' content="' . get_the_title() . '">';
                                if ( has_excerpt() ) {
                                    echo '<meta itemprop="description" content="' . esc_attr( get_the_excerpt() ) . '">';
                                }
                            }

                            if ( 'overlay' !== $sng_feat_img_style ) {
                                if ( 'video' == get_post_format() ) {
                                    get_template_part( 'formats/format', 'video' );
                                }

                                elseif ( 'gallery' == get_post_format() ) {
                                    get_template_part( 'formats/format', 'gallery' );
                                }

                                else {
                                    get_template_part( 'formats/single-format' );
                                }
                            }
                        } else {
                            if ( 'overlay' !== $sng_feat_img_style ) {
                        ?>
                            <header class="entry-header single-meta">
                                <?php
                                printf( '%s', $rows['row_1'] );
                                echo '<h1' . $schema['heading']. ' class="entry-title">' . get_the_title() . '</h1>';
                                printf( '%s', $rows['row_4'] );

                                if ( 'video' == get_post_format() ) {
                                    get_template_part( 'formats/format', 'video' );
    							}

    							elseif ( 'gallery' == get_post_format() ) {
                                    get_template_part( 'formats/format', 'gallery' );
    							}

    							else {
    								get_template_part( 'formats/single-format' );
                                }
                            ?>
                            </header>
                        <?php }
                        }
                        ?>

                        <div class="entry-content articlebody"<?php printf ( $enable_schema ? ' itemprop="articleBody"' : '' ); ?>>
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
<!-- Google DFP -->
			        <!-- /22928866073/banner-final-articulo -->
<div id='div-gpt-ad-1686606309375-0' style='min-width: 728px; min-height: 90px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1686606309375-0'); });
  </script>
</div>
			        <!-- Google DFP -->
                        <footer class="entry-footer">
                            <?php
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'newsplus' ),
                                'after' => '</div>'
                            ) );

                            if ( 'true' != get_option( 'pls_hide_tags' ) ) :
                                if ( get_the_tag_list() ) :
                                    printf( '<div class="tag-wrap"%s>%s</div>',
                                        $enable_schema ? ' itemprop="about"' : '',
                                        get_the_tag_list( '<ul class="tag-list"><li>', '</li><li>', '</li></ul>' )
                                    );
                                endif; // tag list
                            endif; // hide tags
                            ?>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID();?> -->
                    
                    <?php
                    // Previous/next post navigation.
                    if ( 'true' != get_option( 'pls_post_navigation' ) ) {
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'newsplus' ) . '</span> ' .
                            '<span class="screen-reader-text">' . __( 'Next post:', 'newsplus' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'newsplus' ) . '</span> ' .
                            '<span class="screen-reader-text">' . __( 'Previous post:', 'newsplus' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                        ) );
                    }

                    // Social sharing counters
                    if ( 'true' == get_option( 'pls_ss_sharing' ) ) { ?>
                        <div class="ss-sharing-container clear">
                            <?php
                            echo '<h4>' . apply_filters( 'newsplus_social_counters_heading', __( 'Share this post', 'newsplus' ) ) . '</h4>';
                            ss_sharing();
                            ?>
                        </div><!-- .ss-sharing-container -->
                    <?php
                    }

                    // Social sharing buttons
                    if ( 'true' == get_option( 'pls_show_social_btns' ) ) {
                        echo '<h4 class="social-button-heading">' . apply_filters( 'newsplus_social_buttons_heading', __( 'Share this post', 'newsplus' ) ) . '</h4>';
                        echo newsplus_social_sharing( get_option( 'pls_social_btns' ) );
                    }

                    // Author bio
                    if ( ! get_option( 'pls_author', false ) ) {
                        newsplus_author_bio();
                    }

                    // Related posts
                    if ( 'true' != get_option( 'pls_rp' ) ) {
                        if ( ! $hide_related ) {
                            get_template_part( 'includes/related-posts' );
                        }
                    }

                    // Ad area below post content
                    if ( '' == $ad_below_check ) {
                        if ( get_option( 'pls_ad_below', false ) && '' == $ad_below ) { ?>
                            <div class="marketing-area">
                                <?php echo do_shortcode( stripslashes( get_option( 'pls_ad_below' ) ) ); ?>
                            </div>
                            <?php
                        }
                        elseif ( ! empty( $ad_below ) ) { ?>
                            <div class="marketing-area">
                                <?php echo do_shortcode( stripslashes( $ad_below ) ); ?>
                            </div>
                            <?php
                        }
                    }

                    // Comments
                    comments_template( '', true );

                endwhile;

            else :
                newsplus_no_posts();
            endif; ?>
        </div><!-- #content -->
        <?php
        newsplus_sidebar_b();
        ?>
    </div><!-- .primary-row -->
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	if ( 'true' != $post_full_width ) {
		get_sidebar();
	}
}
get_footer(); ?>