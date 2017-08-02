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
	<?php get_template_part('template-parts/transition'); ?>
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
					<div class="intro-question">
						<div class="intro-question-text">
							<?php the_sub_field('word_wall_item_text'); ?> <?php the_sub_field('word_wall_item_text'); ?> <?php the_sub_field('word_wall_item_text'); ?>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			</section>

			<header id="masthead" class="site-header home-navigation">

				<div class="nav-wrap">

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<svg x="0px" y="0px" viewBox="0 0 24 17" enable-background="new 0 0 24 17" xml:space="preserve">
							<rect width="24" height="1"/>
							<rect y="8" width="24" height="1"/>
							<rect y="16" width="24" height="1"/>
							</svg>
						</button>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
						<div class="mobile-nav-close mobile-only">
							<svg width="35" height="33" viewBox="0 0 35 33">
						    <g fill="none" fill-rule="evenodd" stroke="#979797" stroke-width="2" stroke-linecap="square">
						      <path d="M33.649.351L1.673 32.327M1.351.351l31.976 31.976"/>
						    </g>
							</svg>
						</div>
						<div class="mobile-nav-locations mobile-only">
							<div class="footer-location footer-bottom-column">
								<?php the_field('footer_location_1', 'option'); ?>
							</div>

							<div class="footer-location footer-bottom-column">
								<?php the_field('footer_location_2', 'option'); ?>
							</div>

							<div class="footer-location footer-bottom-column">
								<?php the_field('footer_location_3', 'option'); ?>
							</div>
						</div>
					</nav><!-- #site-navigation -->
					</div>

					<a class="rapt-logo-wrap" href="/">
						<svg class="rapt-logo" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 18 37.7506" enable-background="new 0 0 18 37.7506" xml:space="preserve" width=18 height=38>
							<polyline fill="#191911" points="0,0 0,6.4074 3.8427,6.4074 16.6299,0 0,0 "/>
							<polyline fill="#191911" points="18,6.7053 18,0.4848 0.7296,9.1418 8.9132,11.2596 18,6.7053 "/>
							<polyline fill="#191911" points="16.8377,14.3879 0,10.0337 0,16.3861 5.4225,17.7922 16.8368,14.3879 "/>
							<polyline fill="#191911" points="18,21.4717 18,15.1336 0,20.4992 0,26.8373 18,21.4708 "/>
							<polyline fill="#191911" points="18,31.959 18,25.6019 12.5509,24.1863 1.1604,27.5821 18,31.959 "/>
							<polyline fill="#191911" points="5.468,29.7805 0,31.4106 0,37.7506 16.8282,32.7342 5.468,29.7805 "/>
						</svg>
					</a>

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
					<div class="container">
						<div class="more-link-wrapper"><a class="more-link" href="/work">More</a></div>
					</div>


			</section>

			<section class="home-perspectives peach-bkg">

				<div class="container">

					<h1>Perspectives</h1>

					<div class="row clearfix">

						<div class="primary-articles col-md-7">
								<?php

									global $post;
									$args = array( 'posts_per_page' => 1, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

									$myposts = get_posts( $args );
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
											<header class="entry-header">
												<div class="category-list">
													<ul>
														<?php
															$categories = get_the_category();
															$separator = ' · ';
															$output = '';
															if($categories){
															    foreach($categories as $category) {
															if($category->name !== 'Primary'){
															        $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
															    }
															echo trim($output, $separator);
															}
														?>
													</ul>
												</div>
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											</header>
											<div class="entry-content">
												<?php the_excerpt(); ?>
											</div>
										</article>
									<?php endforeach;
									wp_reset_postdata();?>
						</div>

						<div class="secondary-articles col-md-3 col-md-offset-2">
							<?php

									global $post;
									$args = array( 'posts_per_page' => 2, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 4 );

									$myposts = get_posts( $args );
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
											<header class="entry-header">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="category-list">
													<ul>
														<?php
															$categories = get_the_category();
															$separator = ' · ';
															$output = '';
															if($categories){
															    foreach($categories as $category) {
															if($category->name !== 'Secondary'){
															        $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
															    }
															echo trim($output, $separator);
															}
														?>
													</ul>
												</div>
											</header>
										</article>
									<?php endforeach;
									wp_reset_postdata();?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="more-link-wrapper"><a class="more-link" href="/perspectives">More</a></div>

			</section>

			<section class="home-about black-bkg">

				<div class="container">

					<div class="row clearfix">

						<div class="col-sm-8">

							<h1>Rapt is a group of designers, architects and strategists who believe everything is connected, and that anything is possible.</h1>

						</div>

						<div class="clearfix"></div>

						<div class="more-link-wrapper col-sm-8"><a class="more-link" href="/studio">More</a></div>

					</div>

				</div>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

