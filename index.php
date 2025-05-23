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
	<?php get_template_part('template-parts/logo-loader'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main clearfix">

			<!-- <div class="full-width-wrap">

				<div class="filters row clearfix">
					<span class="filter-toggle">Filter</span>
					<img class="filter-search-btn" src="/wp-content/themes/rapt/dist/images/search.svg" width="32" height="auto"/>
				</div>

			</div> -->

			<div class="container">

				<div class="row article-feed clearfix">

					<div class="primary-articles col-md-7">


						<?php
						  // set up or arguments for our custom query
						  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						  $query_args = array(
						    'post_type' => 'post',
						    'category_name' => 'Primary',
						    'posts_per_page' => -1,
						    'paged' => $paged
						  );
						  // create a new instance of WP_Query
						  $the_query = new WP_Query( $query_args );
						?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>


								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php if( get_field('post_link_external') ): ?>
									<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail("full"); ?></a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
								<?php endif; ?>
									<div class="entry-text">
										<header class="entry-header">
											<!-- <div class="category-list">
												<ul>
													<?php
														// $categories = get_the_category();
														// $separator = ' · ';
														// $output = '';
														// if($categories){
														//     foreach($categories as $category) {
														// if($category->name !== 'Primary'){
														//         $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
														//     }
														// echo trim($output, $separator);
														// }
													?>
												</ul>
											</div> -->
											<?php if( get_field('post_link_external') ): ?>
											<h2><a href="<?php the_field('post_link_external'); ?>" target=_"blank"><span><?php the_field('perspectives_source'); ?></span> <?php the_title(); ?></a></h2>
											<?php else: ?>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php endif; ?>
										</header>
										<div class="entry-content">
											<p><?php the_field('intro_paragraph_text'); ?></p>
										</div>
									</div>
								</article>

						<?php endwhile; ?><?php endif; ?>



				</div>

				<div class="secondary-articles col-md-3 col-md-offset-2">
					<?php
						  // set up or arguments for our custom query
						  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						  $query_args = array(
						    'post_type' => 'post',
						    'category_name' => 'Secondary',
						    'posts_per_page' => -1,
						    'paged' => $paged
						  );
						  // create a new instance of WP_Query
						  $the_query = new WP_Query( $query_args );
						?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>


							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php if( get_field('post_link_external') ): ?>
									<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail("full"); ?></a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
								<?php endif; ?>
									<div class="entry-text">
										<header class="entry-header">
											<?php if( get_field('post_link_external') ): ?>
											<h3><a href="<?php the_field('post_link_external'); ?>" target=_"blank"><span><?php the_field('perspectives_source'); ?></span> <?php the_title(); ?></a></h2>
											<?php else: ?>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php endif; ?>
										</header>
										<!-- <div class="category-list">
											<ul>
												<?php
													// $categories = get_the_category();
													// $separator = ' · ';
													// $output = '';
													// if($categories){
													//     foreach($categories as $category) {
													// if($category->name !== 'Secondary'){
													//         $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
													//     }
													// echo trim($output, $separator);
													// }
												?>
											</ul>
										</div> -->
									</div>
								</article>


						<?php endwhile; ?><?php endif; ?>
				</div>

			</div>

		</div>

		<div id="filter-overlay" class="search-filter-overlay" style="display:none">
			<div class="full-width-wrap">
				<img class="close-filter-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
				<div class="filter-options-container col-sm-12">
					<div class="filter-options">

						<?php

						$taxonomy = 'category';
						$terms = get_terms($taxonomy);

						if ( $terms && !is_wp_error( $terms ) ) :
						?>

			        <?php foreach ( $terms as $term ) { ?>
			            <label class="filter-option"><input type="checkbox" value=".<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></label>
			           <!--  <span class="filter-option" data-filter=".<?php //echo $term->slug; ?>"><?php //echo $term->name; ?></span> -->
			        <?php } ?>

						<?php endif;?>

						<?php wp_reset_postdata();?>

					</div>
				</div>
			</div>
			<div class="container">
				<div class="col-sm-12 filter-listings">
					<div class="row filter-listings filter-listings-filters clearfix">
						<?php

							global $post;
							$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date' );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

							<?php $terms = get_the_terms( get_the_ID(), 'category' );

              if ( $terms && ! is_wp_error( $terms ) ) :

              	$work_cat_slug = array();

                foreach ( $terms as $term ) {

                    $work_cat_slug[] = $term->slug;
                }

                $work_cats_slugs = join( " ", $work_cat_slug );

                ?>
								<div class="col-md-4 col-sm-6 col-xs-6 filter-listing filter-listing-filter <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>">
						 				<?php if( get_field('post_link_external') ): ?>
											<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail('filter-thumb'); ?></a>
										<?php else: ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('filter-thumb'); ?></a>
										<?php endif; ?>
						 				<div class="filter-search-text">
							 				<h2>
							 					<!-- <a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a> -->
							 					<?php if( get_field('post_link_external') ): ?>
													<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_title(); ?></a>
												<?php else: ?>
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												<?php endif; ?>
							 				</h2>

			                <div class="category-list">
												<ul>
													<?php
														$categories = get_the_category();
														$separator = ' · ';
														$output = '';
														if($categories){
														    foreach($categories as $category) {
														if($category->name !== 'Primary'){
														        $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
														    }

														echo trim($output, $separator);
														}
													?>
												</ul>
											</div>
										</div>

			              <?php endif; ?>
							 	</div>
							<?php endforeach;
							wp_reset_postdata();?>
					</div>
				</div>
			</div>
		</div>

		<div id="search-overlay" class="search-filter-overlay" style="display:none">
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
							$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date' );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

							<?php $terms = get_the_terms( get_the_ID(), 'category' );

              if ( $terms && ! is_wp_error( $terms ) ) :

              	$work_cat_slug = array();

                foreach ( $terms as $term ) {

                    $work_cat_slug[] = $term->slug;
                }

                $work_cats_slugs = join( " ", $work_cat_slug );

                ?>
								<div class="col-md-4 col-sm-6 col-xs-6 filter-listing filter-listing-search <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats_slugs ) ); ?>">
						 				<!-- <a href="<?php //the_permalink(); ?>"><?php //the_post_thumbnail('filter-thumb'); ?><?php //the_field('grid_thumbnail_23_width'); ?></a> -->

										<?php if( get_field('post_link_external') ): ?>
											<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_post_thumbnail('filter-thumb'); ?></a>
										<?php else: ?>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('filter-thumb'); ?></a>
										<?php endif; ?>

						 				<div class="filter-search-text">
							 				<h2>
							 					<!-- <a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a> -->
							 					<?php if( get_field('post_link_external') ): ?>
													<a href="<?php the_field('post_link_external'); ?>" target=_"blank"><?php the_title(); ?></a>
												<?php else: ?>
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												<?php endif; ?>
							 				</h2>

			                <div class="category-list">
												<ul>
													<?php
														$categories = get_the_category();
														$separator = ' · ';
														$output = '';
														if($categories){
														    foreach($categories as $category) {
														if($category->name !== 'Primary'){
														        $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
														    }

														echo trim($output, $separator);
														}
													?>
												</ul>
											</div>
										</div>

			              <?php endif; ?>
							 	</div>
							<?php endforeach;
							wp_reset_postdata();?>

						</div>
					</div>
			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->



<?php
//get_sidebar();
get_footer();
