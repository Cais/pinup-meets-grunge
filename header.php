<?php
/**
 * Header Template
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php /** Check for WordPress 4.1 compatibility */
	if ( ! function_exists( '_wp_render_title_tag' ) ) { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php } ?>

	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="outside">
	<div id="header">
		<div id="header-top">
			<div id="header-title">
				<div id="blog-title">
					<span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				</div>
				<div id="blog-description">
					<?php bloginfo( 'description' ); ?>
				</div>
				<!-- .blog-description -->
			</div>
			<!-- #header-title -->
		</div>
		<!-- #header-top -->
		<div id="header-middle">
			<div id="top-navigation-menu">
				<?php pmg_nav_menu(); ?>
			</div>
			<div class="clear"></div>
		</div>
		<!-- #header-middle -->
		<div id="header-bottom"></div>
	</div>
	<!-- #header -->