<?php 
declare(strict_types=1);
namespace WSPBPE\publicPage\Controllers;

use WSPBPE\publicPage\Models\Product;
use WC_Product_Variation;
use WC_Data_Store;
use WC;


class Product_Page_Controller{
    public function __construct(){
        add_action('woocommerce_before_single_product' ,[ $this, 'custom_product_page']);
    }
    
    public function custom_product_page(){
      	$product = wc_get_product();
		if ( $product && $product->is_type( 'simple' ) ) {
			return;
		}
		
		
     	if ( $product && $product->is_type( 'variable' ) ) {
		
			 	WC()->session->set('current_variation_id', '');
     			$product = wc_get_product( $product->get_id() );
	
         	$default_attributes = $product->get_default_attributes();  
			$formatted_attributes = $this->reset_attributes($default_attributes);
			$data_store = WC_Data_Store::load('product');
        	$variation_id = $data_store->find_matching_product_variation($product, $formatted_attributes);
			if ($variation_id) {
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


                do_action('wspbpe_product_page_variation', $product, $variation, $meta_html, $price_html,'woocommerce_before_add_to_cart_button' );
				

            }
			
        }
    }

    public function reset_attributes($attr) {
        $formatted_attributes = [];
        foreach ($attr as $key => $value) {
            $formatted_attributes['attribute_' . $key] = $value;
        }
        return $formatted_attributes;
    }
}



