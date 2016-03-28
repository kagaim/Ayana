<?php
/**
 * The template for displaying Featured Posts
 *
 * @package Ayana
 */
?>

<section id="kgm-featured-posts" class="kgm-featured-posts">
    <ul class="bxslider">
        <?php
            $featured_posts = new WP_Query( array( 'meta_key' => '_is_ns_featured_post', 'meta_value' => 'yes' ) );
            if ($featured_posts->have_posts()) : while ($featured_posts->have_posts()) : $featured_posts->the_post();
        ?>
        
        <li>
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('featured-thumb'); ?></a>
            <?php else : ?>
                <a href="<?php echo get_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="No Featured Image" title="No Featured Image" /></a>
            <?php endif; ?>
                        
            <div class="featured-overlay">
                <div class="overlay-text">
                    
                    <?php
                        if(!get_theme_mod('kgm_ayana_featured_posts_cat')) {
                           if ( 'post' === get_post_type() ) {
                                /* translators: used between list items, there is a space after the comma */
                                if ( !get_theme_mod('kgm_ayana_post_cat') ) {
                                    $categories_list = get_the_category_list( esc_html__( ', ', 'kgm_ayana' ) );
                                    if ( $categories_list && kgm_ayana_categorized_blog() ) {
                                        printf( '<span class="cat-links">' . esc_html__( '%1$s', 'kgm_ayana' ) . '</span>', $categories_list ); // WPCS: XSS OK.
                                    }
                                }
                            } 
                        }
                    ?>
                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <span class="overlay-text-divider"></span>
                    <div class="continue-reading clear">
                        <span class="read-more"><?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">Continue Reading</a>'; ?></span>
                    </div>
                </div>
            </div>
               
        </li>
        
        <?php endwhile; endif; ?>
    </ul>
    <div class="featured-slider-controls">
        <span class="slider-prev"></span>
        <span class="slider-next"></span>
    </div>     
</section><!-- featured-posts -->