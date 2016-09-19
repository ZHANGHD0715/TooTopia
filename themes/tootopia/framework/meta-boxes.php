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
 * @link http://www.deluxeblogtips.com/meta-box/
 */

if(! function_exists('smk_get_all_sidebars') ) {
    function smk_get_all_sidebars(){
        global $wp_registered_sidebars;
        $all_sidebars = array();
        if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {

            foreach ( $wp_registered_sidebars as $sidebar ) {
                $all_sidebars[ $sidebar['id'] ] = $sidebar['name'];
            }

        }
        return $all_sidebars;
    }
}

add_filter( 'rwmb_meta_boxes', 'rt_register_meta_boxes' );


function rt_register_meta_boxes( $meta_boxes ) {
    $prefix = 'rt_';

    //POST, PAGE  META BOXES

    // Basic Information
    $meta_boxes[] = array(
        'id' => 'basic-info',
        'title' => __( 'Basic Information', 'rwmb' ),
        'pages' => array( 'post', 'page' ),
		
		'fields' => array(
            array(
				'name'     => __( 'Show Title & Breadcrumbs?', 'rwmb' ),
				'id'       => "{$prefix}breadcrumbs_option",
				'type'     => 'select',
				'options'  => array(
                    'no' => __( 'Do not Show', 'rwmb' ),
				),
				'multiple'    => false,
                'std'         => false,
				'placeholder' => __( 'Default/Show', 'rwmb' ),
			),
            array(
				'name'     => __( 'Choose Post/Page Layout?', 'rwmb' ),
				'id'       => "{$prefix}layout_option",
				'type'     => 'select',
				'options'  => array(
                    'left-sidebar' => __( 'Left Sidebar', 'rwmb' ),
					'right-sidebar' => __( 'Right Sidebar', 'rwmb' ),
				),
				'multiple'    => false,
                'std'         => false,
				'placeholder' => __( 'Default/Full Width', 'rwmb' ),
			),

            array(
				'name'     => __( 'Choose Sidebar?', 'rwmb' ),
				'id'       => "{$prefix}sidebar_option",
				'type'     => 'select',
				'options'  => smk_get_all_sidebars(),
				'multiple'    => false,
                'std'         => false,
				'placeholder' => __( 'Default/Main Sidebar', 'rwmb' ),
			),
		)
	);

    
    //POST  META BOXES


    // Post Single Audio (Audio post)
	$meta_boxes[] = array(
        'id' => 'format-audio',
        'title' => __( 'Add Single Audio', 'rwmb' ),	

		'fields' => array(           
          
			 // URL
			array(
				'name'  => __( 'MP3 File URL', 'rwmb' ),
				'id'    => "{$prefix}post_audio_url",
				'desc'  => __( 'The URL to the .mp3 audio file.', 'rwmb' ),
				'type'  => 'url',
			),

            // TEXTAREA
			array(
				'name' => __( 'Embeded Code', 'rwmb' ),
				'desc' => __( 'The embed code.', 'rwmb' ),
				'id'   => "{$prefix}post_audio_embeded_code",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
            
		)

	);


    // Post Single Video (video post)
	$meta_boxes[] = array(
        'id' => 'format-video',
        'title' => __( 'Add Single Video', 'rwmb' ),	

		'fields' => array(           
          
			 // URL
			array(
				'name'  => __( 'M4V File URL', 'rwmb' ),
				'id'    => "{$prefix}post_video_url",
				'desc'  => __( 'The URL to the .m4v video file.', 'rwmb' ),
				'type'  => 'url',
			),


            // URL
			array(
				'name'  => __( 'Video Thumbnail Image', 'rwmb' ),
				'id'    => "{$prefix}post_video_poster",
				'desc'  => __( 'The preivew image.', 'rwmb' ),
				'type'  => 'url',
			),

            // TEXTAREA
			array(
				'name' => __( 'Embeded Code', 'rwmb' ),
				'desc' => __( 'If you are not using sel-hosted video then you can paste embeded code here.', 'rwmb' ),
				'id'   => "{$prefix}post_video_embeded_code",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
            
		)

	);

    // Post Photo Gallery (gallery post)
	$meta_boxes[] = array(
        'id' => 'format-gallery',
        'title' => __( 'Post Photo Gallery', 'rwmb' ),
		
		'fields' => array(
			array(
				'name'             => __( 'Upload images', 'rwmb' ),
				'id'               => "{$prefix}post_image_upload",
                'desc'               => "Select the images that should be upload to this gallery.",
				'type'             => 'image_advanced',
				'max_file_uploads' => 10,
			),
		)
	);

    


    //PORTFOLIO META BOXES

    // Portfolio Basic Information
	$meta_boxes[] = array(
		'title' => __( 'Portfolio Basic Information', 'rwmb' ),
        'pages'    => array( 'rt_portfolio' ),

		'fields' => array(
            // TEXT
			array(
				'name'  => __( 'Company Name', 'rwmb' ),
				'id'    => "{$prefix}portfolio_company_name",
				'desc'  => __( 'The name of the company to show on portfolio single item.', 'rwmb' ),
				'type'  => 'text',
			),
			// URL
			array(
				'name'  => __( 'Website', 'rwmb' ),
				'id'    => "{$prefix}portfolio_website_url",
				'desc'  => __( 'Portfolio item preview url.', 'rwmb' ),
				'type'  => 'url',
			),
		),
	);

    // Portfolio Photo Gallery
	$meta_boxes[] = array(
        'title' => __( 'Portfolio Photo Gallery', 'rwmb' ),
        'pages'    => array( 'rt_portfolio' ),
		
		'fields' => array(
			array(
				'name'             => __( 'Upload images', 'rwmb' ),
				'id'               => "{$prefix}portfolio_image_upload",
                'desc'               => "Select the images that should be upload to this gallery.",
				'type'             => 'image_advanced',
				'max_file_uploads' => 10,
			),
		)
	);

    // Portfolio Single Video
	$meta_boxes[] = array(
        'title' => __( 'Portfolio Single Video', 'rwmb' ),
        'pages'    => array( 'rt_portfolio' ),		

		'fields' => array(
            
             // URL
			array(
				'name'  => __( 'M4V File URL', 'rwmb' ),
				'id'    => "{$prefix}portfolio_video_url",
				'desc'  => __( 'The URL to the .m4v video file.', 'rwmb' ),
				'type'  => 'url',
			),


            // URL
			array(
				'name'  => __( 'Video Thumbnail Image', 'rwmb' ),
				'id'    => "{$prefix}portfolio_video_poster",
				'desc'  => __( 'The preivew image.', 'rwmb' ),
				'type'  => 'url',
			),

            // TEXTAREA
			array(
				'name' => __( 'Embeded Code', 'rwmb' ),
				'desc' => __( 'If you are not using sel-hosted video then you can paste embeded code here.', 'rwmb' ),
				'id'   => "{$prefix}portfolio_embeded_code",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
            
		)

	);    

    //TEAM  META BOXES

    // Portfolio Single Video (video post)
	$meta_boxes[] = array(
        'title' => __( 'Member Basic Information', 'rwmb' ),	
        'pages'    => array( 'rt_team' ),

		'fields' => array(   
            
            // TEXT
			array(
				'name'  => __( 'Position', 'rwmb' ),
				'id'    => "{$prefix}member_position",
				'desc'  => __( 'Member position.', 'rwmb' ),
				'type'  => 'text',
			),        
          
			 // URL
			array(
				'name'  => __( 'Facebook url', 'rwmb' ),
				'id'    => "{$prefix}member_facebook_url",
				'desc'  => __( 'Facebook url.', 'rwmb' ),
				'type'  => 'url',
			),


            // URL
			array(
				'name'  => __( 'Google Plus url', 'rwmb' ),
				'id'    => "{$prefix}member_google_plus_url",
				'desc'  => __( 'Google Plus url.', 'rwmb' ),
				'type'  => 'url',
			),

            // URL
			array(
				'name'  => __( 'Twitter url', 'rwmb' ),
				'id'    => "{$prefix}member_twitter_url",
				'desc'  => __( 'Twitter url.', 'rwmb' ),
				'type'  => 'url',
			),

            // URL
			array(
				'name'  => __( 'Linkedin url', 'rwmb' ),
				'id'    => "{$prefix}member_linkedin_url",
				'desc'  => __( 'Linkedin url.', 'rwmb' ),
				'type'  => 'url',
			),

            // URL
			array(
				'name'  => __( 'Pinterest url', 'rwmb' ),
				'id'    => "{$prefix}member_pinterest_url",
				'desc'  => __( 'Pinterest url.', 'rwmb' ),
				'type'  => 'url',
			),
            
		)

	);

    //PRICE META BOXES

    // Portfolio Single Video (video post)
	$meta_boxes[] = array(
        'title' => __( 'Price Basic Information', 'rwmb' ),	
        'pages'    => array( 'rt_price' ),

		'fields' => array(   

            // TEXT
			array(
				'name'  => __( 'Price Currency', 'rwmb' ),
				'id'    => "{$prefix}price_currency",
				'desc'  => __( 'Price Currency.', 'rwmb' ),
				'type'  => 'text',
                'std'   => '$',
			),

			// TEXT
			array(
				'name'  => __( 'Price Value', 'rwmb' ),
				'id'    => "{$prefix}price_value",
				'desc'  => __( 'Price Value.', 'rwmb' ),
				'type'  => 'text',
                'std'   => '0',
			),
            
            // TEXT
			array(
				'name'  => __( 'Price Time', 'rwmb' ),
				'id'    => "{$prefix}price_time",
				'desc'  => __( 'Price time option. Example: Month, Day, Year etc.', 'rwmb' ),
				'type'  => 'text',
                'std'   => 'month',
			),  
            
            // COLOR
			array(
				'name' => __( 'Price Title Background Color', 'rwmb' ),
				'id'   => "{$prefix}price_color",
                'desc'  => __( 'Default: #1abc9c.', 'rwmb' ),
				'type' => 'color',
			),

            // TEXT
			array(
				'name'  => __( 'Button Name', 'rwmb' ),
				'id'    => "{$prefix}price_button_name",
				'desc'  => __( 'Price button name.', 'rwmb' ),
				'type'  => 'text',
                'std'   => 'Purchase Now',
			),        

            // TEXT
			array(
				'name'  => __( 'Button Class', 'rwmb' ),
				'id'    => "{$prefix}price_button_class",
				'desc'  => __( 'Price button class.', 'rwmb' ),
				'type'  => 'text',
                'std'   => 'btn btn-flat flat-color',
			),
          
			 // URL
			array(
				'name'  => __( 'Button URL', 'rwmb' ),
				'id'    => "{$prefix}price_button_url",
				'desc'  => __( 'Price button url.', 'rwmb' ),
				'type'  => 'url',
                'std'   => 'http://www.example.com/',
			),
            
		)

	);

    //TESTIMONIAL META BOXES
	$meta_boxes[] = array(
        'title' => __( 'Testimonial Basic Information', 'rwmb' ),	
        'pages'    => array( 'rt_testimonial' ),

		'fields' => array(   

            // TEXT
			array(
				'name'  => __( 'Company Name', 'rwmb' ),
				'id'    => "{$prefix}testimonial_company_name",
				'desc'  => __( 'Write company name here.', 'rwmb' ),
				'type'  => 'text',
			),
          
			 // URL
			array(
				'name'  => __( 'Link To url', 'rwmb' ),
				'id'    => "{$prefix}testimonial_url",
				'desc'  => __( 'Paste url here.', 'rwmb' ),
				'type'  => 'url',
			),
            
		)

	);

    //TESTIMONIAL META BOXES
	$meta_boxes[] = array(
        'title' => __( 'Partner Basic Information', 'rwmb' ),	
        'pages'    => array( 'rt_partner' ),

		'fields' => array(             
			 // URL
			array(
				'name'  => __( 'Link To url', 'rwmb' ),
				'id'    => "{$prefix}partner_url",
				'desc'  => __( 'Paste url here.', 'rwmb' ),
				'type'  => 'url',
			),
            
		)

	);

    return $meta_boxes;
}