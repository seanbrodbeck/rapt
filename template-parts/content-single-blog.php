<?php
/**
 * Template part for displaying blog posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

?>

<div class="row clearfix">

	<div class="col-sm-7">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_post_thumbnail('full'); ?>
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
			</div><!-- .entry-content -->

		
		</article><!-- #post-<?php the_ID(); ?> -->

	</div>

	<div class="col-sm-3 col-sm-offset-2">
		<div class="post-social">
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-twitter.svg" width="38" heith="auto"/></a>
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-fb.svg" width="38" heith="auto"/></a>
			<a href="#"><img src="/wp-content/themes/rapt/dist/images/icon-in.svg" width="38" heith="auto"/></a>
		</div>
		<div style="clear:both;">Get the other posts here...</div>
	</div>

</div>
