<?php 
//  $display_date = "";
//  $current_url = $_SERVER['REQUEST_URI'];
  
  if (intval(substr($current_url,(strlen($current_url)-3),1)) == "/"
      && intval(substr($current_url,(strlen($current_url)-5),1)) == "/"
      && intval(substr($current_url,(strlen($current_url)-10),1)) == "/") {
    $tested = 'it\'s a slash';
  } else {
    $tested = 'keep testing';
  }
  
  if ($m <> "") { /* works for default permalinks only */
    if (strlen($m) == 8) {
      $display_date = strftime("%d %B %Y", strtotime($m));
    } elseif (strlen($m) == 6) {
      $m .= "01"; /* Hack - function requires Year, Month, Day(?), at 6 characters only Year and Month are given */
      $display_date = strftime("%B %Y", strtotime($m));
    } else { /* Year only - no manipulation required */ 
      $display_date = $m;
    }
  $display_date = ": " . $display_date;
  }
?>
<?php get_header(); ?>

<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">
  
    <div id="date-title">
      <?php if ( $paged < 2 ) { ?>
        <?php _e('Posts by date', 'pinup-meets-grunge'); ?><?php echo $display_date; ?>
      <?php } else { ?>
        <?php _e('Page', 'pinup-meets-grunge');?> <?php _e($paged, 'pinup-meets-grunge'); ?> <?php _e('of posts by date', 'pinup-meets-grunge'); ?><?php echo $display_date; ?>
      <?php } ?>
    </div> <!-- #date-title -->

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
            <?php _e(' in ', 'pinup-meets-grunge');?><?php the_category(', ') ?><br />
            <?php the_tags(__('as ', 'pinup-meets-grunge'), ', ', ''); ?><br />
          </div>

          <?php if (($count <= 3) && ($paged < 2)) : ?>
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
    	<p><?php _e('Sorry, time does not exist here.', 'pinup-meets-grunge'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>
        
    <?php endif; ?>
    <!-- end the Loop -->
      
  </div> <!-- #content -->
  <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
