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

	wp_enqueue_style( 'rapt-bootstrap', get_stylesheet_uri() . '/dist/css/bootstrap.min.css', array(), null, 'all');

	wp_enqueue_style( 'rapt-underscores', get_stylesheet_uri(), array(), null, 'all' );

	wp_enqueue_style( 'rapt-theme', get_stylesheet_uri() . '/dist/css/styles.css', array(), null, 'all');

	wp_enqueue_script( 'rapt-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rapt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'rapt-jquery', get_template_directory_uri() . '/dist/js/jquery-1.11.3.min.js', array(), null , true );

	wp_enqueue_script( 'rapt-bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.min.js', array(), null , true );

	wp_enqueue_script( 'rapt-theme-js', get_template_directory_uri() . '/dist/js/scripts.js', array(), null , true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rapt_scripts' );

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
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Work', 'text_domain' ),
		'description'           => __( 'The custom post type for the rapt Portfolio', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
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
