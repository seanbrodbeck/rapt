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
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
	<div class="entry-text">
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
	</div>
</article>