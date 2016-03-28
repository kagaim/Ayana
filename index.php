<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

get_header(); ?>
    
   <!-- Featured Posts Section  -->
    <?php 
        if ( is_front_page() || is_home() ) :
        if( ( !get_theme_mod('kgm_ayana_featured_posts') ) && ( !is_paged() ) ) : 
            get_template_part( 'template-parts/featured-posts' );  
        endif; endif;
    ?>
    
    <!-- Latest Posts Section -->
    
    <?php 
        if ( is_front_page() || is_home() ) :
        if( ( !get_theme_mod('kgm_ayana_latest_post_car') ) && ( !is_paged() ) ) : 
            get_template_part( 'template-parts/latest-posts' );  
        endif; endif;
    ?>
    
   
	<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
            <?php if ( ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'grid' ) || ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'gridone' )  ) : ?><ul class="grid-layout"><?php endif; ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				    
				    if ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'grid' ) {
				        
                        if ( is_front_page() || is_home() ) {
                            get_template_part( 'template-parts/content', 'grid' ); 
                        }
                        
				    } else if ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'gridone' ) {
				        
                        if ( is_front_page() || is_home() ) {
                            get_template_part( 'template-parts/content', 'gridone' ); 
                        }
				        
				    } else if ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'list' ) {
				            
				        if ( is_front_page() || is_home() ) {
                            get_template_part( 'template-parts/content', 'list' ); 
                        }
				        
				    } else if ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'listone' ) {
                            
                        if ( is_front_page() || is_home() ) {
                            get_template_part( 'template-parts/content', 'listone' ); 
                        }
                        
                    } else {
				           
				       get_template_part( 'template-parts/content', get_post_format() ); 
				       
				    }
                    
				?>

			<?php endwhile; ?>
            <?php if ( ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'grid' ) || ( get_theme_mod( 'kgm_ayana_homepage_layout' )  == 'gridone' ) ) : ?></ul><?php endif; ?>
			<?php kgm_ayana_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if( get_theme_mod ( 'kgm_ayana_website_layout' ) == 'full' ) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
