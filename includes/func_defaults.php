<?php

/* for the client
-------------------------------------------------------------------*/
// remove unwanted pages from admin menu
function bigcity_remove_admin_pages(){
	// remove shit for all users
	remove_menu_page('edit-comments.php');
	//remove_menu_page('edit.php');
	//remove_menu_page('upload.php');
	if (get_current_user_id() != 1) {
		// remove shit for clients
		remove_menu_page('options-general.php');
		remove_menu_page('plugins.php');
		//remove_menu_page('themes.php');
		remove_menu_page('tools.php');
	}
}
add_action('admin_menu', 'bigcity_remove_admin_pages');

// add support for SVG and other type of uploads
/*
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ($existing_mimes) {
	$existing_mimes['svg'] = 'image/svg+xml';
	$existing_mimes['eps'] = 'application/postscript';
	return $existing_mimes;
}
*/

// remove wordpress default image sizes to save disk space
function bigcity_remove_default_image_sizes( $sizes) {
	// we're using so keep
    //unset( $sizes['medium_large']); 768px  wordpress core creates this
    //unset( $sizes['large']); 1024px        wordpress settings /wp-admin/options-media.php

    // not using so we remove
    unset( $sizes['thumbnail']); // 150px  wordpress settings /wp-admin/options-media.php
    unset( $sizes['2048x2048']); // wordpress default size
    unset( $sizes['1536x1536']); // wordpress default size
    unset( $sizes['medium']); // this ones pointless since theres a 768px  wordpress settings /wp-admin/options-media.php
    unset( $sizes['woocommerce_single']); // woocommerce size
    unset( $sizes['shop_single']); // woocommerce size
    unset( $sizes['woocommerce_thumbnail']); // woocommerce size
    unset( $sizes['shop_thumbnail']); // woocommerce size
    unset( $sizes['woocommerce_gallery_thumbnail']); // woocommerce size
    unset( $sizes['shop_catalog']); // woocommerce size
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'bigcity_remove_default_image_sizes');

add_filter('big_image_size_threshold', '__return_false'); // this removes image-scaled.jpg images

// rename admin sidebar items
function wptutsplus_change_post_menu_label() {
    global $menu;
    global $submenu;
    //$menu[5][0] = 'News'; // change Posts to News
    $submenu['plugins.php'][10][2] = 'plugin-install.php?tab=favorites'; // default to favorites
}
add_action( 'admin_menu', 'wptutsplus_change_post_menu_label' );

// remove cats and tags for posts if needed
/*
function my_remove_sub_menus() {
    //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // linked with "hide post tags" above
}
add_action('admin_menu', 'my_remove_sub_menus');
*/


// add client help widget to admin dashboard
// http://codex.wordpress.org/Dashboard_Widgets_API
function bigcity_add_dashboard_widgets() {
	if(current_user_can('administrator')){
		wp_add_dashboard_widget('client_help','Client Help','bigcity_client_help_function');
	}
}
add_action( 'wp_dashboard_setup', 'bigcity_add_dashboard_widgets' );
function bigcity_client_help_function() {
?>
	<p>Welcome to the the backend of your website. To the left, you'll see different kinds of content to add like Pages, Posts(News Posts), and Media. If you click on Pages, you'll be able to view/edit/delete any page and create new pages for the website. Alternatively, if you visit any page of the website logged in and you'll see an "Edit Page" link on the top admin bar.</p>

	<hr>
	
	<h2>How to add a Blog Post</h2>
	<ol>
		<li>Click on "Posts" > "Add New" on the left sidebar.</li>
		<li>Give it a title and some body copy.</li>
		<li>Upload a featured image</li>
		<li>Click Publish.</li>
	</ol>

	<h2>How to add a new Page</h2>
	<ol>
		<li>Click on "Pages" > "Add New" on the left sidebar.</li>
		<li>Give it a title and some body copy.</li>
		<!-- <li>If this is a child page, select a parent page on the right sidebar.</li> -->
		<li>Click Publish.</li>
	</ol>
	<h2>How to add a page to the website\'s navigation</h2>
	<ol>
		<li>Click on "Appearance" > "Menus" on the left sidebar.</li>
		<li>Select the correct menu to edit from the dropdown. The Primary menu is the sites top navigation.</li>
		<li>Check a page and click the "Add to Menu" button.</li>
		<li>Click and drag on a menu item to re-order them.</li>
		<li>Click Save Menu.</li>
	</ol>
<?php
}




/* Defaults
-------------------------------------------------------------------*/
// show the title tag
add_theme_support( 'title-tag' );

// remove the default <p> wrapping <img>s in wysiwyg editor
function filter_ptags_on_images($content){
    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// remove the WordPress version from some .css/.js files
add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );
function sdt_remove_ver_css_js( $src, $handle ){
    $handles_with_version = [ 'style' ]; // <-- Adjust to your needs!
    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) ){
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}

