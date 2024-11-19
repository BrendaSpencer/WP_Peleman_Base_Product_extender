<?php 

declare(strict_types=1);

namespace WSPBPE\includes;

use WC_Product_Variation;
use WSPBPE\publicPage\Controllers\Variable_Page_Controller;

class Enqueue_Scripts {
    public function __construct(){
		$Variable_ajax = new Variable_Page_Controller();
		
		add_action( 'wp_enqueue_scripts',[$this, 'mpv_enqueue_custom_scripts' ]);
		add_action('admin_enqueue_scripts', [$this,'enqueue_menu_scripts']); 
		add_action( 'wp_ajax_mpv_update_product_variation_data', [$Variable_ajax,'mpv_update_product_variation_data' ]);
        add_action( 'wp_ajax_nopriv_mpv_update_product_variation_data', [$Variable_ajax,'mpv_update_product_variation_data' ]);

    }
	
	public function enqueue_menu_scripts(){
		$url = WSPBPE_DIRECTORY . 'assets/js/wsppe_product_menu.js';
		$randomVersionNumber = wp_rand(0, 1000);
        wp_enqueue_script(
            'wsppe_product_menu',
            $url,
            array(),
            $randomVersionNumber,
			true 
        );

		
	}

  
	public function mpv_enqueue_custom_scripts() {
		error_log('mpv_enqueue_custom_scripts');

		wp_enqueue_script( 
			'mpv-custom-variation', 
			WSPBPE_DIRECTORY  . 'assets/js/custom-product-variation.js', 
			array( 'jquery' ),
			null, 
			true 
		);
    
		wp_localize_script( 'mpv-custom-variation', 'mpv_variation_params', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'mpv_variation_nonce' ),
		));
	}
}


