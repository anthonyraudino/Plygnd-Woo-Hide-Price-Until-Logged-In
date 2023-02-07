<?php
/**
* Plugin Name: Hide Woocommerce Price Until Logged In
* Plugin URI: https://github.com/anthonyraudino/WooCommerce-Hide-Price-Until-Logged-In
* Description: Wordpress/Woocommerce plugin to hide the price and add to cart buttons on frontend while not logged in as any user.
* Version: 0.4
* Author: Anthony Raudino
* Author URI: https://github.com/anthonyraudino/
**/
  
add_filter( 'woocommerce_get_price_html', 'anth_hide_price_woo_cart', 9999, 2 );
 
function anth_hide_price_woo_cart ( $price, $product ) {
   if ( ! is_user_logged_in() ) { 
      add_filter( 'woocommerce_is_purchasable', '__return_false');
      $price = '<div><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">' . __( 'Login for Prices', 'anthwoo' ) . '</a></div>';
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
   }
   return $price;
}