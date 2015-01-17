<?php
/**
 * Page Template
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 */

get_header(); ?>
	<div id="main-blog">
		<div id="before-content"></div>
		<div id="content">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div id="page-content">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><?php the_title(); ?></h1>

						<div id="page-meta">
							<?php
							comments_popup_link( __( 'with No Comments', 'pinup-meets-grunge' ), __( 'with 1 Comment', 'pinup-meets-grunge' ), __( 'with % Comments', 'pinup-meets-grunge' ), '', __( '', 'pinup-meets-grunge' ) );
							edit_post_link( __( 'Edit this page', 'pinup-meets-grunge' ), __( ' | ', 'pinup-meets-grunge' ), __( '', 'pinup-meets-grunge' ) ); ?>
						</div>
						<!-- #page-meta -->
						<?php the_content( __( 'Read more ...', 'pinup-meets-grunge' ) ); ?>
						<div class="clear"></div>
						<!-- For inserted media at the end of the post -->
						<?php wp_link_pages( array( 'before'         => '<p><strong>' . __( 'Pages: ', 'pinup-meets-grunge' ) . '</strong>',
						                            'after'          => '</p>',
						                            'next_or_number' => 'number'
						) ); ?>
					</div>
					<!-- .post #post-ID -->
					<?php comments_template(); ?>
				</div><!-- #page-content -->
			<?php endwhile;
			else : ?>
				<h2><?php printf( __( 'Search Results for: %s', 'pinup-meets-grunge' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
				<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'pinup-meets-grunge' ); ?></p>
				<?php get_search_form();
			endif; ?>
		</div>
		<!-- #content -->
		<div id="after-content"></div>
	</div><!-- #main-blog -->
<?php get_sidebar();
get_footer();