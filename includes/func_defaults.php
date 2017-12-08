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

// rename admin sidebar items
function wptutsplus_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News'; // change Posts to News
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
	wp_add_dashboard_widget('client_help','Client Help','bigcity_client_help_function');
}
add_action( 'wp_dashboard_setup', 'bigcity_add_dashboard_widgets' );
function bigcity_client_help_function() {
	echo '<p>Welcome to the the backend of your website. To the left, you\'ll see different kinds of content to add like Pages, Posts(News Posts), and Media. If you click on Pages, you\'ll be able to view/edit/delete any page and create new pages for the website. Alternatively, if you visit any page of the website logged in and you\'ll see an "Edit Page" link on the top admin bar.</p>

	<hr>

	<p><strong>Need help? Contact Us.</strong></p>
	<p><a href="http://www.wpbeginner.com/beginners-guide/14-tips-for-mastering-the-wordpress-visual-editor/" target="_blank">How to use the Tiny MCE Editor</a></p>
	<p>
		<a href="https://primaxstudio.com/" target="_blank">Primax Studio</a><br>
		2300 Montana Ave. Suite 102<br>
		Cincinnati, OH 45211<br>
		Phone: 513.443.2797
	</p>

	<hr>

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
	';
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
	echo 'Theme by <a target="_blank" href="https://primaxstudio.com">Primax Studio</a>. Powered by Wordpress.';
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