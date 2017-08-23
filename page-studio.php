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
	<?php get_template_part('template-parts/transition'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="studio-hero" style="background:url('<?php the_field("studio_hero"); ?>') no-repeat center;background-size:cover;"></section>

			<section class="team">
				<div class="container">
					<div class="row clearfix">
						<div class="col-md-5">
							<h1><?php the_field('team_header'); ?></h1>
						</div>
						<div class="col-md-6 col-md-offset-1 team-sort-links">
							<?php the_field('team_filter_list'); ?>
						</div>
					</div>
					<div class="row team-sort clearfix">
						<div class="col-md-12 team-members">
								<!-- <div class="col-sm-4"></div> -->

								<?php if( have_rows('team_member_groups') ): ?>

									<?php while( have_rows('team_member_groups') ): the_row(); ?>

										<div id="<?php the_sub_field('team_member_group_slug'); ?>" class="team-member-group active">

											<?php if( have_rows('team_members') ): ?>

												<?php while( have_rows('team_members') ): the_row(); ?>

													<div class="col-md-4 col-sm-4 col-xs-6 team-member">
														<div class="inner">

															 <?php
							                     if (is_mobile()) {
								                    	echo "<img src='";
								                    	the_sub_field('team_member_image');
								                    	echo "'/>";
							                     } else {
							                     		echo "<video width='100%' height='auto' autoplay loop>";
							                     		echo " <source src='";
							                     		the_sub_field('team_member_video');
							                     		echo "' type='video/mp4'>";
							                     		echo "</video>";
							                  } ?>

															<div class="team-member-info">
																<h3><?php the_sub_field('team_member_name'); ?></h3>
																<p><?php the_sub_field('team_member_title'); ?></p>
															</div>
														</div>
													</div>

												<?php endwhile; ?>

											<?php endif; ?>
										</div>

									<?php endwhile; ?>

								<?php endif; ?>

						</div>
					</div>
				</div>
			</section>

			<section class="we">
				<div class="container">
					<div class="row we-wrapper clearfix">
						<div class="col-md-7 we-large-text">
							<h2 class="large"><?php the_field('we_large_text'); ?></h2>
						</div>
						<div class="col-md-9 col-md-offset-3">
							<div class="col-md-6 col-md-offset-6 we-block">
								<?php the_field('we_ask_why'); ?>
							</div>
							<div class="col-md-6 we-block">
								<?php the_field('we_dont_design_things'); ?>
							</div>
							<div class="col-md-6 we-block">
								<?php the_field('we_tell_your_truth'); ?>
							</div>
						</div>
				</div>
			</section>

			<section class="clients">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-12">
							<h2 class="large"><?php the_field('client_section_header'); ?></h2>

								<?php if( have_rows('client_logo_row') ): ?>
								<div class="client-logos-row" id="client_logo_row">
									<?php while( have_rows('client_logo_row') ): the_row(); ?>
										<?php if( have_rows('client_logos') ): ?>
											<?php while( have_rows('client_logos') ): the_row();?>
												<div class="client-logo col-md-3 col-sm-6 col-xs-6"><img src="<?php the_sub_field('client_logo'); ?>"/></div>
											<?php endwhile; ?>
										<?php endif; ?>
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
								<p class="cat-header"><?php the_sub_field('service_category_header'); ?></p>
								<?php the_sub_field('service_list'); ?>
							</div>

							<?php endwhile; ?>

						<?php endif; ?>
					</div>
				</div>
			</section>

			<section class="video-section">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-10 col-sm-offset-1">
							<?php the_field('upload_section'); ?>
						</div>
					</div>
				</div>
			</section>

			<section class="contact-info">
				<div class="container">
					<div class="row contact-info-wrapper clearfix">
						<div class="col-md-5 contact-info-header">
							<h2 class="large"><?php the_field('contact_section_header'); ?></h2>
						</div>
						<div class="col-md-8 col-md-offset-4">
							<div class="row clearfix">
								<div class="col-md-6 col-sm-12"></div>
								<?php if(get_field('contact_info_grid')): ?>

									<?php while(has_sub_field('contact_info_grid')): ?>

									<div class="col-sm-6 contact-info-listing">
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
