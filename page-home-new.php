<?php
/**
 * Template Name: Home Page 2.0
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




				<section class="splash-text-hero">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-lg-10 col-lg-offset-1">
									<h1 class="sr-only">Rapt Studio</h1>
									<h2 class="xl">
										<?php the_field('splash_text') ?>
									</h2>
								</div>
							</div>
						</div>
				</section>





				<?php if( have_rows('home_page_work_carousel') ): $i = 0; ?>
					<section class="home-carousel">
						<div class="container">
					    <div class="home-carousel-list home-carousel-js">
					    <?php while( have_rows('home_page_work_carousel') ): the_row();
									$i++;
					        $image = get_sub_field('image_1');
									$image2 = get_sub_field('image_2');
					        ?>
					        <div class="home-carousel-list-item">
										<a href="<?php the_sub_field('link'); ?>" <?php if(get_sub_field('new_tab')): ?>target="_blank"<?php endif;?> title="More About <?php the_sub_field('title'); ?>">
											<?php if($image2) :?>
												<div class="row">
													<div class="col-xs-6"><?php echo wp_get_attachment_image( $image, 'carousel-split' ); ?></div>
													<div class="col-xs-6"><?php echo wp_get_attachment_image( $image2, 'carousel-split' ); ?></div>
												</div>
											<?php else: ?>
												<?php echo wp_get_attachment_image( $image, 'carousel-full' ); ?>
											<?php endif; ?>
											<div class="home-carousel-list-item-info">
												<div class="left">
													<!-- <p class="m-0">Case No. <span class="case-number"><?php //echo $i ?></span></p> -->
													<p class="m-0"><?php the_sub_field('work_type'); ?></p>
													</div>
												<div class="right">
													<h3 class="m-0"><?php the_sub_field('title'); ?></h3>
													<?php if(get_sub_field('teaser')): ?><h4><?php the_sub_field('teaser'); ?></h4><?php endif;?>
												</div>
											</div>
										</a>
					        </div>
					    <?php endwhile; ?>
							</div>
						</div>
					</section>
			<?php endif; ?>

			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'controller'); ?>

			<section class="home-about black-bkg">

				<div class="container">

					<div class="row clearfix">

						<div class="col-sm-12 col-md-8">

							<h1><a href="/contact" title="Contact Rapt."><?php the_field('home_page_footer_text'); ?></a></h1>

						</div>

						<div class="clearfix"></div>

						<!-- <div class="more-link-wrapper col-sm-8"><a class="more-link" href="/studio">More</a></div> -->

					</div>

				</div>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
