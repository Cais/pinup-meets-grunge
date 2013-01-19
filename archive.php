<?php
/**
 * Archive Template
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

get_header(); ?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-details">
                <?php
                printf( __('Posted by %1$s on %2$s ', 'pinup-meets-grunge'), get_the_author_meta( 'display_name' ), get_the_time( get_option( 'date_format' ) ) );
                echo ' '; comments_popup_link( __( 'with No Comments', 'pinup-meets-grunge' ), __( 'with 1 Comment', 'pinup-meets-grunge' ), __( 'with % Comments', 'pinup-meets-grunge' ), '', __( 'with Comments Closed', 'pinup-meets-grunge' ) );
                edit_post_link( __( 'Edit', 'pinup-meets-grunge' ), __( ' | ', 'pinup-meets-grunge' ), __( '', 'pinup-meets-grunge' ) );
                _e( '<br />in ', 'pinup-meets-grunge' ); the_category( ', ' ); ?><br />
                <?php the_tags( __( 'as ', 'pinup-meets-grunge' ), ', ', '' ); ?><br />
            </div><!-- .post-details -->
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
            }
            the_excerpt(); ?>
            <div class="clear"></div><!-- For inserted media at the end of the post -->
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
        <?php
        get_search_form();
    endif; ?>
    </div><!-- #content -->
    <div id="after-content"></div>
</div><!-- #main-blog -->
<?php get_sidebar();
get_footer();