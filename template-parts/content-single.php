<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail( ); ?>
            </div>
        <?php } ?>
        
        
		<?php 
    		if ( is_single() ) {
    		   the_title( '<h1 class="entry-title">', '</h1>' ); 
    		} else {
    		   the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
    		}
    	?>
        
         <?php if ( !get_theme_mod( 'kgm_ayana_post_date' ) ) : ?>
            <div class="entry-meta">
                <?php kgm_ayana_posted_on(); ?>
            </div><!-- .entry-meta -->
         <?php endif; ?>
            
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kgm_ayana' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php kgm_ayana_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

