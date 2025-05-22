<section class="team">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-6">
				<h1><?php the_sub_field('header'); ?></h1>
				<a class="show-everyone" href="#"><img style="display:inline-block;width:20px!important;margin-right:8px;height:auto!important;position:relative;top:-4px;" src="/wp-content/themes/rapt/dist/images/show-more.svg"/> <span>Just show me everyone.</span></a>
			</div>
		</div>
		<div class="row team-sort clearfix">
			<div class="col-md-12 team-members">
					<!-- <div class="col-sm-4"></div> -->

					<?php if( have_rows('team_member_groups') ): ?>

						<?php while( have_rows('team_member_groups') ): the_row(); ?>

							<?php if( have_rows('team_members') ): ?>

								<?php while( have_rows('team_members') ): the_row(); ?>

									<div class="col-xs-4 team-member">
										<div class="inner">

											<?php
												$image = get_sub_field('team_member_image');
												$size = 'team'; 
												if( $image ) {
												    echo wp_get_attachment_image( $image, $size, array ('class' => 'team-member-video' ));
												}?>

											 <?php
													 // if (wp_is_mobile()) {
															// echo "<img class='team-member-video' width='100%' height='auto' src='";
															// the_sub_field('team_member_image');
															// echo "'/>";
													 // } else {
															// echo "<video width='100%' height='auto' autoplay loop>";
															// echo " <source src='";
															// the_sub_field('team_member_video');
															// echo "' type='video/mp4'";
															// echo "'>";
															// echo "</video>";
												// } ?>

											<div class="team-member-info">
												<h3><?php the_sub_field('team_member_name'); ?></h3>
												<p><?php the_sub_field('team_member_title'); ?></p>
											</div>
										</div>
									</div>

								<?php endwhile; ?>

							<?php endif; ?>

						<?php endwhile; ?>

					<?php endif; ?>

			</div>
		</div>
	</div>
</section>
