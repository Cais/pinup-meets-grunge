<?php
/**
 * Sidebar Template
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 *
 * @version 2.2
 * @date    January 17, 2015
 * Removed `wp_list_bookmarks`
 */ ?>
<div id="sidebar">
	<div id="sidebar-inside">
		<div id="sidebar-1">
			<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
				<div class="widget-top"></div>
				<div class="widget">
					<ul id="search">
						<li><?php get_search_form(); ?></li>
					</ul>
					<!-- #search -->
				</div><!-- .widget -->
				<div class="widget-bottom"></div>

				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Calendar', 'nona' ); ?></h2>

					<div align="center">
						<?php get_calendar( 0 ); ?>
					</div>
				</div><!-- .widget -->
				<div class="widget-bottom"></div>

				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Categories', 'pinup-meets-grunge' ); ?></h2>
					<ul><?php wp_list_categories( 'title_li=&show_count=1' ); ?></ul>
				</div><!-- .widget -->
				<div class="widget-bottom"></div>

				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Archives', 'pinup-meets-grunge' ); ?></h2>
					<ul><?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?></ul>
				</div><!-- .widget -->
				<div class="widget-bottom"></div>

				<div class="widget-top"></div>
				<div class="widget">
					<h2 class="widget-title"><?php _e( 'Meta', 'pinup-meets-grunge' ); ?></h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li>
							<a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a>
						</li>
						<?php wp_meta(); ?>
					</ul>
				</div><!-- .widget -->
				<div class="widget-bottom"></div>
			<?php endif; ?>
		</div>
		<!-- #sidebar-1 -->

		<div id="sidebar-2"><?php if ( dynamic_sidebar( 'sidebar-2' ) ) : else : endif; ?></div>

		<div id="sidebar-3"><?php if ( dynamic_sidebar( 'sidebar-3' ) ) : else : endif; ?></div>
	</div>
	<!-- #sidebar-inside -->
</div><!-- #sidebar -->