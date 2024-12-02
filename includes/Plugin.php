<?php

declare(strict_types=1);

namespace WSPBPE\includes;

use WSPBPE\adminPage\Views\Peleman_Menu;
use WSPBPE\adminPage\Controllers\Base_Meta_Controller;
use WSPBPE\publicPage\Controllers\Product_Page_Controller;
use WSPBPE\publicPage\Controllers\Variable_Page_Controller;
use WSPBPE\publicPage\Views\Overwrite_Templates;
use WSPBPE\includes\Enqueue_Scripts;
use WSPBPE\includes\Enqueue_Styles;

class Plugin {

    public function __construct() {
        add_action('plugins_loaded', [$this, 'initialize_plugin']);
    }

    public function initialize_plugin() {

	    new Enqueue_Styles();
		new Enqueue_Scripts();
		if(!is_admin()){
			       $this->create_extender_public_classes();	
		}
		
        if (is_admin()) {
            $this->create_extender_admin_classes();	
        }
    }

    public function activate() {
    }
	
	public function create_extender_public_classes() {
     		new Overwrite_Templates();
			new Product_Page_Controller();
    }



    public function create_extender_admin_classes() {
    
        new Peleman_Menu();
		new Base_Meta_Controller();
		
    }
}
