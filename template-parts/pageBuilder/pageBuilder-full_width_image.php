<section class="page-builder full_width_image">
	<?php
	$link = get_sub_field('link');
	if( $link ):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_attr( $link_title ); ?>">
<?php endif; ?>
	<?php
			$image = get_sub_field('image');
			$size = 'full-width-section';
			if( $image ) {
					echo wp_get_attachment_image( $image, $size );
			}
		?>
		<?php if($link):?></a><?php endif; ?>
</section>
