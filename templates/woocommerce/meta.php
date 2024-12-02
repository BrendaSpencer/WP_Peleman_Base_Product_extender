<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\Views;

if($variation){
	$product = $variation;
}else{
	global $product;
}


   if (!empty($product)) : ?>
<div class='product-meta'>
	

        <span class="sku_wrapper">
              <span class="label">
                    <?php echo esc_html__('Individual price', 'Peleman_Base_Product_extender') . ': '; ?>
                </span>
                <span class="bundle-price-amount woocommerce-Price-amount amount">
                    <?php echo $product->get_price_html();  ?>
                </span>
                <span class="woocommerce-price-suffix">                 
                </span>
          </span>
			<br>
          <span class="sku_wrapper">
                <span class="label">
                    <?php echo esc_html__( "SKU", 'Peleman_Base_Product_extender') . ': '; ?>
                </span>
                <span class="">
					<?php echo $product->get_sku()  ?>
                </span>
        </span>			
	</div>
    <?php endif; ?>

