<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ayana
 */

get_header(); ?>

	<div id="primary" class="content-area">
	   
		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if( get_theme_mod ( 'kgm_ayana_website_layout' ) == 'full' ) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
