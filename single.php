<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="container main-blog-wrap">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-single-blog', get_post_format() );

				// the_post_navigation();

			endwhile; // End of the loop.
			?>
<!--
			<?php the_post_navigation( array(
            'prev_text'                  => __( 'prev chapter: %title' ),
            'next_text'                  => __( 'More' ),
            'screen_reader_text' => __( 'Continue Reading' ),
        ) );
			?> -->

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
