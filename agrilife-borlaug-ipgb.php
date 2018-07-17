<?php
/*
 * Plugin Name: AgriLife Borlaug IPGB
 * Plugin URI: http://github.com/AgriLife/agrilife-borlaug-ipgb
 * Description: Customizations for the Borlaug IPGB site
 * Version: 1.0.0
 * Author: Zachary Watkins
 * Author URI: https://github.com/ZachWatkins
 * Author Email: zachary.watkins@ag.tamu.edu
 * License: GPL2+
 */

define( 'BIPGB_DIRNAME', 'agrilife-borlaug-ipgb' );
define( 'BIPGB_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BIPGB_DIR_URL', plugin_dir_url( __FILE__ ) );

add_filter( 'ag-people-list-photo', function($img, $data, $img_url){

	$img = str_replace($img_url, $data['sizes']['medium'], $img);
	$img = preg_replace('/width="\d+"/', '', $img);
	$img = preg_replace('/height="\d+"/', '', $img);

	return $img;

}, 11, 3);

add_filter( 'ag-people-list-item', function($listing, $data){

	$data['contact-details'] = "<div class=\"people-contact-details\">{$data['contact-email']}
{$data['contact-phone']}</div>";

	$listing = "<div class=\"people-photo-name\">{$data['photo-wrap']}{$data['name-title']}</div>
		{$data['contact-details']}";

	return $listing;

}, 11, 2);

add_action( 'wp_enqueue_scripts', 'borlaug_ipgb_register_styles' );
add_action( 'wp_enqueue_scripts', 'borlaug_ipgb_enqueue_styles' );

function borlaug_ipgb_register_styles() {

	wp_register_style(
		'borlaug_ipgb_stylesheet',
		BIPGB_DIR_URL . 'css/borlaug-ipgb.css',
		array(),
		filemtime(BIPGB_DIR_PATH . 'css/borlaug-ipgb.css')
	);

}

function borlaug_ipgb_enqueue_styles() {

	wp_enqueue_style( 'borlaug_ipgb_stylesheet' );

}
