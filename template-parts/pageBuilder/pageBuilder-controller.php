<?php if( have_rows('rapt_page_builder') ): ?>
	<?php while( have_rows('rapt_page_builder') ): the_row(); ?>

			<?php if( get_row_layout() == 'full_width_image' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'full_width_image'); ?>

			<?php elseif( get_row_layout() == 'list_text' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'list_text'); ?>

			<?php elseif( get_row_layout() == 'running_text' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'running_text'); ?>

			<?php elseif( get_row_layout() == 'brand_recognition' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'brand_recognition'); ?>

			<?php elseif( get_row_layout() == 'stats' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'stats'); ?>

				<?php elseif( get_row_layout() == 'press' ): ?>
				<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'press'); ?>

			<?php elseif( get_row_layout() == 'team' ): ?>
			<?php get_template_part('template-parts/pageBuilder/pageBuilder', 'team'); ?>



			<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>
