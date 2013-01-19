<?php
/**
 * Functions
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 */

/** ... with credits to the Twenty Ten theme from WordPress for inspiration and code */

/**
 * Set the content width based on the theme's design and stylesheet.
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) ) $content_width = 595;

add_action( 'after_setup_theme', 'pmg_setup' );
if ( ! function_exists('pmg_setup') ):
    /**
     * PMG Setup
     *
     * Tell WordPress to run pmg_setup() when the 'after_setup_theme' hook is run.
     *
     * @version 1.6
     * @date    July 10, 2012
     * Removed deprecated function call to `add_custom_background`
     */
    function pmg_setup() {
        global $wp_version;
        /** This theme styles the visual editor with editor-style.css to match the theme style. */
        add_editor_style();
        /** This theme uses post thumbnails */
        add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
        /** Add default posts and comments RSS feed links to head */
        add_theme_support( 'automatic-feed-links' );

        /** This theme allows users to set a custom background */
        add_theme_support( 'custom-background', array(
            'default-color' => '000000',
            'default-image' => get_template_directory_uri() . '/images/GrungeOverlayTileSmall.png'
        ) );

        /** wp_nav_menu support */
        if ( ! function_exists('pmg_nav_menu') ) {
            /**
             * Add wp_nav_menu() custom menu support
             * @uses    wp_nav_menu
             */
            function pmg_nav_menu() {
                wp_nav_menu( array(
                    'menu_class' => 'nav-menu',
                    'theme_location' => 'top-menu',
                    'fallback_cb' => 'pmg_list_pages'
                ) );
            }
        }
        if ( ! function_exists('pmg_list_pages') ) {
            /**
             * @uses    wp_list_pages
             */
            function pmg_list_pages() { ?>
            <ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
            <?php
            }
        }
        register_nav_menu( 'top-menu', __( 'Top Menu', 'pinup-meets-grunge' ) );
        /** End wp_nav_menu support */

        /**
         * Make theme available for translation
         * @internal Translations can be filed in the /languages/ directory
         */
        load_theme_textdomain( 'pinup-meets-grunge', get_template_directory_uri() . '/languages' );
        $locale = get_locale();
        $locale_file = get_template_directory_uri() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );
    }
endif;

/**
 * Creates a link to the dashboard, or a login / register link.
 *
 * @param   string $args
 *
 * @uses    apply_filters
 * @uses    get_current_site
 * @uses    home_url
 * @uses    is_user_logged_in
 * @uses    wp_logout_url
 * @uses    wp_parse_args
 * @uses    wp_register
 *
 * @return  mixed|string|void
 */
