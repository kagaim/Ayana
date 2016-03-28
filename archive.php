<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php if ( ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'grid' ) || ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'gridone' )  ) : ?><ul class="grid-layout"><?php endif; ?>
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                    
                    if ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'grid' ) {
                        
                        if ( is_archive() ) {
                            get_template_part( 'template-parts/content', 'grid' ); 
                        }
                        
                    } else if ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'gridone' ) {
                        
                        if ( is_archive() ) {
                            get_template_part( 'template-parts/content', 'gridone' ); 
                        }
                        
                    } else if ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'list' ) {
                            
                        if ( is_archive() ) {
                            get_template_part( 'template-parts/content', 'list' ); 
                        }
                        
                    } else if ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'listone' ) {
                            
                        if ( is_archive() ) {
                            get_template_part( 'template-parts/content', 'listone' ); 
                        }
                        
                    } else {
                           
                       get_template_part( 'template-parts/content', get_post_format() ); 
                       
                    }
                    
                ?>

            <?php endwhile; ?>
            
            <?php if ( ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'grid' ) || ( get_theme_mod( 'kgm_ayana_archive_layout' )  == 'gridone' ) ) : ?></ul><?php endif; ?>

			<?php kgm_ayana_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if( get_theme_mod ( 'kgm_ayana_website_layout' ) == 'full' ) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
