<section class="page-builder running_text">
	<div class="container">
		<div class="row">
			<?php if(get_sub_field('header')):?>
				<div class="col-md-11">
					<h2 class="<?php the_sub_field('header_size');?> h2-space text-black"><?php the_sub_field('header');?></h2>
				</div>
			<?php endif; ?>
			<?php if(get_sub_field('left_content')):?>
        <div class="col-md-7 mb-mobile">
            <?php the_sub_field('left_content');?>
        </div>
			<?php endif; ?>
			<?php if(get_sub_field('right_content')):?>
				<div class="col-md-4 col-md-offset-1">
						<?php the_sub_field('right_content');?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
