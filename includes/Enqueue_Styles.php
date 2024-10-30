<?php 

declare(strict_types=1);

namespace WSPBPE\includes;

class Enqueue_Styles {
    public function __construct(){
	
        add_action('wp_enqueue_scripts', [$this,'enqueue_styles'], 60);
    }
	
	 public function enqueue_styles(){
		error_log('Style is loaded!');
        wp_enqueue_style(
            'WSPBPE_admin_stylesheet',
            plugin_dir_url(__FILE__) . 'assets/css/style.css',
            array(),
          '1.0.0'  // Add a version here to avoid errors
        );
    }
	
	
}