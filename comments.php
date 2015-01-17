<?php
/**
 * Comments Template
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

/** Do not delete these lines */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( __( 'Please do not load this page directly. Thanks!', 'pinup-meets-grunge' ) );
}
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'pinup-meets-grunge' ); ?></p>
	<?php
	return;
}
/**
 * Comment Add MicroID
 *
 * Add a microid to all the comments
 *
 * @param $classes
 *
 * @return array
 */
function comment_add_microid( $classes ) {
	$c_email = get_comment_author_email();
	$c_url   = get_comment_author_url();
	if ( ! empty ( $c_email ) && ! empty( $c_url ) ) {
		$microid = 'microid-mailto+http:sha1:' . sha1( sha1( 'mailto:' . $c_email ) . sha1( $c_url ) );
		$classes[] = $microid;
	}

	return $classes;
}

add_filter( 'comment_class', 'comment_add_microid' );

/**
 * Comment Add User ID
 *
 * Add a userid to all the comments; if user exists add their ID, otherwsie add user-id-0 for "guests"
 *
 * @param $classes
 *
 * @return array
 */
function comment_add_userid( $classes ) {
	global $comment;
	if ( $comment->user_id == 1 ) {
		/** Super Administrator */
		$userid = "administrator administrator-prime user-id-1";
	} else {
		/** All other users - NB: user-id-0 -> non-registered user */
		$userid = "user-id-" . ( $comment->user_id );
	}
	$classes[] = $userid;

	return $classes;
}

add_filter( 'comment_class', 'comment_add_userid' ); ?>

<div id="comments-main">
	<?php
	/** Show the comments */
	if ( have_comments() ) : ?>
		<h4 id="comments"><?php comments_number( __( 'No Comments', 'pinup-meets-grunge' ), __( 'One Comment', 'pinup-meets-grunge' ), __( '% Comments', 'pinup-meets-grunge' ) ); ?></h4>
		<ul class="commentlist" id="singlecomments">
			<?php wp_list_comments( array(
				'avatar_size' => 60,
				'reply_text'  => __( '&raquo; Reply to this Comment &laquo;', 'pinup-meets-grunge' )
			) ); ?>
		</ul>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div><!-- .navigation -->
	<?php
	else :
		/** This is displayed if there are no comments so far */
		global $post;
		if ( 'open' == $post->comment_status ) :
			/** If comments are open, but there are no comments. */
		else :
			/** Comments are closed */
		endif;
	endif;
	comment_form(); ?>
</div><!-- #comments-main -->