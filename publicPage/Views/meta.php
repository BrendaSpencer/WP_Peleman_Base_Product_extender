<?php 
declare(strict_types=1);
namespace WSPBPE\adminPage\Views;

		error_log(' === inside the view === ');
		error_log('PRODUCT ===   ' . $product);

   if (!empty($product)) : ?>
        <span class="sku_wrapper">
            <span class="">
                <span class="label">
                    <?php echo esc_html__('Individual price', 'Peleman-Webshop-Package') . ': '; ?>
                </span>
                <span class="">
                    <?php echo 'hello' ?>
                </span>
                <span class="woocommerce-price-suffix">
                    
                </span>
            </span>
            <span class="add-to-cart-price">
                <span class="label">
                    <?php echo esc_html__('fffff', 'Peleman-Webshop-Package') . ': '; ?>
                </span>
                <span class="bundle-price-amount woocommerce-Price-amount amount">
					<?php  ?>
                </span>
                <span class="woocommerce-price-suffix">
					
                    <?php  ?> 
                    <span class=""><?php ?></span>
                </span>
            </span>
        </span>
    <?php endif; ?>

