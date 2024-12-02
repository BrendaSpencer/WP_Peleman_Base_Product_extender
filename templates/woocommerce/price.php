<?php


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if($variation){
	$product = $variation;
}else{
	global $product;
}



// $cartUnits = (int)$product->get_meta('cart_units');
// $cartPrice = (float)$product->get_meta('cart_price');

// if ($cartUnits > 1 && !empty($cartPrice)) {
// 	return;
// }

?>

<p class="product-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
