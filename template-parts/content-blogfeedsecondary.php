<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rapt
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( get_field('post_link_external') ): ?>
		<a href="<?php the_field('post_link_external'); ?>"><?php the_post_thumbnail("full"); ?></a>
	<?php else: ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
	<?php endif; ?>
		<div class="entry-text">
			<header class="entry-header">
				<?php if( get_field('post_link_external') ): ?>
				<h3><a href="<?php the_field('post_link_external'); ?>"><span><?php the_field('perspectives_source'); ?></span> <?php the_title(); ?></a></h2>
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
