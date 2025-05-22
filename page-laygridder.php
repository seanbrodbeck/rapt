<?php
/**
 * Template Name: Laygridder
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	    <section class="grid-content">

	  
	      		<h1 class="sr-only"><?php the_title();?></h1>
				<?php the_laygrid(); ?>
	   
	    </section>

		<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
