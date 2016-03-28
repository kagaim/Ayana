<?php
/**
 * The footer sidebar
 *
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
    return;
}
?>
<?php if (get_theme_mod( 'kgm_ayana_footer_bg_img')) : ?>
    <div id="supplementary" class="footer-background-image" style="background-image: url('<?php echo esc_url(get_theme_mod('kgm_ayana_footer_bg_img')); ?>')">
<?php else : ?>
    <div id="supplementary">
<?php endif; ?>
    <div class="footer-area">
        <div id="footer-widgets" class="footer-widgets widget-area clear" role="complementary">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div><!-- #footer-sidebar -->
    </div><!-- footer-area -->    
</div><!-- #supplementary -->