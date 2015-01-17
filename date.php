<?php
/**
 * Date Template
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

/** Works for default permalinks only */
$display_date = '';
global $m;
if ( $m <> "" ) {
	if ( strlen( $m ) == 8 ) {
		$display_date = strftime( "%d %B %Y", strtotime( $m ) );
	} elseif ( strlen( $m ) == 6 ) {
		/** Hack - function requires Year, Month, Day(?), at 6 characters only Year and Month are given */
		$m .= "01";
		$display_date = strftime( "%B %Y", strtotime( $m ) );
	} else {
		/** Year only - no manipulation required */
		$display_date = $m;
	}
}

get_header(); ?>
	<div id="main-blog">
		<div id="before-content"></div>
		<div id="content">
			<div id="date-title">
				<?php
				global $paged;
				if ( $paged < 2 ) {
					printf( __( 'Posts by date %1$s: ', 'pinup-meets-grunge' ), $display_date );
				} else {
					printf( __( 'Page %1$s of posts by date %2$s: ', 'pinup-meets-grunge' ), $paged, $display_date );
				} ?>
			</div>
			<!-- #date-title -->

			<!-- start the Loop -->
			<?php
			if ( have_posts() ) :
				$count = 0;
				while ( have_posts() ) : the_post();
					$count ++; ?>
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'pinup-meets-grunge' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">
							<?php
							printf( __( 'Posted by %1$s on %2$s ', 'pinup-meets-grunge' ), get_the_author_meta( 'display_name' ), get_the_time( get_option( 'date_format' ) ) );
							echo ' ';
							comments_popup_link( __( 'with No Comments', 'pinup-meets-grunge' ), __( 'with 1 Comment', 'pinup-meets-grunge' ), __( 'with % Comments', 'pinup-meets-grunge' ), '', __( 'with Comments Closed', 'pinup-meets-grunge' ) );
							edit_post_link( __( 'Edit', 'pinup-meets-grunge' ), __( ' | ', 'pinup-meets-grunge' ), __( '', 'pinup-meets-grunge' ) );
							_e( '<br />in ', 'pinup-meets-grunge' );
							the_category( ', ' ); ?><br />
							<?php the_tags( __( 'as ', 'pinup-meets-grunge' ), ', ', '' ); ?>
							<br />
						</div>
						<!-- .post-details -->
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
						}
						if ( ( $count <= 3 ) && ( $paged < 2 ) ) :
							the_content( __( 'Read more... ', 'pinup-meets-grunge' ) ); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
							<?php
							wp_link_pages( array( 'before'         => '<p><strong>' . __( 'Pages: ', 'pinup-meets-grunge' ) . '</strong>',
							                      'after'          => '</p>',
							                      'next_or_number' => 'number'
							) );
						else :
							the_excerpt(); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
						<?php endif; ?>
					</div><!-- .post #post-ID -->
				<?php endwhile; ?>
				<div id="nav-global" class="navigation">
					<div class="left">
						<?php next_posts_link( __( '&laquo; Previous entries ', 'pinup-meets-grunge' ) ); ?>
					</div>
					<div class="right">
						<?php previous_posts_link( __( ' Next entries &raquo;', 'pinup-meets-grunge' ) ); ?>
					</div>
				</div><!-- .navigation -->
				<div class="clear"></div>
			<?php else : ?>
				<h2><?php printf( __( 'Search Results for: %s', 'pinup-meets-grunge' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
				<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'pinup-meets-grunge' ); ?></p>
				<?php get_search_form();
			endif; ?>
			<!-- end the Loop -->

		</div>
		<!-- #content -->
		<div id="after-content"></div>
	</div><!-- #main-blog -->
<?php get_sidebar();
get_footer();