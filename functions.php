<?php
/**
 * rapt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rapt
 */

if ( ! function_exists( 'rapt_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rapt_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on rapt, use a find and replace
	 * to change 'rapt' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'rapt', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'rapt' ),
	) );

	add_image_size( 'preview', 200, 200, true );
	add_image_size( 'filter-thumb', 600, 313, true );
	add_image_size( 'client-logo', 500, 500, true );
	add_image_size( 'carousel-split', 700, 815, true );
	add_image_size( 'carousel-full', 1400, 800, true );
	add_image_size( 'team', 600, 870, true );
	add_filter('jpeg_quality', function($arg){return 100;});

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'rapt_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'rapt_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rapt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rapt_content_width', 640 );
}
add_action( 'after_setup_theme', 'rapt_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rapt_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rapt' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rapt' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rapt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rapt_scripts() {

	wp_enqueue_style( 'rapt-bootstrap', get_template_directory_uri() . '/dist/css/bootstrap.min.css', array(), null, 'all');

	wp_enqueue_style( 'rapt-underscores', get_stylesheet_uri(), array(), null, 'all' );

	wp_enqueue_style( 'rapt-theme', get_template_directory_uri() . '/dist/css/styles.css', array(), '2.8', 'all');

	wp_enqueue_script( 'rapt-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rapt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// wp_enqueue_script( 'rapt-jquery', get_template_directory_uri() . '/dist/js/jquery-1.11.3.min.js', array(), null , true );

	wp_enqueue_script( 'rapt-isotope', get_template_directory_uri() . '/dist/js/isotope.pkgd.min.js', array('jquery'), null , true );

	wp_enqueue_script( 'rapt-images-loaded', get_template_directory_uri() . '/dist/js/imagesloaded.pkgd.min.js', array(), null , true );

	wp_enqueue_script( 'rapt-bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.min.js', array('jquery'), null , true );

	wp_enqueue_script( 'rapt-waypoints', get_template_directory_uri() . '/dist/js/waypoint.js', array(), null , true );

	wp_enqueue_script( 'rapt-slick', get_template_directory_uri() . '/dist/js/slick.min.js', array(), null , true );

	wp_enqueue_script( 'rapt-theme-js', get_template_directory_uri() . '/dist/js/scripts.js', array('jquery'), '1.1' , true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rapt_scripts' );


function load_custom_wp_admin_style() {
        wp_register_script( 'custom_wp_admin_js', get_template_directory_uri() . '/dist/js/admin-scripts.js', array(), null , true );
        wp_enqueue_script( 'custom_wp_admin_js' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Register Work Post Type
function work_post_type() {

	$labels = array(
		'name'                  => _x( 'Works', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Work', 'text_domain' ),
		'name_admin_bar'        => __( 'Work', 'text_domain' ),
		'archives'              => __( 'Work Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Works', 'text_domain' ),
		'add_new_item'          => __( 'Add New Work', 'text_domain' ),
		'add_new'               => __( 'Add New Work', 'text_domain' ),
		'new_item'              => __( 'New Work', 'text_domain' ),
		'edit_item'             => __( 'Edit Work', 'text_domain' ),
		'update_item'           => __( 'Update Work', 'text_domain' ),
		'view_item'             => __( 'View Work', 'text_domain' ),
		'view_items'            => __( 'View Works', 'text_domain' ),
		'search_items'          => __( 'Search Work', 'text_domain' ),
		'not_found'             => __( 'Work Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Work Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured work Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured work image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured work image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured work image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into work item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this work item', 'text_domain' ),
		'items_list'            => __( 'Work Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Work Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter work items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'work',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Work', 'text_domain' ),
		'description'           => __( 'The custom post type for the rapt Portfolio', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'            => false,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'work-archive',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'work_post_type', $args );

}
add_action( 'init', 'work_post_type', 0 );

// create taxonomies for work post type

add_action( 'init', 'create_work_taxonomies', 0 );


function create_work_taxonomies() {

	$labels = array(
		'name'              => _x( 'Work Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Work Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Work Categories', 'textdomain' ),
		'all_items'         => __( 'All Work Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Work Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Work Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Work Category', 'textdomain' ),
		'update_item'       => __( 'Update Work Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Work Category', 'textdomain' ),
		'new_item_name'     => __( 'New Work Category Name', 'textdomain' ),
		'menu_name'         => __( 'Work Categories', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'work-category' ),
	);

	register_taxonomy( 'work_categories', array( 'work_post_type' ), $args );

}



// Register Things Post Type
function things_post_type() {

	$labels = array(
		'name'                  => _x( 'Things', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Thing', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Things', 'text_domain' ),
		'name_admin_bar'        => __( 'Thing', 'text_domain' ),
		'archives'              => __( 'Thing Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Things', 'text_domain' ),
		'add_new_item'          => __( 'Add New Thing', 'text_domain' ),
		'add_new'               => __( 'Add New Thing', 'text_domain' ),
		'new_item'              => __( 'New Thing', 'text_domain' ),
		'edit_item'             => __( 'Edit Thing', 'text_domain' ),
		'update_item'           => __( 'Update Thing', 'text_domain' ),
		'view_item'             => __( 'View Thing', 'text_domain' ),
		'view_items'            => __( 'View Thing', 'text_domain' ),
		'search_items'          => __( 'Search Thing', 'text_domain' ),
		'not_found'             => __( 'Thing Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Thing Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured thing image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured thing image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured thing image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured thing image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into thing item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this thing item', 'text_domain' ),
		'items_list'            => __( 'Thing items list', 'text_domain' ),
		'items_list_navigation' => __( 'Thing items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter thing items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'things',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Thing', 'text_domain' ),
		'description'           => __( 'The custom post type for the rapt Things collection', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'            => false,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'things-archive',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'things_post_type', $args );

}
add_action( 'init', 'things_post_type', 0 );

// create taxonomies for products post type

add_action( 'init', 'create_product_taxonomies', 0 );


function create_product_taxonomies() {

	$labels = array(
		'name'              => _x( 'Things Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Thing Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Thing Categories', 'textdomain' ),
		'all_items'         => __( 'All Thing Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Thing Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Thing Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Thing Category', 'textdomain' ),
		'update_item'       => __( 'Update Thing Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Thing Category', 'textdomain' ),
		'new_item_name'     => __( 'New Thing Category Name', 'textdomain' ),
		'menu_name'         => __( 'Thing Categories', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'things-category' ),
	);

	register_taxonomy( 'product_categories', array( 'things_post_type' ), $args );

}

// Jobs Post Type

// Register Custom Post Type
function jobs() {

	$labels = array(
		'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Jobs', 'text_domain' ),
		'name_admin_bar'        => __( 'Jobs', 'text_domain' ),
		'archives'              => __( 'Job Archives', 'text_domain' ),
		'attributes'            => __( 'Job Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Job:', 'text_domain' ),
		'all_items'             => __( 'All Jobs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Job', 'text_domain' ),
		'add_new'               => __( 'Add New Job', 'text_domain' ),
		'new_item'              => __( 'New Job', 'text_domain' ),
		'edit_item'             => __( 'Edit Job', 'text_domain' ),
		'update_item'           => __( 'Update Job', 'text_domain' ),
		'view_item'             => __( 'View Job', 'text_domain' ),
		'view_items'            => __( 'View Jobs', 'text_domain' ),
		'search_items'          => __( 'Search Job', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Job', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Job', 'text_domain' ),
		'items_list'            => __( 'Jobs list', 'text_domain' ),
		'items_list_navigation' => __( 'Jobs list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Jobs list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'careers',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Job Post Type', 'text_domain' ),
		'description'           => __( 'The Job Post Type', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'jobs_post_type', $args );

}
add_action( 'init', 'jobs', 0 );


// Options Page

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Footer Info',
		'menu_title'	=> 'Footer Info',
		'menu_slug' 	=> 'theme-footer-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

// add_theme_support('auto-load-next-post');

// Create full time job post dropdown function for Contact Form 7

add_action( 'wpcf7_init', 'postselect' );

function postselect() {
    wpcf7_add_form_tag( 'joblist', 'custom_post_select', array( 'name-attr' => true ) );
}
function custom_post_select( $tag ) {
  $posttype = 'jobs_post_type';
	$args = array(
		'post_type' => $posttype,
		'posts_per_page' => -1
	);
	$posts = get_posts( $args );
	//$output .= "<select class='wpcf7-form-control wpcf7-select wpcf7-validates-as-required form-control' name='" . $tag['JobList'] . "' id='" . $tag['JobList'] . "' onchange='document.getElementById(\"" . $tag['JobList'] . "\").value=this.value;'><option></option>";
	$output .= "<select name='JobList' class='wpcf7-form-control wpcf7-select wpcf7-validates-as-required form-control' id='JobList' aria-required='true' aria-invalid='false' >";
	$output .= '<option value="What position are you applying for?" selected>What position are you applying for?*</option>';
	foreach ( $posts as $post ) {
            $postid = $post->ID;
	    			$posttitle = get_the_title( $postid );
            $postslug = get_post_field( 'post_name', $postid );
    				$output .= '<option value="' . $posttitle . '">' . $posttitle . '</option>';
	}
	$output .= "</select>";
    return $output;
}

// Customize Privacy Form
// add_filter( 'the_password_form', 'custom_password_form' );
// function custom_password_form() {
//     global $post;
//     $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
//     $o = '<form class="protected-post-form aligncenter" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
//     ' . __( "<h1 style='margin-bottom:10px;'>Password Protected Content</h1><p>Enter the password below to see the remainder of the page</p>" ) . '
//     <input name="post_password" id="' . $label . '" type="password" class="form-control" style="display:block;background: #ffffff; border:1px solid #999; color:#333333; padding:10px;width:300px;margin:10px auto;" size="20" placeholder="Password" />
//     <input type="submit" name="Submit" class="button" style="font-size: 30px;-webkit-appearance: none;border:1px solid #000;background:none;border-radius:0;font-family: noe-display;padding:15px 30px 10px;" value="' . esc_attr__( "Submit" ) . '" />
//     </form><p style="font-size:14px;margin:0px;"></p>
//     ';
//     return $o;
// }
