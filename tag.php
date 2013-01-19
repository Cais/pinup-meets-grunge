<?php get_header(); ?>
<?php /* used to create dynamic tag link */
  $curr_tag = single_tag_title("", false);
?>
<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">

    <div id="tag-title">
      <?php if ( $paged < 2 ) { ?>
        <?php _e('First page of the', 'pinup-meets-grunge'); ?> <span id="tag-name"><?php single_tag_title(); ?></span> <?php _e('archive.', 'pinup-meets-grunge'); ?>
      <?php } else { ?>
        <?php _e('Page', 'pinup-meets-grunge');?> <?php _e($paged, 'pinup-meets-grunge'); ?> <?php _e('of the', 'pinup-meets-grunge'); ?> <span id="tag-name"><a href="<?php echo(bloginfo('url') . "?tag=" . $curr_tag); ?>" title="<?php echo $curr_tag; ?>"><?php single_tag_title(); ?></a></span> <?php _e('archive.', 'pinup-meets-grunge'); ?>
      <?php } ?>
    </div> <!-- #tag-title -->

    <div id="tag-description">
      <?php echo tag_description(); ?>
    </div> <!-- #tag-description -->

    <!-- start the Loop -->
    <?php if (have_posts()) : ?>
      <?php $count = 0; ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php $count++; ?>

      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'pinup-meets-grunge'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-details">
          <?php _e('Posted by ', 'pinup-meets-grunge'); ?><?php the_author() ?><?php _e(' on ', 'pinup-meets-grunge');?><?php the_time('M j, Y') ?>
          <?php _e('with', 'pinup-meets-grunge'); ?> <?php comments_popup_link(__('No Comments', 'pinup-meets-grunge'), __('1 Comment', 'pinup-meets-grunge'), __('% Comments', 'pinup-meets-grunge'), '',__('Closed', 'pinup-meets-grunge')); ?>
          <?php edit_post_link(__('Edit', 'pinup-meets-grunge'), __('&#124; ', 'pinup-meets-grunge'), __('', 'pinup-meets-grunge')); ?><br />
          <?php _e('in ', 'pinup-meets-grunge');?><?php the_category(', ') ?><br />
          <?php the_tags(__('as ', 'pinup-meets-grunge'), ', ', ''); ?><br />
        </div>

        <?php if (($count <= 2) && ($paged < 2)) : ?>
          <?php the_content(); ?>
		    <?php else : ?>
    		  <?php the_excerpt(); ?>
		    <?php endif; ?>
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
      <p><?php _e('Sorry, there are no posts with this tag.', 'pinup-meets-grunge'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>
        
    <?php endif; ?>
  <!-- end the Loop -->
      
  </div> <!-- #content -->
  <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
