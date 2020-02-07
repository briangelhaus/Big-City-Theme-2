<?php
add_action('woocommerce_before_main_content', 'bigcity_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'bigcity_wrapper_end', 10);

function bigcity_wrapper_start() { echo ''; }
function bigcity_wrapper_end() { echo ''; }

// hide notices like add to cart so we can display them where we want
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 ); /*Archive Product*/
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 120 ); /*Single Product*/

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
            'delimiter'   => ' <span><i class="fas fa-chevron-right"></i></span> ',
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

// add continue shopping button on the add to cart notice
add_filter('wc_add_to_cart_message_html', 'handler_function_name', 10, 2);
function handler_function_name($message, $product_id) {
    return '<a href="/shop/" class="button wc-forward" style="margin-left: 20px;">Continue Shopping</a>'. $message;
}


// make woocommerce load faster
// https://wordpress.org/plugins/wc-speed-drain-repair
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
function child_manage_woocommerce_styles() {
	
    //first check that woo exists to prevent fatal errors
    if ( function_exists( 'is_woocommerce' ) ) {
	    //remove generator meta tag
	    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
  
        //dequeue scripts and styles
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
            wp_dequeue_style( 'woocommerce_frontend_styles' );
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            wp_dequeue_script( 'wc_price_slider' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-add-to-cart' );
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' );
            wp_dequeue_script( 'wc-chosen' );
            wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );
        }
    }
 }
 
 
 // edit woocommerce admin orders - add purchase products column
add_filter('manage_edit-shop_order_columns', 'bigcity_order_items_column' );
function bigcity_order_items_column( $order_columns ) {
    $order_columns['order_products'] = "Purchased products";
    return $order_columns;
}

// edit woocommerce admin orders - show products that the user ordered
add_action( 'manage_shop_order_posts_custom_column' , 'bigcity_order_items_column_cnt' );
function bigcity_order_items_column_cnt( $colname ) {
	global $the_order; // the global order object
 	if( $colname == 'order_products' ) {
		// get items from the order global object
		$order_items = $the_order->get_items();
		if ( !is_wp_error( $order_items ) ) {
			foreach( $order_items as $order_item ) {
 				echo $order_item['quantity'] .' × <a href="' . admin_url('post.php?post=' . $order_item['product_id'] . '&action=edit' ) . '">'. $order_item['name'] .'</a><br />';
				// you can also use $order_item->variation_id parameter
				// by the way, $order_item['name'] will display variation name too
			}
		}
	}
}