<?php

declare(strict_types=1);

namespace WSPBPE\adminPage\Models;



class Base_Custom_Meta {    
    private int $cartUnits;
	private int $minQuantity;
	private int $incrementStep;
    private float $cartPrice;
    private string $unitCode;
    private string $f2dArticleCode;

    public function __construct(){
        
    }
    public function set_f2dArticleCode($article_Code){
        $this->f2dArticleCode = $article_Code;
    }

    public function get_f2dArticleCode(){
        return $this->f2dArticleCode;
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

    #[\ReturnTypeWillChange]
    public function jsonSerialize(){
        return[
            'cart_units' => $this->get_cartUnits(),
            'min_quantity' => $this->get_minQuantity(),
            'increment_step' => $this->get_incrementStep(),
            'cart_price' => $this->get_cartPrice(),
            'unit_code' => $this->get_unitCode(),
            'f2d_artcd' => $this->get_f2dArticleCode(),
        ];
    }

}
