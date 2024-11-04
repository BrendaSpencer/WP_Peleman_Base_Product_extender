<?php

declare(strict_types=1);

namespace WSPBPE\adminPage\Views;

use WSPBPE\adminPage\Models\Base_Custom_Meta;

class Custom_Meta_Simple_Input{ 
    
    public function __construct(){
        add_action('woocommerce_product_options_general_product_data', [$this,'render_Simple_fields'], 11, 3);   
     }
	
	public function render_Simple_fields(){
		$id = get_the_ID();
		$product = wc_get_product($id);
		if(!$product->is_type('simple')){
			return;
		}
		 $this->currencySuffix =  ' (' . get_woocommerce_currency_symbol() . ')';
		$Base_Meta = new Base_Custom_Meta($product);
		?>
        <div  class="<?php echo esc_attr('wsppe-options-group  wsppe-options-margins'); ?>">
        <h1 class="<?php echo esc_attr('wsppe-options-group-title'); ?>"><?php echo esc_attr('Product Settings'); ?></h1>
		<div  >
<?php
	        
        woocommerce_wp_text_input(array(
            'id' => Base_Custom_Meta::UNIT_PRICE,
            'name' => Base_Custom_Meta::UNIT_PRICE,
            'label' => __('Unit Purchase Price', 'Peleman-Webshop-Package') . $this->currencySuffix,
            'value' =>  $Base_Meta->get_cartPrice(),
            'desc_tip' => true,
            'description' => __('The price of the unit total that will be added to cart. This is used in conjunction with UNIT AMOUNT.', 'Peleman-Webshop-Package'),
            'class' => "wc_input_price",
            'wrapper_class' => 'form-row form-row-first wsppe-form-row-padding-5',
            'data_type' => 'price',
            'type' => 'number',
            'placeholder' => wc_format_localized_decimal('0.00'),
        ));

        woocommerce_wp_text_input(array(
            'id' => Base_Custom_Meta::UNIT_AMOUNT,
            'name' =>  Base_Custom_Meta::UNIT_AMOUNT,
            'label' => __('Unit amount', 'Peleman-Webshop-Package'),
            'value' => $Base_Meta->get_cartUnits(),
            'desc_tip' => true,
            'description' =>  __('Amount of items per unit. ie. 1 box (unit) contains 20 cards (items).', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-last wsppe-form-row-padding-5',
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 1,
                'min' => 1
            ),
            'placeholder' => 1
        ));

        woocommerce_wp_text_input(array(
            'id' =>  Base_Custom_Meta::UNIT_CODE,
            'name' =>  Base_Custom_Meta::UNIT_CODE,
            'label' => __('Unit code', 'Peleman-Webshop-Package'),
            'value' => $Base_Meta->get_unitCode(),
            'desc_tip' => true,
            'description' =>  __('The unit code for internal identification , ie. BOX, CRT, ...', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-first wsppe-form-row-padding-5',
            'placeholder' => 'BOX, CRT, ...'
        ));


        woocommerce_wp_text_input(array(
            'id' =>  Base_Custom_Meta::CUSTOM_LABEL_KEY,
            'name' =>  Base_Custom_Meta::CUSTOM_LABEL_KEY,
            'label' => __('Custom add to cart label', 'Peleman-Webshop-Package'),
            'value' => $Base_Meta->get_customAddToCartLabel() ,
            'desc_tip' => true,
            'description' =>  __('Custom Add To Cart label that will be displayed on the product page', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-last wsppe-form-row-padding-5',
            'placeholder' => 'Add to cart'
        ));
		        ?>
			       </div>
        </div>
    <?php

	}
 } 