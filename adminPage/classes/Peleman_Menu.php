<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\classes;

class Peleman_Menu {
    public const PAGE_SLUG = 'peleman-control-panel';

    public function __construct() {
        // Only hook the menu setup when the admin area is being viewed
        if (is_admin()) {
            add_action('admin_menu', [$this, 'add_control_Peleman_panel']);
        }
    }

    // Method to add the control panel menu
    public function add_control_Peleman_panel(): void {
        // Log to confirm the method is called
        error_log('add_control_Peleman_panel called!');
        
        add_menu_page(
            esc_html__("Peleman Webshop Control Panel"), 
            'Peleman Products Extender', 
            "manage_options",
            self::PAGE_SLUG,
            [$this, 'display_general_message'],
            'dashicons-hammer',
            120
        );
    }

    // Display content for the admin page
    public function display_general_message() {
        echo "<h1>Peleman Products Extender</h1><p>Welcome to the control panel.</p>";
    }
}
