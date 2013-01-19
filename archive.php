<?php get_header(); ?>
<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">
  
    <?php if (have_posts()) : ?>
    
      <?php while (have_posts()) : the_post(); ?>
    
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'pinup-meets-grunge'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

          <div class="post-details">
            <?php _e('Posted by ', 'pinup-meets-grunge'); ?><?php the_author() ?><?php _e(' on ', 'pinup-meets-grunge');?><?php the_time('M j, Y') ?>
            <?php _e('with', 'pinup-meets-grunge'); ?> <?php comments_popup_link(__('No Comments', 'pinup-meets-grunge'), __('1 Comment', 'pinup-meets-grunge'), __('% Comments', 'pinup-meets-grunge'), '',__('Closed', 'pinup-meets-grunge')); ?>
            <?php edit_post_link(__('Edit', 'pinup-meets-grunge'), __('&#124; ', 'pinup-meets-grunge'), __('', 'pinup-meets-grunge')); ?><br />
            <?php _e(' in ', 'pinup-meets-grunge');?><?php the_category(', ') ?><br />
            <?php the_tags(__('as ', 'pinup-meets-grunge'), ', ', ''); ?><br />
          </div> <!-- .post-details -->

          <?php the_excerpt(); ?>
          <div class="clear"></div> <!-- For inserted media at the end of the post -->
        </div>
    
      <?php endwhile; ?>
	
			<div id="nav-global" class="navigation">
				<div class="left">
					<?php next_posts_link(__('&laquo; Previous entries ', 'nona')); ?>
				</div>
				<div class="right">
					<?php previous_posts_link(__(' Next entries &raquo;', 'nona')); ?>
				</div>
			</div>
			<div class="clear"></div>
  
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
