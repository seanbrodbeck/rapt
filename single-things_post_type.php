<?php
/**
 * The template for displaying a "product"
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rapt
 */

get_header(); ?>
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">


			<section class="single-hero" style="background:url('<?php the_field("work_hero_image"); ?>') no-repeat center;background-size:cover;">
	      <div class="container">
	        <div class="row clearfix">
	          <div class="col-md-5">
	            <h1><?php the_title(); ?></h1>
	          </div>
	        </div>
	      </div>
	    </section>

	    <section class="single-intro">
	      <div class="container">
	        <div class="row clearfix">
	          <div class="col-md-6">
	            <h2><?php the_field("work_header_text"); ?></h2>
	            <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );

              if ( $terms && ! is_wp_error( $terms ) ) :

                $work_cat_list = array();

                foreach ( $terms as $term ) {
                    $work_cat_list[] = $term->name;
                }

                $work_cats = join( " • ", $work_cat_list );
                ?>

                <p class="work-cats category-list">
                    <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                </p>

              <?php endif; ?>
	          </div>
	          <div class="col-md-5 col-md-offset-1">
	            <p><?php the_field("work_subheader_text"); ?></p>
	          </div>
	        </div>
	      </div>
	    </section>

	    <section class="grid-content">
	      <div class="container">
	      	<div class="col-sm-12">
	      		<?php echo get_laygrid(); ?>
	      	</div>
	      </div>
	    </section>

	    <section class="awards-press">
	      <div class="container">
	        <div class="row clearfix">

	           <?php if(get_field('press')): ?>

								<div class="col-md-6 press-col">
								<h2>Press</h2>
								<?php while(has_sub_field('press')): ?>

								<div class="awards-press-entry">
									<h4><a href="<?php the_sub_field('press_url'); ?>" target="_blank"><?php the_sub_field('press_title'); ?> <span><?php the_sub_field('press_text'); ?></span></a></h4>
								</div>

								<?php endwhile; ?>

								</div>

							<?php endif; ?>

							 <?php if(get_field('awards')): ?>

								<div class="col-md-6">
									<h2>Awards</h2>
									<?php while(has_sub_field('awards')): ?>

									<div class="awards-press-entry">
										<h4><a href="<?php the_sub_field('award_url'); ?>" target="_blank"><?php the_sub_field('award_title'); ?> <span><?php the_sub_field('award_text'); ?></span></a></h4>
									</div>

									<?php endwhile; ?>

									</div>

								<?php endif; ?>

	        </div>
	      </div>
	    </section>

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
	        		<h2>Also See</h2>
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

								// Cluster
								// if( get_row_layout() == 'cluster_of_4' )
								// 	get_template_part('template-parts/content', 'work-row-cluster');

								// Full Width
								// if( get_row_layout() == 'work_row_full_width' )
								// 	get_template_part('template-parts/content', 'work-row-full');

								endwhile;
							endif;

						endwhile; endif; ?>
				</div>
				<div class="container">
        	<div class="more-link-wrapper"><a class="more-link" href="/work">More</a></div>
      	</div>
	    </section>
	    <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
