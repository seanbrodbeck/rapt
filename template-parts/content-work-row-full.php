<section class="work-row-full">

    <div class="row">

      <div class="col-sm-12">

      <?php

        $post_object = get_sub_field('full_width_work_item');

        if( $post_object ): 

          $post = $post_object;
          setup_postdata( $post ); 

          ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php the_excerpt(); ?> </a></h2>
              Get the Work Category List Here
            <?php wp_reset_postdata(); ?>

      <?php endif; ?>

    </div>

 	</div>

</section>
