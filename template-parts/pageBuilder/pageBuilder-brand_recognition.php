<section class="page-builder clients brand_recognition">
	<div class="container">
		<div class="row clearfix">
			<div class="col-sm-11">
				<h2 class="large"><?php the_sub_field('header'); ?></h2>


				<div class="client-logos-row" id="client_logo_row">

							<?php
							$images = get_sub_field('client_logos');
							$size = 'client-logo';
							$count = 0;
							if( $images ): ?>
				        <?php foreach( $images as $image_id ): ?>
				           <div class="col-md-3 col-sm-6 col-xs-6 client-logo <?php //$countLimit = $count++; if ($countLimit < 4) { echo "is-active";}?>">
				                <?php echo wp_get_attachment_image( $image_id, $size ); ?>
				            </div>
				        <?php endforeach; ?>
							<?php endif; ?>
					</div>

			</div>
		</div>
	</div>
</section>
