<?php 
declare(strict_types=1);
namespace WSPBPE\publicPage\Controllers;

use WSPBPE\publicPage\Models\Product;
use WC_Product_Variation;

class Variable_Page_Controller{

    public function mpv_update_product_variation_data() {
		add_filter( 'woocommerce_get_price_html',[$this,'adjust_product_price_display'], 10, 2 );
        error_log('mpv_update_product_variation_data');
    
//     if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mpv_variation_nonce' ) ) {
//         wp_send_json_error( 'Invalid request.' );
//         wp_die();
//     }

//     $product_id = absint( $_POST['product_id'] );
//     error_log('PRODUCTID === ' . $product_id);
//     parse_str( $_POST['selected_options'], $selected_options );
//     error_log('OPTIONS === ' . print_r($selected_options , true));


//     $product = wc_get_product( $product_id );
//     error_log('PRODUCTID === ' . print_r($product , true));

//     if ( $product && $product->is_type( 'variable' ) ) {
//         $available_variations = $product->get_available_variations(); 
//         $variation_id = null;
//         foreach ( $available_variations as $variation ) {
//             $match = true;
//             foreach ( $selected_options as $key => $value ) {
//                 if ( strpos( $key, 'attribute_' ) !== false && $variation['attributes'][$key] !== $value ) {
//                     $match = false;
//                     break;
//                 }
//             }
//             if ( $match ) {
//                 $variation_id = $variation['variation_id'];
//                 break;
//             }
//         }

//         if ( $variation_id ) {
//             $variation = new WC_Product_Variation( $variation_id );
//             $price = $variation->get_price_html();
//             $stock_status = $variation->is_in_stock() ? __( 'In stock', 'woocommerce' ) : __( 'Out of stock', 'woocommerce' );

          
// //             wp_send_json_success( array(
// //                 'price' => 100,
// //                 'stock_status' => $stock_status,
// //             ));
// //         } else {
// //             wp_send_json_error( 'No matching variation found.' );
// //         }
// //     } else {
// //         wp_send_json_error( 'Invalid product.' );
// //     }
   
		



}
		public function adjust_product_price_display( $price_html, $product ) {

			if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) {
				// Example: Apply a discount or add a custom price modification
				$new_price =  0.9; // 10% discount
				$price_html = wc_price( $new_price );
    	}

			return $price_html;
		}
}
