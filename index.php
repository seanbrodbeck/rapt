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

	<div id="primary" class="content-area">
		<main id="main" class="site-main clearfix">

			<div class="container">

				<div class="filters row clearfix">
					<div class="col-sm-12">
						<span class="filter-toggle">Filter</span>
						<img class="filter-search-btn" src="/wp-content/themes/rapt/dist/images/search.svg" width="32" height="auto"/>
					</div>
				</div>

				<div class="row article-feed clearfix">

					<div class="primary-articles col-sm-7">
						<?php

							global $post;
							$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
									<header class="entry-header">
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
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									</header>
									<div class="entry-content">
										<?php the_excerpt(); ?>
									</div>
								</article>
							<?php endforeach; 
							wp_reset_postdata();?>
				</div>

				<div class="secondary-articles col-sm-3 col-sm-offset-2">
					<?php

							global $post;
							$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 4 );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
									<header class="entry-header">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="category-list">
											<ul>
												<?php
													$categories = get_the_category();
													$separator = ' · ';
													$output = '';
													if($categories){
													    foreach($categories as $category) {
													if($category->name !== 'Secondary'){
													        $output .= '<li>'.$category->cat_name.'</li>'.$separator;}
													    }
													echo trim($output, $separator);
													}
												?>
											</ul>
										</div>
									</header>
								</article>
							<?php endforeach; 
							wp_reset_postdata();?>
				</div>

			</div>

		</div>

		<div id="filter-overlay" class="search-filter-overlay" style="display:none">
			<div class="container">
				<img class="close-filter-overlay" src="/wp-content/themes/rapt/dist/images/close.svg" width="32" height="auto"/>
				<div class="col-sm-10">
					<div class="filter-options">

						<?php

						$taxonomy = 'category';
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
							$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date' );

							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

							<?php $terms = get_the_terms( get_the_ID(), 'category' );
			                                     
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
//get_sidebar();
get_footer();
