<?php

declare(strict_types=1);

namespace WSPBPE\adminPage\Models;

class Base_Custom_Meta{ 
	   public const CUSTOM_LABEL_KEY       = 'custom_variation_add_to_cart_label';
	   public const UNIT_AMOUNT            = 'cart_units';
	   public const MIN_QUANTITY			= 'min_quantity';
	   public const INCREMENT_STEP			= 'increment_step';
	   public const UNIT_PRICE             = 'cart_price';
	   public const UNIT_CODE              = 'unit_code';
	
	private string $custom_cart_label;
    private int $cartUnits;
	private int $minQuantity;
	private int $incrementStep;
    private float $cartPrice;
    private string $unitCode;
	private string $customAddToCartLabel;
    

    public function __construct($product){
		        $this->customAddToCartLabel = (string)$product->get_meta('custom_variation_add_to_cart_label') ?: '';
		        $this->cartUnits            = (int)$product->get_meta('cart_units') ?: 1;
        		$this->minQuantity        	= (int)$product->get_meta('min_quantity') ?: 1;
				$this->incrementStep       	= (int)$product->get_meta('increment_step') ?: 1;
		        $this->cartPrice            = (float)$product->get_meta('cart_price') ?: 0.00;
		        $this->unitCode             = (string)$product->get_meta('unit_code') ?: '';  
    }

    public function set_CustomAddToCartLabel($label){
        $this->customAddToCartLabel = $label;
    }

    public function get_customAddToCartLabel(){
        return $this->customAddToCartLabel;
    }

    public function set_unitCode($unit_code){
        $this->unitCode = $unit_code;
    }

    public function get_unitCode(){
        return $this->unitCode;
    }
    public function set_cartPrice($cart_price){
        $this->cartPrice = $cart_price;
    }

    public function get_cartPrice(){
        return $this->cartPrice;
    }

    public function set_incrementStep($increment_Step){
        $this->incrementStep = $increment_Step;
    }

    public function get_incrementStep(){
        return $this->incrementStep;
    }
    public function set_minQuantity($min_Quantity){
        $this->minQuantity = $min_Quantity;
    }

    public function get_minQuantity(){
        return $this->minQuantity;
    }
    public function set_cartUnits($cart_units){
        $this->cartUnits = $cart_units;
    }

    public function get_cartUnits(){
        return $this->cartUnits;
    }

}
