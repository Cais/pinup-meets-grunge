<?php
/**
 * Search Form Template
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 */ ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<label class="hidden" for="s"><?php _e( 'Search for:', 'pinup-meets-grunge' ); ?></label>

	<div id="search-container">
		<input type="text" value="<?php _e( 'Enter keyword(s) and hit enter', 'pinup-meets-grunge' ); ?>" onblur="if(this.value == '') {this.value = '<?php _e( 'Enter keyword(s) and hit enter', 'nona' ); ?>';}" onfocus="if(this.value == '<?php _e( 'Enter keyword(s) and hit enter', 'pinup-meets-grunge' ); ?>') {this.value = '';}" name="s" id="s" />
		<input type="submit" class="hidden" id="search-submit" value="<?php _e( 'Search', 'pinup-meets-grunge' ); ?>" />
	</div>
	<!-- #search-container -->
</form>