<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ayana
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kgm_ayana' ); ?></a>
    
        <?php 
            if ( get_header_image() && !('blank' == get_header_textcolor()) ) {
                echo '<header id="masthead" class="site-header header-background-image" role="banner" style="background-image: url(' . get_header_image() . ')">';
            } else {
                echo '<header id="masthead" class="site-header" role="banner">';
            }
        ?>
					
		<div class="site-branding">
			<!-- start logo -->
                <?php if (get_theme_mod( 'kgm_ayana_logo')) : ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('kgm_ayana_logo')); ?>" alt="<?php bloginfo('name'); ?>"></a>
                <?php else : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php endif; ?>
            <!-- end logo -->  
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<div class="mobile-menu"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'container_class' => 'ayana-menu', 'container_id' => 'ayana-menu', 'menu_id' => 'primary-menu' ) ); ?>
			
			<?php if(!get_theme_mod('kgm_ayana_menu_search_box')) : ?>
    			<div class="search-toggle">
                    <i class="fa fa-search"></i>
                    <a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'kgm_ayana' ); ?></a>
                </div><!-- #search-toggle -->
            <?php endif; ?>
            
			<?php if(!get_theme_mod('kgm_ayana_menu_social')) :  kgm_ayana_social_menu(); endif; ?>
			
			<div id="search-container" class="search-box-wrapper clear">
                <div class="search-box clear">
                    <?php get_search_form(); ?>
                </div>
            </div><!-- #search-container -->
			    
		</nav><!-- #site-navigation -->
		
		
	</header><!-- #masthead -->
    
    <?php
    
        if ( is_page() && !is_front_page() ) {
            echo '<div id="content" class="site-content">';
        } else if ( ( is_single() && !is_front_page() ) || ( is_single() && !is_archive() ) ) {
           if ( get_theme_mod('kgm_ayana_post_layout')  == 'left' ) {
               echo '<div id="content" class="site-content ayana-left">';
           } else if ( get_theme_mod('kgm_ayana_post_layout')  == 'right' ) {
               echo '<div id="content" class="site-content ayana-right">';
           } else if ( get_theme_mod('kgm_ayana_post_layout')  == 'full' ) {
               echo '<div id="content" class="site-content ayana-full">';
           } else {
               echo '<div id="content" class="site-content ayana-left">';
           }
        } else {
           if ( get_theme_mod('kgm_ayana_website_layout')  == 'left' ) {
               echo '<div id="content" class="site-content ayana-left">';
           } else if ( get_theme_mod('kgm_ayana_website_layout')  == 'right' ) {
               echo '<div id="content" class="site-content ayana-right">';
           } else if ( get_theme_mod('kgm_ayana_website_layout')  == 'full' ) {
               echo '<div id="content" class="site-content ayana-full">';
           } else {
               echo '<div id="content" class="site-content ayana-right">';
           }
        }
        
    ?>
	
