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
<link rel="icon" type="image/png" href="/wp-content/themes/rapt/dist/images/favicon.png">
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
					<svg x="0px" y="0px"
						 viewBox="0 0 24 17" enable-background="new 0 0 24 17" xml:space="preserve">
					<rect fill="#191911" width="24" height="1"/>
					<rect y="8" fill="#191911" width="24" height="1"/>
					<rect y="16" fill="#191911" width="24" height="1"/>
					</svg>

				</button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
				<a class="rapt-logo-wrap" href="/">
					<svg class="rapt-logo" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 18 37.7506" enable-background="new 0 0 18 37.7506" xml:space="preserve" width=18 height=38>
						<polyline fill="#191911" points="0,0 0,6.4074 3.8427,6.4074 16.6299,0 0,0 "/>
						<polyline fill="#191911" points="18,6.7053 18,0.4848 0.7296,9.1418 8.9132,11.2596 18,6.7053 "/>
						<polyline fill="#191911" points="16.8377,14.3879 0,10.0337 0,16.3861 5.4225,17.7922 16.8368,14.3879 "/>
						<polyline fill="#191911" points="18,21.4717 18,15.1336 0,20.4992 0,26.8373 18,21.4708 "/>
						<polyline fill="#191911" points="18,31.959 18,25.6019 12.5509,24.1863 1.1604,27.5821 18,31.959 "/>
						<polyline fill="#191911" points="5.468,29.7805 0,31.4106 0,37.7506 16.8282,32.7342 5.468,29.7805 "/>
					</svg>
				</a>
				<div class="mobile-nav-close mobile-only">
					<svg width="35" height="33" viewBox="0 0 35 33">
				    <g fill="none" fill-rule="evenodd" stroke="#979797" stroke-width="2" stroke-linecap="square">
				      <path d="M33.649.351L1.673 32.327M1.351.351l31.976 31.976"/>
				    </g>
					</svg>
				</div>
				<div class="mobile-nav-locations mobile-only">
					<div class="footer-location footer-bottom-column">
						<?php the_field('footer_location_1', 'option'); ?>
					</div>

					<div class="footer-location footer-bottom-column">
						<?php the_field('footer_location_2', 'option'); ?>
					</div>

					<div class="footer-location footer-bottom-column">
						<?php the_field('footer_location_3', 'option'); ?>
					</div>
				</div>
			</nav><!-- #site-navigation -->
			</div>


	</header><!-- #masthead -->

	<div id="content" class="site-content">
