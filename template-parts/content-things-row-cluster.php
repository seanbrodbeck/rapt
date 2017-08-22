<div class="work-cluster">

  <div class="work-row work-row-twothirds-onethird">

    <div class="container">

      <div class="row clearfix work-row-inner">

          <div class="col-sm-7 grid-item">

            <?php

              $post_object = get_sub_field('things_cluster_top_left');

              if( $post_object ): 

                $post = $post_object;
                setup_postdata( $post ); 

                ?>
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php the_field('grid_thumbnail_23_width'); ?>"/>
                  </a>
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field('work_excerpt'); ?></span></a></h2>
                  
                    <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );
                                       
                      if ( $terms && ! is_wp_error( $terms ) ) : 
                     
                        $work_cat_list = array();
                     
                        foreach ( $terms as $term ) {
                            $work_cat_list[] = $term->name;
                        }
                                             
                        $work_cats = join( " · ", $work_cat_list );
                        ?>
                     
                        <p class="work-cats category-list">
                            <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                        </p>

                      <?php endif; ?>

                  <?php wp_reset_postdata(); ?>

              <?php endif; ?>

       		</div>


         <div class="col-sm-4 col-sm-offset-1 grid-item">     
           	
            <?php

              $post_object = get_sub_field('things_cluster_top_right');

              if( $post_object ): 

                $post = $post_object;
                setup_postdata( $post ); 

                ?>
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php
                       if (is_mobile()) {
                       the_field('grid_thumbnail_23_width');
                       } else {
                       the_field('grid_thumbnail_13_width');
                    } ?>"/>
                  </a>
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field('work_excerpt'); ?></span></a></h2>
                    <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );
                                       
                      if ( $terms && ! is_wp_error( $terms ) ) : 
                     
                        $work_cat_list = array();
                     
                        foreach ( $terms as $term ) {
                            $work_cat_list[] = $term->name;
                        }
                                             
                        $work_cats = join( " · ", $work_cat_list );
                        ?>
                     
                        <p class="work-cats category-list">
                            <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                        </p>

                      <?php endif; ?>
                  <?php wp_reset_postdata(); ?>

              <?php endif; ?>

         </div>

      </div>

    </div>

  </div>

  <div class="work-row work-row-onethird-twothirds">

    <div class="container">

      <div class="row clearfix work-row-inner">

        <div class="col-sm-4 grid-item">

          <?php

            $post_object = get_sub_field('things_cluster_bottom_left');

            if( $post_object ): 

              $post = $post_object;
              setup_postdata( $post ); 

              ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php
                       if (is_mobile()) {
                       the_field('grid_thumbnail_23_width');
                       } else {
                       the_field('grid_thumbnail_13_width');
                    } ?>"/>
                </a>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field('work_excerpt'); ?></span></a></h2>
                  <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );
                                       
                      if ( $terms && ! is_wp_error( $terms ) ) : 
                     
                        $work_cat_list = array();
                     
                        foreach ( $terms as $term ) {
                            $work_cat_list[] = $term->name;
                        }
                                             
                        $work_cats = join( " · ", $work_cat_list );
                        ?>
                     
                        <p class="work-cats category-list">
                            <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                        </p>

                      <?php endif; ?>
                <?php wp_reset_postdata(); ?>

            <?php endif; ?>

        </div>


       <div class="col-sm-7 col-sm-offset-1 grid-item">

          <?php

            $post_object = get_sub_field('things_cluster_bottom_right');

            if( $post_object ): 

              $post = $post_object;
              setup_postdata( $post ); 

              ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('grid_thumbnail_23_width'); ?>"/>
                </a>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span><?php the_field('work_excerpt'); ?></span></a></h2>
                  <?php $terms = get_the_terms( get_the_ID(), 'work_categories' );
                                       
                      if ( $terms && ! is_wp_error( $terms ) ) : 
                     
                        $work_cat_list = array();
                     
                        foreach ( $terms as $term ) {
                            $work_cat_list[] = $term->name;
                        }
                                             
                        $work_cats = join( " · ", $work_cat_list );
                        ?>
                     
                        <p class="work-cats category-list">
                            <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                        </p>

                      <?php endif; ?>
                <?php wp_reset_postdata(); ?>

            <?php endif; ?>

        </div>

     </div>

    </div>

  </div>

</div>

