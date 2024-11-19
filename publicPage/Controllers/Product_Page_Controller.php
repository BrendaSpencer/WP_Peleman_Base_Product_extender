<?php 
declare(strict_types=1);
namespace WSPBPE\publicPage\Controllers;

use WSPBPE\publicPage\Models\Product;

class Product_Page_Controller{
    public function __construct(){
        add_action('woocommerce_product_meta_start' ,[ $this, 'custom_product_page']);
    }
    
    public function custom_product_page(){
        $id = get_the_ID();
		$product = wc_get_product($id);
        
        //$product = new Product();

        include_once WSPBPE_PATH . 'publicPage/Views/meta.php';

    }
}


