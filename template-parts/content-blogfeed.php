<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

?>


	<div class="primary-articles col-sm-7">
			<?php

				global $post;
				$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'date', 'category' => 3 );

				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_post_thumbnail("full"); ?>
						<div class="entry-text">
							<header class="entry-header">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</header>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
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
						<?php the_post_thumbnail("full"); ?>
						<header class="entry-header">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</header>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</article>
				<?php endforeach; 
				wp_reset_postdata();?>
	</div>