if ( ! function_exists('pmg_login') ) {
    function pmg_login( $args = '' ) {
        $values = array( 'login' => '', 'after_login' => '', 'logout' => '', 'goto' => '', 'separator' => '' );
        $args = wp_parse_args( $args, $values );

        /** Initialize $output - start with an empty string */
        $output = '';
        /**
         * Defaults values:
         * @var $login          string - anchor text for log in link
         * @var $after_login    string - user is logged in message
         * @var $logout         string - anchor text for log out link
         * @var $goto           string - anchor text linking to "Dashboard"
         * @var $separator      string - characters used to separate link/message texts
         * @var $sep            string - $separator wrapper for styling purposes, etc. - just in case ...
         */
        $login        = empty( $args['login'] ) ? sprintf( __( 'Log in here!', 'pmg-login' ) ) : $args['login'];
        $after_login  = empty( $args['after_login'] ) ? sprintf( __( 'You are logged in!<br />', 'pmg-login' ) ) : $args['after_login'];
        $logout       = empty( $args['logout'] ) ? sprintf( __( 'Logout', 'pmg-login' ) ) : $args['logout'];
        $goto         = empty( $args['goto'] ) ? sprintf( __( '<br />Go to Dashboard', 'pmg-login' ) ) : $args['goto'];
        $separator    = empty( $args['separator'] ) ? sprintf( __( ' &laquo;&raquo; ' ) ) : $args['separator'];
        $sep          = '<span class="pmg-login-separator">' . $separator . '</span>';

        /** The real work gets done next ...  */
        $login_url = home_url( '/wp-admin/' );
        if ( is_user_logged_in() ) {
            $output .= '<div id="pmg-logged-in" class="pmg-login">' . $after_login . $sep;
            /** Multisite - logout returns to Multisite main domain page */
            if ( function_exists( 'get_current_site' ) ) {
                $current_site = get_current_site();
                $home_domain = 'http://' . $current_site->domain . $current_site->path;
                $logout_url = wp_logout_url( $home_domain );
            } else {
                $logout_url = wp_logout_url( home_url() );
            }
            $output .= '<a href="' . $logout_url . '" title="' . $logout . '">' . $logout . '</a>' . $sep;
            $output .= '<a href="' . $login_url . '" title="' . $goto . '">' . $goto . '</a></div>';
        } else {
            /** if user is not logged in display login; or, register if allowed */
            $output .= '<div id="pmg-logged-out" class="pmg-login">';
            $output .= '<a href="' . $login_url . '" title="' . $login . '">' . $login . '</a>';
            $output .= wp_register( $sep, '', false );
            $output .= '</div>';
        }
        echo apply_filters( 'pmg_login', $output, $args );
    }
}


if ( ! function_exists('pmg_dynamic_copyright') ) {
    /**
     * @param   string $args
     *
     * @uses    apply_filters
     * @uses    get_bloginfo
     * @uses    get_posts
     * @uses    home_url
     * @uses    post_date_gmt
     * @uses    wp_parse_args
     */
    function pmg_dynamic_copyright( $args = '' ) {
        $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
        $args = wp_parse_args( $args, $initialize_values );

        /** Initialize the output variable to empty */
        $output = '';

        /** Start common copyright notice */
        empty( $args['start'] ) ? $output .= sprintf( __('Copyright', 'pinup-meets-grunge') ) : $output .= $args['start'];

        /** Calculate Copyright Years; and, prefix with Copyright Symbol */
        if ( empty( $args['copy_years'] ) ) {
            /** Get all posts */
            $all_posts = get_posts( 'post_status=publish&order=ASC' );
            /** Get first post */
            $first_post = $all_posts[0];
            /** Get date of first post */
            $first_date = $first_post->post_date_gmt;

            /** First post year versus current year */
            $first_year = substr( $first_date, 0, 4 );
            if ( $first_year == '' )
                $first_year = date( 'Y' );

            /** Add to output string */
            if ( $first_year == date( 'Y' ) ) {
                /** Only use current year if no posts in previous years */
                $output .= ' &copy; ' . date( 'Y' );
            } else {
                $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
            }
        } else {
            $output .= ' &copy; ' . $args['copy_years'];
        }

        /** Create URL to link back to home of website */
        empty( $args['url'] )
            ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  '
            : $output .= ' ' . $args['url'];

        /** End common copyright notice */
        empty( $args['end'] )
            ? $output .= ' ' . sprintf( __( 'All rights reserved.', 'pinup-meets-grunge' ) )
            : $output .= ' ' . $args['end'];

        /** Construct and sprintf the copyright notice */
        $output = sprintf( __( '<span id="pmg-dynamic-copyright"> %1$s </span><!-- #pmg-dynamic-copyright -->', 'pinup-meets-grunge' ), $output );
        echo apply_filters( 'pmg_dynamic_copyright', $output, $args );
    }
}

