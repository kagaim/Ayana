<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ayana
 */

?>

	</div><!-- #content -->
    
	<footer id="colophon" class="site-footer" role="contentinfo">
	    <?php if ( !get_theme_mod( 'kgm_ayana_instagram_widget' ) ) :  get_sidebar( 'instagram' ); endif; ?>
	    <?php if ( !get_theme_mod( 'kgm_ayana_footer_widget' ) ) :  get_sidebar( 'footer' ); endif; ?>
		<div class="site-info">
			<?php echo get_theme_mod('kgm_ayana_copyright_text'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#" id="ScrollToTop"><i class="fa fa-angle-up"></i></a><!-- Scroll to Top -->
<?php wp_footer(); ?>

</body>
</html>
