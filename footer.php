</div> <!-- #head2toe -->
<div id="footer">
  <div id="footer-top"></div>
        
  <div id="footer-widgets-above"></div>
    
    <div id="footer-widgets">
    <!-- NB: It is very important to maintain the order of the following widget code to insure the formatting and style does not break!!! -->
      <div id="fw-middle" class="fw-column">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-middle") ) : else : ?>
        <div class="widget-top"></div>
          <div class="footer-widget">
            <!-- Middle Footer Widget -->
            <?php bns_login(); ?>
            <!-- Remove the following line to delete the reminder text under the BNS-Login function output -->
            <h6><?php _e('If you use this widget area please consider using the ', 'pinup-meets-grunge'); ?><a href="http://wordpress.org/extend/plugins/bns-login/" title="<?php _e('BNS-Login plugin at WordPress','pinup-meets-grunge'); ?>">"BNS Login"</a><?php _e(' plugin. Thank You!', 'pinup-meets-grunge'); ?></h6>  
          </div>
        <div class="widget-bottom"></div>
        <?php endif; ?> <!-- end widget zone footer-middle -->
      </div>
      
      <div id="fw-left" class="fw-column">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-left") ) : else : ?>
<!--
        <div class="widget-top"></div>
          <div class="footer-widget">
            Left Footer Widget - Remove all the HTML comments to "hard-code" items into this section
          </div>
        <div class="widget-bottom"></div>
-->
        <?php endif; ?> <!-- end widget zone footer-left -->
      </div>
      
      <div id="fw-right" class="fw-column">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-right") ) : else : ?>
<!--
        <div class="widget-top"></div>
          <div class="footer-widget">
            Right Footer Widget - Remove all the HTML comments to "hard-code" items into this section
          </div>
        <div class="widget-bottom"></div>
-->
        <?php endif; ?> <!-- end widget zone footer-right -->
      </div>
    </div> <!-- #footer-widgets -->
        
  <div id="footer-widgets-below"></div>
        
  <div id="footer-middle">
    <p>
      <?php _e('Copyright', 'pinup-meets-grunge'); ?> &copy; <?php echo date("Y"); ?>  <strong><?php bloginfo('name'); ?></strong> <?php _e('All rights reserved', 'pinup-meets-grunge'); ?>.
      <?php bns_theme_version(); ?>
    </p>
  </div> <!-- #footer-middle -->
        
  <div id="footer-bottom"><?php wp_footer(); ?></div>
        
</div> <!-- #footer -->
</div> <!-- #outside -->
</div> <!-- #full-screen -->
</body>
</html>
