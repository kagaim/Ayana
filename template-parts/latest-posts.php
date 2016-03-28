<?php
/**
 * The template for displaying latest Posts
 *
 * @package Ayana
 */
?>

<?php
    $latest_post_cat = get_theme_mod( 'kgm_ayana_latest_post_cat' );
    $number = get_theme_mod( 'kgm_ayana_number_latest_posts' );
?>

<?php if(!get_theme_mod('kgm_ayana_latest_post_header_section')) : ?>
    <div class="latest-posts-header">
        <?php if(!get_theme_mod('kgm_ayana_latest_post_title')) : ?>
        <h2>
            <?php echo get_theme_mod('kgm_ayana_latest_posts_title_text'); ?> <?php echo get_cat_name( $latest_post_cat ); ?>
        </h2><!-- Title -->
        <?php endif; ?>
        
        <?php if(!get_theme_mod('kgm_ayana_latest_post_car_btn')) : ?>
        <div class="latest-post-carousel-controls">
            <span class="post-prev"></span>
            <span class="post-next"></span>
        </div><!-- latest-post-carousel-controls -->
        <?php endif; ?>
    </div><!-- latest-posts-header -->
<?php endif; ?>

<section id="kgm-latest-posts" class="kgm-latest-posts">
    
    <ul class="bxslider">
        
        <?php
            $latest_posts_query = new WP_Query( array( 'cat' => $latest_post_cat, 'showposts' => $number ) );        
            if ( $latest_posts_query->have_posts() ) : while ( $latest_posts_query->have_posts() ) : $latest_posts_query->the_post();
        ?>
        
        <li>
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('lposts-thumb'); ?></a>
            <?php else : ?>
                <a href="<?php echo get_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image-latest-post.jpg" alt="No Featured Image" title="No Featured Image" /></a>
            <?php endif; ?>
            
            <div class="featured-overlay">
                <div class="overlay-text">
                    
                    <h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <span class="overlay-text-divider"></span>
                    <div class="continue-reading clear">
                        <span class="read-more"><?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">Continue Reading</a>'; ?></span>
                    </div>
                </div>
            </div>
        </li>
        
        <?php endwhile; endif; ?>
        
    </ul><!-- bxslider -->
       
</section><!-- latest-posts -->