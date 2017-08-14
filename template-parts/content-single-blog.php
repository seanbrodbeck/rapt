<?php
/**
 * Template part for displaying blog posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

?>

<div class="row single-wrapper clearfix">

	<div class="col-md-7 single-content">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_post_thumbnail('full'); ?>
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
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<h2><?php the_field('intro_paragraph_text'); ?></h2>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rapt' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rapt' ),
						'after'  => '</div>',
					) );
				?>
			</div>

		</article>

 
		 <?php 
		 	$next_post = get_adjacent_post( true, '', false); 
		 	$nextthumbnail = get_the_post_thumbnail($next_post->ID);
		 ?>
		 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 <?php if ( is_a( $next_post, 'WP_Post' ) ) {  ?>
			 <?php next_post_link($nextthumbnail); ?>
			 <header class="entry-header">
			 	<div class="category-list">
					<div class="category-list">
					<ul>
						<?php
							$categories = get_the_category($next_post->ID);
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
			 	<h1 class="entry-title"><?php echo get_the_title( $next_post->ID ); ?></h1>
		 	</header>

		 	<h2><?php echo get_field('intro_paragraph_text', $next_post->ID); ?></h2>
		 	<?php echo $next_post->post_content; ?>
			 <?php } ?>
		</article> 


	</div>

	<div class="col-md-3 col-md-offset-2 single-sidebar">
		<div class="post-social clearfix">
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-twitter.svg" width="38" heith="auto"/></a>
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-fb.svg" width="38" heith="auto"/></a>
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-in.svg" width="38" heith="auto"/></a>
		</div>
		<div class="single-related-posts">


			<?php
				//for use in the loop, list 5 post titles related to first tag on current post
				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
				echo '';
				$first_tag = $tags[0]->term_id;
				$args=array(
				'tag__in' => array($first_tag),
				'post__not_in' => array($post->ID),
				'posts_per_page'=>3,
				'caller_get_posts'=>1
				);
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post(); ?>

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

				<?php
				endwhile;
				}
				wp_reset_query();
				}
				?>
		</div>
	</div>

</div>
