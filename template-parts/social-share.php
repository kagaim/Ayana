<?php
/**
 * The template for displaying Social Share Plugins
 *
 * @package Ayana
 */
?>

<span class="social-share">
    <?php printf( esc_html__( 'Share:', 'kgm_ayana' ) ); ?>
    <!-- twitter -->
    <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;"><i class="fa fa-twitter"></i></a>
    <!-- facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;"><i class="fa fa-facebook"></i></a>
    <!-- linkedin -->
    <a href="https://www.linkedin.com/shareArticle?mini=true%26url=<?php the_permalink(); ?>%26source=<?php home_url(); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=490,height=530');return false;"><i class="fa fa-linkedin"></i></a>
    <!-- pinterest -->
    <?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
    <a data-pin-do="skipLink" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($pin_image); ?>&amp;description=<?php echo rawurlencode(the_title('', '', false)); ?>"
       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
      <i class="fa fa-pinterest-p"></i>
    </a>
</span>