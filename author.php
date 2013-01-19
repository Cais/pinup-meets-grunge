<?php get_header(); ?>

<?php /* This sets the $curauth variable */
if(isset($_GET['author_name'])) :
  $curauth = get_userdatabylogin($author_name);
else :
  $curauth = get_userdata(intval($author));
endif;
?>

<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">
  
    <div id="author" class="<?php if ((get_userdata(intval($author))->ID) == '1') echo 'administrator';
      /* elseif ((get_userdata(intval($author))->ID) == '2') echo 'user-id-2'; */ /* sample */
      /* add additional user_id following above example, echo the 'CSS element' you want to use for styling */
      ?>">
      <h2><?php _e('About ', 'pinup-meets-grunge'); ?><?php echo $curauth->display_name; ?></h2>
      <ul>
        <li><?php _e('Website', 'pinup-meets-grunge'); ?>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a> <?php _e('or', 'pinup-meets-grunge'); ?> <a href="mailto:<?php echo $curauth->user_email; ?>"><?php _e('email', 'pinup-meets-grunge'); ?></a></li>
        <li><?php _e('Biography', 'pinup-meets-grunge'); ?>: <?php echo $curauth->user_description; ?></li>
      </ul>
    </div> <!-- #author -->

    <h2><?php _e('Posts by ', 'pinup-meets-grunge'); ?><?php echo $curauth->display_name; ?>:</h2>

    <!-- start the Loop -->
    <?php if (have_posts()) : ?>

      <?php $count = 0; ?>

      <?php while (have_posts()) : the_post(); ?>

        <?php $count++; ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'pinup-meets-grunge'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          <div class="post-details">
            <?php _e(' on ', 'pinup-meets-grunge');?><?php the_time('M j, Y') ?>
            <?php _e('with', 'pinup-meets-grunge'); ?> <?php comments_popup_link(__('No Comments', 'pinup-meets-grunge'), __('1 Comment', 'pinup-meets-grunge'), __('% Comments', 'pinup-meets-grunge'), '',__('Closed', 'pinup-meets-grunge')); ?>
            <?php edit_post_link(__('Edit', 'pinup-meets-grunge'), __('&#124; ', 'pinup-meets-grunge'), __('', 'pinup-meets-grunge')); ?><br />
            <?php _e(' in ', 'pinup-meets-grunge');?><?php the_category(', ') ?><br />
            <?php the_tags(__('as ', 'pinup-meets-grunge'), ', ', ''); ?><br />            
          </div>

				  <?php if ($count == 1) : ?>
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
		  <p><?php _e('Sorry, there are no posts by this author.', 'pinup-meets-grunge'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>
        
    <?php endif; ?>
    <!-- end the Loop -->
	
  </div> <!-- #content -->
  <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
