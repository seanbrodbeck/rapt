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

	<footer id="colophon" class="site-footer <?php if( have_rows('rapt_page_builder') ): ?>m-0<?php endif;?>">
		<div class="container">


			<div class="row clearfix footer-top">
				<div class="col-md-9 col-sm-6 footer-nav">
					<?php wp_nav_menu( array( 'menu_id' => 'primary-menu', )); ?>
				</div><!-- .site-info -->
				<div class="col-md-3 col-md-offset-3 footer-subscribe">
					<!-- Begin MailChimp Signup Form -->

					<!-- <form action="//raptstudio.us6.list-manage.com/subscribe/post?u=ffd971c82d8b0e37775847995&amp;id=57c3a03987" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<p class="mc-field-group">
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Join our newsletter">
							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						</p>
				    <div id="mce-responses" class="clear">
				      <div class="response" id="mce-error-response" style="display:none"></div>
				      <div class="response" id="mce-success-response" style="display:none"></div>
				    </div>
				    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ffd971c82d8b0e37775847995_57c3a03987" tabindex="-1" value=""></div>
					</form> -->
					<!--End mc_embed_signup-->
				</div>
			</div>


			<div class="row clearfix footer-bottom">


				<div class="col-md-3 col-sm-12 footer-social footer-bottom-column">
					<?php if(get_field('social_links', 'option')): ?>
						<ul>
						<?php while(has_sub_field('social_links', 'option')): ?>
							<li><a href="<?php the_sub_field('social_link_url', 'option'); ?>" target="_blank"><?php the_sub_field('social_link_title', 'option'); ?></a></li>
						<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div><!-- .site-info -->

				<div class="col-md-9 text-align-right footer-privacy">
					&copy; Rapt Studio <?php echo date('Y'); ?> <a href="/legal">Terms of Service &amp; Privacy Policy</a>
				</div>

			</div>

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26264867-1']);
  _gaq.push(['_setDomainName', 'raptstudio.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>
