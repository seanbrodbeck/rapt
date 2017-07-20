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
		<div class="container">


			<div class="row clearfix footer-top">
				<div class="col-sm-9 footer-nav">
					<?php wp_nav_menu( array( 'menu_id' => 'primary-menu', )); ?>
				</div><!-- .site-info -->
				<div class="col-sm-3 footer-subscribe">
					<p><a href="#">Join our newsletter</a></p>
				</div>
			</div>


			<div class="row clearfix footer-bottom">

				<div class="col-sm-3 footer-social">
					<?php if(get_field('social_links', 'option')): ?>
						<ul>
						<?php while(has_sub_field('social_links', 'option')): ?>
							<li><a href="<?php the_sub_field('social_link_url', 'option'); ?>"><?php the_sub_field('social_link_title', 'option'); ?></a></li>
						<?php endwhile; ?>
						</ul>
					<?php endif; ?>			
				</div><!-- .site-info -->

				<div class="col-sm-3 footer-location">
					<?php the_field('footer_location_1', 'option'); ?>
				</div>

				<div class="col-sm-3 footer-location">
					<?php the_field('footer_location_2', 'option'); ?>
				</div>

				<div class="col-sm-3 footer-location">
					<?php the_field('footer_location_3', 'option'); ?>
				</div>
			</div>

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
