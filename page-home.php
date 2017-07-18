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

			<header id="masthead" class="site-header">

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

				<div class="container">
					This is where the work will show up on the home page
				</div>

			</section>

			<section class="home-perspectives peach-bkg">

				<div class="container">

					<h2>Perspectives</h2>

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

					</div>

				</div>

			</section>

			<section class="home-about black-bkg">

				<div class="container">

					<div class="row clearfix">

						<div class="col-sm-9">

							<h2>Rapt is a group of designers, architects and strategists who believe everything is connected, and that anything is possible.</h2>

						</div>

					</div>

				</div>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

