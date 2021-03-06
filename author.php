<?php
/**
 * Author Template
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

get_header();
/** Set the $curauth variable */
$curauth = ( get_query_var( 'author_name ' ) )
	? get_user_by( 'id', get_query_var( 'author_name' ) )
	: get_userdata( get_query_var( 'author' ) ); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">

			<div id="author" class="<?php if ( user_can( $curauth, 'manage_options' ) ) {
				echo 'administrator';
			} ?>">

				<h2>
					<?php _e( 'About ', 'nona' ); ?><?php echo $curauth->display_name; ?>
				</h2>
				<ul>
					<?php if ( ! empty( $curauth->user_url ) ) { ?>
						<li><?php _e( 'Website', 'pinup-meets-grunge' ); ?>:
							<a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a> <?php _e( 'or', 'pinup-meets-grunge' ); ?>
							<a href="mailto:<?php echo $curauth->user_email; ?>"><?php _e( 'email', 'pinup-meets-grunge' ); ?></a>
						</li>
					<?php }
					/** End if - not empty - current user url */
					if ( ! empty( $curauth->user_description ) ) { ?>
						<li><?php _e( 'Biography', 'pinup-meets-grunge' ); ?>: <?php echo $curauth->user_description; ?></li>
					<?php } /** End if - not empty - current user description */ ?>
				</ul>

			</div>
			<!-- #author -->

			<h2>
				<?php _e( 'Posts by ', 'pinup-meets-grunge' );
				echo $curauth->display_name; ?>:
			</h2>

			<!-- start the Loop -->
			<?php
			if ( have_posts() ) {

				$count = 0;
				while ( have_posts() ) {
					the_post();
					$count ++; ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'pinup-meets-grunge' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">

							<?php
							printf( __( ' on %1$s ', 'pinup-meets-grunge' ),
								get_the_time( get_option( 'date_format' ) )
							);
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
						/** End if - has post thumbnail */

						if ( $count == 1 ) {
							the_content( __( 'Read more... ', 'pinup-meets-grunge' ) ); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
							<?php
							wp_link_pages( array( 'before'         => '<p><strong>' . __( 'Pages: ', 'pinup-meets-grunge' ) . '</strong>',
							                      'after'          => '</p>',
							                      'next_or_number' => 'number'
							) );
						} else {
							the_excerpt(); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
						<?php } /** End if - count is 1 */ ?>

					</div><!-- .post #post-ID -->

				<?php } ?>

				<div id="nav-global" class="navigation">
					<div class="left">
						<?php next_posts_link( __( '&laquo; Previous entries ', 'pinup-meets-grunge' ) ); ?>
					</div>
					<div class="right">
						<?php previous_posts_link( __( ' Next entries &raquo;', 'pinup-meets-grunge' ) ); ?>
					</div>
				</div><!-- .navigation -->

				<div class="clear"></div>

			<?php } else { ?>

				<h2>
					<?php printf( __( 'Search Results for: %s', 'pinup-meets-grunge' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
				</h2>
				<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'pinup-meets-grunge' ); ?></p>
				<?php get_search_form();
			} /** End if - have posts */ ?>
			<!-- end the Loop -->

		</div>
		<!-- #content -->

		<div id="after-content"></div>

	</div><!-- #main-blog -->

<?php
get_sidebar();
get_footer();