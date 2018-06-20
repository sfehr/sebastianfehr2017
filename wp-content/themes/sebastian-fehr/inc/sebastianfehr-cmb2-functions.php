<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */


add_action( 'cmb2_init', 'sf_cmb2_metabox' );
/**
 * Define the metabox and field configurations.
 */
function sf_cmb2_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'sf_cmb2';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'front_end_post_form',
		'title'         => __( 'Media Field (Image or Video)', 'cmb2' ),
		'object_types'  => array( 'post', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
//        'hookup'        => false,
//        'save_fields'   => false,		
		
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );
	
	
	//Test image field as featured image
	/*
	$cmb->add_field( array(
		'name'    => 'Test File',
		'desc'    => 'Upload an image or enter an URL.',
		'id'      => '_thumbnail',
		'type'    => 'file',
	) );
/*

	/**
	 * Flexible Field
	 */	
	$cmb->add_field( array(
		'name'       => __( 'Media Selection', 'cmb2-flexible' ),
		'desc'       => __( 'field description (optional)', 'cmb2-flexible' ),
		'id'         => 'sf_flexible_content',
		'type'       => 'flexible',
		'layouts' => array(
		
					// Image group		
					'image' => array(
						'title' => 'Image Group',
						'fields' => array(
		
							// Image field
							array(
								'type' => 'file',
								'name' => 'Image',
								'id' => 'sf_image',
							),
		
							// Radio field
							array(
								'name'             => 'Show in Start Page',
								'id'               => 'sf_radio',
								'type'             => 'radio',
								'show_option_none' => false,
								'options'          => array(
									'show' => __( 'Yes', 'cmb2' ),
									'noshow'   => __( 'No', 'cmb2' ),
									),
								'default' => 'show',
							)
						),
					),
		
					// Movie group
					'movie' => array(
					'title' => 'Movie Group',
					'fields' => array(
		
							// Movie field
							array(
								'name' => 'Movie',
								'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
								'id'   => 'sf_embed',
								'type' => 'oembed',
							),

							// Radio field
							array(
								'name'             => 'Show in Start Page',
								'id'               => 'sf_radio',
								'type'             => 'radio',
								'show_option_none' => false,
								'options'          => array(
									'show' => __( 'Yes', 'cmb2' ),
									'noshow'   => __( 'No', 'cmb2' ),
									),
								'default' => 'show',
							)		
					),
				),
			)
	) );
	

	
	
	
	
	
	
//        set_post_thumbnail( $new_submission_id, $img_id );
	
	
	/**
	 * Test Hybrid groupd field
	 */	
/*	$group_field_id = $cmb->add_field( array(
		'id'          => 'sf_repeat_group',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		// 'repeatable'  => false, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'   => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
			'remove_button' => __( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	
	//Radio Field (for selection)
	$cmb->add_group_field( $group_field_id, array(
	'name'             => 'Media Selection',
	'id'               => 'sf_radio',
	'type'             => 'radio',
	'show_option_none' => false,
	'options'          => array(
		'standard' => __( 'Image', 'cmb2' ),
		'custom'   => __( 'Movie', 'cmb2' ),
		),
	//'default' => 'standard',
	) );

	//Image Field
	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Image',
		'id'   => 'sf_image',
		'type' => 'file',
	) );
	
	// oEmbed (Movie) Field
	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Movie',
		'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
		'id'   => 'sf_embed',
		'type' => 'oembed',
	) );	
*/	
}

