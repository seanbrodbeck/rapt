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

				<ul>
				<!-- Start Repeater -->

					<?php
					global $post;
					$user_id = get_current_user_id();
					if( have_rows('work_item_grid')): // check for repeater fields ?>

					    <?php while ( have_rows('work_item_grid')) : the_row(); // loop through the repeater fields ?>

					    <?php // set up post object
					        $post_object = get_sub_field('work_item');
					        if( $post_object ) :
					        $post = $post_object;
					        setup_postdata($post);
					        ?>

					       <div class="<?php the_sub_field('grid_item_width'); ?>"> 
					       	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					       	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php the_excerpt(); ?> </a></h2>
					       	Get the Work Category List Here
					       </div>

					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

					    <?php endif; ?>

					    <?php endwhile; ?>

					<!-- End Repeater -->
					<?php endif; ?>
				</ul>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
