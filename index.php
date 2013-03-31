<?php
/**
 * Pinup Meets Grunge
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @todo Custom Header Images - further work is required to add appropriate code to make use of the existing child themes available from http://buynowshop.com/themes/nona/
 * @todo Review date.php template for better ways to incorporate end-user time and date settings
 * @todo Review changing post without title to use `Posted` instead of date (see Shades Theme); definitely implement if post-formats are used.
 * @todo Review addition of a "loop" template as well as other template parts to tidy up the code. (see Shades v1.8 / Ground Floor v1.9)
 *
 * @version 2.0
 * @date    January 19, 2013
 * Fully refactored to use NoNa theme version 1.7 (NoNa was originally built
 * from Pinup Meets Grunge).
 *
 * @version 2.1
 * @date    March 31, 2013
 * Code refactoring / formatting and block termination comments added
 */

get_header(); ?>

<div id="main-blog">

    <div id="before-content"></div>

    <div id="content">

        <?php
        if ( have_posts() ) {

            while ( have_posts() ) {

                the_post(); ?>

                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                    <h2>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'pinup-meets-grunge' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="post-details">

                        <?php
                        printf( __('Posted by %1$s on ', 'pinup-meets-grunge'),
                            get_the_author_meta( 'display_name' )
                        );

                        /** for posts without titles - creates a permalink using the post date referencing the post ID */
                        if ( get_the_title() == "" ) { ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to post ', 'pinup-meets-grunge' ); the_id(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
                        <?php } else {
                            the_time( get_option( 'date_format' ) );
                        } /** End if - no title */

                        echo ' '; comments_popup_link( __( 'with No Comments', 'pinup-meets-grunge' ), __( 'with 1 Comment', 'pinup-meets-grunge' ), __( 'with % Comments', 'pinup-meets-grunge' ), '', __( 'with Comments Closed', 'pinup-meets-grunge' ) );
                        edit_post_link( __( 'Edit', 'pinup-meets-grunge' ), __( ' | ', 'pinup-meets-grunge' ), __( '', 'pinup-meets-grunge' ) );
                        _e( '<br />in ', 'pinup-meets-grunge' ); the_category( ', ' );

                        $pmg_post_tags = get_the_tags();
                        if ( $pmg_post_tags ) { ?>
                            <br />
                            <?php the_tags( __( 'as ', 'pinup-meets-grunge' ), ', ', '' );
                        } /** End if - has post tags */ ?>

                        <br />

                    </div><!-- .post-details -->

                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    } /** End if - has post thumbnail */
                    the_content( __( 'Read more... ', 'pinup-meets-grunge' ) ); ?>

                    <div class="clear"></div><!-- For inserted media at the end of the post -->

                    <?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'pinup-meets-grunge') . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

                </div><!-- .post #post-ID -->

            <?php } /** End while - have posts */ ?>

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

            <?php
            get_search_form();

        } /** End if - have posts */ ?>

    </div><!-- #content -->

    <div id="after-content"></div>

</div><!-- #main-blog -->

<?php
get_sidebar();
get_footer();