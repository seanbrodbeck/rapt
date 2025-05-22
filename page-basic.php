<?php
/**
 * Template Name: Basic Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="basic-page-title pt-0">
				<div class="container">
					<div class="col-md-12">
						<h1><?php the_title();?></h1>
					</div>
				</div>
	    </section>

	    <section class="basic-page-content">
				<div class="container">
					<div class="col-md-12">
			    	<?php the_content();?>
					</div>
				</div>
	    </section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
