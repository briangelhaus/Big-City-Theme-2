<?php

// add css and scripts
function bigcity_add_css_scripts() {
	// css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'base', get_template_directory_uri().'/css/base.css');
	wp_enqueue_style( 'wp', get_template_directory_uri().'/css/wp.css');
	wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css');

	// scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.bundle.min.js', array(), '', true );
	wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'bigcity_add_css_scripts' );


/* woocommerce
-------------------------------------------------------------------*/
include('includes/func_woocommerce.php');


/* stuff for the client and defaults for wordpress
-------------------------------------------------------------------*/
include('includes/func_defaults.php');


/* custom post types
-------------------------------------------------------------------*/
include('includes/func_post_types.php');


/* custom functions
-------------------------------------------------------------------*/
//add_theme_support( 'post-thumbnails' );

// add custom logo to login page
function bigcity_login_logo_css() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            height: 170px;
            width: inherit;
            background-size: contain;
        }
        <?php // style login page ?>
/*
        body.login { background: #333; }
        .login #backtoblog a,
        .login #nav a { color: #fff !important; }
*/
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'bigcity_login_logo_css' );


// add custom css or js to admin
function bigcity_custom_admin_css() { ?>
    <style type="text/css">
	    /* limit annoying category spacing description field */
        .edit-tags-php .description.column-description { white-space: nowrap; overflow: auto; }

        /* client help dashboard widget */
        #client_help .inside h2 { font-size: 16px; line-height: inherit; padding: 0 0 10px 0; font-weight: bold; }
        #client_help .inside ul { list-style-type: disc; padding-left: 25px; }
        #client_help .inside ul,
        #client_help .inside ol { margin-bottom: 25px; margin-top: 0; }
        #client_help .inside p,
        #client_help .inside li { font-size: 14px; }
        #client_help .inside a { text-decoration: underline; }

        /* make nav menus box bigger */
        .posttypediv div.tabs-panel { max-height: 800px !important; }

        /* hide post categories */
/*
        #categorydiv,
        .column-categories { display: none; }
*/
        /* hide post tags - linked with "my_remove_sub_menus" below */
/*
        #tagsdiv-post_tag,
        .column-tags { display: none; }
*/
    </style>
<?php }
add_action( 'admin_head', 'bigcity_custom_admin_css' );

// add custom css to admin wysiwyg editor
/*
function bigcity_admin_wysiwyg_styles() {
    add_editor_style( 'css/wp.css' );
}
add_action( 'admin_init', 'bigcity_admin_wysiwyg_styles' );
*/