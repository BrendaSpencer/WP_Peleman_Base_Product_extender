<?php 

declare(strict_types=1);

namespace WSPBPE\includes;

class Enqueue_Styles {
    public function __construct(){
        add_action( 'wp_admin_stylesheet', '' );

        

    }
}