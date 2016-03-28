<?php
/**
 * Template part for displaying audio posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ayana
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- Featured Audio -->
		<?php 
            $audio_host_type = rwmb_meta( 'kgm_ayana_audio_host_type', $args = array('type' => 'radio'), $post->ID );
            $audio_self_hosted = rwmb_meta( 'kgm_ayana_shaudio', $args = array('type' => 'file_advanced'), $post->ID );
            $bg_image = 'style="background-image: url(' . esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . ');"' ;
        
        if ($audio_host_type =='embeded'): 
        ?>
		<div class="post-thumbnail">
            <?php echo rwmb_meta( 'kgm_ayana_audio_embed_code', $args = array('type' => 'textarea'), $post->ID ); ?>
        </div>
        <?php else : if ($audio_host_type =='selfhosted' && $audio_self_hosted != NULL) : ?>
            <div class="post-thumbnail self-hosted-audio"  <?php if (has_post_thumbnail()) echo $bg_image ?>>
                
                <?php foreach ($audio_self_hosted as $audio): ?>
                   <?php echo do_shortcode( '[audio src="'. $audio['url'] .'"][/audio]' ); ?>
                <?php endforeach ?>
        
            </div>
        <?php endif; endif;?>
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

