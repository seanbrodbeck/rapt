<section class="home-perspectives peach-bkg page-builder press">

	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 press-title"><h2 class="xl text-black">Press</h3></div>
			<div class="primary-articles col-md-7">

					<?php if(get_sub_field('primary_blog_post')): ?>
						<?php while(has_sub_field('primary_blog_post')): ?>

								<?php $post_object = get_sub_field('primary_post_object');

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

				<?php if(get_sub_field('secondary_posts')): ?>
						<?php while(has_sub_field('secondary_posts')): ?>

								<?php $post_object = get_sub_field('secondary_post_object');

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
	<!-- <div class="container">
		<div class="more-link-wrapper"><a class="more-link" href="/press">More</a></div>
	</div> -->

</section>
