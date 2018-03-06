<?php
add_action('woocommerce_before_main_content', 'bigcity_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'bigcity_wrapper_end', 10);

function bigcity_wrapper_start() { echo ''; }
function bigcity_wrapper_end() { echo ''; }

// hide notices like add to cart so we can display them where we want
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 ); /*Archive Product*/
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 ); /*Single Product*/

add_action( 'after_setup_theme', 'bigcity_woocommerce_support' );
function bigcity_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// remove woocomerce breadcrumbs. we want to show them somewhere else
add_action( 'init', 'bigcity_remove_wc_breadcrumbs' );
function bigcity_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// default used for all woo breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'bigcity_woocommerce_breadcrumbs' );
function bigcity_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' <span>&#10095;</span> ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Products', 'breadcrumb', 'woocommerce' ),
        );
}

// change home url for woo breadcrumb
add_filter( 'woocommerce_breadcrumb_home_url', 'bigcity_custom_breadrumb_home_url' );
function bigcity_custom_breadrumb_home_url() {
    return '/shop';
}

// remove crowded columns from product list in admin
function bigcity_remove_columns() {
	add_filter( 'manage_product_posts_columns' , function($columns){
		unset($columns['product_tag']);
		unset($columns['featured']);
		unset($columns['product_type']);
		return $columns;
	} );
}
add_action( 'admin_init' , 'bigcity_remove_columns' );

// remove help videos to save load time
function remove_help($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'remove_help', 999, 3 );

// edit the order complete thank you page text
add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2 );
function woo_change_order_received_text( $thank_yout_text, $order ) {
    $thank_yout_text = 'Thank you. Your order has been received.';
    return $thank_yout_text;
}

// edit the subject line of the new order emails that are sent to the admin
add_filter('woocommerce_email_subject_new_order', 'change_admin_email_subject', 1, 2);
function change_admin_email_subject( $subject, $order ) {
	global $woocommerce;
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	$subject = sprintf('New Customer Order (#%s) from %s %s', $order->id, $order->billing_first_name, $order->billing_last_name);
	return $subject;
}