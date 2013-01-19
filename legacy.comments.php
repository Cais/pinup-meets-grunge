<?php
// Do not delete these lines

  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (__('Please do not load this page directly. Thanks!', 'pinup-meets-grunge'));

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>

  <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'pinup-meets-grunge'); ?></p>

<?php
  return;
    }
  }
?>

<!-- You can start editing here. -->
<?php 
/* This variable is used for alternating comment styles */
  $oddcomment = 'comment-text-1';
?>

  <div id="comments-main">
    <?php if ($comments) : ?>
    
      <h3 id="comment-header"><?php comments_number(__('No Comments', 'pinup-meets-grunge'), __('1 Comment', 'pinup-meets-grunge'), __('% Comments', 'pinup-meets-grunge'));?></h3>
      
      <div class="commentlist">
      
      <?php foreach ($comments as $comment) : ?>
      
        <div class="<?php if ($comment->user_id == '1') echo 'administrator';
        /* elseif ($comment->user_id == '2') echo 'user-id-2'; */ /* sample */
        /* add additional user_id following above example, echo the 'CSS element' you want to use for styling */
        else echo $oddcomment; ?> item" id="comment-<?php comment_ID() ?>" >
            
          <div class="comment-details">
          
            <div class="cgravatar"> <?php echo show_avatar( $comment, 60 ); ?> </div>
            
            <div class="comment-author">
              <?php comment_author_link() ?><br />
              <div class="commentmeta"><?php comment_date('M j, Y') ?><?php _e(' at ', 'pinup-meets-grunge'); ?><?php comment_time() ?></div>
            </div>
            
          </div>
          
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.', 'pinup-meets-grunge'); ?></em>
          <?php endif; ?>
          <br />

          <?php comment_text() ?>
          
        </div>
        
        <div style="height:1px; overflow:hidden;">&nbsp;</div>
        
        <?php
		      /* Changes every other comment to a different class */
		      if ('comment-text-1' == $oddcomment) $oddcomment = 'comment-text-2';
		      else $oddcomment = 'comment-text-1';
        ?>

        <?php endforeach; /* end for each comment */ ?>

      </div> <!-- .commentlist -->

      <?php else : // this is displayed if there are no comments so far ?>

        <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
          <p class="nocomments"><?php _e('Comments are closed.', 'pinup-meets-grunge'); ?></p>
        <?php endif; ?>

      <?php endif; ?>

      <?php if ('open' == $post->comment_status) : ?>

        <h3 id="respond"><?php _e('Reply', 'pinup-meets-grunge'); ?></h3>

        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
          <p><?php _e('You must be ', 'pinup-meets-grunge'); ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'pinup-meets-grunge'); ?></a><?php _e(' to post a comment.', 'pinup-meets-grunge'); ?></p>
        <?php else : ?>

          <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <?php if ( $user_ID ) : ?>

              <p><?php _e('Logged in as ', 'pinup-meets-grunge'); ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'pinup-meets-grunge'); ?>"><?php _e('Logout ', 'pinup-meets-grunge'); ?>&raquo;</a></p>

            <?php else : ?>

              <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
              <label for="author"><strong><?php _e('Name', 'pinup-meets-grunge'); ?></strong> <?php if ($req) _e('(required)', 'pinup-meets-grunge'); ?></label></p>
              <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
              <label for="email"><strong><?php _e('Mail', 'pinup-meets-grunge'); ?></strong> <em><?php _e('(will not be published)', 'pinup-meets-grunge'); ?></em> <?php if ($req) _e('(required)', 'pinup-meets-grunge'); ?></label></p>
              <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
              <label for="url"><strong><?php _e('Website', 'pinup-meets-grunge'); ?></strong></label></p>

            <?php endif; ?>

            <p><textarea name="comment" id="comment" cols="40" rows="10" tabindex="4"></textarea></p>

            <p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'pinup-meets-grunge'); ?>" />
              <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            </p>
            <?php do_action('comment_form', $post->ID); ?>

        </form>

      <?php endif; // If registration required and not logged in ?>
    <?php endif; // if you delete this the sky will fall on your head ?>
  </div>