if ( ! function_exists('pmg_theme_version') ) {
    /**
     * @uses    is_child_theme
     * @uses    wp_get_theme
     * @uses    WP_Theme::parent
     */
    function pmg_theme_version () {
        /** @var $active_theme_data - array object containing the current theme's data */
        $active_theme_data = wp_get_theme();
        if ( is_child_theme() ) {
            /** @var $parent_theme_data - array object containing the Parent Theme's data */
            $parent_theme_data = $active_theme_data->parent();
            printf( __( '<br /><span id="pmg-theme-version">%1$s (v%2$s) accessorizes the %3$s theme (v%4$s) created by %5$s.</span>', 'pinup-meets-grunge' ),
                $active_theme_data['Name'],
                $active_theme_data['Version'],
                $parent_theme_data['Name'],
                $parent_theme_data['Version'],
                '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>');
        } else {
            printf( __( '<br /><span id="pmg-theme-version">This site is dressed in the %1$s theme (v%2$s) from %3$s.</span>', 'pinup-meets-grunge' ),
                $active_theme_data['Name'],
                $active_theme_data['Version'],
                '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>' );
        }
    }
}

/**
 * Widgets Areas
 *
 * @uses    register_sidebar
 */
register_sidebar( array(
    'name'          => __( 'Sidebar 1', 'pinup-meets-grunge' ),
    'description'   => __( 'First sidebar area located on the right side of the layout. This contains the default theme sidebar widgets. Drag and drop a widget into this to clear *ALL* of the default widgets of the theme.', 'pinup-meets-grunge' ),
    'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
    'after_widget'  =>'</div><!-- .widget--><div class="widget-bottom"></div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'          => __( 'Sidebar 2', 'pinup-meets-grunge' ),
    'description'   => __( 'Second sidebar area located on the right side of the layout', 'pinup-meets-grunge' ),
    'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
    'after_widget'  =>'</div><!-- .widget--><div class="widget-bottom"></div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'          => __( 'Sidebar 3', 'pinup-meets-grunge' ),
    'description'   => __( 'Third sidebar area located on the right side of the layout', 'pinup-meets-grunge' ),
    'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
    'after_widget'  =>'</div><!-- .widget--><div class="widget-bottom"></div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Left', 'pinup-meets-grunge' ),
    'id'             => 'footer-left',
    'description'    => __( 'Sidebar area located at the bottom of the theme to the left side of the layout.', 'pinup-meets-grunge' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Middle', 'pinup-meets-grunge' ),
    'id'             => 'footer-middle',
    'description'    => __( 'Sidebar area located at the bottom of the theme in the middle of the layout.', 'pinup-meets-grunge' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Right', 'pinup-meets-grunge' ),
    'id'             => 'footer-right',
    'description'    => __( 'Sidebar area located at the bottom of the theme to the right side of the layout.', 'pinup-meets-grunge' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );

if ( ! function_exists('pmg_wp_title') ) {
    /**
     * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
     * @link    https://gist.github.com/1410493
     *
     * @param   string $old_title - default title text
     * @param   string $sep - separator character
     * @param   string $sep_location - left|right - separator placement in relationship to title
     *
     * @uses    (global) var $page
     * @uses    (global) var $paged
     * @uses    get_bloginfo
     * @uses    is_front_page
     * @uses    is_home
     *
     * @return  string - new title text
     */
    function pmg_wp_title( $old_title, $sep, $sep_location ) {
        global $page, $paged;
        /** Set initial title text */
        $pmg_title_text = $old_title . get_bloginfo( 'name' );
        /** Add wrapping spaces to separator character */
        $sep = ' ' . $sep . ' ';

        /** Add the blog description (tagline) for the home/front page */
        $site_tagline = get_bloginfo( 'description', 'display' );
        if ( $site_tagline && ( is_home() || is_front_page() ) )
            $pmg_title_text .= "$sep$site_tagline";

        /** Add a page number if necessary */
        if ( $paged >= 2 || $page >= 2 )
            $pmg_title_text .= $sep . sprintf( __( 'Page %s', 'pinup-meets-grunge' ), max( $paged, $page ) );

        return $pmg_title_text;
    }
}
add_filter( 'wp_title', 'pmg_wp_title', 10, 3 );