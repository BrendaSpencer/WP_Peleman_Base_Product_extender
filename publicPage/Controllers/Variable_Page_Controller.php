<?php 
declare(strict_types=1);
namespace WSPBPE\publicPage\Controllers;

use WSPBPE\publicPage\Models\Product;
use WC_Product_Variation;
use WC_Product_Data_Store_CPT;

class Variable_Page_Controller{

    public function mpv_update_product_variation_data() {
		
		$WC_Product_Data_Store_CPT = new WC_Product_Data_Store_CPT();

	    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mpv_variation_nonce' ) ) {
    	    wp_send_json_error( 'Invalid request.' );
        	wp_die();
    	}

    	$product_id = absint( $_POST['product_id'] );
		$variation_id = absint( $_POST['variation_id'] );
		
    	parse_str( $_POST['selected_options'], $selected_options );

    	$product = wc_get_product( $product_id );

    	if ( $product && $product->is_type( 'variable' ) ) {
        	$available_variations = $product->get_available_variations(); 
       
        	foreach ( $available_variations as $variation ) {
            	$match = true;
            	foreach ( $selected_options as $key => $value ) {
                	if ( strpos( $key, 'attribute_' ) !== false && $variation['attributes'][$key] !== $value ) {
                    	$match = false;
                    	break;
                	}
            	}
            	if ( $match ) {
                	$variation_id = $variation['variation_id'];
                	break;
            	}
        	}

        	if ( $variation_id ) {
				
            	$variation = new WC_Product_Variation( $variation_id );
			ob_start();
            include WSPBPE_PATH . 'templates/woocommerce/meta.php';
	
            $meta_html = ob_get_clean();
				
			ob_start();

			include WSPBPE_PATH . 'templates/woocommerce/price.php';
            $price_html = ob_get_clean();
				        wp_send_json_success([
               				'meta_html' => $meta_html,
							'price_html' => $price_html,
 
           				]);
				
     		}   
		
		}
	}

}
