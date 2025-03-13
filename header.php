<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "#main" div.
 */
$schema = newsplus_schema( get_option( 'pls_schema' ) );
$pls_header_style = get_option( 'pls_header_style', 'default' );
$pls_disable_resp_css = get_option( 'pls_disable_resp_css' );
$pls_html_main_menu = get_option( 'pls_html_main_menu' );
$pls_html_top_menu = get_option( 'pls_html_top_menu' );
?><!DOCTYPE html>
<html <?php printf( '%s', $schema['html'] ); language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( 'true' != $pls_disable_resp_css ) : ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2228174355565432"
     crossorigin="anonymous"></script>
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/1a06659f197b417d6bd3e3058/3917774c442f2fae0bf581dfc.js");</script>
	<!-- Google DFP -->
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/22928866073/hotevia-header-1', [800, 200], 'div-gpt-ad-1685536153316-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-home-contenidos-1', [750, 188], 'div-gpt-ad-1686233605735-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-home-contenidos-2', [750, 188], 'div-gpt-ad-1686233697349-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-home-contenidos-3', [750, 188], 'div-gpt-ad-1741185631673-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-laterla-1-hotevia', [333, 400], 'div-gpt-ad-1686086586577-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-2-hotevia', [333, 400], 'div-gpt-ad-1685725232961-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-3-hotevia', [333, 400], 'div-gpt-ad-1685725346311-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-4-hotevia', [333, 400], 'div-gpt-ad-1685725407771-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-5-hotevia', [333, 400], 'div-gpt-ad-1685725463245-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-6-hotevia', [333, 400], 'div-gpt-ad-1685725546999-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-7-hotevia', [333, 400], 'div-gpt-ad-1685726273480-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-8-hotevia', [333, 400], 'div-gpt-ad-1685726313052-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-9-hotevia', [333, 400], 'div-gpt-ad-1685726383968-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-10-hotevia', [333, 400], 'div-gpt-ad-1686086502024-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-11-hotevia', [333, 400], 'div-gpt-ad-1685726514067-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-12-hotevia', [333, 400], 'div-gpt-ad-1685726561556-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-13-hotevia', [333, 400], 'div-gpt-ad-1686086961203-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-14-hotevia', [333, 400], 'div-gpt-ad-1740494397694-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-15-hotevia', [333, 400], 'div-gpt-ad-1697558715993-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-16-hotevia', [333, 400], 'div-gpt-ad-1698077383723-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-17-Hotevia', [333, 400], 'div-gpt-ad-1699900827915-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-18-Hotevia', [333, 400], 'div-gpt-ad-1699900999881-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-19-Hotevia', [333, 400], 'div-gpt-ad-1708090362054-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-20-hotevia', [333, 400], 'div-gpt-ad-1708094257841-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-21-hotevia', [333, 400], 'div-gpt-ad-1708094359979-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-22-hotevia', [333, 400], 'div-gpt-ad-1708094429031-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-23-hotevia', [333, 400], 'div-gpt-ad-1708094517464-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-lateral-24-hotevia', [333, 400], 'div-gpt-ad-1708094588513-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-oferta-empleos-1', [750, 188], 'div-gpt-ad-1686665991624-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-final-articulo', [728, 90], 'div-gpt-ad-1686606309375-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-new-1', [600, 188], 'div-gpt-ad-1715131107277-0').addService(googletag.pubads());
    googletag.defineSlot('/22928866073/banner-interno-articulos-400-1', [400, 200], 'div-gpt-ad-1715130835428-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-1', [750, 188], 'div-gpt-ad-1714863903217-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-2', [750, 188], 'div-gpt-ad-1714864079667-0').addService(googletag.pubads());
    googletag.defineSlot('/22928866073/banner-interno-articulos-3', [750, 188], 'div-gpt-ad-1731442825854-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-4', [750, 188], 'div-gpt-ad-1686694502532-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-5', [750, 188], 'div-gpt-ad-1686694549191-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-6', [750, 188], 'div-gpt-ad-1687279494092-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-7', [750, 188], 'div-gpt-ad-1687279554299-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-8', [750, 188], 'div-gpt-ad-1687279602154-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-9', [750, 188], 'div-gpt-ad-1687279645707-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-10', [750, 188], 'div-gpt-ad-1687279714681-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-11', [750, 188], 'div-gpt-ad-1687279751403-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-12', [750, 188], 'div-gpt-ad-1693836436516-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-13', [750, 188], 'div-gpt-ad-1687279825974-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-14', [750, 188], 'div-gpt-ad-1687279867528-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-15', [750, 188], 'div-gpt-ad-1687279905675-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-16', [750, 188], 'div-gpt-ad-1687279940680-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-17', [750, 188], 'div-gpt-ad-1687279989204-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-18', [750, 188], 'div-gpt-ad-1687280022604-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-19', [750, 188], 'div-gpt-ad-1687280056235-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/banner-interno-articulos-20', [750, 188], 'div-gpt-ad-1687280091004-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-enlace-directorio-1', [300, 31], 'div-gpt-ad-1687543689456-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-1', [300, 31], 'div-gpt-ad-1686877225958-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-2', [300, 31], 'div-gpt-ad-1688240426584-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-3', [300, 31], 'div-gpt-ad-1686877338162-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-4', [300, 31], 'div-gpt-ad-1686877392214-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-5', [300, 31], 'div-gpt-ad-1686877447941-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-6', [300, 31], 'div-gpt-ad-1686877501951-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-7', [300, 31], 'div-gpt-ad-1686877566095-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-8', [300, 31], 'div-gpt-ad-1686877620553-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-9', [300, 31], 'div-gpt-ad-1686877674490-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-10', [300, 31], 'div-gpt-ad-1686877726556-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-11', [300, 31], 'div-gpt-ad-1686877790825-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-12', [300, 31], 'div-gpt-ad-1686877838575-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-13', [300, 31], 'div-gpt-ad-1686877912945-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-14', [300, 31], 'div-gpt-ad-1686877961175-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-15', [300, 31], 'div-gpt-ad-1686878007643-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-16', [300, 31], 'div-gpt-ad-1686878059556-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-17', [300, 31], 'div-gpt-ad-1686878103982-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-18', [300, 31], 'div-gpt-ad-1686878147165-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-19', [300, 31], 'div-gpt-ad-1686878204541-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-url-20', [300, 31], 'div-gpt-ad-1686878281306-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-grande-url-1', [400, 50], 'div-gpt-ad-1687961202576-0').addService(googletag.pubads());
	googletag.defineSlot('/22928866073/boton-750x188-internos-1', [750, 188], 'div-gpt-ad-1688262224090-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
	<!-- Google DFP -->
</head>

<body <?php body_class(); ?>>
	<?php
	wp_body_open();
    if ( is_active_sidebar( 'top-widget-area' ) ) { ?>
        <div class="wrap top-widget-area">
        <?php dynamic_sidebar( 'top-widget-area' ); ?>
        </div><!-- .top-widget-area -->
    <?php } ?>
    <div id="page" class="hfeed site clear">
    <?php if ( 'true' != get_option( 'pls_top_bar_hide' ) ) : ?>
        <div id="utility-top" class="top-nav">
            <div class="wrap clear">
                <?php if ( 'menu' == get_option( 'pls_cb_item_left', 'text' ) ) : ?>
                <nav id="optional-nav" class="secondary-nav">
                    <?php
                    if ( '' != $pls_html_top_menu ) {
						echo do_shortcode( stripslashes( $pls_html_top_menu ) );
					}
					else {
						wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'sec-menu clear', 'container' => false ) );
					}?>
                </nav><!-- #optional-nav -->
                <?php else : ?>
                <div id="callout-bar" class="callout-left" role="complementary">
                    <div class="callout-inner">
                    <?php echo do_shortcode( stripslashes( get_option( 'pls_cb_text_left', __( 'Optional text here', 'newsplus' ) ) ) ); ?>
                    </div><!-- .callout-inner -->
                </div><!-- #callout-bar -->
                <?php endif;
                if ( 'searchform' == get_option( 'pls_cb_item_right', 'searchform' ) ) {  ?>
                <div id="search-bar" role="complementary">
                    <?php get_search_form(); ?>
                </div><!-- #search-bar -->
                <?php }
                elseif ( 'cart' == get_option( 'pls_cb_item_right' ) && class_exists( 'woocommerce' ) ) {
                    get_template_part( 'woocommerce/cart-nav' );
                }
                else { ?>
                    <div id="callout-bar" role="complementary">
                        <div class="callout-inner">
                        <?php echo do_shortcode( stripslashes( get_option( 'pls_cb_text_right' ) ) );  ?>
                        </div><!-- .callout-inner -->
                    </div><!-- #callout-bar -->
                <?php } // callout bar item check ?>
            </div><!-- .top-nav .wrap -->
        </div><!-- .top-nav-->
		<?php endif;
	 
		if ( 'below_top_menu' == get_option( 'pls_ticker_placement' ) ) {
			if ( get_option( 'pls_ticker_home_check' ) ) {
				if ( is_home() || is_front_page() ) {
					echo '<div class="wrap newsplus-news-ticker after-top-menu">' . newsplus_ticker_output() . '</div>';
				}
			}
			else {
				echo '<div class="wrap newsplus-news-ticker after-top-menu">' . newsplus_ticker_output() . '</div>';
			}
        }		
		
		if ( 'slim' == $pls_header_style ) {
			get_template_part( 'includes/header-slim' );
		}		
		
		else {
		?>
            <header id="header" class="site-header">
                <div class="wrap full-width clear">    
                <?php                
                    get_template_part( 'includes/header-' . $pls_header_style );
                ?>
                </div><!-- #header .wrap -->
            </header><!-- #header -->
        <?php 
		}
		
		if ( 'slim' !== $pls_header_style ) {

			if ( 'true' != $pls_disable_resp_css ) {
				if ( 'true' != get_option( 'pls_disable_resp_menu' ) ) {
				?>
					<div id="responsive-menu" class="resp-main">
                        <div class="wrap">
							<?php if ( get_option( 'pls_inline_search_box', false ) ) { ?>
                                <div class="inline-search-box"><a class="search-trigger" href="#"><span class="screen-reader-text"><?php esc_attr_e( 'Open search panel', 'newsplus' ); ?></span></a>
                                
                                <?php get_search_form(); ?>  
                                </div><!-- /.inline-search-box -->   
                            <?php } ?>                         
                            <h3 class="menu-button"><span class="screen-reader-text"><?php echo apply_filters( 'newsplus_mobile_text', esc_attr__( 'Menu', 'newsplus' ) ); ?></span>Menu<span class="toggle-icon"><span class="bar-1"></span><span class="bar-2"></span><span class="bar-3"></span></span></h3>
                        </div><!-- /.wrap -->
						<nav<?php printf( '%s', $schema['nav'] ); ?> class="menu-drop"></nav><!-- /.menu-drop -->                        
					</div><!-- /#responsive-menu -->
				<?php
				}
			}			
			
			?>
            <nav<?php printf( '%s', $schema['nav'] ); ?> id="main-nav" class="primary-nav<?php if ( 'true' == get_option( 'pls_disable_resp_menu' ) ) echo ' do-not-hide'; if ( 'center' == get_option( 'pls_menu_align' ) ) echo ' text-center';?>">
                <div class="wrap clearfix<?php if ( get_option( 'pls_inline_search_box', false ) ) { echo ' has-search-box'; } ?>">
                    <?php
					if ( '' != $pls_html_main_menu ) {
						echo do_shortcode( stripslashes( $pls_html_main_menu ) );
					}
					else {
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu clear', 'container' => false ) );
					}
					
					if ( get_option( 'pls_inline_search_box', false ) ) { ?>
                        <div class="inline-search-box"><a class="search-trigger" href="#"><span class="screen-reader-text"><?php esc_attr_e( 'Open search panel', 'newsplus' ); ?></span></a>
                        
                        <?php get_search_form(); ?>  
                        </div><!-- /.inline-search-box -->   
                    <?php } ?>     
                    
                </div><!-- .primary-nav .wrap -->
            </nav><!-- #main-nav -->
		
		<?php
		}
		if ( 'below_main_menu' == get_option( 'pls_ticker_placement' ) ) {
			if ( get_option( 'pls_ticker_home_check' ) ) {
				if ( is_home() || is_front_page() ) {
					echo '<div class="wrap newsplus-news-ticker after-main-menu">' . newsplus_ticker_output() . '</div>';
				}
			}
			else {
				echo '<div class="wrap newsplus-news-ticker after-main-menu">' . newsplus_ticker_output() . '</div>';
			}
        }
		       
		if ( is_active_sidebar( 'widget-area-before-content' ) ) : ?>
            <div id="widget-area-before-content">
                <div class="wrap">
					<?php dynamic_sidebar( 'widget-area-before-content' ); ?>
                </div><!--.wrap -->
            </div><!-- #widget-area-before-content -->
        <?php endif;

        // Hooked newsplus_single_overlay_header() - 20
        do_action( 'newsplus_before_main' );
        ?>
        <div id="main">
            <div class="wrap clearfix">
            	<div class="main-row clearfix">