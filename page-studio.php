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
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="single-hero" style="background:url('<?php the_field("studio_hero"); ?>') no-repeat center 80%;background-size:cover;">
				<div class="container">
	        <div class="row clearfix">
	          <div class="col-md-5">
	            <h1><?php the_title();?></h1>
	          </div>
	        </div>
	      </div>
			</section>

			<?php if(get_field('hide_team_members')):?>
			<section class="team">
				<div class="container">
					<div class="row clearfix">
						<div class="col-md-6">
							<h1><?php the_field('team_header'); ?></h1>
							<a class="show-everyone" href="#"><img style="display:inline-block;width:20px!important;margin-right:8px;height:auto!important;position:relative;top:-4px;" src="/wp-content/themes/rapt/dist/images/show-more.svg"/> <span>Just show me everyone.</span></a>
						</div>
					</div>
					<div class="row team-sort clearfix">
						<div class="col-md-12 team-members">
								<!-- <div class="col-sm-4"></div> -->

								<?php if( have_rows('team_member_groups') ): ?>

									<?php while( have_rows('team_member_groups') ): the_row(); ?>

										<?php if( have_rows('team_members') ): ?>

											<?php while( have_rows('team_members') ): the_row(); ?>

												<div class="col-xs-4 team-member">
													<div class="inner">

														 <?php
						                     // if (wp_is_mobile()) {
							                    	echo "<img class='team-member-video' width='100%' height='auto' src='";
							                    	the_sub_field('team_member_image');
							                    	echo "'/>";
						                     // } else {
						                     		// echo "<video width='100%' height='auto' autoplay loop>";
						                     		// echo " <source src='";
						                     		// the_sub_field('team_member_video');
						                     		// echo "' type='video/mp4'";
						                     		// echo "'>";
						                     		// echo "</video>";
						                  // } ?>

														<div class="team-member-info">
															<h3><?php the_sub_field('team_member_name'); ?></h3>
															<p><?php the_sub_field('team_member_title'); ?></p>
														</div>
													</div>
												</div>

											<?php endwhile; ?>

										<?php endif; ?>

									<?php endwhile; ?>

								<?php endif; ?>

						</div>
					</div>
				</div>
			</section>
			<?php endif;?>

			<section class="we">
				<div class="container">
					<div class="row we-wrapper clearfix">
						<div class="col-md-6 we-large-text">
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

			<section class="services bg-gray">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<h2 class="large"><?php the_field('studio_services_section_header');?></h3>
						</div>
						<div class="col-md-4 left">
							<h3><?php the_field('studio_services_left_col_header');?></h3>
							<?php the_field('studio_services_left_col_content');?>
						</div>
						<div class="col-md-4 right">
							<h3><?php the_field('studio_services_right_col_header');?></h3>
							<?php the_field('studio_services_right_col_content');?>

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
			<?php if(get_field('studio_services')): ?>
			<section class="services">
				<div class="container">
					<div class="row clearfix">

							<?php while(has_sub_field('studio_services')): ?>

							<div class="col-xs-4">
								<p class="cat-header"><?php the_sub_field('service_category_header'); ?></p>
								<?php the_sub_field('service_list'); ?>
							</div>

							<?php endwhile; ?>

					</div>
				</div>
			</section>
			<?php endif; ?>

			<?php if (get_field('upload_section')):?>
			<section class="video-section">
				<div class="container">
					<div class="row clearfix">
						<div class="col-md-6 contact-info-header">
							<h2 class="large"><?php the_field('contact_section_header'); ?></h2>
						</div>
						<div class="col-sm-8 col-sm-offset-3">
							<?php the_field('upload_section'); ?>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>

			<?php if(get_field('contact_info_grid')): ?>
			<section class="contact-info">
				<div class="container">
					<div class="row contact-info-wrapper clearfix">
						<div class="col-md-12">
							<div class="row clearfix">


									<?php while(has_sub_field('contact_info_grid')): ?>

									<div class="col-sm-3 contact-info-listing">
										<h4><?php the_sub_field('contact_info_header'); ?></h4>
										<?php the_sub_field('contact_info'); ?>
									</div>

									<?php endwhile; ?>


							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
