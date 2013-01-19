<?php get_header(); ?>
<div id="main-blog">
  <div id="before-content"></div>
  <div id="content">

      <?php if (have_posts()) : ?>
      
      <?php while (have_posts()) : the_post(); ?>
      
      <div id="page-content">  
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <h1><?php the_title(); ?></h1>
          <div id="page-meta">
            <?php _e('with', 'pinup-meets-grunge'); ?> <?php comments_popup_link(__('No Comments', 'pinup-meets-grunge'), __('1 Comment', 'pinup-meets-grunge'), __('% Comments', 'pinup-meets-grunge'), '',__('Comments Closed', 'pinup-meets-grunge')); ?>
            <?php edit_post_link(__('Edit this page', 'pinup-meets-grunge'), __('&gt ', 'pinup-meets-grunge'), __('', 'pinup-meets-grunge')); ?>
          </div> <!-- #page-meta -->
          <?php the_content(__('Read more ...', 'pinup-meets-grunge')); ?>
          <div class="clear"></div> <!-- For inserted media at the end of the post -->
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>
        <?php comments_template(); ?>
      </div> <!-- #page-content -->
      
      <?php endwhile; ?>
      
      <?php else : ?>

        <h2<?php _e('Not Found', 'pinup-meets-grunge'); ?></h2>
        <p<?php _e('Sorry, but you are looking for something that is not here.', 'pinup-meets-grunge'); ?></p>
        <?php include (TEMPLATEPATH . "/searchform.php"); ?>

      <?php endif; ?>

  </div> <!-- #content -->
  <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
