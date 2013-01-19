<?php
add_action( 'after_setup_theme', 'pmg_setup' );

if ( ! function_exists( 'pmg_setup' ) ):

function pmg_setup() {
  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();
  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );
  // Add custom background options
  add_custom_background();

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'pinup-meets-grunge', TEMPLATEPATH . '/languages' );
  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );
    // This theme allows users to set a custom background
}
endif;

// Get the page number
function get_page_number() {
  if ( get_query_var( 'paged' ) ) {
    print ' | ' . __( 'Page ' , 'pinup-meets-grunge' ) . get_query_var( 'paged' );
  }
}
// end get_page_number

// bns_menu
function bns_menu( $menu, $args ) {
  if ( is_home() || is_front_page() ) {
    $args['show_home'] = false;
    $args['echo'] = false;
    $args['depth'] = 1;
    remove_filter( 'wp_page_menu', 'bns_menu', 10, 2 );
    $menu = wp_page_menu( $args );
  }
  return $menu; // no need to remake the menu if nothing changed
}
add_filter( 'wp_page_menu', 'bns_menu', 10, 2 );
// End bns_menu

// bns_login
function bns_login() {
  $login_url = get_bloginfo( 'url' ) . '/wp-admin/';
  if ( is_user_logged_in() ) {
    echo '<div id="bns-logged-in" class="bns-login">' . __( 'You are logged in! ', 'pinup-meets-grunge' );
    if ( function_exists( 'get_current_site' ) ) {
      $current_site = get_current_site();
      $home_domain = 'http://' . $current_site->domain . $current_site->path;
      echo '<a href="' . wp_logout_url( $home_domain ) . '" title="' . __( 'Logout', 'pinup-meets-grunge' ) . '">' . __( 'Logout', 'pinup-meets-grunge' ) . '</a>';
    } else {
      echo '<a href="' . wp_logout_url( get_bloginfo( 'url' ) ) . '" title="' . __( 'Logout', 'pinup-meets-grunge' ) . '">' . __( 'Logout', 'pinup-meets-grunge' ) . '</a>';
    }
    echo __( ' or go to the ', 'pinup-meets-grunge' ) . '<a href="' . $login_url . '" title="' . __( 'dashboard', 'pinup-meets-grunge' ) . '">' . __( 'dashboard', 'pinup-meets-grunge' ) . '</a>.</div>';
  } else {
    echo '<div id="bns-logged-out" class="bns-login"><a href="' . $login_url . '" title="' . __( 'Log in here', 'pinup-meets-grunge' ) . '">' . __( 'Log in here!', 'pinup-meets-grunge' ) . '</a></div>';
  }
}
// End bns_login

// Widgetizing
if ( function_exists( 'register_sidebar' ) )
  register_sidebars( 3, array(
                              'before_widget' => '<div class="widget-top"></div><div class="widget">',
                              'after_widget' => '</div><!-- .widget--><div class="widget-bottom"></div>',
                              'before_title' => '<h2 class="widget-title">',
                              'after_title' => '</h2>',
                              ) );
  
  register_sidebar( array(
                          'name' => 'Footer Left',
                          'id' => 'footer-left',
                          'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                          'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                          'before_title' => '<h2 class="widget-title">',
                          'after_title' => '</h2>',
                          ) );
  
  register_sidebar( array(
                          'name' => 'Footer Middle',
                          'id' => 'footer-middle',
                          'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                          'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                          'before_title' => '<h2 class="widget-title">',
                          'after_title' => '</h2>',
                          ) );
  
  register_sidebar( array(
                          'name' => 'Footer Right',
                          'id' => 'footer-right',
                          'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                          'after_widget' => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
                          'before_title' => '<h2 class="widget-title">',
                          'after_title' => '</h2>',
                          ) );
// End Widgetizing

// Gravatar
function show_avatar( $comment, $size ) {
  $email = strtolower( trim( $comment->comment_author_email ) );
  $rating = "G"; // [G | PG | R | X]
  if ( function_exists( 'get_avatar' ) ) {
    echo get_avatar( $email, $size );
  } else {
    $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5( $emaill ) . "&size=" . $size . "&rating=" . $rating;
    echo "<img src='$grav_url'/>";
  }
}
// End Gravatar

function bns_theme_version () {
  $theme_version = ''; /* Clear variable */
  /* Get details of the theme / child theme */
  $blog_css_url = get_stylesheet_directory() . '/style.css';
  $my_theme_data = get_theme_data($blog_css_url);
  $parent_blog_css_url = get_template_directory() . '/style.css';
  $parent_theme_data = get_theme_data( $parent_blog_css_url );
  /* Create and append to string to be displayed */
  $theme_version .= '<br />' . $my_theme_data['Name'] . ' v' . $my_theme_data['Version'];
  if ( $blog_css_url != $parent_blog_css_url ) {
    $theme_version .= ' a child of the ' . $parent_theme_data['Name'] . ' v' . $parent_theme_data['Version'];
  }
  $theme_version .= ' theme from	<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.';
  /* Display string */
  echo $theme_version;
}
?>