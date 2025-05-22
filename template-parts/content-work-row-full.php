
        <?php if (get_sub_field('full_width_external_content_toggle') ) : ?>

          <a class="work-row-full-external" href="<?php the_sub_field('external_url'); ?>" target="_blank">
          <div class="work-row work-row-full" style="background:url('<?php the_sub_field('external_image'); ?>') no-repeat center 80%;background-size:cover;"></div>
          <div class="container">
            <div class="row clearfix work-row">
              <div class="col-lg-6 col-md-6 col-sm-7 grid-item">
                <h2><?php the_sub_field('external_title'); ?></h2>
                <p class="work-cats category-list">
                  <?php the_sub_field('external_subtitle'); ?>
                </p>
              </div>
            </div>
          </div>
          </a>


        <?php else : ?>

        <?php

          $post_object = get_sub_field('full_width_work_item');

          if( $post_object ):

            $post = $post_object;
            setup_postdata( $post );

            ?>
            <a href="<?php the_permalink(); ?>"><div class="work-row work-row-full" style="background:url('<?php if (wp_is_mobile()) { the_field('grid_thumbnail_13_width'); } else { the_field('grid_thumbnail_full_width'); } ?><?php //the_post_thumbnail_url('full'); ?>') no-repeat center 80%;background-size:cover;">
              <div class="container">
                <div class="row clearfix">
                  <div class="col-lg-5 col-md-6 col-sm-7">
                    <h2><?php the_title(); ?> <span><?php the_field('work_excerpt'); ?></span></h2>

                    <?php //$terms = get_the_terms( get_the_ID(), 'work_categories' );

                      // if ( $terms && ! is_wp_error( $terms ) ) :
                      //
                      //   $work_cat_list = array();
                      //
                      //   foreach ( $terms as $term ) {
                      //       $work_cat_list[] = $term->name;
                      //   }
                      //
                      //   $work_cats = join( " · ", $work_cat_list );
                        ?>

                        <!-- <p class="work-cats category-list">
                            <?php //printf( esc_html__( '%s', 'textdomain' ), esc_html( $work_cats ) ); ?>
                        </p> -->

                      <?php //endif; ?>

                  </div>
                </div>
              </div>
            </div></a>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>


<?php endif; ?>
