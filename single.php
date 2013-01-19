<?php get_header(); ?>
<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
			
      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'pinup-meets-grunge'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      
        <div class="post-details">
          <?php _e('Posted by ', 'pinup-meets-grunge'); ?><?php the_author() ?><?php _e(' on ', 'pinup-meets-grunge');?><?php the_time('M j, Y') ?> | <a class="rss" href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Subscribe to my feed', 'pinup-meets-grunge'); ?>"><?php _e('Subscribe', 'pinup-meets-grunge'); ?></a> <?php edit_post_link(__('Edit', 'pinup-meets-grunge'), __('&#124; ', 'pinup-meets-grunge'), __('', 'pinup-meets-grunge')); ?><br />
          <?php _e(' in ', 'pinup-meets-grunge');?><?php the_category(', ') ?><br />
          <?php the_tags(__('as ', 'pinup-meets-grunge'), ', ', ''); ?><br />
        </div>
			
        <?php the_content(__('Read more ...', 'pinup-meets-grunge')); ?>
        <div class="clear"></div> <!-- For inserted media at the end of the post -->
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		  	<div id="author_link"><?php _e('... other posts by ', 'pinup-meets-grunge'); ?><?php the_author_posts_link(); ?></div>
						
		  </div> <!-- .post -->
		
      <?php comments_template(); ?>
		
      <?php endwhile; ?>
  
    <?php else : ?>

      <h2><?php _e('Not Found', 'pinup-meets-grunge'); ?></h2>
      <p><?php _e('Sorry, but you are looking for something that is not here.', 'pinup-meets-grunge'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>
    
    <?php endif; ?>

  </div> <!-- #content -->
  <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
