<?php 

declare(strict_types=1);

namespace WSPBPE\includes;

class Enqueue_Styles {
    public function __construct(){
	
        add_action('admin_enqueue_scripts', [$this,'enqueue_styles']);
    }
	
	 public function enqueue_styles(){
		 $url = WSPBPE_DIRECTORY . 'assets/css/style.css';
		 
        wp_enqueue_style(
            'admin_stylesheet',
            $url,
            array(),
          '2.0.0',
            'all'
        );
    }
	
	
}