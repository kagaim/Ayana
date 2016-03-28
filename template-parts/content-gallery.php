<?php
/**
 * Template part for displaying gallery posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- Gallery Slider -->
		<?php
		  $gallery_type = rwmb_meta( 'kgm_ayana_gallery_type', $args = array('type' => 'radio'), $post->ID );
          $gallery_images = rwmb_meta( 'kgm_ayana_gallery_images', $args = array('type' => 'file_advanced'), $post->ID );
          
          if (!empty($gallery_images) && $gallery_type == 'slider') : 
		?>
        <div class="post-thumbnail post-gallery-slider">
            <ul class="bxslider">
                <?php foreach ($gallery_images as $image): ?>
                    <li>
                        <?php 
                            $the_image = wp_get_attachment_image_src( $image['ID'], 'large-thumb' );
                            $attachment = get_post($image['ID']);
                            $image_caption = $attachment->post_excerpt; 
                        ?>
                        
                        <img src="<?php echo $the_image[0]; ?>" <?php if ( $image_caption !=NULL ) : ?>title="<?php echo $image_caption; ?>"<?php endif; ?> />
                        
                    </li>
                <?php endforeach; ?>
            </ul> 
        </div>
        <!-- Tiled Slider -->
        <?php else : if (!empty($gallery_images) && $gallery_type == 'tiled') : ?>
            <div class="tiled-thumbnail">
                <div class="gallery-tiled popup-gallery">
                    <ul>
                        <?php foreach ($gallery_images as $image): ?>
                            <li>
                                <?php
                                    $attachment = get_post($image['ID']);
                                    $image_caption = $attachment->post_excerpt;
                                ?>
                                <a href="<?php echo $image['url'] ?>" <?php if ($image_caption !=NULL) : ?>data-caption="<?php echo $image_caption; ?>" <?php endif; ?>>
                                    <?php echo wp_get_attachment_image($image['ID'], 'tiled-thumb') ?>
                                    <div class="overlay"></div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        
        <?php endif; endif; ?>
		
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

