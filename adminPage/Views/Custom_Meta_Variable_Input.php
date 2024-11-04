<?php

declare(strict_types=1);

namespace WSPBPE\adminPage\Views;

use WSPBPE\adminPage\Models\Base_Custom_Meta;

class Custom_Meta_Variable_Input { 
    
    public function render_Variable_fields($loop, $variation_data, $variation) {
		?>
        <div  class="<?php echo esc_attr('wsppe-options-group'); ?>">
        <h1 class="<?php echo esc_attr('wsppe-options-group-title'); ?>"><?php echo esc_attr('Product Settings'); ?></h1>
		<div  class="<?php echo esc_attr('wsppe-options-group'); ?>">
        <?php
        $this->currencySuffix =  ' (' . get_woocommerce_currency_symbol() . ')';
		$variationId = $variation->ID;
		$product = wc_get_product($variationId);
		$Base_Meta = new Base_Custom_Meta($product);
		
        woocommerce_wp_text_input(array(
            'id'            => $loop . Base_Custom_Meta::UNIT_PRICE,
            'name'          => $loop . Base_Custom_Meta::UNIT_PRICE,
            'label'         => __('Unit Purchase Price', 'Peleman-Webshop-Package'),
            'value'         =>  (string)$Base_Meta->get_cartPrice() ?: 0,
            'desc_tip'      => true,
            'description'   => __('The price of the unit total that will be added to cart. This is used in conjunction with UNIT AMOUNT.', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-first wsppe-form-row-padding-5',
            'class'         => "wc_input_price",
            'data_type'     => 'price',
            'placeholder'   => wc_format_localized_decimal('0.00'),
        ));

        woocommerce_wp_text_input(array(
            'id'                => $loop . Base_Custom_Meta::UNIT_AMOUNT,
            'name'              => $loop . Base_Custom_Meta::UNIT_AMOUNT,
            'label'             => __('Unit amount', 'Peleman-Webshop-Package'),
            'value'             => (string)$Base_Meta->get_cartUnits() ?: 1,
            'desc_tip'          => true,
            'description'       =>  __('Amount of items per unit. ie. 1 box (unit) contains 20 cards (items).', 'Peleman-Webshop-Package'),
            'wrapper_class'     => 'form-row form-row-last wsppe-form-row-padding-5',
            'type'              => 'number',
            'custom_attributes' => array(
                'step'              => 1,
                'min'               => 1
            ),
            'placeholder'       => 1
        ));

        woocommerce_wp_text_input(array(
            'id'            => $loop . Base_Custom_Meta::UNIT_CODE,
            'name'          => $loop . Base_Custom_Meta::UNIT_CODE,
            'label'         => __('Unit code', 'Peleman-Webshop-Package'),
            'value'         => (string)$Base_Meta->get_unitCode(),
            'desc_tip'      => true,
            'description'   =>  __('The unit code for internal identification , ie. BOX, CRT, ...', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-first wsppe-form-row-padding-5',
            'placeholder'   => 'BOX, CRT, ...'
        ));

        woocommerce_wp_text_input(array(
            'id'            => $loop . Base_Custom_Meta::CUSTOM_LABEL_KEY,
            'name'          => $loop . Base_Custom_Meta::CUSTOM_LABEL_KEY,
            'label'         => __('Custom add to cart label', 'Peleman-Webshop-Package'),
            'value'         => $Base_Meta->get_customAddToCartLabel(),
            'desc_tip'      => true,
            'description'   =>  __('Custom Add To Cart label that will be displayed on the product page', 'Peleman-Webshop-Package'),
            'wrapper_class' => 'form-row form-row-last wsppe-form-row-padding-5',
            'placeholder'   => 'Add to cart'
        ));
		
		woocommerce_wp_text_input(array(
            'id'                => $loop . Base_Custom_Meta::MIN_QUANTITY,
            'name'              => $loop . Base_Custom_Meta::MIN_QUANTITY,
            'label'             => __('Minimum Quantity', 'Peleman-Webshop-Package'),
            'value'             => $Base_Meta->get_minQuantity(),
            'desc_tip'          => true,
            'description'       =>  __('Set the minimum quantity of the order', 'Peleman-Webshop-Package'),
            'wrapper_class'     => 'form-row form-row-first wsppe-form-row-padding-5',
            'type'              => 'number', 
			'custom_attributes' => array(
                'step'              => 1,
                'min'               => 1
            ),
            'placeholder'       => 1
        ));		
		
		woocommerce_wp_text_input(array(
            'id'                => $loop . Base_Custom_Meta::INCREMENT_STEP,
            'name'              => $loop . Base_Custom_Meta::INCREMENT_STEP,
            'label'             => __('increment step', 'Peleman-Webshop-Package'),
            'value'             => $Base_Meta->get_incrementStep(),
            'desc_tip'          => true,
            'description'       =>  __('Set the steps of the increment', 'Peleman-Webshop-Package'),
            'wrapper_class'     => 'form-row form-row-last wsppe-form-row-padding-5',
            'type'              => 'number', 
			'custom_attributes' => array(
                'step'              => 1,
                'min'               => 1
            ),
            'placeholder'       => 1
        ));	
			
					        ?>
			       </div>
        </div>
    <?php
    }
}