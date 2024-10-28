<?php

declare(strict_types=1);

namespace WSPBPE\includes;

use WSPBPE\adminPage\classes\Peleman_Menu;
use WSPBPE\includes\Enqueue_Scripts;
use WSPBPE\includes\Enqueue_Styles;

class Plugin {

    public function __construct() {
        // Hook to initialize plugin when WordPress is ready
        add_action('plugins_loaded', [$this, 'initialize_plugin']);
    }

    public function initialize_plugin() {
        if (is_admin()) {
            $this->create_extender_admin_classes();
        }
    }

    public function activate() {
        // Called once when the plugin is activated
        $this->enqueue_extender_scripts();
        $this->enqueue_extender_styles();
    }

    private function enqueue_extender_scripts() {
        new Enqueue_Scripts();
    }

    private function enqueue_extender_styles() {
        new Enqueue_Styles();
    }

    public function create_extender_admin_classes() {
        // Instantiate the Peleman_Menu class
        new Peleman_Menu();
    }
}
