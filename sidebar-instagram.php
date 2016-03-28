<?php
/**
 * The instagram sidebar
 *
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
    return;
}
?>

<div id="instagram-footer">
    <div id="instagram-widget" class="instagram-widget widget-area clear" role="complementary">
        <?php dynamic_sidebar( 'sidebar-3' ); ?>
    </div><!-- #instagram-sidebar -->
</div><!-- #instagram-footer -->