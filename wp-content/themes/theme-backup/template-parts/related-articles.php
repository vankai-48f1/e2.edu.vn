<div class="related">
    <h3 class="mg-bt-1">Top articles</h3>
    <?php
    $cats = wp_get_post_categories(get_the_ID(), array('fields' => 'slugs'));
    $cats_id_related = wp_get_post_categories(get_the_ID(), array('fields' => 'ids'));
    $cats[0];
    $cats_id_related[0];
    $id_current_post = $cats = $post->ID;


    $args_related = array(
        'post_type' => 'post',
        'order' => 'DESC',
        // 'orderby' => 'rand',
        // 'category_name' => $cats[0],
        'post__not_in'  => array($id_current_post),
        // 'cat' => $cats_id_related[0],
        'showposts' => 4
    );
    $query_post_related = new WP_Query($args_related);

    // The Loop
    if ($query_post_related->have_posts()) :
        while ($query_post_related->have_posts()) : $query_post_related->the_post(); ?>
            <div class="related-item">
                <a href="<?php the_permalink() ?>" class="related-thumb">
                    <?php the_post_thumbnail() ?>
                </a>
                <div class="related-name">
                    <a href="<?php the_permalink() ?>" class="title-type-third cl-black">
                        <?php the_title() ?>
                    </a>
                    <div class="related-parent mdp-flex mflex-wrap">
                        <i class="fa fa-circle cl-dark-orange" aria-hidden="true"></i>&ensp;<?php echo the_category() ?>
                    </div>
                </div>

            </div>
    <?php endwhile;
    endif;
    wp_reset_postdata(); ?>
</div>