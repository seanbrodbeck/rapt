<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rapt
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rapt' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="nav-wrap">

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<svg x="0px" y="0px" viewBox="0 0 24 17" enable-background="new 0 0 24 17" xml:space="preserve">
					<rect width="24" height="1"/>
					<rect y="8" width="24" height="1"/>
					<rect y="16" width="24" height="1"/>
					</svg>
				</button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
				<a class="rapt-logo-wrap mobile-only" href="/">
					<img class="rapt-logo" src="/wp-content/themes/rapt/dist/images/logo.svg" width="18" height="auto" />
				</a>
			</nav><!-- #site-navigation -->
			</div>

			<a class="rapt-logo-wrap desktop-only" href="/">
				<img class="rapt-logo" src="/wp-content/themes/rapt/dist/images/logo.svg" width="18" height="auto" />
			</a>

			
	</header><!-- #masthead -->

	<div id="content" class="site-content">
