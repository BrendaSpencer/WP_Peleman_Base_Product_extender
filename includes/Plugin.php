<?php

declare(strict_types=1);

namespace WSPBPE\includes;

use WSPBPE\adminPage\Views\Peleman_Menu;
use WSPBPE\adminPage\Controllers\Base_Meta_Controller;
use WSPBPE\includes\Enqueue_Scripts;
use WSPBPE\includes\Enqueue_Styles;

class Plugin {

    public function __construct() {
		
        add_action('plugins_loaded', [$this, 'initialize_plugin']);
	
    }

    public function initialize_plugin() {
	$this->enqueue_extender_styles();
		 
        if (is_admin()) {
            $this->create_extender_admin_classes();
			
        }
    }

    public function activate() {

        
    }

    private function enqueue_extender_scripts() {
        new Enqueue_Scripts();
    }

    private function enqueue_extender_styles() {
        new Enqueue_Styles();
    }

    public function create_extender_admin_classes() {
      
        new Peleman_Menu();
		new Base_Meta_Controller();
    }
}
