<?php
/**
 * Footer Template
 *
 * @package     PinUpMeetsGrunge
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/pinup-meets-grunge/
 * @link        https://github.com/Cais/pinup-meets-grunge/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 */ ?>

<div id="footer">
    <div id="footer-top"></div>

    <div id="footer-widgets-above"></div>
    <!-- NB: It is very important to maintain the order of the following widget code to insure the formatting and style does not break!!! -->
    <div id="footer-widgets">
        <div id="fw-middle" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-middle" ) ) : else : ?>
            <div class="widget-top"></div>
            <div class="footer-widget">
                <!-- Middle Footer Widget -->
                <?php pmg_login(); ?>
            </div>
            <div class="widget-bottom"></div>
            <?php endif; ?><!-- end widget zone footer-middle -->
        </div><!-- #fw-middle -->

        <div id="fw-left" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-left" ) ) : else : endif; ?>
        </div><!-- #fw-left -->

        <div id="fw-right" class="fw-column">
            <?php if ( dynamic_sidebar( "footer-right" ) ) : else : endif; ?>
        </div><!-- #fw-right -->
    </div><!-- #footer-widgets -->
    <div id="footer-widgets-below"></div>

    <div id="footer-middle">
        <p>
            <?php pmg_dynamic_copyright();
            pmg_theme_version(); ?>
        </p>
    </div><!-- #footer-middle -->

    <div id="footer-bottom"><?php wp_footer(); ?></div>
</div><!-- #footer -->
</div><!-- #outside -->
</body>
</html>