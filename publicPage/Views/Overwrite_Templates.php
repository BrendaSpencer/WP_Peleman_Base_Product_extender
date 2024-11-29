<?php

declare(strict_types=1);

namespace WSPBPE\publicPage\Views;

class Overwrite_Templates{
    public function __construct(){
        add_action('woocommerce_locate_template', [$this,'overwrite_wc_template'], 12, 3);

    }

    public function overwrite_wc_template(string $template, string $templateName, string $templatePath){
        switch (basename($template, '.php')) {
            case 'meta':
                return WSPBPE_PATH . 'templates/woocommerce/meta.php';
            case 'price':
                return WSPBPE_PATH . 'templates/woocommerce/price.php';
			default:
                return $template;
            }
    }
}