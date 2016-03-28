<?php
/**
 * The template for displaying grid one lists
 *
 * @package Ayana
 */

    if ( $wp_query->current_post == 0 && !is_paged() && is_archive() ) {
        
        ?>
            <div class="kgm-grid-standard-post">
        <?php    
                get_template_part( 'template-parts/content', get_post_format() ); 
        ?>
            </div>
        <?php  
        
    } else if ( $wp_query->current_post == 0 && !is_paged() && is_front_page() ) {
        
        ?>
            <div class="kgm-grid-standard-post">
        <?php    
                get_template_part( 'template-parts/content', get_post_format() ); 
        ?>
            </div>
        <?php 
        
    } else {
        
        get_template_part( 'template-parts/content', 'grid' );
        
    }
    
?>