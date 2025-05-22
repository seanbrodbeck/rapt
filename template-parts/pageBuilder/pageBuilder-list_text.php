<section class="page-builder services list_text <?php the_sub_field('background_color');?>">
	<div class="container">
			<div class="row">
				<?php if(get_sub_field('intro')):?>
				<div class="col-md-11 mb-5">
					<h2 class="large h2-space"><?php the_sub_field('intro');?></h2>
				</div>
				<?php endif; ?>
				<?php if( have_rows('columns') ): ?>
		    <?php while( have_rows('columns') ): the_row(); ?>
		        <div class="col-xs-6 col-md-4 mb-mobile">
								<h3><?php the_sub_field('header');?></h3>
		            <?php the_sub_field('text');?>
		        </div>
		    <?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
</section>
