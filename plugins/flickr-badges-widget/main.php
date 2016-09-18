<?php
/*
    Main Plugin Class 0.0.1
    
	Copyright 2016 zourbuth.com (email: zourbuth@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if ( ! defined( 'ABSPATH' ) ) // exit if is accessed directly
	exit;


/**
 * Class constructor
 * 
 * @since 0.0.1
 */	
class Flickr_Badges_Widget_Main {
	
	 var $textdomain;
	 
	/**
	 * Class constructor
	 * 
	 * @since 0.0.1
	 */		
	function __construct() {	
		add_shortcode( 'flickr-badge-widget',  array( &$this, 'widget_shortcode' ) );		
	}

	
	/**
	 * Add widget shortcode based on widget id
	 * 
	 * @param $atts (array)
	 * @since 0.0.1
	 */	
	function widget_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id' => false,
		), $atts, 'urlink' );
		
		$html = '';		

		$options = get_option( 'widget_zflickr' );
		$widget_id = $atts['id'];
		$instance = $options[$widget_id];		
		
		$args = wp_parse_args( (array) $instance, fbw_default_args() );
							
		return fbw_output( $args );
	}


} new Flickr_Badges_Widget_Main();


/**
 * Default arguments
 * 
 * @since 0.0.1
 */	
function fbw_default_args() {
	return array(
		'title'			=> esc_attr__( 'Flickr Widget', 'flickr-badges-widget' ),
		'type'			=> 'user',
		'flickr_id'		=> '', // 71865026@N00
		'count'			=> 9,
		'display'		=> 'display',
		'size'			=> 's',
		'copyright'		=> true,
		'tab'			=> array( 0 => true, 1 => false, 2 => false, 3 => false ),
		'intro_text'	=> '',
		'outro_text'	=> '',
		'custom'		=> ''
	);
}


/**
 * Default arguments
 * 
 * @since 0.0.1
 */	
function fbw_output( $args ) {
	
	$output = '';
	
	// Get the user direction, rtl or ltr
	if ( function_exists( 'is_rtl' ) )
		$dir = is_rtl() ? 'rtl' : 'ltr';

	// Wrap the widget
	if ( ! empty( $args['intro_text'] ) )
		$output .= '<p>' . do_shortcode( $args['intro_text'] ) . '</p>';

	$output .= "<div class='flickr-badge-wrapper zframe-flickr-wrap-$dir'>";

	$protocol = is_ssl() ? 'https' : 'http';
	
	// If the widget have an ID, we can continue
	if ( ! empty( $args['flickr_id'] ) )
		$output .= "<script type='text/javascript' src='$protocol://www.flickr.com/badge_code_v2.gne?count={$args['count']}&amp;display={$args['display']}&amp;size={$args['size']}&amp;layout=x&amp;source={$args['type']}&amp;{$args['type']}={$args['flickr_id']}'></script>";
	else
		$output .= '<p>' . __('Please provide an Flickr ID', 'flickr-badges-widget') . '</p>';
	
	$output .= '</div>';
	
	if ( ! empty( $args['outro_text'] ) )
		$output .= '<p>' . do_shortcode( $args['outro_text'] ) . '</p>';
	
	if ( $args['copyright'] )
		$output .= '<a href="http://wordpress.org/extend/plugins/flickr-badges-widget/">
			<span style="font-size: 11px;"><span style="color: #0063DC; font-weight: bold;">Flick</span><span style="color: #FF0084; font-weight: bold;">r</span> Badges Widget</span>
			</a>';
	
	return $output;
}