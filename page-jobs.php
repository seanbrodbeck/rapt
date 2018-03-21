<?php
/**
 * Template Name: Jobs Landing Page
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

	    <section class="single-intro">
	      <div class="container">
	        <div class="row single-intro-row clearfix">
	          <div class="col-md-6">
	            <h2><?php the_field("generic_page_work_header_text"); ?></h2>
	            <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );

              if ( $terms && ! is_wp_error( $terms ) ) :

                $work_cat_list = array();

                foreach ( $terms as $term ) {
                    $work_cat_list[] = $term->name;
                }

                $work_cats = join( " · ", $work_cat_list );
                ?>

                <p class="work-cats category-list">
                    <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                </p>

              <?php endif; ?>
	          </div>
	          <div class="col-md-5 col-md-offset-1">
	            <p><?php the_field("generic_page_work_subheader_text"); ?></p>
	          </div>


	      </div>
	    </section>

	     <section class="jobs-content">
	      <div class="container">
	      	<div class="col-sm-6">
	      		<?php the_field("careers_info_block"); ?>
	      	</div>
	      	<div class="col-sm-5 col-sm-offset-1">
	      		<h2>Open Positions</h2>
	      		<?php
	      		$query = new WP_Query(array(
						    'post_type' => 'jobs_post_type',
						    'post_status' => 'publish',
						    'posts_per_page' => -1
						));


						while ($query->have_posts()) {
						    $query->the_post();
						    $post_title = get_the_title();
						    $post_link = get_the_permalink();
						    echo "<div class='job-posting'><a href='";
						    echo $post_link;
						    echo "'>";
						    echo $post_title;
						    echo " <span>";
						    echo the_field('job_location');
						    echo "</span>";
						    echo "</a></div>";
						}

						wp_reset_query();
	      		?>
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



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
