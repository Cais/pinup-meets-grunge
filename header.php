<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); _e(' | ', 'pinup-meets-grunge'); bloginfo('name');}       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); _e(' | ', 'pinup-meets-grunge'); bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); _e(' | ', 'pinup-meets-grunge'); bloginfo('name'); }
        elseif ( is_search() ) { bloginfo('name'); print __(' | Search results for ', 'pinup-meets-grunge') . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); _e(' | Not Found', 'pinup-meets-grunge'); }
        else { bloginfo('name'); wp_title(__(' | ', 'pinup-meets-grunge')); get_page_number(); }
    ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	
<!--[if lte IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie.css" type="text/css" media="screen" />
<![endif]-->
 
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
 
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'pinup-meets-grunge' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'pinup-meets-grunge' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
</head>

<body <?php body_class(); ?>>
<div id="full-screen">
<div id="outside">

  <div id="header">
    <div id="header-top">
      <div id="header-title">
        <div id="blog-title"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span></div>
        <div id="blog-description">
          <?php bloginfo( 'description' ) ?>
          <!--[if lte IE 7]>
            <p>This theme looks much better on a current browser, perhaps you should come to terms with the advancements of today's technology.</p>
          <![endif]-->
        </div>
      </div> <!-- #header-title -->
    </div>

    <div id="header-middle">  
      <!-- see 'bns_menu' in the functions.php file for additional configuration details -->
      <?php wp_page_menu('show_home=1&depth=1'); ?>
      <div class="clear"></div>
    </div> <!-- #header-middle -->

  <div id="header-bottom"></div>
  </div> <!-- #header -->
  <div id="head2toe">
