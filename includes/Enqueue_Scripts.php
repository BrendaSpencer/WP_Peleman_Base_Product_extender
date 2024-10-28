<?php 

declare(strict_types=1);

namespace WSPBPE\includes;

class Enqueue_Scripts {
    public function __construct(){
        add_action( 'wp_ajax_mpv_update_product_variation_data', 'mpv_update_product_variation_data' );
        add_action( 'wp_ajax_nopriv_mpv_update_product_variation_data', 'mpv_update_product_variation_data' );
        add_action( 'wp_enqueue_scripts', 'mpv_enqueue_custom_scripts' );

        

    }

    // Enqueue scripts and styles
function mpv_enqueue_custom_scripts() {



    wp_enqueue_script( 
        'mpv-custom-variation', 
        plugin_dir_url( __FILE__ ) . 'js/custom-product-variation.js', 
        array( 'jquery' ),
         null, 
         true );

    
    wp_localize_script( 'mpv-custom-variation', 'mpv_variation_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'mpv_variation_nonce' ),
    ));
}



    function mpv_update_product_variation_data() {
        // Check nonce for security
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mpv_variation_nonce' ) ) {
            wp_send_json_error( 'Invalid request.' );
            wp_die();
        }
    
        // Get product ID and selected options
        $product_id = absint( $_POST['product_id'] );
        parse_str( $_POST['selected_options'], $selected_options );
    
        // Get the WooCommerce product object
        $product = wc_get_product( $product_id );
    
        if ( $product && $product->is_type( 'variable' ) ) {
            // Find the matching variation
            $available_variations = $product->get_available_variations();
            $variation_id = null;
    
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
                $price = $variation->get_price_html();
                $stock_status = $variation->is_in_stock() ? __( 'In stock', 'woocommerce' ) : __( 'Out of stock', 'woocommerce' );
    
                // Send back updated data
                wp_send_json_success( array(
                    'price' => $price,
                    'stock_status' => $stock_status,
                ));
            } else {
                wp_send_json_error( 'No matching variation found.' );
            }
        } else {
            wp_send_json_error( 'Invalid product.' );
        }
    
        wp_die();
    }
}