<?php
/**
 * Template Name: Generic
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if( get_field('generic_page_work_hero_video') ): ?>
			<section class="single-hero video" style="background:url('<?php the_field("generic_page_work_hero_video_fallback_image"); ?>') no-repeat center 80%;background-size:cover;">
	      <div class="container">
	        <div class="row clearfix">
	          <div class="col-md-5">
	            <h1><?php the_title(); ?></h1>
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
	            <h1><?php the_title(); ?></h1>
	          </div>
	        </div>
	      </div>
	    </section>
	    <?php endif; ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    <section class="single-intro">


				<?php the_content(); ?>



	      <div class="container">
	        <div class="row single-intro-row clearfix">
	          <div class="col-md-6">
	            <h2><?php if ( ! post_password_required() ) { the_field("generic_page_work_header_text");} ?></h2>
							<!-- <h2><?php //the_field("generic_page_work_header_text"); ?></h2> -->
	          </div>
	          <div class="col-md-5 col-md-offset-1">
	            <p><?php if ( ! post_password_required() ) { the_field("generic_page_work_subheader_text");} ?></p>
							<!-- <p><?php //the_field("generic_page_work_subheader_text"); ?></p> -->
	          </div>

	      </div>
	    </section>

	    <section class="grid-content">
	      <div class="container">
	      	<div class="col-sm-12">
	      		<?php if ( !  post_password_required() ) { the_laygrid();} ?>
						<?php //the_laygrid(); ?>
	      	</div>
	      </div>
	    </section>

		<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>



	    <?php if( have_rows('things_grid_layout') ): ?>

	    <section class="featured-products">
	      <div class="container">
	        <div class="row clearfix">
	        	<div class="col-sm-12">
	        		<h2>Featured Products</h2>
	        	</div>
	        </div>
	      </div>
	      <div class="work-grid">
			<?php
				if (have_posts()) : while (have_posts()) : the_post();

					if( have_rows('things_grid_layout') ):

						while ( have_rows('things_grid_layout') ) : the_row();

						// 1/3 2/3
						if( get_row_layout() == 'things_row_13_23' )
							get_template_part('template-parts/content', 'things-row-13-23');

						// 2/3 1/3
						if( get_row_layout() == 'things_row_23_13' )
							get_template_part('template-parts/content', 'things-row-23-13');

						// Cluster
						if( get_row_layout() == 'things_cluster_of_4' )
							get_template_part('template-parts/content', 'things-row-cluster');

						// Full Width
						// if( get_row_layout() == 'things_row_full_width' )
						// 	get_template_part('template-parts/content', 'things-row-full');

						endwhile;
					endif;

				endwhile; endif; ?>
	      </div>
	    </section>
	    <?php endif; ?>

	    <?php if( have_rows('work_grid_layout') ): ?>

	     <section class="also-see black-bkg">
	      <div class="container">
	        <div class="row clearfix">
	        	<div class="col-sm-12">
	        		<h2>More to see</h2>
	        	</div>
	       	</div>
	      </div>
      	<div class="work-grid">
					<?php
						if (have_posts()) : while (have_posts()) : the_post();

							if( have_rows('work_grid_layout') ):

								while ( have_rows('work_grid_layout') ) : the_row();

								// 1/3 2/3
								if( get_row_layout() == 'work_row_13_23' )
									get_template_part('template-parts/content', 'work-row-13-23');

								// 2/3 1/3
								if( get_row_layout() == 'work_row_23_13' )
									get_template_part('template-parts/content', 'work-row-23-13');

								// Cluster
								if( get_row_layout() == 'cluster_of_4' )
									get_template_part('template-parts/content', 'work-row-cluster');

								// Full Width
								// if( get_row_layout() == 'work_row_full_width' )
								// 	get_template_part('template-parts/content', 'work-row-full');

								endwhile;
							endif;

						endwhile; endif; ?>
				</div>
<!-- 				<div class="container">
        	<div class="more-link-wrapper"><a class="more-link" href="/work">More</a></div>
     	 	</div> -->
	    </section>
	    <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
