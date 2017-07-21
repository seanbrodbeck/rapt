<?php
/**
 * Template Name: Studio
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="studio-hero" style="background:url('<?php the_field("studio_hero"); ?>') no-repeat center;background-size:cover;"></section>

			<section class="team">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-6">
							<h1><?php the_field('team_header'); ?></h1>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-sm-6">
							<?php the_field('team_filter_list'); ?>
						</div>
						<div class="col-sm-6">
							Team Members Here (nested repeater)
						</div>
					</div>
				</div>
			</section>

			<section class="we">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-7">
							<h2 class="large"><?php the_field('we_large_text'); ?></h2>
						</div>
						<div class="col-sm-4 col-sm-offset-1">
							<?php the_field('we_ask_why'); ?>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-sm-4 col-sm-offset-4">
							<h1><?php the_field('we_dont_design_things'); ?></h1>
						</div>
						<div class="col-sm-4">
							<?php the_field('we_tell_your_truth'); ?>
						</div>
					</div>
				</div>
			</section>

			<section class="clients light-gray-bkg">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-12">
							<h2 class="large"><?php the_field('client_section_header'); ?></h2>
							<?php if(get_field('client_logos')): ?>

							<div class="carousel clearfix">

							<?php while(has_sub_field('client_logos')): ?>

								<div class="carousel-item col-sm-3"><img src="<?php the_sub_field('client_logo'); ?>"/></div>

							<?php endwhile; ?>

							</div>

						<?php endif; ?>
						</div>
					</div>

				</div>
			</section>

			<section class="services">
				<div class="container">
					<div class="row clearfix">
						<?php if(get_field('services')): ?>

							<?php while(has_sub_field('services')): ?>

							<div class="col-sm-4">
								<h2 class="large"><?php the_sub_field('service_category_header'); ?></h2>
								<?php the_sub_field('service_list'); ?>
							</div>

							<?php endwhile; ?>

						<?php endif; ?>
					</div>
					<div class="row clearfix">
						<div class="col-sm-10 col-sm-offset-1">
							<?php the_field('upload_section'); ?>
						</div>
					</div>
				</div>
			</section>

			<section class="contact-info">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-4">
							<h2 class="large"><?php the_field('contact_section_header'); ?></h2>
						</div>
						<div class="col-sm-8">
							<div class="row clearfix">
								<div class="col-sm-6"></div>
								<?php if(get_field('contact_info_grid')): ?>

									<?php while(has_sub_field('contact_info_grid')): ?>

									<div class="col-sm-6">
										<h4><?php the_sub_field('contact_info_header'); ?></h4>
										<?php the_sub_field('contact_info'); ?>
									</div>

									<?php endwhile; ?>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
