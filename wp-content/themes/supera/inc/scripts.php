<?php
		
	function afx_scripts()
	{
		global $domain;
		wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style('styles', get_stylesheet_directory_uri().'/css/styles.css', array(), '1');
		wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/fonts/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'ionicons', get_stylesheet_directory_uri() . '/css/ionicons.min.css' );
		wp_enqueue_script('scripts', get_stylesheet_directory_uri().'/js/scripts.min.js', array('jquery'), '1');
		wp_enqueue_script('owl-carousel', get_stylesheet_directory_uri(). '/js/owl-carousel.js', false, null, false);
		wp_enqueue_script('scripts-custom', get_stylesheet_directory_uri(). '/js/scripts.js', false, null, false);
	}
	add_action('wp_enqueue_scripts', 'afx_scripts');