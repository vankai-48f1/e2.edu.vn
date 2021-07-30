<?php
/*
 *Template Name: Video
 * Template Post Type: post
 */
get_header() ?>
<!-- Page Content -->
<div class="single">

    <div class="container-large container">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <div class="single-main">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="sg-heading mg-bt-3">
                                <div class="mdp-flex mg-bt-1"><i class="fa fa-circle cl-dark-orange " aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                <h1 class="title-post"><?php the_title() ?></h1>
                            </div>
                            <div class="single-video-iframe mg-bt-2">
                                <iframe src="https://www.youtube.com/embed/<?php the_field('id_youtube'); ?>" id="show-video" frameborder="0" allowfullscreen allow="autoplay" width="100%" height="100%"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">

                            <div class="banner-sidebar">
                                <?php
                                global $post;
                                $postcat            = get_the_category($post->ID);
                                $postCatId          = $postcat[0]->term_id; // get category current post
                                $parentCatPostId    = $postcat[0]->parent; // get parrent category current post
                                $banner_default     = get_field('banner_default', 'option'); // run if $postCatId and $parentCatPostId not belong to 
                                $banners_belong_to  = get_field('banners_belong_to', 'option');
                                $groupIdBelongTo    = [];

                                foreach ($banners_belong_to as $item) :
                                    $banner     = $item['banner']['url'];
                                    $redirect   = $item['redirect'];
                                    $belong_to  = $item['belong_to'];
                                    array_push($groupIdBelongTo, $belong_to);

                                    if ($belong_to == $postCatId || $belong_to == $parentCatPostId) : ?>
                                        <a href="<?php echo $redirect; ?>">
                                            <img src="<?php echo $banner ?>" alt="">
                                        </a>
                                <?php
                                    endif;
                                endforeach;

                                if (!in_array($postCatId, $groupIdBelongTo) && !in_array($parentCatPostId, $groupIdBelongTo)) :
                                    echo '<img src="' . $banner_default['url'] . '" alt=""/>';
                                endif;
                                ?>

                            </div>
                            
                            <div class="related">
                                <h3 class="mg-bt-1">Top article</h3>
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
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php endif; ?>
    </div>



    <div class="container-lager container">
        <div class="related-mb">

            <div class="related">
                <h3 class="mg-bt-1">Top article</h3>
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
        </div>
    </div>

    <div class="interested obj-animate">
        <div class="container-large container">
            <h3 class="title-interested title-post mg-bt-2">Your might find interested</h3>
            <div class="for-section-list">
                <div class="wrap-section">
                    <div class="article-list">
                        <?php
                        $argsParent  = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'orderby' => 'rand',
                            'order' => 'DESC',
                            'showposts' => 3,
                            'post__not_in'  => array($id_current_post),
                        );
                        $articleParent = new WP_Query($argsParent);
                        if ($articleParent->have_posts()) :
                            while ($articleParent->have_posts()) : $articleParent->the_post(); ?>
                                <div class="article-item pd-bt-1 mg-bt-1">
                                    <article>
                                        <div class="article-thumb mg-bt-1">
                                            <a href="<?php the_permalink() ?>" class="eff-scale">
                                                <?php the_post_thumbnail() ?>
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail();
                                                } else { ?>
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/error-image.png" alt="error-image">
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="article-cate mg-bt-1">
                                            <div class="mdp-flex"><i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                        </div>
                                        <h3>
                                            <a href="<?php the_permalink() ?>" class="title-type-third eff-cl-green">
                                                <?php the_title() ?>
                                            </a>
                                        </h3>
                                    </article>
                                </div>
                        <?php endwhile;
                        endif;
                        // Reset Post Data
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <!-- < ?php dynamic_sidebar('signup') ?> -->
            </div>
        </div>
    </div>

</div>
<!-- /.container -->
<?php get_footer() ?>