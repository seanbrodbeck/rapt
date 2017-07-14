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

		<div class="primary-articles col-sm-7">
			<?php

				global $post;
				$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_post_thumbnail("full"); ?>
						<header class="entry-header">
							<?php echo get_the_category_list(); ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
						<?php the_post_thumbnail("full"); ?>
						<header class="entry-header">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php echo get_the_category_list(); ?>
						</header>
					</article>
				<?php endforeach; 
				wp_reset_postdata();?>
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
