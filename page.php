<?php
/**
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
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if( have_rows('rapt_page_builder') ): ?>

				<?php if( get_field('generic_page_work_hero_video') ): ?>
				<section class="single-hero video" style="background:url('<?php the_field("generic_page_work_hero_video_fallback_image"); ?>') no-repeat center 80%;background-size:cover;">
		      <div class="container">
		        <div class="row clearfix">
		          <div class="col-md-5">
		            <h1 <?php if( get_field('hide_page_header') ): ?>class="sr-only"<?php endif;?>><?php the_title(); ?></h1>
		          </div>
		        </div>
		      </div>
		      <video src="<?php the_field("generic_page_work_hero_video"); ?>" poster="<?php the_field("generic_page_work_hero_video_fallback_image"); ?>" autoplay muted loop>
		    </section>
		  	<?php else: ?>
		    <section class="single-hero" style="background:url('<?php the_field("generic_page_work_hero_image"); ?>') no-repeat center 80%;background-size:cover;">
		      <div class="container">
		        <div class="row clearfix">
		          <div class="col-md-5">
		            <h1 <?php if( get_field('hide_page_header') ): ?>class="sr-only"<?php endif;?>><?php the_title(); ?></h1>
		          </div>
		        </div>
		      </div>
		    </section>
		    <?php endif; ?>

				<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'controller'); ?>

			<?php else :?>

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;

				endwhile; // End of the loop.
				?>

			<?php endif;?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
