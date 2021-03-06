<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		        
        <?php 
            if (has_post_thumbnail()) {
                echo '<div class="post-thumbnail clear">';
                echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">';
                echo the_post_thumbnail('feature-thumb');
                echo '</a>';
                echo '</div>';
            }
        ?>
		
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		
		  <?php if ( !get_theme_mod( 'kgm_ayana_post_date' ) ) : ?>
                <div class="entry-meta">
                    <?php kgm_ayana_posted_on(); ?>
                </div><!-- .entry-meta -->
          <?php endif; ?>
		
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kgm_ayana' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

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
