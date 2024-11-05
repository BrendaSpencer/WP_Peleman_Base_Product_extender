<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\Controllers;
use WSPBPE\adminPage\Views\Custom_Meta_Simple_Input;
use WSPBPE\adminPage\Views\Custom_Meta_Variable_Input;

class Base_Meta_Controller {

    public function __construct() {
		$Variable_input = new Custom_Meta_Variable_Input();
		$Simple_input = new Custom_Meta_Simple_Input();
		add_action('woocommerce_product_after_variable_attributes', [$Variable_input, 'render_Variable_fields'], 9, 3);
		add_action('woocommerce_save_product_variation',[$Variable_input,'save_variables'], 11,2);
		add_action('woocommerce_process_product_meta',[$Simple_input,'save_variables'], 11,2);
    }
}