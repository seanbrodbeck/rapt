<?php
/**
 * Template Name: Work Landing
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

				<?php // open the WordPress loop
					if (have_posts()) : while (have_posts()) : the_post();

						// are there any rows within within our flexible content?
						if( have_rows('work_grid_layout') ): 

							// loop through all the rows of flexible content
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


							endwhile; // close the loop of flexible content
						endif; // close flexible content conditional

					endwhile; endif; // close the WordPress loop ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
