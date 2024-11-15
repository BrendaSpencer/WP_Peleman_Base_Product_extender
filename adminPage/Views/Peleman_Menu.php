<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\Views;

class Peleman_Menu {
    public const PAGE_SLUG = 'peleman-control-panel';

    public function __construct() {
        
        if (is_admin()) {
            add_action('admin_menu', [$this, 'add_control_Peleman_panel']);
        }
    }

  
    public function add_control_Peleman_panel(): void {

        add_menu_page(
            esc_html__("Peleman Webshop Control Panel"), 
            'Peleman Products Extender', 
            "manage_options",
            self::PAGE_SLUG,
            array($this, 'render_tab_buttons'),
            'dashicons-hammer',
            120
        );
    }
	


    public function render_tab_buttons()
    {
        
        $nonce = wp_create_nonce('tab_nonce');
		
		if (isset($_POST['tab_nonce']) && wp_verify_nonce($_POST['tab_nonce'], 'tab_nonce')) {
			if (isset($_POST['api_key'])) {
        	    $api_key = sanitize_text_field($_POST['api_key']); 
                
        		update_option('wsppe_api_key', $api_key); 
            }
		}

        $get = isset($_GET) ? wp_unslash($_GET) : array(); 
        $activeTab = isset($get['tab']) ? sanitize_text_field($get['tab']) : '';
        
        $tabGroups = apply_filters('WSPBPE_get_admin_menu_tabs', []);
    ?>
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>
            <h2>Webshop Settings</h2>
            <?php settings_errors();
            ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo esc_attr($this::PAGE_SLUG); ?>" class="nav-tab <?php echo esc_html($activeTab == '' ? 'nav_tab_active' : ''); ?>">General</a>
                <?php
                foreach ($tabGroups as $key => $group) :
                ?>
                <a href="<?php echo esc_url($this->assemble_tab_url($key)); ?>" class=" nav-tab <?php echo esc_html($activeTab == $key ? 'nav_tab_active' : ''); ?>"><?php 					echo esc_html($key); ?></a>
                <?php endforeach; ?>
            </h2>
            <form method="post" action='<?php echo esc_url(add_query_arg('tab', $activeTab, admin_url('options.php'))); ?>'>
                <?php
                if (isset($tabGroups[$activeTab]) ) {
                    $tabGroups[$activeTab]->render_menu($this::PAGE_SLUG);
                } else {
                    $this->display_general_message();
                }
                ?>
            </form>
        </div>
    <?php
    }
    private function assemble_tab_url(string $key): string
    {
        return esc_url(sprintf('?page=%s&tab=%s', $this::PAGE_SLUG, $key));
    }


    private function display_general_message()
    {
    ?>
        <div class="WSPBPE-settings">
            <h1>Peleman Base Products Extender</h1>
            <h3>Current Version: </h3>
            <hr>
            <p>The Peleman Base Products Extender is the base needed when we want to use the Peleman Image Editor or the f2d custom pricing </p>
            <p>The WSPBPE plugin requires the following plugins for its functionality:</p>
            <ul>
                <li>Woocommerce 7.2.0+</li>
            </ul>
            <hr>
            <p>For proper communication with the <b>PIE</b>, the Peleman editor communicator is required </p>
			<hr>
            <p>For proper communication with the <b>F2D</b>, the Peleman F2D communicator  is required </p>
			<hr>
            <p>For pdf uploads, the Peleman pdf uploader is required </p>
        </div>
    <?php
    }
}
