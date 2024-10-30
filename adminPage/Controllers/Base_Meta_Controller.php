<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\Controllers;

class Base_Meta_Controller{
    public function __construct(){
        add_action('woocommerce_product_after_variable_attributes', [$this,'render_custom_base_fields'], 11, 3);
		add_action('woocommerce_product_options_general_product_data', [$this,'render_custom_base_fields'], 11, 3);
    }

    public function render_custom_base_fields(){
		 ?>
			<h2 class="wsppe-options-group-title">Product Settings</h2>
    <div >
       
<?php
        $product = wc_get_product(get_the_ID());
		error_log('id  === ' . get_the_ID() );
        if (!$product) return;
        woocommerce_wp_text_input(array(
            'id' => 'TESTER',
            'name' => 'TESTER',
            'label' => __('TESTER', 'Peleman-Webshop-Package'),
            'value' => 'Whatever',
            'desc_tip' => true,
            'description' =>  __('Fly2Data article code for this variation/product', 'Peleman-Webshop-Package'),
               'wrapper_class' => 'form-row form-row-last wsppe-form-row-padding-5',
            'placeholder'   => 'Fly2Data article code',
        ));
		?>
			  </div>
			<?php
    }


}
