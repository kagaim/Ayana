<?php
/**
 * Template part for displaying list layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */
 ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class('list-layout'); ?>>
    <?php 
        if (has_post_thumbnail()) {
            echo '<div class="post-thumbnail">';
            echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">';
            echo the_post_thumbnail('large-thumb');
            echo '</a>';
            echo '</div>';
        } 
    ?>
    <div class="list-content">
        <div class="entry-content">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            
            <?php
                the_excerpt();
            ?>
    
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kgm_ayana' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->        
    </div>
</article><!-- #post-## -->


