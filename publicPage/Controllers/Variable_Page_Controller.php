<?php 
declare(strict_types=1);
namespace WSPBPE\publicPage\Controllers;

use WSPBPE\publicPage\Models\Product;
use WC_Product_Variation;
use WC_Data_Store;
use WC;


class Variable_Page_Controller{

    public function mpv_update_product_variation_data() {
		
	

	    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mpv_variation_nonce' ) ) {
    	    wp_send_json_error( 'Invalid request.' );
        	wp_die();
    	}

    	$product_id = absint( $_POST['product_id'] );

		
    	parse_str( $_POST['selected_options'], $selected_options );

    	$product = wc_get_product( $product_id );

    	if ( $product && $product->is_type( 'variable' ) ) {
			
			$data_store = WC_Data_Store::load('product');
        	$variation_id = $data_store->find_matching_product_variation($product, $selected_options);
	
            if ($variation_id) {
				error_log('variation id in Variable Page Controller === '. $variation_id);
				WC()->session->set('current_variation_id', '');
				WC()->session->set('current_variation_id', $variation_id);
                $variation = new \WC_Product_Variation($variation_id);

                ob_start();
                $meta_html = wc_get_template(
                    'meta.php',
                    ['variation' => $variation],
                    '',
                    WSPBPE_PATH . 'templates/woocommerce/'
                );
                $meta_html = ob_get_clean();

                ob_start();
                $price_html = wc_get_template(
                    'price.php',
                    ['variation' => $variation],
                    '',
                    WSPBPE_PATH . 'templates/woocommerce/'
                );
                $price_html = ob_get_clean();

                
                do_action('wspbpe_variation_update', $product, $variation, $meta_html, $price_html,'woocommerce_before_add_to_cart_button' );
								

                wp_send_json_success([
                    'meta_html' => $meta_html,
                    'price_html' => $price_html,
                ]);

            }
        }
    }
}
