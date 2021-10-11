<?php get_header() ?>
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
                            <div class="featured-img-current mg-bt-2">
                                <?php the_post_thumbnail() ?>
                            </div>

                            <div class="single-tabs mg-bt-3">
                                <div class="row obj-animate">
                                    <div class="col-lg-3">
                                        <div class="sg-tabs-nav">
                                            <h3>Contents</h3>
                                            <ul>
                                                <?php
                                                $i = 0;
                                                if (have_rows('tabs_single')) :;
                                                    while (have_rows('tabs_single')) : the_row();
                                                        $i++;
                                                        $title_tabs_single = get_sub_field('title_tabs_single');
                                                ?>
                                                        <li class="tabs-name <?php echo $i == 1 ? 'active' : null ?>" data-tab="tabs-<?php echo $i ?>">
                                                            <a href="#tabs-<?php echo $i ?>">
                                                                <?php echo $i . '. ' . $title_tabs_single; ?>
                                                            </a>
                                                        </li>
                                                <?php endwhile;
                                                else :
                                                // no rows found
                                                endif;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="single-content mg-bt-2">
                                            <?php the_content() ?>
                                            <?php  the_field('test_editor') ?>
                                        </div>
                                        <hr>
                                        <div class="sg-tabs-ct">
                                            <?php
                                            $num = 0;

                                            if (have_rows('tabs_single')) :;
                                                while (have_rows('tabs_single')) : the_row();
                                                    $num++;
                                                    $content_tabs_single = get_sub_field('content_tabs_single', false);
                                                    $show_block_course = get_sub_field('show_block_course_after');
                                            ?>
                                                    <div class="tabs-ct <?php echo $num == 1 ? 'active' : null ?>" id="tabs-<?php echo $num ?>">
                                                        <?php echo $content_tabs_single; ?>

                                                        <?php
                                                        if ($show_block_course[0] == 'show') : ?>
                                                            <div class="course obj-animate">
                                                                <div class="title-cource text-center mg-bt-3">
                                                                    <h2><?php echo get_field('course_popup_title', 'option'); ?></h2>
                                                                    <h3><?php echo get_field('course_popup_subtitle', 'option'); ?></h3>
                                                                </div>

                                                                <div class="ctn-course">
                                                                    <div class="list-course">
                                                                        <?php
                                                                        $argsCourse  = array(
                                                                            'post_type' => 'post',
                                                                            'post_status' => 'publish',
                                                                            'cat' => 6,
                                                                            'orderby' => 'date',
                                                                            'order' => 'ASC',
                                                                            'showposts' => 6
                                                                        );
                                                                        $articleCourse = new WP_Query($argsCourse);
                                                                        $i = 0;
                                                                        if ($articleCourse->have_posts()) :
                                                                            while ($articleCourse->have_posts()) : $articleCourse->the_post();
                                                                                $i++;
                                                                                $arr_course = get_field('link_course');
                                                                                if ($arr_course) :
                                                                        ?>
                                                                                    <div class="course-item">
                                                                                        <article class="pd-bt-2">
                                                                                            <div class="course-thumb">
                                                                                                <a href="<?php echo esc_url($arr_course['url']) ?>" target="_blank">
                                                                                                    <?php the_post_thumbnail() ?>
                                                                                                </a>
                                                                                            </div>
                                                                                            <a class="wrap-course-title" href="<?php echo esc_url($arr_course['url']) ?>" target="_blank">
                                                                                                <h3 class="course-title <?php echo 'course-title-' . $i; ?>">
                                                                                                    <span class="cl-white"><?php the_title() ?></span>
                                                                                                </h3>
                                                                                                <div class="fill-bg-title <?php echo 'fill-bg-title-' . $i; ?>"></div>
                                                                                            </a>
                                                                                        </article>
                                                                                    </div>
                                                                        <?php endif;
                                                                            endwhile;
                                                                        endif;
                                                                        // Reset Post Data
                                                                        wp_reset_postdata();
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="link-course text-center">
                                                                    <?php
                                                                    $course_popup_link = get_field('course_popup_link', 'option');
                                                                    ?>
                                                                    <a target="_blank" href="<?php echo esc_url($course_popup_link['url']) ?>"><?php echo esc_html($course_popup_link['title']) ?></a>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>
                                            <?php endwhile;
                                            else :
                                            // no rows found
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="comment-form-block">
                                <?php comments_template() ?>
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
                                        <a target="_blank" href="<?php echo $redirect; ?>">
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

                            <div class="banner-sidebar">
                                <?php
                                $banners_belong_to_bottom  = get_field('banners_belong_to_bottom', 'option');
                                foreach ($banners_belong_to_bottom as $item) :
                                    $banner     = $item['banner']['url'];
                                    $redirect   = $item['redirect'];
                                    $belong_to  = $item['belong_to'];

                                    if ($belong_to == $postCatId || $belong_to == $parentCatPostId) : ?>
                                        <a target="_blank" href="<?php echo $redirect; ?>">
                                            <img src="<?php echo $banner ?>" alt="">
                                        </a>
                                <?php
                                    endif;
                                endforeach;
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php endif; ?>
    </div>

    <div class="container-lager container">
        <div class="related-mb">
            <div class="banner-sidebar">
                <?php
                 $groupIdBelongTo    = [];
                foreach ($banners_belong_to as $item) :
                    $banner     = $item['banner']['url'];
                    $redirect   = $item['redirect'];
                    $belong_to  = $item['belong_to'];
                    array_push($groupIdBelongTo, $belong_to);

                    if ($belong_to == $postCatId || $belong_to == $parentCatPostId) : ?>
                        <a target="_blank" href="<?php echo $redirect; ?>">
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

            <div class="banner-sidebar">
                <?php
                $banners_belong_to_bottom  = get_field('banners_belong_to_bottom', 'option');
                foreach ($banners_belong_to_bottom as $item) :
                    $banner     = $item['banner']['url'];
                    $redirect   = $item['redirect'];
                    $belong_to  = $item['belong_to'];

                    if ($belong_to == $postCatId || $belong_to == $parentCatPostId) : ?>
                        <a target="_blank" href="<?php echo $redirect; ?>">
                            <img src="<?php echo $banner ?>" alt="">
                        </a>
                <?php
                    endif;
                endforeach;
                ?>

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
<script>
    var elementCourse = document.querySelectorAll('.tabs-ct .course');
    var blockCourse = document.querySelector('.tabs-ct');

    elementCourse.forEach(itemCourse => {
        courseCoordinatesX = blockCourse.getBoundingClientRect().left;
        itemCourse.style.left = '-' + courseCoordinatesX + 'px';
    })

    window.addEventListener('resize', function() {
        setTimeout(function() {
            elementCourse.forEach(itemCourse => {
                courseCoordinatesX = blockCourse.getBoundingClientRect().left;
                itemCourse.style.left = '-' + courseCoordinatesX + 'px';
            })
        }, 100)
    })
</script>

