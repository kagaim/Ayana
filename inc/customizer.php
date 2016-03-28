<?php
/**
 * Ayana Theme Customizer.
 *
 * @package Ayana
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kgm_ayana_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    // Add Sections

    class Customize_Number_Control extends WP_Customize_Control {
        public $type = 'number';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="number" name="quantity" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">
            </label>
            <?php
        }
    }
    
    class Customize_CustomCss_Control extends WP_Customize_Control {
        public $type = 'custom_css';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea style="width:100%; height:150px;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
            </label>
            <?php
        }
    }
    
    if (class_exists('WP_Customize_Control')) {
        class WP_Customize_Category_Control extends WP_Customize_Control {
            /**
             * Render the control's content.
             *
             * @since 3.4.0
             */
            public function render_content() {
                $dropdown = wp_dropdown_categories(
                    array(
                        'name'              => '_customize-dropdown-categories-' . $this->id,
                        'echo'              => 0,
                        'show_option_none'  => __( '&mdash; Select &mdash;', 'kgm_ayana' ),
                        'option_none_value' => '0',
                        'selected'          => $this->value(),
                    )
                );
     
                // Hackily add in the data link parameter.
                $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
     
                printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                    $this->label,
                    $dropdown
                );
            }
        }
    }
           
    /* General Settings */
    $wp_customize->add_section(
        'general_settings',
        array(
            'title' => __( 'General Settings', 'kgm_ayana' ),
            'description' => __( 'Some common settings for entire site', 'kgm_ayana' ),
            'priority' => 30,
        )
    );
    
    // logo
    $wp_customize->add_setting(
        'kgm_ayana_logo', array (
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'kgm_ayana_logo',
            array(
                'label' => __( 'Upload Logo', 'kgm_ayana' ),
                'section' => 'general_settings',
                'settings' => 'kgm_ayana_logo'
            )
        )
    );
       
    //Home and Archive Page Sidebar Options
    $wp_customize->add_setting (
        'kgm_ayana_website_layout',
        array(
            'default'     => 'right',
            'sanitize_callback' => 'kgm_ayana_sanitize_sidebar'
        )
    );
    
    $wp_customize->add_control (
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_website_layout',
            array(
                'label'          => __( 'Home and Archive Page Sidebar Options', 'kgm_ayana' ),
                'description' => __( 'Does not work with Pages, for pages use Template setting', 'kgm_ayana' ),
                'section'        => 'general_settings',
                'settings'       => 'kgm_ayana_website_layout',
                'type'           => 'radio',
                'choices'        => array(
                    'left'   => 'Left Sidebar Layout',
                    'right'   => 'Right Sidebar Layout',
                    'full'  => 'Full Width Layout',
                )
            )
        )
    );
    
    //Post Sidebar Options
    $wp_customize->add_setting (
        'kgm_ayana_post_layout',
        array(
            'default'     => 'left',
            'sanitize_callback' => 'kgm_ayana_sanitize_post_sidebar'
        )
    );
    
    $wp_customize->add_control (
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_post_layout',
            array(
                'label'          => __( 'Post Sidebar Options', 'kgm_ayana' ),
                'description' => __( 'Does not work with Pages, for pages use Template setting', 'kgm_ayana' ),
                'section'        => 'general_settings',
                'settings'       => 'kgm_ayana_post_layout',
                'type'           => 'radio',
                'choices'        => array(
                    'left'   => 'Left Sidebar Layout',
                    'right'   => 'Right Sidebar Layout',
                    'full'  => 'Full Width Layout',
                )
            )
        )
    );
    
    //Home Page Options
    $wp_customize->add_setting (
        'kgm_ayana_homepage_layout',
        array(
            'default'     => 'standard',
            'sanitize_callback' => 'kgm_ayana_sanitize_layout'
        )
    );
    
    $wp_customize->add_control (
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_homepage_layout',
            array(
                'label'          => __( 'Home Page Layout', 'kgm_ayana' ),
                'description' => __( 'Set your home page blog layout. It also works with your default posts page as set in Reading Settings.', 'kgm_ayana' ),
                'section'        => 'general_settings',
                'settings'       => 'kgm_ayana_homepage_layout',
                'type'           => 'radio',
                'choices'        => array(
                    'standard'   => 'Standard Layout',
                    'grid'   => 'Grid Layout',
                    'gridone' => '1st Standard Post then Grid',
                    'list'  => 'List Layout',
                    'listone'  => '1st Standard Post then List',
                )
            )
        )
    );
    
    //Archive Page Options
    $wp_customize->add_setting (
        'kgm_ayana_archive_layout',
        array(
            'default'     => 'standard',
            'sanitize_callback' => 'kgm_ayana_sanitize_archive_layout'
        )
    );
    
    $wp_customize->add_control (
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_archive_layout',
            array(
                'label'          => __( 'Archive Page Layout', 'kgm_ayana' ),
                'description'   => __( 'Set your archive page blog layout.', 'kgm_ayana' ),
                'section'        => 'general_settings',
                'settings'       => 'kgm_ayana_archive_layout',
                'type'           => 'radio',
                'choices'        => array (
                    'standard'   => 'Standard Layout',
                    'grid'   => 'Grid Layout',
                    'gridone' => '1st Standard Post then Grid',
                    'list'  => 'List Layout',
                    'listone'  => '1st Standard Post then List',
                )
            )
        )
    );
    
    //Disable Menu Search Box
    $wp_customize->add_setting(
        'kgm_ayana_menu_search_box',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_menu_search_box',
            array(
                'label'      => __( 'Disable Menu Search Box', 'kgm_ayana' ),
                'section'    => 'general_settings',
                'settings'   => 'kgm_ayana_menu_search_box',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Menu Social Links
    $wp_customize->add_setting(
        'kgm_ayana_menu_social',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_menu_social',
            array(
                'label'      => __( 'Hide Menu Social Links', 'kgm_ayana' ),
                'section'    => 'general_settings',
                'settings'   => 'kgm_ayana_menu_social',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Featured Area Settings */
    $wp_customize->add_section(
        'featured_area_settings',
        array(
            'title' => __( 'Featured Area Settings', 'kgm_ayana' ),
            'description' => __( 'Slide\'s settings for the featured area', 'kgm_ayana' ),
            'priority' => 31,
        )
    );
    
    // Hide/ Show Featured Posts
    $wp_customize->add_setting(
        'kgm_ayana_featured_posts',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_featured_posts',
            array(
                'label'      => __( 'Hide/ Show Featured Posts Slideshow', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_featured_posts',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide/ Show Featured Posts Category
    $wp_customize->add_setting(
        'kgm_ayana_featured_posts_cat',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_featured_posts_cat',
            array(
                'label'      => __( 'Hide/ Show Featured Posts Category', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_featured_posts_cat',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide/ Show Latest Posts Carousel
    $wp_customize->add_setting(
        'kgm_ayana_latest_post_car',
        array(
            'default'     => FALSE,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_latest_post_car',
            array(
                'label'      => __( 'Hide/ Show Latest Posts Carousel', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_latest_post_car',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Latest Posts Title Text
    $wp_customize->add_setting(
        'kgm_ayana_latest_posts_title_text',
        array(
            'default'     => __( 'Latest Posts in', 'kgm_ayana' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'kgm_ayana_crt_sanitize_text'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_latest_posts_title_text',
            array(
                'label'      => __( 'Latest Posts Title', 'kgm_ayana' ),
                'section'    => 'featured_area_settings',
                'settings'   => 'kgm_ayana_latest_posts_title_text',
                'type' => 'text'            
            )
        )
    );
        
    // Show Categories Dropdown
    $wp_customize->add_setting(
        'kgm_ayana_latest_post_cat',
        array(
            'sanitize_callback' => 'kgm_ayana_crt_sanitize_text'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'kgm_ayana_latest_post_cat',
            array(
                'label'    => __( 'Choose Latest Posts Category', 'kgm_ayana' ),
                'settings' => 'kgm_ayana_latest_post_cat',
                'section'  => 'featured_area_settings',
                'type'     => 'select'
            )
        )
    );
    
    // Number of Slides to show
    $wp_customize->add_setting(
        'kgm_ayana_number_latest_posts',
        array(
            'default'     => '6',
            'sanitize_callback' => 'kgm_ayana_sanitize_number'
        )
    );
    
    $wp_customize->add_control(
        new Customize_Number_Control(
            $wp_customize,
            'kgm_ayana_number_latest_posts',
            array(
                'label'      => __( 'Number of Latest Posts', 'kgm_ayana' ),
                'section'    => 'featured_area_settings',
                'settings'   => 'kgm_ayana_number_latest_posts',
                'type'       => 'number'
            )
        )
    );
    
    // Hide/ Show Latest Posts Header Section
    $wp_customize->add_setting(
        'kgm_ayana_latest_post_header_section',
        array(
            'default'     => FALSE,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_latest_post_header_section',
            array(
                'label'      => __( 'Hide/ Show Carousel Header', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_latest_post_header_section',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide/ Show Latest Posts Title
    $wp_customize->add_setting(
        'kgm_ayana_latest_post_title',
        array(
            'default'     => FALSE,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_latest_post_title',
            array(
                'label'      => __( 'Hide/ Show Latest Posts Title', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_latest_post_title',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide/ Show Latest Posts Carousel Buttons
    $wp_customize->add_setting(
        'kgm_ayana_latest_post_car_btn',
        array(
            'default'     => FALSE,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_latest_post_car_btn',
            array(
                'label'      => __( 'Hide/ Show Carousel Buttons', 'kgm_ayana' ),
                'settings'   => 'kgm_ayana_latest_post_car_btn',
                'section'    => 'featured_area_settings',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Post Settings */
    $wp_customize->add_section(
        'post_settings',
        array(
            'title' => __( 'Post Settings', 'kgm_ayana' ),
            'priority' => 32,
        )
    );
    
    // Hide Posts Date and Author
    $wp_customize->add_setting(
        'kgm_ayana_post_date',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_post_date',
            array(
                'label'      => __( 'Hide Date and Author', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_post_date',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Hide Posts Category
    $wp_customize->add_setting(
        'kgm_ayana_post_cat',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_post_cat',
            array(
                'label'      => __( 'Hide Category', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_post_cat',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Hide Posts Tags
    $wp_customize->add_setting(
        'kgm_ayana_post_tag',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_post_tag',
            array(
                'label'      => __( 'Hide Tags', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_post_tag',
                'type'       => 'checkbox'
            )
        )
    );
    
    //Hide Share Buttons
    $wp_customize->add_setting(
        'kgm_ayana_share_buttons',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_share_buttons',
            array(
                'label'      => __( 'Hide Share Buttons', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_share_buttons',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide Prev/ Next Post Links
    $wp_customize->add_setting(
        'kgm_ayana_pn_links',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_pn_links',
            array(
                'label'      => __( 'Hide Prev/ Next Post Links', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_pn_links',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide Author Box
    $wp_customize->add_setting(
        'kgm_ayana_author_box',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_author_box',
            array(
                'label'      => __( 'Hide Author Box', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_author_box',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide Related Posts
    $wp_customize->add_setting(
        'kgm_ayana_related_posts',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_related_posts',
            array(
                'label'      => __( 'Hide Related Posts', 'kgm_ayana' ),
                'section'    => 'post_settings',
                'settings'   => 'kgm_ayana_related_posts',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Page Settings */
    $wp_customize->add_section(
        'page_settings',
        array(
            'title' => __( 'Page Settings', 'kgm_ayana' ),
            'priority' => 33,
        )
    );
    
    // Hide page Share Buttons
    $wp_customize->add_setting(
        'kgm_ayana_page_share_buttons',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control (
            $wp_customize,
            'kgm_ayana_page_share_buttons',
            array(
                'label'      => __( 'Hide Page Share Buttons', 'kgm_ayana' ),
                'section'    => 'page_settings',
                'settings'   => 'kgm_ayana_page_share_buttons',
                'type'       => 'checkbox'
            )
        )
    );
    
    /* Footer Settings */
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title' => __( 'Footer Settings', 'kgm_ayana' ),
            'priority' => 34,
        )
    );
    
    // Hide Instagram Widget Area
    $wp_customize->add_setting(
        'kgm_ayana_instagram_widget',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_instagram_widget',
            array(
                'label'      => __( 'Hide Instagram Widget Area', 'kgm_ayana' ),
                'section'    => 'footer_settings',
                'settings'   => 'kgm_ayana_instagram_widget',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Hide Footer Widget Area
    $wp_customize->add_setting(
        'kgm_ayana_footer_widget',
        array(
            'default'     => false,
            'sanitize_callback' => 'kgm_ayana_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_footer_widget',
            array(
                'label'      => __( 'Hide Footer Widget Area', 'kgm_ayana' ),
                'section'    => 'footer_settings',
                'settings'   => 'kgm_ayana_footer_widget',
                'type'       => 'checkbox'
            )
        )
    );
    
    // Footer Widget Area Background image
    $wp_customize->add_setting(
        'kgm_ayana_footer_bg_img', array (
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'kgm_ayana_footer_bg_img',
            array(
                'label' => __( 'Background Image', 'kgm_ayana' ),
                'description' => __( 'This image displays in the background of the footer widgets area. The recommended size is 1920px*800px.', 'kgm_ayana' ),
                'section' => 'footer_settings',
                'settings' => 'kgm_ayana_footer_bg_img'
            )
        )
    );
    
    //Copyright Text
    $wp_customize->add_setting(
        'kgm_ayana_copyright_text',
        array(
            'default'     => 'Copyright 2015 Kagai.me. All Rights Reserved.',
            'transport' => 'postMessage',
            'sanitize_callback' => 'kgm_ayana_crt_sanitize_text'
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'kgm_ayana_copyright_text',
            array(
                'label'      => __( 'Copyright Text', 'kgm_ayana' ),
                'section'    => 'footer_settings',
                'settings'   => 'kgm_ayana_copyright_text',
                'type' => 'text'            
            )
        )
    );
    
     /* Custom CSS Section */
    $wp_customize->add_section( 'kgm_ayana_section_custom_code' , array(
        'title'      => __( 'Custom Code', 'kgm_ayana' ),
        'description'=> __( 'Enter your custom CSS code, to overwrite the theme CSS.', 'kgm_ayana' ),
        'priority'   => 200,
    ) );
    
    // Custom CSS
    $wp_customize->add_setting (
        'kgm_ayana_custom_css'
    );
    
    $wp_customize->add_control(
        new Customize_CustomCss_Control(
            $wp_customize,
            'kgm_ayana_custom_css',
            array(
                'label'      => __( 'Custom CSS', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_section_custom_code',
                'settings'   => 'kgm_ayana_custom_css',
                'type'       => 'textarea',
            )
        )
    );
    
    // Color Settings
       
   // Color: Theme
   $wp_customize->add_setting(
        'kgm_ayana_theme_color',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_theme_color',
            array(
                'label'      =>  __( 'Theme Color', 'kgm_ayana' ),
                'section'    => 'colors',
                'settings'   => 'kgm_ayana_theme_color'
            )
        )
    );
    
    // Color: Theme Background Color
   $wp_customize->add_setting(
        'kgm_ayana_theme_bg_color',
        array(
            'default'     => '#fdfdfd',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_theme_bg_color',
            array(
                'label'      =>  __( 'Theme Elements Background Color', 'kgm_ayana' ),
                'description' =>  __( 'This setting controls the background color for hentry, comments area, site main and posts navigation.', 'kgm_ayana' ),
                'section'    => 'colors',
                'settings'   => 'kgm_ayana_theme_bg_color'
            )
        )
    );
    
   // Color: Theme Border Color
   $wp_customize->add_setting(
        'kgm_ayana_theme_border_color',
        array(
            'default'     => '#f1f1f1',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_theme_border_color',
            array(
                'label'      =>  __( 'Theme Elements Border Color', 'kgm_ayana' ),
                'description' =>  __( 'This setting controls the border color for hentry, comments area, site main and posts navigation.', 'kgm_ayana' ),
                'section'    => 'colors',
                'settings'   => 'kgm_ayana_theme_border_color'
            )
        )
    );
      
    // Color: Text Logo
   $wp_customize->add_setting(
        'kgm_ayana_text_logo_color',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_text_logo_color',
            array(
                'label'      =>  __( 'Text Logo Color', 'kgm_ayana' ),
                'section'    => 'colors',
                'settings'   => 'kgm_ayana_text_logo_color'
            )
        )
    );
    
    // Color: Theme Link
   $wp_customize->add_setting(
        'kgm_ayana_theme_link_color',
        array(
            'default'     => '#292425',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_theme_link_color',
            array(
                'label'      =>  __( 'Theme Link Color', 'kgm_ayana' ),
                'section'    => 'colors',
                'settings'   => 'kgm_ayana_theme_link_color'
            )
        )
    );
    
    // Color: Menu bar
    $wp_customize->add_section( 'kgm_ayana_menu_bar_colors' , array(
        'title'      => __( 'Colors: Menu Bar', 'kgm_ayana' ),
        'description'=> __( 'Enter your custom colors for the menu bar section', 'kgm_ayana' ),
        'priority'   => 35,
    ) );
    
    // Color: Menu Bar - Border
   $wp_customize->add_setting(
        'kgm_ayana_menubar_border_color',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_border_color',
            array(
                'label'      => __( 'Menu Border Top Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_border_color'
            )
        )
    );
    
    // Color: Menu Bar - Search Icon
   $wp_customize->add_setting(
        'kgm_ayana_menubar_search_icon_color',
        array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_search_icon_color',
            array(
                'label'      => __( 'Search Icon Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_search_icon_color'
            )
        )
    );
    
    // Color: Menu Bar - Search Background
   $wp_customize->add_setting(
        'kgm_ayana_menubar_search_bg_color',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_search_bg_color',
            array(
                'label'      => __( 'Search Background Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_search_bg_color'
            )
        )
    );
    
    // Color: Menu Bar - Search Box Background
   $wp_customize->add_setting(
        'kgm_ayana_menubar_search_box_background_color',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_search_box_background_color',
            array(
                'label'      => __( 'Search Box Background Color', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_search_box_background_color'
            )
        )
    );
    
    // Color: Menu Bar - Social Icons Color
   $wp_customize->add_setting(
        'kgm_ayana_menubar_social_icons_color',
        array(
            'default'     => '#292425',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_social_icons_color',
            array(
                'label'      => __( 'Social Icons Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_social_icons_color'
            )
        )
    );
    
   // Color: Menu Bar - Social Icons Color
   $wp_customize->add_setting(
        'kgm_ayana_menubar_social_icons_color_hover',
        array(
            'default'     => '#999966',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_social_icons_color_hover',
            array(
                'label'      => __( 'Social Icons Hover Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_social_icons_color_hover'
            )
        )
    );
    
    // Color: Menu Bar - Menu Separator Color
   $wp_customize->add_setting(
        'kgm_ayana_menubar_separator_color',
        array(
            'default'     => '#ebebeb',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_menubar_separator_color',
            array(
                'label'      => __( 'Menu Links Separator Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_menu_bar_colors',
                'settings'   => 'kgm_ayana_menubar_separator_color'
            )
        )
    );
    
    // Color: Sidebar
    $wp_customize->add_section( 'kgm_ayana_sidebar_colors' , array(
        'title'      => __( 'Colors: Sidebar', 'kgm_ayana' ),
        'description'=> __( 'Enter your custom colors for the sidebar', 'kgm_ayana' ),
        'priority'   => 36,
    ) );
    
    // Color: Sidebar - Widget Title Color
   $wp_customize->add_setting(
        'kgm_ayana_widget_title_color',
        array(
            'default'     => '#333333',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_widget_title_color',
            array(
                'label'      => __( 'Widget Title Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_sidebar_colors',
                'settings'   => 'kgm_ayana_widget_title_color'
            )
        )
    );
    
   // Color: Sidebar - Widget Title Border Color
   $wp_customize->add_setting(
        'kgm_ayana_widget_title_border_color',
        array(
            'default'     => '',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_widget_title_border_color',
            array(
                'label'      => __( 'Widget Title Border Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_sidebar_colors',
                'settings'   => 'kgm_ayana_widget_title_border_color'
            )
        )
    );
    
   // Color: Sidebar - Widget Background Color
   $wp_customize->add_setting(
        'kgm_ayana_widget_bg_color',
        array(
            'default'     => false,
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_widget_bg_color',
            array(
                'label'      => __( 'Widget Background Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_sidebar_colors',
                'settings'   => 'kgm_ayana_widget_bg_color'
            )
        )
    );  
    
    // Color: Footer
    $wp_customize->add_section( 'kgm_ayana_footer_colors' , array(
        'title'      => __( 'Colors: Footer', 'kgm_ayana' ),
        'description'=> __( 'Enter your custom colors for the footer', 'kgm_ayana' ),
        'priority'   => 37,
    ) );
    
    // Color: Footer - Widget Title Color
   $wp_customize->add_setting(
        'kgm_ayana_footer_widget_title_color',
        array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_footer_widget_title_color',
            array(
                'label'      => __( 'Widget Title Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_footer_colors',
                'settings'   => 'kgm_ayana_footer_widget_title_color'
            )
        )
    );
    
    // Color: Footer - Widget Text Color
   $wp_customize->add_setting(
        'kgm_ayana_footer_text_color',
        array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_footer_text_color',
            array(
                'label'      => __( 'Widget Text Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_footer_colors',
                'settings'   => 'kgm_ayana_footer_text_color'
            )
        )
    );
    
    // Color: Footer - Widget Background Color
   $wp_customize->add_setting(
        'kgm_ayana_footer_widget_bg_color',
        array(
            'default'     => '#313131',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );
   
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kgm_ayana_footer_widget_bg_color',
            array(
                'label'      => __( 'Footer Widget Area Background Color ', 'kgm_ayana' ),
                'section'    => 'kgm_ayana_footer_colors',
                'settings'   => 'kgm_ayana_footer_widget_bg_color'
            )
        )
    );
    
       // Color: Footer - Copyright Background Color
       $wp_customize->add_setting(
            'kgm_ayana_copyright_bg_color',
            array(
                'default'     => '#000000',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
       
       $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'kgm_ayana_copyright_bg_color',
                array(
                    'label'      => __( 'Copyright Background Color ', 'kgm_ayana' ),
                    'section'    => 'kgm_ayana_footer_colors',
                    'settings'   => 'kgm_ayana_copyright_bg_color'
                )
            )
        );
        
        // Color: Footer - Copyright Text Color
       $wp_customize->add_setting(
            'kgm_ayana_copyright_text_color',
            array(
                'default'     => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
       
       $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'kgm_ayana_copyright_text_color',
                array(
                    'label'      => __( 'Copyright Text Color ', 'kgm_ayana' ),
                    'section'    => 'kgm_ayana_footer_colors',
                    'settings'   => 'kgm_ayana_copyright_text_color'
                )
            )
        );
}
add_action( 'customize_register', 'kgm_ayana_customize_register' );

/**
 * Sanitize sidebar options
 */
function kgm_ayana_sanitize_sidebar( $value ) {
    if ( ! in_array( $value, array( 'left', 'right', 'full' ) ) )
        $value = 'right';
     return $value;
}

function kgm_ayana_sanitize_post_sidebar( $value ) {
    if ( ! in_array( $value, array( 'left', 'right', 'full' ) ) )
        $value = 'left';
     return $value;
}

/**
 * Sanitize layout options
 */
function kgm_ayana_sanitize_layout( $value ) {
    if ( ! in_array( $value, array( 'standard', 'grid', 'gridone', 'list', 'listone' ) ) )
        $value = 'standard';
     return $value;
}

/**
 * Sanitize archive layout options
 */
function kgm_ayana_sanitize_archive_layout( $value ) {
    if ( ! in_array( $value, array( 'standard', 'grid', 'gridone', 'list', 'listone' ) ) )
        $value = 'standard';
     return $value;
}

/**
 * Sanitize checkbox
 */
function kgm_ayana_sanitize_checkbox( $value ) {
    if ( $value == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize number
 */
function kgm_ayana_sanitize_number( $value ) {
    if ( $value <= 0 ) {
        return '1';
    } else if ( is_int( $value ) ) {
        return '1';
    } else {
        return $value;
    }
}

/**
 * Sanitize copyright text
 */
function kgm_ayana_crt_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds CSS Styles to WP Header
 */
function kgm_ayana_customizer_css() {
?> 
    <style type="text/css">
    
        <?php if(get_theme_mod( 'kgm_ayana_custom_css' )) : ?>
        
            <?php echo get_theme_mod( 'kgm_ayana_custom_css' ); ?>
            
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_theme_color' )) : ?>
                a,
                a:visited,
                a:hover,
                a:focus,
                a:active  {
                    border-color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                a:hover,
                a:focus,
                a:active {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .Ayana-menu a:hover {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .Ayana-menu li:hover > a,
                .Ayana-menu li.focus > a {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .Ayana-menu ul ul :hover > a,
                .Ayana-menu ul ul .focus > a {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .Ayana-menu .current_page_item > a,
                .Ayana-menu .current-menu-item > a,
                .Ayana-menu .current-menu-ancestor > a,
                .Ayana-menu .current_page_ancestor > a {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .paging-navigation .current {
                    background: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .mejs-controls .mejs-time-rail .mejs-time-current {
                  background: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?> !important;
                }
                
                .format-audio .self-hosted-audio {
                    background: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .social-share a:hover {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .read-more a {
                    border-color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .read-more a:hover {
                    background: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .wp-caption .wp-caption-text {
                    background: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }
                
                .site-footer a:hover {
                    color: <?php echo get_theme_mod( 'kgm_ayana_theme_color' ); ?>;
                }

            <?php endif; ?>
            
        <?php if(get_theme_mod( 'kgm_ayana_theme_bg_color' )) : ?>
            .hentry, .comments-area, .site-main .posts-navigation {
                background: <?php echo get_theme_mod( 'kgm_ayana_theme_bg_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_theme_border_color' )) : ?>
            .hentry, .comments-area, .site-main .posts-navigation {
                border-color: <?php echo get_theme_mod( 'kgm_ayana_theme_border_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_text_logo_color' )) : ?>
            .site-title a {
                color: <?php echo get_theme_mod( 'kgm_ayana_text_logo_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_theme_link_color' )) : ?>
            a,
            a:visited,
            .Ayana-menu a{
                color: <?php echo get_theme_mod( 'kgm_ayana_theme_link_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_border_color' )) : ?>
            .main-navigation {
                border-color: <?php echo get_theme_mod( 'kgm_ayana_menubar_border_color' ); ?>;
            }
        <?php endif; ?>
            
        <?php if(get_theme_mod( 'kgm_ayana_menubar_search_icon_color' )) : ?>
            .search-toggle {
                color: <?php echo get_theme_mod( 'kgm_ayana_menubar_search_icon_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_search_bg_color' )) : ?>
            .search-toggle {
                background: <?php echo get_theme_mod( 'kgm_ayana_menubar_search_bg_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_search_box_background_color' )) : ?>
            .search-box {
                background: <?php echo get_theme_mod( 'kgm_ayana_menubar_search_box_background_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_social_icons_color' )) : ?>
            .menu-social li a:before {
                color: <?php echo get_theme_mod( 'kgm_ayana_menubar_social_icons_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_social_icons_color_hover' )) : ?>
            .menu-social li a:hover::before { 
                color: <?php echo get_theme_mod( 'kgm_ayana_menubar_social_icons_color_hover' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_menubar_separator_color' )) : ?>
            .Ayana-menu ul li a:before {
                color: <?php echo get_theme_mod( 'kgm_ayana_menubar_separator_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_widget_title_color' )) : ?>
            .widget-title {
                color: <?php echo get_theme_mod( 'kgm_ayana_widget_title_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_widget_title_border_color' )) : ?>
            .widget-title {
                border-color: <?php echo get_theme_mod( 'kgm_ayana_widget_title_border_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_widget_bg_color' )) : ?>
            .widget {
                background: <?php echo get_theme_mod( 'kgm_ayana_widget_bg_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_widget_bg_border_color' )) : ?>
            .widget {
                border-color: <?php echo get_theme_mod( 'kgm_ayana_widget_bg_border_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_footer_widget_title_color' )) : ?>
            .footer-widgets .widget-title, .footer-widgets .widget a:hover {
                color: <?php echo get_theme_mod( 'kgm_ayana_footer_widget_title_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_footer_widget_bg_color' )) : ?>
            footer #supplementary {
                background: <?php echo get_theme_mod( 'kgm_ayana_footer_widget_bg_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_footer_text_color' )) : ?>
            .site-footer {
                color: <?php echo get_theme_mod( 'kgm_ayana_footer_text_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_copyright_bg_color' )) : ?>
            .site-info {
                background: <?php echo get_theme_mod( 'kgm_ayana_copyright_bg_color' ); ?>;
            }
        <?php endif; ?>
        
        <?php if(get_theme_mod( 'kgm_ayana_copyright_text_color' )) : ?>
            .site-info {
                color: <?php echo get_theme_mod( 'kgm_ayana_copyright_text_color' ); ?>;
            }
        <?php endif; ?>
            
        <?php if ( get_theme_mod( 'kgm_ayana_footer_widget' ) ) : ?>
        
            .site-footer {
                padding-top: 0;
            }
        
        <?php endif; ?>
         
    </style>
<?php
}
add_action( 'wp_head', 'kgm_ayana_customizer_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kgm_ayana_customize_preview_js() {
	wp_enqueue_script( 'kgm_ayana_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'kgm_ayana_customize_preview_js' );
