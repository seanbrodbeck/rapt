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
				$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
				if( $related ) foreach( $related as $post ) {
				setup_postdata($post); ?>

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
					</div>
				</article>

				<?php }
				wp_reset_postdata(); ?>
			
		</div>
	</div>

</div>
