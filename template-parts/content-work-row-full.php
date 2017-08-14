<?php

  $post_object = get_sub_field('full_width_work_item');

  if( $post_object ): 

    $post = $post_object;
    setup_postdata( $post ); 

    ?>
    <div class="work-row work-row-full" style="background:url('<?php if (is_mobile()) { the_field('grid_thumbnail_13_width'); } else { the_field('grid_thumbnail_full_width'); } ?><?php //the_post_thumbnail_url('full'); ?>') no-repeat center;background-size:cover;">
      <div class="container">
        <div class="row clearfix">
          <div class="col-lg-5 col-md-6 col-sm-7">
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

          </div>
        </div>
      </div>
    </div>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>