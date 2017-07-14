<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rapt
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		FOOTER STARTS HERE
		<div class="site-info">
			<?php wp_nav_menu( array( 'menu_id' => 'primary-menu', )); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
