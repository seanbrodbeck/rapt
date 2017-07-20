<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="container">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-single-blog', get_post_format() );

				the_post_navigation();

			endwhile; // End of the loop.
			?>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
