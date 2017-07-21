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

get_header('home'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

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
					<span class="intro-question"><?php the_sub_field('word_wall_item_text'); ?></span>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>

			</section>

			<header id="masthead" class="site-header home-navigation">

				<div class="container">
					
					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'rapt' ); ?></button>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
					</nav><!-- #site-navigation -->

					</div>
				
			</header><!-- #masthead -->


			<section class="home-work">

					<div class="work-grid">
						<?php 
							if (have_posts()) : while (have_posts()) : the_post();

								if( have_rows('work_grid_layout') ): 

									while ( have_rows('work_grid_layout') ) : the_row();

									// 1/3 2/3
									if( get_row_layout() == 'work_row_13_23' )
										get_template_part('template-parts/content', 'work-row-12-23');

									// 2/3 1/3
									if( get_row_layout() == 'work_row_23_13' )
										get_template_part('template-parts/content', 'work-row-23-12');

									// Full Width
									if( get_row_layout() == 'work_row_full_width' )
										get_template_part('template-parts/content', 'work-row-full');

									endwhile; 
								endif; 

							endwhile; endif; ?>
					</div>

					<div class="clearfix"></div>
					<div class="more-link-wrapper"><a class="more-link" href="/work">More</a></div>
				

			</section>

			<section class="home-perspectives peach-bkg">

				<div class="container">

					<h1>Perspectives</h1>

					<div class="row clearfix">

						<div class="primary-articles col-sm-7">
								<?php

									global $post;
									$args = array( 'posts_per_page' => 1, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

									$myposts = get_posts( $args );
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
											<header class="entry-header">
												<?php echo get_the_category_list(); ?>
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											</header>
											<div class="entry-content">
												<?php the_excerpt(); ?>
											</div>
										</article>
									<?php endforeach; 
									wp_reset_postdata();?>
						</div>

						<div class="secondary-articles col-sm-3 col-sm-offset-2">
							<?php

									global $post;
									$args = array( 'posts_per_page' => 2, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 4 );

									$myposts = get_posts( $args );
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
											<header class="entry-header">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<?php echo get_the_category_list(); ?>
											</header>
										</article>
									<?php endforeach; 
									wp_reset_postdata();?>
						</div>
						<div class="clearfix"></div>
						<div class="more-link-wrapper"><a class="more-link" href="/perspectives">More</a></div>

					</div>

				</div>

			</section>

			<section class="home-about black-bkg">

				<div class="container">

					<div class="row clearfix">

						<div class="col-sm-8">

							<h1>Rapt is a group of designers, architects and strategists who believe everything is connected, and that anything is possible.</h1>

						</div>

						<div class="clearfix"></div>

						<div class="more-link-wrapper"><a class="more-link" href="/about">More</a></div>

					</div>

				</div>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

