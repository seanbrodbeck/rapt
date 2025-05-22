<section class="page-builder stats bg-gray">
	<div class="container">
			<div class="row">
				<?php if(get_sub_field('header')):?>
				<div class="col-md-4">
					<h2 class="large"><?php the_sub_field('header');?></h2>
				</div>
				<?php endif; ?>
				<?php if( have_rows('columns') ): ?>
		    <?php while( have_rows('columns') ): the_row(); ?>
		        <div class="col-md-4">
								<h2 class="large"><?php the_sub_field('stat');?></h2>
		            <p><?php the_sub_field('text');?></p>
		        </div>
		    <?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
</section>