// remove default widgets in admin dashboard
function bigcity_remove_dashboard_meta() {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); // news
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // quick draft
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); // recent activity
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // at a glance
}
add_action( 'admin_init', 'bigcity_remove_dashboard_meta' );

// core and plugin update options
// //codex.wordpress.org/Configuring_Automatic_Background_Updates
//add_filter( 'allow_minor_auto_core_updates', '__return_true' ); // enable minor core updates
add_filter( 'allow_major_auto_core_updates', '__return_true' ); // enable major core updates
add_filter( 'auto_update_plugin', '__return_true' ); // enable updates for plugins
add_filter( 'auto_update_theme', '__return_true' ); // enable updates for themes

// add the class img-responsive to all images when added to the wysiwyg editor
function add_image_class($class){
    $class .= ' img-fluid';
    return $class;
}
add_filter('get_image_tag_class','add_image_class');


// use bootstrap responsive dropdown menu
// https://github.com/wp-bootstrap/wp-bootstrap-navwalker
require_once 'wp-bootstrap-navwalker.php';

register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'bigcity' ),
) );

// remove emojis scripts. wtf wordpress
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// remove unneeded <head> files
// http://clicknathan.com/web-design/minimizing-http-requests-with-wordpress-themes/
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');


// use googles CDN for jquery
function bigcity_modify_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null); // bootstrap doesnt support v3 yet
		wp_enqueue_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'bigcity_modify_jquery');


//add_filter( 'send_password_change_email', '__return_false' ); // disable email for user password changes
//add_filter( 'send_email_change_email', '__return_false' ); // disable email for user email changes


// remove unwanted links in admin toolbar
function bigcity_remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    //$wp_admin_bar->remove_menu('site-name');
    //$wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('comments');
    //$wp_admin_bar->remove_menu('new-content');
    //$wp_admin_bar->remove_menu('wpseo-menu');
}
add_action( 'wp_before_admin_bar_render', 'bigcity_remove_admin_bar_links' );


// edit admin footer text
function bigcity_admin_footer_text() {
	echo 'Powered by Wordpress.';
}
add_filter('admin_footer_text', 'bigcity_admin_footer_text');


// add seo yoast to the end of the admin page, below ACF
add_filter( 'wpseo_metabox_prio', function() { return 'low';});


// set the posts per page option in edit.php to 100
function bigcity_items_per_page(){
	update_user_option( get_current_user_id(), 'edit_post_per_page', 100 );
	update_user_option( get_current_user_id(), 'edit_page_per_page', 100 );
}
add_action('admin_head', 'bigcity_items_per_page');


// change heartbeats refresh rate because its a memory hog
// http://code.tutsplus.com/tutorials/the-heartbeat-api-changing-the-pulse--wp-32462
function wptuts_heartbeat_settings( $settings ) {
    $settings['interval'] = 60; // anything between 15-60
    return $settings;
}
add_filter('heartbeat_settings', 'wptuts_heartbeat_settings');

// disable heartbeat completely if only 1 user will be logged in at a time
/*
function stop_heartbeat() {
	wp_deregister_script('heartbeat');
}
add_action( 'init', 'stop_heartbeat', 1 );
*/

// tell tiny mce to stop removing empty span and div tags
function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
} 
add_filter('tiny_mce_before_init', 'override_mce_options');


// remove classes tinyMCE throws on common tags
// replaces <p class="p1"></p> with kist <p></p>
add_filter('tiny_mce_before_init', 'customize_tinymce');
function customize_tinymce($in) {
	$in['paste_preprocess'] = "function(pl,o){ 
		o.content = o.content.replace(/p class=\"p[0-9]+\"/gi,'p'); 
		o.content = o.content.replace(/span class=\"s[0-9]+\"/gi,'span'); 
		o.content = o.content.replace(/ul class=\"ul[0-9]+\"/gi,'ul'); 
		o.content = o.content.replace(/li class=\"li[0-9]+\"/gi,'li'); 
	}";
	return $in;
}

/*
// change gutenburg auto save time to something less annoying
add_filter( 'block_editor_settings', 'jp_block_editor_settings', 10, 2 );
function jp_block_editor_settings( $editor_settings, $post ) {
	$editor_settings['autosaveInterval'] = 200; //number of second [default value is 10]
	return $editor_settings;
}
*/


// disable auto-update email notifications for plugins. Started in Wordpress 5.5
add_filter( 'auto_plugin_update_send_email', '__return_false' );
 
// disable auto-update email notifications for themes. Started in Wordpress 5.5
add_filter( 'auto_theme_update_send_email', '__return_false' );

// disable XML-RPC which started to be enabled by default in WordPress 3.5
// if you want to access and publish to your blog remotely, then you need XML-RPC enabled
add_filter('xmlrpc_enabled', '__return_false');