<?php
/**
 * Template Name: Page - Contact
 *
 * Description: A page template for displaying contact form.
 */

if ( isset( $_POST['submit'] ) ) :

	// Validate Name Field
	if ( trim( $_POST['username'] ) === '' ) {
		$name_err = __( 'Enter Your Name', 'newsplus' );
		$errorflag = true;
	}
	else {
		$name = trim( $_POST['username'] );
	}

	// Validate E-mail Address
	if ( trim( $_POST['email'] ) === '' ) {
		$email_err = __( 'An email is required', 'newsplus' );
		$errorflag = true;
	} elseif ( ! preg_match( "/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim( $_POST['email'] ) ) ) {
		$email_err = __( 'Enter a valid email', 'newsplus' );
		$errorflag = true;
	} else {
		$email = trim( $_POST['email'] );
	}

	// If URL is left blank. Allow form sending
	if ( trim( $_POST['url'] ) == '' ) {
		$url = __( 'No URL provided', 'newsplus' );
	}
	elseif ( trim( $_POST['url'] ) != '' ) {
		if ( ! preg_match( "/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", trim($_POST['url'] ) ) ) {
			$url_err = __( 'Please enter a valid URL', 'newsplus' );
			$errorflag = true;
		}
		else
			$url = trim($_POST['url']);
	}

	// Validate Message
	if ( trim( $_POST['comment'] ) === '' ) {
		$comment_err = __( 'A comment is required', 'newsplus' );
		$errorflag = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( trim( $_POST['comment'] ) );
		} else {
			$comments = trim( $_POST['comment'] );
		}
	}

	//If there were no errors, send the mail.
	if ( ! isset( $errorFlag ) ) {
	
		$to			 = ( get_option( 'pls_email' ) != '' ) ? get_option( 'pls_email' ) : get_option( 'admin_email' );
		$subject	 = sprintf( __( 'Message sent from your website by: %1$s', 'newsplus' ), $name );
	
		$headers	 = "From: " . $email . "\r\n";
		$headers	.= "Reply-To: " . $email . "\r\n";
		$headers	.= "MIME-Version: 1.0\r\n";
		$headers	.= "Content-Type: text/html; charset=UTF-8\r\n";
	
		$message	 = '<html><body>';
		$message	.= 'Name: ' . $name . '<br/>';
		$message	.= 'Email: ' . $email . '<br/>';
		$message	.= 'URL: ' . $url . '<br/>';
		$message	.= 'Message: ' . $comments . '<br/>';
		$message	.= '</body></html>';
	
		if ( function_exists( 'newsplus_mail' ) ) {
			$sent_mail	 = newsplus_mail( $to, $subject, $message, $headers );
		}

		if( $sent_mail )
			$sent = true;

		else	//the mail was not sent
			$sent = false;
	}
	
endif; // isset form
get_header(); ?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
		<?php show_breadcrumbs();
		$page_opts 		= get_post_meta( $posts[0]->ID, 'page_options', true );
		$hide_page_title = isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;
		
		if ( ! ( $hide_page_title || get_option( 'pls_hide_page_titles' ) ) ) {			
		   echo '<header class="page-header"><h1 class="entry-title">' . get_the_title() . '</h1></header>';            
		}
			
        if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
				if ( '' != get_option( 'pls_google_map' ) ) {
					$column_class = 'column half last'; ?>
					<div class="column half">
						<?php echo stripslashes( get_option( 'pls_google_map' ) ); ?>
					</div><!-- .half -->
					<?php
                } // Google Map
				else
					$column_class = 'full'; ?>
				<div class="<?php echo esc_attr( $column_class ); ?>">
					<?php if ( isset( $sent ) ) { ?>
                    <div id="mail-success-no-js" class="box box2">
                    <?php echo stripslashes( get_option( 'pls_success_msg' ) ); ?>
                    </div><!-- .mail-success-no-js-->
                    <?php } ?>
                    <form <?php if ( isset( $sent ) ) { ?>style="display:none"<?php }?> action="<?php the_permalink();?>" method="post" id="contactform" class="commentform">
                        <p><label for="name"><?php _e( 'Name<span class="required">*</span>', 'newsplus' ); ?></label><input type="text" class="<?php if ( isset( $name_err ) && $name_err != '' ) { ?>error<?php } ?>" id="name" name="username" value="<?php if ( isset( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" /></p>
                        <p><label for="email"><?php _e( 'Email<span class="required">*</span>', 'newsplus' ); ?></label><input type="text" id="email" name="email" class="<?php if ( isset( $email_err ) && $email_err != '' ) { ?>error<?php } ?>" value="<?php if ( isset( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" /></p>
                        <p><label for="url"><?php _e( 'URL', 'newsplus' ); ?></label><input type="text" id="url" name="url" class="<?php if ( isset( $url_err ) && $url_err != '' ) { ?>error<?php } ?>" value="<?php if ( isset( $_POST['url'] ) ) echo esc_url( $_POST['url'] ); ?>" /></p>
                        <p><label for="comment"><?php _e( 'Message<span class="required">*</span>', 'newsplus' ); ?></label><textarea name="comment" rows="10" cols="8" class="<?php if ( isset( $comment_err ) && $comment_err != '' ) { ?>error<?php } ?>" id="comment" ><?php if ( isset( $_POST['comment'] ) ) { if ( function_exists( 'stripslashes' ) ) { echo stripslashes( $_POST['comment'] ); } else { echo esc_html( $_POST['comment'] ); } } ?></textarea></p>
                        <p class="submit"><input name="submit" type="submit" class="submit" tabindex="5" value="<?php _e( 'Send Message', 'newsplus' ); ?>" /></p>
                        </form>
                    <div id="mail_success" class="box box2">
                    <?php echo stripslashes( get_option( 'pls_success_msg' ) ); ?>
                    </div>
				</div><!-- .<?php echo esc_attr( $column_class ); ?> -->
			<?php endwhile;
        else : ?>
            <article id="post-0" class="post no-results not-found">
                <header class="page-header">
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'newsplus' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newsplus' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->
        <?php endif; ?>
    </div><!-- #content -->
    <?php
	newsplus_sidebar_b();
    ?>
    </div><!--.primary-row -->
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	get_sidebar();
}
get_footer(); ?>