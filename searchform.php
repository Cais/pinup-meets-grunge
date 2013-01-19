<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
  <label class="hidden" for="s"><?php _e('Search for:','pinup-meets-grunge'); ?></label>
  <div id="search-container">
    <input type="text" value="<?php _e('Enter keyword(s) and hit enter', 'pinup-meets-grunge'); ?>" onblur="if(this.value == '') {this.value = '<?php _e('Enter keyword(s) and hit enter', 'pinup-meets-grunge'); ?>';}" onfocus="if(this.value == '<?php _e('Enter keyword(s) and hit enter', 'pinup-meets-grunge'); ?>') {this.value = '';}" name="s" id="s" />
    <input type="submit" class="hidden" id="search-submit" value="<?php _e('Search' , 'pinup-meets-grunge'); ?>" />
  </div> <!-- #search-container -->
</form>
