<?php
/**
 * Template part for displaying grid layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */
?>

<li>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
                   
            <?php 
                if (has_post_thumbnail()) {
                    echo '<div class="post-thumbnail clear">';
                    echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">';
                    echo the_post_thumbnail('large-thumb');
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
                the_excerpt();
            ?>
    
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kgm_ayana' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
    
        <footer class="entry-footer">
            <div class="continue-reading clear">
                <span class="read-more"><?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">Continue Reading</a>'; ?></span>
            </div>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</li>