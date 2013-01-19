<?php
/**
 * Tag Template
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

get_header();
/** used to create dynamic tag link */
$curr_tag = single_tag_title( "", false ); ?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <div id="tag-title">
            <?php
            global $paged;
            if ( $paged < 2 ) {
                printf( __( 'First page of the %1$s archive', 'pinup-meets-grunge' ), '<span id="tag-name">' . single_tag_title( '', false ) . '</span>'  );
            } else {
                printf( __( 'Page %1$s of the %2$s archive.', 'pinup-meets-grunge' ), $paged, '<span id="tag-name"><a href="' . home_url() . '"?tag="' . $curr_tag . '" title="' . $curr_tag . '">' . single_tag_title( '', false ) . '</a></span>' );
            } ?>
        </div><!-- #tag-title -->
        <div id="tag-description"><?php echo tag_description(); ?></div><!-- #tag-description -->

        <!-- start the Loop -->
        <?php
        if ( have_posts() ) :
            $count = 0;
            while ( have_posts() ) : the_post();
                $count++; ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'pinup-meets-grunge' ); the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php
                        printf( __( 'Posted by %1$s on %2$s ', 'pinup-meets-grunge' ), get_the_author_meta( 'display_name' ), get_the_time( get_option( 'date_format' ) ) );
                        echo ' '; comments_popup_link( __( 'with No Comments', 'pinup-meets-grunge' ), __( 'with 1 Comment', 'pinup-meets-grunge' ), __( 'with % Comments', 'pinup-meets-grunge' ), '', __( 'with Comments Closed', 'pinup-meets-grunge' ) );
                        edit_post_link( __( 'Edit', 'pinup-meets-grunge' ), __( ' | ', 'pinup-meets-grunge' ), __( '', 'pinup-meets-grunge' ) );
                        _e( '<br />in ', 'pinup-meets-grunge' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'pinup-meets-grunge' ), ', ', '' ); ?><br />
                    </div><!-- .post-details -->
                    <?php
                    if ( ( $count <= 2 ) && ( $paged < 2 ) ) :
                        the_content( __( 'Read more... ', 'pinup-meets-grunge' ) ); ?>
                        <div class="clear"></div><!-- For inserted media at the end of the post -->
                        <?php
                        wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'pinup-meets-grunge') . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) );
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

    </div><!-- #content -->
    <div id="after-content"></div>
</div><!-- #main-blog -->
<?php get_sidebar();
get_footer();