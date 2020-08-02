<?php
/**
 * Plugin Name: Setup Social Toolbar
 * Description: A toolbar that contains important information as well as buttons for sharing content.
 * Version: 4.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/* --------------------------------------------------------------------------------------------
 * | FILTER URL
 * ----------------------------------------------------------------------------------------- */
function spk_url_origin( $s, $use_forwarded_host = false ) {
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function spk_full_url( $s, $use_forwarded_host = false ) {
    return spk_url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

/* --------------------------------------------------------------------------------------------
 * | SOCIAL TOOLBAR
 * ----------------------------------------------------------------------------------------- */
function setup_social_toolbar_function() {

    $absolute_url = spk_full_url( $_SERVER );

    // check which page we're at
    if ( is_front_page() ) {
        $share_text = 'Succeed more. Learn More. Grow more. Life is... relationships. — '.get_bloginfo( 'description' );
    } else {
        $share_text = get_the_title( get_the_ID() );
    }

    // How to Support My Work
    $howtosupportmywork = '<div class="wrap">
                                <div>
                                    <h5 class="space-bottom-half">How To Support My Work</h5>
                                    <a class="item-pic pic-paypal" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LKGTSSLYJ93J6"></a>
                                    <div class="fontsize-xxsml space-bottom-half">This is a member supported site. You tip your favorite bartender, right? How about a buck, $2, $3, $5, maybe $10? Whatever YOU feel its worth, every time you feel I have given you a good tip, new knowledge or helpful insight. Please feel free to donate any amount you think is equal to the value you received from my eBook & Home Study Course (audio lessons), articles, emails, videos, newsletters, etc.</div>
                                    <a class="button space-bottom-half" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LKGTSSLYJ93J6"><h5>DONATE VIA PAYPAL</h5></a>
                                    <div class="fontsize-xxsml space-bottom-half">Just click the "Donate" button above to enter your donation/gratuity. Thanks in advance for your support! From my heart to yours, Corey Wayne.</div>
                                </div>
                            </div>';
    
    $sharesocialmedia = '<div class="wrap">
                            <div><h6 class="space-bottom-half">Share Page on Social Media:</h6></div>
                            <span><div><a class="item-icon-bar icon-twitter" href="https://twitter.com/share?url='.$absolute_url.'&text='.$share_text.'" target="_blank"></a></div></span>
                            <span><div><a class="item-icon-bar icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$absolute_url.'" target="_blank"></a></div></span>
                            <span><div><a class="addthis_button_compact"></a></div></span>
                         </div>'; // <img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" border="0" alt="Share" />

    $followcorey = '<span><a class="item-icon icon-twitter" href="https://www.twitter.com/CoachCoreyWayne"></a></span>
                    <span><a class="item-icon icon-facebook" href="https://www.facebook.com/Coach.Corey.Wayne"></a></span>
                    <span><a class="item-icon icon-linkedin" href="https://www.linkedin.com/in/coachcoreywayne"></a></span>
                    <span><a class="item-icon icon-youtube" href="https://www.youtube.com/user/coachcoreywayne?sub_confirmation=1"></a></span>
                    <span><a class="item-icon icon-instagram" href="https://instagram.com/CoachCoreyWayne/"></a></span>
                    <span><a class="item-icon icon-pinterest" href="https://www.pinterest.com/coachcoreywayne/"></a></span>
                    <span><a class="item-icon icon-medium" href="https://medium.com/@coachcoreywayne"></a></span>
                    <span><a class="item-icon icon-soundcloud" href="https://soundcloud.com/coachcoreywayne"></a></span>
					<span><a class="item-icon icon-podcast" href="https://itunes.apple.com/us/podcast/coach-corey-wayne/id1396723809?mt=2"></a></span>';

    $media_bd = '<a href="'.get_permalink( spk_master_get_post_id( 'free-ebook' ) ).'"><h5 class="space-bottom-half">Free eBook &amp; Online Audio Program Access</h5></a>                 

				<h4>How To Be A 3% Man</h4>
				<div class="fontsize-xsml space-bottom-half">
				<div>Audiobook | <a href="https://www.audible.com/pd/B01EIA86VC/?source_code=AUDFPWS0223189MWT-BK-ACX0-057626&ref=acx_bty_BK_ACX0_057626_rh_us">Audible - FREE Trial</a> | <a href="https://amzn.to/1rlT7vd">Audible - $19.95</a> | <a href="https://geo.itunes.apple.com/us/audiobook/how-to-be-a-3-man-unabridged/id1106013146?at=1l3vuUo&mt=3">iTunes - $19.95</a></div>
				<div>eBook | <a href="https://www.amazon.com/Winning-Heart-Woman-Your-Dreams-ebook/dp/B004QOBAPK/ref=as_sl_pc_ss_til?tag=understand0d4-20&amp;linkCode=w01&amp;linkId=7AK7WO7PJQCR2MPY&amp;creativeASIN=B004QOBAPK">Kindle - $9.99</a> | <a href="https://geo.itunes.apple.com/us/book/how-to-be-3-man-winning-heart/id948035350?mt=11&uo=6&at=1l3vuUo">iBook - $9.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/how-to-be-a-3-man-winning-the-heart-of-the-woman-of-your-dreams/ebook/product-23229519.html">Lulu.com - $9.99</a></div>
				<div>Paperback | <a href="https://www.amazon.com/Winning-Heart-Woman-Your-Dreams/dp/0692552669/ref=as_sl_pc_ss_til?tag=understand0d4-20&amp;linkCode=w01&amp;linkId=XKGGODHAZJIG4FEC&amp;creativeASIN=0692552669">Amazon - $29.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/how-to-be-a-3-man-winning-the-heart-of-the-woman-of-your-dreams/paperback/product-23232512.html">Lulu.com - $29.99</a></div>
				<div>Hardcover | <a href="http://amzn.to/2qe8Kci">Amazon - $59.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/how-to-be-a-3-man-winning-the-heart-of-the-woman-of-your-dreams/hardcover/product-23409054.html">Lulu.com - $59.99</h5></a></div>
				</div>

				<h4>Mastering Yourself</h4>
				<div class="fontsize-xsml space-bottom-half">
				<div>Audiobook | <a href="https://www.audible.com/pd/B07B3LCDKK/?source_code=AUDFPWS0223189MWT-BK-ACX0-109399&ref=acx_bty_BK_ACX0_109399_rh_us">Audible - FREE Trial</a> | <a href="http://amzn.to/2CRjVIM">Audible - $24.95</a> | <a href="https://geo.itunes.apple.com/us/audiobook/mastering-yourself-how-to-align-your-life-your-true/id1353594955?mt=3&at=1l3vuUo">iTunes - $24.95</a></div>
				<div>eBook | <a href="http://amzn.to/2CPRhI8">Kindle - $9.99</a> | <a href="https://geo.itunes.apple.com/us/book/mastering-yourself-how-to-align-your-life-your-true/id1353139487?mt=11&at=1l3vuUo">iBook - $9.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/mastering-yourself-how-to-align-your-life-with-your-true-calling-reach-your-full-potential/ebook/product-23536468.html">Lulu.com - $9.99</a></div>
				<div>Paperback | <a href="http://amzn.to/2oB0HmB">Amazon - $49.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/mastering-yourself-how-to-align-your-life-with-your-true-calling-reach-your-full-potential/paperback/product-23528167.html">Lulu.com - $49.99</a></div>
				<div>Hardcover | <a href="https://amzn.to/2Gvg238">Amazon - $99.99</a> | <a href="http://www.lulu.com/shop/corey-wayne/mastering-yourself-how-to-align-your-life-with-your-true-calling-reach-your-full-potential/hardcover/product-23537349.html">Lulu.com - $99.99</h5></a></div>
				</div>';
    
    ?>

    <!-- DESKTOP VERSION - DONATE / SUPPORT -->
    <div class="st_desktop_donate_pop">
        <?php echo $howtosupportmywork; ?>
    </div>

    <!-- DESKTOP VERSION - BOOK -->
    <div class="st_desktop_book_pop"><div class="wrap">
        <div class="media">
        <div class="media-img"><a class="item-pic pic-ebook" href="<?php echo get_permalink( spk_master_get_post_id( 'free-ebook' ) ); ?>"></a></div>
        <div class="media-bd"><?php echo $media_bd; ?></div>
        </div>
    </div></div>

    <!-- DESKTOP VERSION - PRODUCTS -->
    <div class="st_desktop_products_pop">
        <div class="wrap">
            <div class="media">
            <div class="media-img"><a class="item-icon icon-phonecoaching" href="<?php echo get_permalink( spk_master_get_post_id( 'phone-coaching' ) ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( '22818' ); ?>"><h5>1 Hour Phone/Skype Coaching Session</h5></a></div>
            </div>
            <div class="divider-line clearfix space-vertical-half"></div>
            <div class="media">
            <div class="media-img"><a class="item-icon icon-emailcoaching" href="<?php echo get_permalink( spk_master_get_post_id( 'email-coaching' ) ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( spk_master_get_post_id( 'email-coaching' ) ); ?>"><h5>Emergency Email Response Coaching</h5></a></div>
            </div>
            <div class="divider-line clearfix space-vertical-half"></div>
            <div class="media">
            <div class="media-img"><a class="item-icon icon-amazon" href="<?php echo get_permalink( '22910' ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( '22910' ); ?>"><h5>Self-Help Products, Books, Supplements, Etc. I Recommend</h5></a></div>
            </div>
        </div>
    </div>

    <!-- DESKTOP VERSION | PARENT -->
    <div class="st_desktop" id="st_desktop">
        <div class="wrap">

        <div class="st_desktop_follow"><?php echo $followcorey; ?></div>
            
        <div class="st_desktop_donate">
            <div class="st-desktop-cta-donate"></div>
        </div>

        <div class="st_desktop_book">
            <div class="st-desktop-cta-book"></div>
        </div>

        <div class="st_desktop_products">
            <div class="st-desktop-cta-product"></div>
        </div>

        <div class="st_desktop_coaching">
        </div>

        <div class="st_desktop_share"><?php echo $sharesocialmedia; ?></div>

        </div>
    </div>

    <!-- COMPACT VERSION - FOLLOW -->
    <div class="st_mobile_follow_2">
        <div class="wrap"><?php echo $followcorey; ?></div>
    </div>

    <!-- COMPACT VERSION - DONATE -->
    <div class="st_mobile_donate_2">
        <?php echo $howtosupportmywork; ?>
    </div>

    <!-- COMPACT VERSION - PRODUCTS -->
    <div class="st_mobile_buybook_2">
        <div class="wrap">
            <div class="media">
            <div class="media-img media-right"><a class="item-icon icon-phonecoaching" href="<?php echo get_permalink( spk_master_get_post_id( 'phone-coaching' ) ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( '22818' ); ?>"><h5>1 Hour Phone/Skype Coaching Session</h5></a></div>
            </div>
            <div class="divider-line clearfix space-vertical-half"></div>
            <div class="media">
            <div class="media-img media-right"><a class="item-icon icon-emailcoaching" href="<?php echo get_permalink( spk_master_get_post_id( 'email-coaching' ) ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( spk_master_get_post_id( 'email-coaching' ) ); ?>"><h5>Emergency Email Response Coaching</h5></a></div>
            </div>
            <div class="divider-line clearfix space-vertical-half"></div>
            <div class="media">
            <div class="media-img media-right"><a class="item-icon icon-amazon" href="<?php echo get_permalink( '22910' ); ?>"></a></div>
            <div class="media-bd"><a href="<?php echo get_permalink( '22910' ); ?>"><h5>Self-Help Products, Books, Supplements, Etc. I Recommend</h5></a></div>
            </div>
            <div class="divider-line clearfix space-vertical-half"></div>
            <div class="media">
            <div class="media-img media-right"><a class="item-pic pic-ebook" href="<?php echo get_permalink( spk_master_get_post_id( 'free-ebook' ) ); ?>"></a></div>
            <div class="media-bd"><?php echo $media_bd; ?></div>
            </div>
        </div>
    </div>

    <!-- COMPACT VERSION - SHARE -->
    <div class="st_mobile_share_2"><?php echo $sharesocialmedia; ?></div>

    <!-- COMPACT VERSION | PARENT -->
    <div class="st_mobile" id="st_mobile">
        <div class="st_mobile_follow">FOLLOW</div>
        <div class="st_mobile_donate">DONATE</div>
        <div class="st_mobile_buybook">PRODUCTS</div>
        <div class="st_mobile_share">SHARE</div>
    </div>

    <!-- SHOW or HIDE BUTTON -->
    <div class="showhide">
        <div class="showhide_icon"><img id="showhide_icon" src="<?php echo plugins_url( 'images/arrow.png', __FILE__ ); ?>" alt="top" class="rotate180" /></div>
    </div>

    <?php
    // .'#ver='.date( 'YmdHis', filemtime( plugin_dir_path( __FILE__ ).'../images/arrow.png' ) )
}

/* --------------------------------------------------------------------------------------------
 * | GET POST ID
 * ----------------------------------------------------------------------------------------- */
function spk_master_get_post_id( $slug ) {
    /*global $wpdb;
    $query = $wpdb->get_results( "SELECT id FROM ".$wpdb->prefix."posts WHERE post_name='".$slug."' ", OBJECT );
    return $query[0]->id;
    wp_reset_postdata();*/

	if ( $post = get_page_by_path( $slug, OBJECT, 'page' ) )
	    return $post->ID;

}





/* --------------------------------------------------------------------------------------------
 * | ENQUEUE SCRIPTS
 * ----------------------------------------------------------------------------------------- */
function setup_social_toolbar_scripts() {

	$scripts = array( 'jquery-ui-core', 'jquery-effects-core', 'jquery-effects-slide', 'jquery-effects-fade'/*, 'jquery-ui-accordion' */);
	foreach ( $scripts as $value ) {
		if( !wp_script_is( $value, 'enqueued' ) ) {
        	wp_enqueue_script( $value );
    	}
	}
    
	// --------------

    // last arg is true - will be placed before </body>
    wp_register_script( 'setup_social_toolbar', plugins_url( 'js/asset.js', __FILE__ ), NULL, '1.0', TRUE );
     
    // Localize the script with new data
    /*$translation_array = array(
        'spk_master_one_ajax' => plugin_dir_url( __FILE__ ).'../ajax/spk_master_plug_v1_ajax.php',
    );
    wp_localize_script( 'spk_master_plugins_v1_js', 'spk_master_one', $translation_array );
    */
    // Enqueued script with localized data.
    wp_enqueue_script( 'setup_social_toolbar' );

}

/* --------------------------------------------------------------------------------------------
 * | EXECUTE
 * ----------------------------------------------------------------------------------------- */
if ( !is_admin() ) {

    // ENQUEUE SCRIPTS
    //add_action( 'wp_enqueue_scripts', 'setup_social_toolbar_scripts' );
    add_action( 'wp_footer', 'setup_social_toolbar_scripts', 5 );

	// ADD HTML & JAVASCRIPTS TO THE FOOTER FOR THE SOCIAL TOOLBAR
    // wp_footer | genesis_before_footer
    add_action( 'wp_footer', 'setup_social_toolbar_function', 1 );

}
