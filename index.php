<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main clearfix">

			<div class="container">

				<div class="filters row clearfix">

					<div class="col-sm-12">
						<span class="filter-toggle">Filter</span>
						<div class="filter-search-field" style="display:none;">
							<input type="text">
						</div>
						<img class="filter-search-btn" src="/wp-content/themes/rapt/dist/images/search.svg" width="32" height="auto"/>
						<div class="filter-options" style="display:none;">
							<div class="filter-option">Filter Option 1</div>
							<div class="filter-option">Filter Option 2</div>
							<div class="filter-option">Filter Option 3</div>
							<div class="filter-option">Filter Option 4</div>
						</div>
					</div>

				</div>

				<div class="row article-search clearfix" style="display:none;">
					<div class="container">
						Search results will go here...
					</div>
				</div>

				<div class="row article-feed clearfix">

					<div class="primary-articles col-sm-7">
						<?php

							global $post;
							$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

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
							$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 4 );

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

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
