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
	<?php get_template_part('template-parts/transition'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="full-width-wrap">
				<div class="filters row clearfix">
						<span class="filter-toggle">Filter</span>
						<img class="filter-search-btn" src="/wp-content/themes/rapt/dist/images/search.svg" width="32" height="auto"/>
				</div>
			</div>

			<div class="work-grid">
				<?php
					if (have_posts()) : while (have_posts()) : the_post();

						if( have_rows('work_grid_layout') ):

							while ( have_rows('work_grid_layout') ) : the_row();

							// 1/3 2/3
							if( get_row_layout() == 'work_row_13_23' )
								get_template_part('template-parts/content', 'work-row-12-23');

							// 2/3 1/3
							if( get_row_layout() == 'work_row_23_13' )
								get_template_part('template-parts/content', 'work-row-23-12');

							// Full Width
							if( get_row_layout() == 'work_row_full_width' )
								get_template_part('template-parts/content', 'work-row-full');

							endwhile;
						endif;

					endwhile; endif; ?>
			</div>

		<div id="filter-overlay" class="search-filter-overlay" style="display:none">
			<div class="full-width-wrap">
				<img class="close-filter-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
				<div class="filter-options-container col-sm-10">
					<div class="filter-options">

						<?php

						$taxonomy = 'work_categories';
						$terms = get_terms($taxonomy);

						if ( $terms && !is_wp_error( $terms ) ) :
						?>

			        <?php foreach ( $terms as $term ) { ?>
			            <span class="filter-option" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></span>
			        <?php } ?>

						<?php endif;?>

						<?php wp_reset_postdata();?>

					</div>
				</div>
			</div>
			<div class="container">
				<div class="col-sm-12">
					<div class="row filter-listings filter-listings-filters clearfix">
						<?php

							global $post;
							$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date', 'post_type' => 'work_post_type' );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

							<?php $terms = get_the_terms( get_the_ID(), 'work_categories' );

              if ( $terms && ! is_wp_error( $terms ) ) :

                $work_cat_list = array();
              	$work_cat_slug = array();

                foreach ( $terms as $term ) {
                    $work_cat_list[] = $term->name;
                    $work_cat_slug[] = $term->slug;
                }

                $work_cats = join( " · ", $work_cat_list );
                $work_cats_slugs = join( " ", $work_cat_slug );

                ?>
								<div class="col-md-4 col-sm-6 col-xs-6 filter-listing filter-listing-filter <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>" data-category="<?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>">
						 				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('filter-thumb'); ?></a>
						 				<div class="filter-search-text">
							 				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                <p class="work-cats category-list"><?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?></p>
		              	</div>
			              <?php endif; ?>
							 	</div>
							<?php endforeach;
							wp_reset_postdata();?>
							<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div id="search-overlay" class="search-filter-overlay" style="display:none;">
			<div class="full-width-wrap">
				<img class="close-search-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
				<input type="text" class="quicksearch" placeholder="Start Typing...">
			</div>
			<div class="container">
				<div class="clearfix"></div>
				<div class="col-sm-12">
					<div class="row clearfix filter-listings filter-listings-search">
						<?php

							global $post;
							$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date', 'post_type' => 'work_post_type' );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

							<?php $terms = get_the_terms( get_the_ID(), 'work_categories' );

              if ( $terms && ! is_wp_error( $terms ) ) :

                $work_cat_list = array();
              	$work_cat_slug = array();

                foreach ( $terms as $term ) {
                    $work_cat_list[] = $term->name;
                    $work_cat_slug[] = $term->slug;
                }

                $work_cats = join( " · ", $work_cat_list );
                $work_cats_slugs = join( " ", $work_cat_slug );

                ?>
								<div class="col-md-4 col-sm-6 col-xs-6 filter-listing filter-listing-search <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>">
						 				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('filter-thumb'); ?></a>
						 				<div class="filter-search-text">
							 				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                <p class="work-cats category-list"><?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?></p>
		              	</div>
			              <?php endif; ?>
							 	</div>
							<?php endforeach;
							wp_reset_postdata();?>
							<div class="clearfix"></div>
					</div>
				</div>


			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
