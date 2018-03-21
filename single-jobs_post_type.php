<?php
/**
 * The template for displaying "jobs"
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if( get_field('job_hero_video') ): ?>
			<section class="single-hero video" style="background:url('<?php the_field("work_hero_video_fallback_image"); ?>') no-repeat center 80%;background-size:cover;">
	      <div class="container">
	        <div class="row clearfix">
	          <div class="col-md-5">
	            <h1><?php the_title(); ?></h1>
	          </div>
	        </div>
	      </div>
	      <video src="<?php the_field("job_hero_video"); ?>" poster="<?php the_field("job_hero_video_fallback_image"); ?>" autoplay muted loop>
	    </section>
	  	<?php else: ?>
	    <section class="single-hero" style="background:url('<?php the_field("job_hero_image"); ?>') no-repeat center 80%;background-size:cover;">
	      <div class="container">
	        <div class="row clearfix">
	          <div class="col-md-5">
	            <h1><?php the_title(); ?></h1>
	          </div>
	        </div>
	      </div>
	    </section>
	    <?php endif; ?>

	    <section class="single-intro">
	      <div class="container">
	        <div class="row single-intro-row clearfix">
	          <div class="col-md-5">
	            <h2><?php the_field("job_header_text"); ?></h2>
	            
	          </div>
	          <div class="col-md-6 col-md-offset-1">
	          	<p><?php the_field("job_subheader_text"); ?></p>
	          </div>


	      </div>
	    </section>

	    <section class="black-bkg job-qualifications">
	      <div class="container">
	      	<div class="col-sm-12">
	      		<h2><?php the_field('job_qualifications_header'); ?></h2>
	      		<div class="job-qualifications-text">
	      		<?php the_field('job_qualifications'); ?>
	      		</div>
	      	</div>
	      </div>
	    </section>

	    <section class="white-bkg about-rapt-careers">
	      <div class="container">
	      	<div class="col-sm-5">
	      		<h2><?php the_field('what_we_offer_header'); ?></h2>
	      		<p><?php the_field('what_we_offer_copy'); ?></p>
	      	</div>
	      	<div class="col-sm-6 col-sm-offset-1 job-application">
	      			<h2>Apply</h2>
	      		 <?php echo do_shortcode(get_field('job_application_form')); ?>
	      	</div>
	      </div>
	    </section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
