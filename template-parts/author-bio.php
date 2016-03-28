<?php
/**
 * The template for displaying Author bios
 *
 * @package Ayana
 */
?>

<div class="author-box">
    <h3 class="author-heading"><?php _e( 'About the author', 'kgm_ayana' ); ?></h3>
    <div class="author-avatar">
        <?php
        
        $author_bio_avatar_size = apply_filters( 'kgm_ayana_author_bio_avatar_size', 70 );

        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
        ?>
    </div><!-- .author-avatar -->

    <div class="author-description">
        <h4 class="author-title"><?php echo get_the_author(); ?></h4>

        <p class="author-bio">
            <?php the_author_meta( 'description' ); ?>
            <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                <?php printf( __( 'View all posts by %s <i class="fa fa-arrow-right"></i>', 'kgm_ayana' ), get_the_author() ); ?>
            </a>
        </p><!-- .author-bio -->

    </div><!-- .author-description -->
</div><!-- .author-box -->