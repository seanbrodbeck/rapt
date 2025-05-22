<?php
/**
 * Template Name: Home Page
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


			<?php if( get_field('word_wall_or_video_hero') == 'words' ): ?>

				<section class="intro">
					<?php if(get_field('home_page_word_wall')): ?>
						<div class="intro-images">
						<?php while(has_sub_field('home_page_word_wall')): ?>
							<img src="<?php the_sub_field('word_wall_item_image'); ?>" class="intro-image" alt=""/>
						<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<?php if(get_field('home_page_word_wall')): ?>
						<div class="intro-questions">
						<?php while(has_sub_field('home_page_word_wall')): ?>
							<div class="intro-question">
								<div class="intro-question-text">
									<?php the_sub_field('word_wall_item_text'); ?> <?php the_sub_field('word_wall_item_text'); ?> <?php the_sub_field('word_wall_item_text'); ?> <?php the_sub_field('word_wall_item_text'); ?>
								</div>
							</div>
						<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</section>



			<?php elseif( get_field('word_wall_or_video_hero') == 'vid' ): ?>
				<section class="vid-intro nopad">
						<div class="videoWrapper">
							<?php the_field('hero_video') ?>
						</div>
				</section>

			<?php elseif( get_field('word_wall_or_video_hero') == 'splash' ): ?>

				<section class="splash-text-hero">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-lg-10">
									<h1 class="sr-only"><?php the_field('splash_title') ?></h1>
									<p class="splash-content">
										<?php if(get_field('splash_title')) :?><span class="splash_title" style="font-family: 'noe-display';font-weight: 300;"><?php the_field('splash_title') ?></span> <?php endif; ?><span class="splash_text"><?php the_field('splash_text') ?></span>
									</p>
								</div>
							</div>
						</div>
				</section>

			<?php endif; ?>



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
												<div class="left"><p class="m-0">Case No. <span class="case-number"><?php echo $i ?></span></p></div>
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


			<section class="services bg-gray">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<h2 class="large"><?php the_field('services_section_header');?></h3>
						</div>
						<div class="col-md-4 left">
							<h3><?php the_field('services_left_col_header');?></h3>
							<?php the_field('services_left_col_content');?>
						</div>
						<div class="col-md-4 right">
							<h3><?php the_field('services_right_col_header');?></h3>
							<?php the_field('services_right_col_content_');?>

						</div>
					</div>
				</div>
			</section>




			<!-- <section class="home-work">

					<div class="work-grid">
						<?php
							// if (have_posts()) : while (have_posts()) : the_post();
							//
							// 	if( have_rows('work_grid_layout') ):
							//
							// 		while ( have_rows('work_grid_layout') ) : the_row();
							//
							// 		// 1/3 2/3
							// 		if( get_row_layout() == 'work_row_13_23' )
							// 			get_template_part('template-parts/content', 'work-row-13-23');
							//
							// 		// 2/3 1/3
							// 		if( get_row_layout() == 'work_row_23_13' )
							// 			get_template_part('template-parts/content', 'work-row-23-13');
							//
							// 		// Full Width
							// 		if( get_row_layout() == 'cluster_of_4' )
							// 			get_template_part('template-parts/content', 'work-row-cluster');
							//
							// 		// Full Width
							// 		if( get_row_layout() == 'work_row_full_width' )
							// 			get_template_part('template-parts/content', 'work-row-full');
							//
							// 		endwhile;
							// 	endif;
							//
							// endwhile; endif;
							?>
					</div>

					<div class="clearfix"></div>
					<div class="container">
						<div class="more-link-wrapper"><a class="more-link" href="/work">More</a></div>
					</div>


			</section> -->

			<section class="home-perspectives peach-bkg">

				<div class="container">
					<div class="row clearfix">
						<div class="col-md-12 press-title"><h2 class="large">Press</h3></div>
						<div class="primary-articles col-md-7">

								<?php if(get_field('home_page_featured_primary_blog_posts')): ?>
									<?php while(has_sub_field('home_page_featured_primary_blog_posts')): ?>

											<?php $post_object = get_sub_field('home_primary_blog_post');

												if( $post_object ):

													$post = $post_object;
													setup_postdata( $post );

													?>
												    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
															<?php if( get_field('post_link_external') ): ?>
																<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail("full"); ?></a>
															<?php else: ?>
																<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
															<?php endif; ?>
																<div class="entry-text">
																	<header class="entry-header">
																		<!-- <div class="category-list">
																			<ul>
																				<?php
																					// $categories = get_the_category();
																					// $separator = ' · ';
																					// $output = '';
																					// if($categories){
																					//     foreach($categories as $category) {
																					// if($category->name !== 'Primary'){
																					//         $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
																					//     }
																					// echo trim($output, $separator);
																					// }
																				?>
																			</ul>
																		</div> -->
																		<?php if( get_field('post_link_external') ): ?>
																		<h2><a href="<?php the_field('post_link_external'); ?>"><span><?php the_field('perspectives_source'); ?></span> <?php the_title(); ?></a></h2>
																		<?php else: ?>
																		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
																		<?php endif; ?>
																	</header>
																	<div class="entry-content">
																		<p><?php the_field('intro_paragraph_text'); ?></p>
																	</div>
																</div>
															</article>
												    <?php wp_reset_postdata(); ?>
												<?php endif; ?>

										<?php endwhile; ?>

									<?php endif; ?>

						</div>

						<div class="secondary-articles col-md-3 col-md-offset-2">

							<?php if(get_field('home_page_featured_secondary_blog_posts')): ?>
									<?php while(has_sub_field('home_page_featured_secondary_blog_posts')): ?>

											<?php $post_object = get_sub_field('home_secondary_blog_post');

												if( $post_object ):

													$post = $post_object;
													setup_postdata( $post );

													?>
												    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
															<?php if( get_field('post_link_external') ): ?>
																<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail("full"); ?></a>
															<?php else: ?>
																<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
															<?php endif; ?>
																<div class="entry-text">
																	<header class="entry-header">
																		<?php if( get_field('post_link_external') ): ?>
																		<h3><a href="<?php the_field('post_link_external'); ?>"><span><?php the_field('perspectives_source'); ?></span> <?php the_title(); ?></a></h2>
																		<?php else: ?>
																		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
																		<?php endif; ?>
																	</header>
																	<!-- <div class="category-list">
																		<ul>
																			<?php
																				// $categories = get_the_category();
																				// $separator = ' · ';
																				// $output = '';
																				// if($categories){
																				//     foreach($categories as $category) {
																				// if($category->name !== 'Secondary'){
																				//         $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
																				//     }
																				// echo trim($output, $separator);
																				// }
																			?>
																		</ul>
																	</div> -->
																</div>
															</article>
												    <?php wp_reset_postdata(); ?>
												<?php endif; ?>

										<?php endwhile; ?>

									<?php endif; ?>

						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="container">
					<div class="more-link-wrapper"><a class="more-link" href="/press">More</a></div>
				</div>

			</section>

			<section class="home-about black-bkg">

				<div class="container">

					<div class="row clearfix">

						<div class="col-sm-12 col-md-8">

							<h1><a href="/studio" title="More about the studio."><?php the_field('home_page_footer_text'); ?></a></h1>

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
