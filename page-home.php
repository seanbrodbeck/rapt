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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

				<?php if(get_field('home_page_word_wall')): ?>

				<div id="word-wall-wrap">

				<?php while(has_sub_field('home_page_word_wall')): ?>

					<span class="word-wall-text"><?php the_sub_field('word_wall_item_text'); ?></span>
					<img src="<?php the_sub_field('word_wall_item_image'); ?>"/>

				<?php endwhile; ?>

				</div>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
