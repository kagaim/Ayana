<?php 

$orig_post = $post;
global $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 3, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) {
	    $count = $my_query->post_count;
        if ( $count == 3 ) {
         ?>
		<div class="related-posts clear">
			<h4 class="rposts-heading">
				<?php _e('You might also like', 'kgm_ayana'); ?>
			</h4>
		<?php while( $my_query->have_posts() ) {
			$my_query->the_post();?>
				<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<div class="related-articles">
					
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('rposts-thumb'); ?></a>
					
					<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					
					<span class="date"><?php the_time( get_option('date_format') ); ?></span>
					
				</div>
				<?php endif; ?>
		<?php
		  }
		echo '</div>';
	   }
	}
}
$post = $orig_post;
wp_reset_query();

?>