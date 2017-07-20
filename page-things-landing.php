<?php
/**
 * Template Name: Product Landing
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

			<div class="container">
				<div class="filters row clearfix">
					<div class="col-sm-12">
						<span class="filter-toggle">Filter</span>
						<img class="filter-search-btn" src="/wp-content/themes/rapt/dist/images/search.svg" width="32" height="auto"/>
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
								get_template_part('template-parts/content', 'things-row-12-23');

							// 2/3 1/3
							if( get_row_layout() == 'things_row_23_13' )
								get_template_part('template-parts/content', 'things-row-23-12');

							// Full Width
							if( get_row_layout() == 'things_row_full_width' )
								get_template_part('template-parts/content', 'things-row-full');

							endwhile; 
						endif; 

					endwhile; endif; ?>

				</div>

				<div id="filter-overlay" class="search-filter-overlay" style="display:none">
					<div class="container">
						<img class="close-filter-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
						<div class="col-sm-10">
							<div class="filter-options">

								<?php

								$taxonomy = 'product_categories';
								$terms = get_terms($taxonomy); 

								if ( $terms && !is_wp_error( $terms ) ) :
								?>

					        <?php foreach ( $terms as $term ) { ?>
					            <span class="filter-option"><a href="#<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></span>
					        <?php } ?>
								    
								<?php endif;?>

								<?php wp_reset_postdata();?>

							</div>
						</div>
						<div class="col-sm-12 filter-listings">
							<div class="row clearfix">
								<?php

									global $post;
									$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date', 'post_type' => 'things_post_type' );

									$myposts = get_posts( $args );
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

									<?php $terms = get_the_terms( get_the_ID(), 'product_categories' );
					                                     
		              if ( $terms && ! is_wp_error( $terms ) ) : 
		             
		                $work_cat_list = array();
		              	$work_cat_slug = array();
		             
		                foreach ( $terms as $term ) {
		                    $work_cat_list[] = $term->name;
		                    $work_cat_slug[] = $term->slug;
		                }
		                                     
		                $work_cats = join( " • ", $work_cat_list );
		                $work_cats_slugs = join( " ", $work_cat_slug );

		                ?>
										<div class="col-sm-4 filter-listing <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>">
								 				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('filter-thumb'); ?></a>
								 				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				                <p class="work-cats category-list"><?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?></p>

					              <?php endif; ?>
									 	</div>
									<?php endforeach; 
									wp_reset_postdata();?>
							</div>		
						</div>
					</div>
				</div>

				<div id="search-overlay" class="search-filter-overlay" style="display:none">
					<div class="container">
						<img class="close-search-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
						<input type="text" placeholder="Start Typing...">
					</div>
				</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
