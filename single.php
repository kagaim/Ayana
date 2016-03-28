<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ayana
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                
            <?php 
                if ( !get_theme_mod( 'kgm_ayana_related_posts' ) ) :
                    
                if(is_single()) : 
            
            ?>
                <?php get_template_part('template-parts/related-posts'); ?>
           
            <?php endif; endif; ?>
                       
            <?php
                if ( !get_theme_mod( 'kgm_ayana_author_box' ) ) :
                    //Author Box
                    if ( is_single() && get_the_author_meta( 'description' ) ) :
                        get_template_part( 'template-parts/author-bio' );
                    endif;
                endif;
            ?>

			<?php if ( !get_theme_mod( 'kgm_ayana_pn_links' ) ) :  the_post_navigation();  endif; ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if( ( get_theme_mod ( 'kgm_ayana_website_layout' ) == 'full' ) || ( get_theme_mod ( 'kgm_ayana_post_layout' ) == 'full' ) ) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
