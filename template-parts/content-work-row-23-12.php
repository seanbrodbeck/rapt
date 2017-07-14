<section class="work-row-twothirds-onethird">

  <div class="row clearfix work-row">

      <div class="col-sm-8">

        <?php

          $post_object = get_sub_field('left_work_item_2');

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


     <div class="col-sm-4">     
       	
        <?php

          $post_object = get_sub_field('right_work_item_2');

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
