<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */


add_filter( 'rwmb_meta_boxes', 'kgm_ayana_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function kgm_ayana_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'kgm_ayana_';

	// metabox for gallery post format
    $meta_boxes[] = array(
        'id'            => 'gallerymetabox',
        'title'         => __('Gallery Format Post Options', 'kgm_ayana'),
        'post_types'    => array('post', 'page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'autosave'      => true,
        'fields'        => array(

            array(
                'name'  => __( 'Gallery Type', 'kgm_ayana' ),
                'id'    => "{$prefix}gallery_type",
                'type'  => 'radio',
                'options' => array(
                    'slider' => __( 'Slider Gallery', 'kgm_ayana' ),
                    'tiled' => __( 'Tiled Gallery', 'kgm_ayana' ),
                ),
                'std'   => 'slider',
                'desc'  => __('Choose the Gallery type to display', 'kgm_ayana')
            ),
            array(
                'name'  => __('Upload or Choose Images', 'kgm_ayana'),
                'id'    => "{$prefix}gallery_images",
                'desc'  => __('Choose or upload images for this gallery', 'kgm_ayana'),
                'type'  => 'file_advanced',
                'mime_type'  => 'image'
            ),
        )
    );
    
    // metabox for audio post format
    $meta_boxes[] = array(
        'id'            => 'audiometabox',
        'title'         => __('Audio Format Post Options', 'kgm_ayana'),
        'post_types'    => array('post', 'page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'autosave'      => true,
        'fields'        => array(

            array(
                'name'  => __( 'Host Type', 'kgm_ayana' ),
                'id'    => "{$prefix}audio_host_type",
                'type'  => 'radio',
                'options' => array(
                    'embeded' => __( 'Embed Code', 'kgm_ayana' ),
                    'selfhosted' => __( 'Self Hosted', 'kgm_ayana' ),
                ),
                'std'   => 'embeded',
            ),
            array(
                'name'  => __('Embed Audio Code', 'kgm_ayana'),
                'id'    => "{$prefix}audio_embed_code",
                'desc'  => __('Paste the embed code here. If you want to use self hosted, you may leave it blank and choose self hosted option above.', 'kgm_ayana'),
                'type'  => 'textarea',
                'class' => 'field-embed'

            ),
            array(
                'name'  => __( 'Upload Audio File', 'kgm_ayana' ),
                'id'    => "{$prefix}shaudio",
                'type'  => 'file_advanced',
                'class' => 'field-sh',
                'desc'  => __( 'Upload or select your self hosted audio. If you want to use embed code. you may leave it blank and choose embed code option above.', 'kgm_ayana' ),
                'mime_type'  => 'audio', // Leave blank for all file types
            ),
            

        )
    );
    
    // metabox for video post format
    $meta_boxes[] = array(
        'id'            => 'videometabox',
        'title'         => __('Video Format Post Options', 'kgm_ayana'),
        'post_types'    => array('post', 'page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'autosave'      => true,
        'fields'        => array(

            array(
                'name'  => __( 'Host Type', 'kgm_ayana' ),
                'id'    => "{$prefix}video_host_type",
                'type'  => 'radio',
                'options' => array(
                    'embeded' => __( 'Embed Code', 'kgm_ayana' ),
                    'selfhosted' => __( 'Self Hosted', 'kgm_ayana' ),
                ),
                'std'   => 'embeded',
            ),
            array(
                'name'  => __('Embed Video Code', 'kgm_ayana'),
                'id'    => "{$prefix}video_embed_code",
                'desc'  => __('Paste the embed code here. If you want to use self hosted, you may leave it blank and choose self hosted option above.', 'kgm_ayana'),
                'type'  => 'textarea',
                'class' => 'field-embed'
            ),
            array(
                'name'  => __( 'Upload Video File', 'kgm_ayana' ),
                'id'    => "{$prefix}shvideo",
                'type'  => 'file_advanced',
                'class' => 'field-sh',
                'desc'  => __( 'Upload or select your self hosted Video. If you want to use embed code. you may leave it blank and choose embed code option above.', 'kgm_ayana' ),
                'max_file_uploads' => 1,
                'mime_type'  => 'video', // Leave blank for all file types
            )
        )
    );

	return $meta_boxes;
}