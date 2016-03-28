<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ayana
 */

if ( ! function_exists( 'kgm_ayana_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function kgm_ayana_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'kgm_ayana' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'kgm_ayana' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'kgm_ayana_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function kgm_ayana_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        if ( !get_theme_mod('kgm_ayana_post_cat') ) {
            $categories_list = get_the_category_list( esc_html__( ', ', 'kgm_ayana' ) );
            if ( $categories_list && kgm_ayana_categorized_blog() ) {
                printf( '<span class="cat-links">' . esc_html__( '%1$s', 'kgm_ayana' ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }
        }

        /* translators: used between list items, there is a space after the comma */
        if ( !get_theme_mod('kgm_ayana_post_tag') ) {
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'kgm_ayana' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( '%1$s', 'kgm_ayana' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }
    }
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'kgm_ayana' ), esc_html__( '1 Comment', 'kgm_ayana' ), esc_html__( '% Comments', 'kgm_ayana' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'kgm_ayana' ), '<span class="edit-link">', '</span>' );
    
    if ( is_single() ) {
        if ( !get_theme_mod( 'kgm_ayana_share_buttons' ) ) {
            get_template_part('template-parts/social-share');
        }
        
    } else if ( is_page() ) {
        if ( !get_theme_mod( 'kgm_ayana_page_share_buttons' ) ) {
            get_template_part('template-parts/social-share');
        }
    } else {
        
        ?>
        <div class="continue-reading clear">
            <span class="read-more"><?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'kgm_ayana') . get_the_title() . '" rel="bookmark">Continue Reading</a>'; ?></span>
                
                <?php 
                    if ( !get_theme_mod( 'kgm_ayana_share_buttons' ) ) {
                        get_template_part('template-parts/social-share');
                    }
                ?>
                
        </div>
        <?php
        
    }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kgm_ayana_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'kgm_ayana_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kgm_ayana_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kgm_ayana_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kgm_ayana_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kgm_ayana_categorized_blog.
 */
function kgm_ayana_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'kgm_ayana_categories' );
}
add_action( 'edit_category', 'kgm_ayana_category_transient_flusher' );
add_action( 'save_post',     'kgm_ayana_category_transient_flusher' );

/*
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */

function kgm_ayana_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
    wp_nav_menu(
        array(
            'theme_location'  => 'social',
            'container'       => 'div',
            'container_id'    => 'menu-social',
            'container_class' => 'menu-social',
            'menu_id'         => 'menu-social-items',
            'menu_class'      => 'menu-items',
            'depth'           => 1,
            'link_before'     => '<span class="screen-reader-text">',
            'link_after'      => '</span>',
            'fallback_cb'     => '',
        )
    );
    }
}

if ( ! function_exists( 'kgm_ayana_paging_nav' ) ) :
/**
 * Display paginated navigation to next/previous page when applicable.
 *
 * @return void
 */
function kgm_ayana_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 2,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '<i class="fa fa-angle-double-left"></i>', 'kgm_ayana' ),
        'next_text' => __( '<i class="fa fa-angle-double-right"></i>', 'kgm_ayana' ),
        'type'      => 'list',
    ) );

    if ( $links ) :

    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'kgm_ayana' ); ?></h1>
            <?php echo $links; ?>
    </nav><!-- .navigation -->
    <?php
    endif;
}
endif;

/* Modify the read more link */
add_filter( 'the_content_more_link', 'modify_read_more_link' );

function modify_read_more_link() {
    return '';
}

/* The Excerpt */

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
