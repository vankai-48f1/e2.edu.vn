<?php
/*
Template Name: Home
*/
?>
<?php get_header() ?>
<!-- Page Content -->
<div class="main">
    <section>
        <div class="container-large container mg-bt-3">
            <div class="row">
                <div class="col-xl-5 col-md-8">
                    <div class="top-section">
                        <div class="slider-primary">
                            <?php
                            $latestPost = array(
                                'post_status' => 'publish',
                                'post_type' => 'post',
                                // 'showposts' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => -1, 
                                // 'category__not_in' => array( 21),
                            );
                            $topLatestPost = new WP_Query($latestPost);

                            if ($topLatestPost->have_posts()) : $count = 0;
                                while ($topLatestPost->have_posts()) : $topLatestPost->the_post();
                                    if (!e2_language_vi()) {
                                        if (!e2post_is_vi()) {
                                            $count++;
                                            if ($count === 1) {
                                                get_template_part('template-parts/home/latest', 'post-1');
                                                break;
                                            }
                                        }
                                    } else {
                                        $count++;
                                        if ($count === 1) {
                                            get_template_part('template-parts/home/latest', 'post-1');
                                            break;
                                        }
                                    }

                                endwhile;
                            endif;
                            // Reset Post Data
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <?php
                    $featured = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => -1, 
                        // 'category__not_in' => array( 21),
                    );
                    $featuredPost = new WP_Query($featured);
                    if ($featuredPost->have_posts()) : $count = 0;
                        while ($featuredPost->have_posts()) : $featuredPost->the_post();
                            if (!e2_language_vi()) {
                                if (!e2post_is_vi()) {
                                    $count++;

                                    if ($count > 1 && $count < 4) {
                                        get_template_part('template-parts/home/latest', 'post-2');
                                    }
                                }
                            } else {
                                $count++;
                                if ($count > 1 && $count < 4) {
                                    get_template_part('template-parts/home/latest', 'post-2');
                                }
                            }
                        endwhile;
                    endif;
                    // Reset Post Data
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="post-popular">
                        <h2 class="title-type-one mg-bt-2">Popular this month</h2>
                        <div class="post-list">
                            <?php
                            $popular = array(
                                'post_status' => 'publish',
                                'post_type' => 'post',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => -1,  
                            );
                            $popularPost = new WP_Query($popular);
                            if ($popularPost->have_posts()) : $count = 0;
                                while ($popularPost->have_posts()) : $popularPost->the_post();
                                    if (!e2_language_vi()) {
                                        if (!e2post_is_vi()) {
                                            $count++;

                                            if ($count > 3 && $count < 8) {
                                                get_template_part('template-parts/home/latest', 'post-3');
                                            }
                                        }
                                    } else {
                                        $count++;
                                        if ($count > 3 && $count < 8) {
                                            get_template_part('template-parts/home/latest', 'post-3');
                                        }
                                    }
                                endwhile;
                            endif;
                            // Reset Post Data
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="obj-animate" style="display: none">
        <div class="for-section container-large container bg-beige">
            <div class="wrap-section pd-bt-3">
                <h3 class="cl-green mb-4 title-type-fifth"><i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;&nbsp;For parents</h3>
                <div class="">
                    <div class="row">
                        <div class="col-lg-7 col-sm-12 col-12">
                            <div class="image-for pd-r-4 mdp-flex malign-center h-100">
                                <div class="wrap-img-for">
                                    <?php $image_for_parent = get_field('image_for_parent'); ?>
                                    <img src="<?php echo esc_url($image_for_parent['url']); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12 col-12">
                            <div class="for-section-ct mg-t-1">
                                <div class="title-for">
                                    <h2 class="title-type-one cl-black mb-2">
                                        <?php echo get_post_meta($post->ID, 'title_for_parent', true); ?>
                                    </h2>
                                </div>
                                <div class="description-for text-type-one">
                                    <?php the_field('description_for_parent') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vector">
                <svg viewbox="0 0 500 500">

                    <path d="M0, 20 C250, -37 250, 60 500, 0 L500, 00 L0, 0 Z" style="stroke:none;">
                    </path>
                </svg>
            </div>
        </div>

        <div class="for-section-list">
            <div class="container-large container">
                <div class="wrap-section">
                    <div class="article-list">
                        <?php
                        $argsParent  = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'cat' => 4,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'showposts' => 3
                        );
                        $articleParent = new WP_Query($argsParent);
                        if ($articleParent->have_posts()) :
                            while ($articleParent->have_posts()) : $articleParent->the_post(); ?>
                                <div class="article-item pd-bt-1 mg-bt-1 eff-third">
                                    <article>
                                        <div class="article-thumb mg-bt-1">
                                            <a href="<?php the_permalink() ?>" class="over-hidden">
                                                <?php the_post_thumbnail() ?>
                                            </a>
                                        </div>
                                        <div class="article-cate mg-bt-1">
                                            <div class="mdp-flex"><i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                        </div>
                                        <h3>
                                            <a href="<?php the_permalink() ?>" class="title-type-four">
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
            </div>
        </div>
    </section>

    <section class="obj-animate">
        <div class="course">
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
                            $i++; ?>
                            <div class="course-item">
                                <article class="pd-bt-2">
                                    <?php
                                    $arr_course = get_field('link_course');
                                    if ($arr_course) :
                                    ?>
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
                                    <?php endif; ?>
                                </article>
                            </div>
                    <?php endwhile;
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
    </section>


    <section>
        <div class="container-large container">
            <div class="category-pre mg-t-4">

                <?php
                $cat_group_1 = get_field('category_group_1');
                $cat_group_2 = get_field('category_group_2');
                $cat_group_3 = get_field('category_group_3');

                // column 1
                if ($cat_group_1) :

                    $cate_data_tempt = array(
                        'cate'  => $cat_group_1
                    );
                    get_template_part('template-parts/home/category', 'posts', $cate_data_tempt);
                endif;

                // column 2
                if ($cat_group_2) :
                    $cate_data_tempt = array(
                        'cate'  => $cat_group_2
                    );
                    get_template_part('template-parts/home/category', 'posts', $cate_data_tempt);
                endif;

                // column 3
                if ($cat_group_3) :
                    $cate_data_tempt = array(
                        'cate'  => $cat_group_3
                    );
                    get_template_part('template-parts/home/category', 'posts', $cate_data_tempt);
                endif;

                // column double

                $cat_group_4 = get_field('category_group_4');
                if ($cat_group_4) : ?>
                    <div class="cate-pre-item double-width">
                        <div class="article-item pd-bt-1 mg-bt-1">
                            <div class="cate-heading">
                                <h2><?php echo esc_html($cat_group_4->name); ?></h2>
                                <a href="<?php echo esc_url(get_term_link($cat_group_4)); ?>" class="cl-green">See all&ensp;
                                    <span>
                                        <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
                                            <polygon points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 
	                                    405.606,308.713 476.213,238.106 " />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <span class="line-bottom mg-bt-3"></span>
                            <div class="download-ebook">
                                <?php
                                $argsStudent_4  = array(
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'cat' => $cat_group_4->term_id,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                );

                                $articleStudent_4 = new WP_Query($argsStudent_4);
                                if ($articleStudent_4->have_posts()) : $count = 0;
                                    while ($articleStudent_4->have_posts()) : $articleStudent_4->the_post();
                                        if (!e2_language_vi()) {
                                            if (!e2post_is_vi()) {
                                                $count++;

                                                if ($count < 3) { ?>
                                                    <div class="ebook-item eff-third">
                                                        <a href="<?php the_permalink() ?>">
                                                            <h3 class="title">
                                                                <?php the_title() ?>
                                                            </h3>
                                                            <div class="ebook-wrap-thumb over-hidden bd-radius-5">
                                                                <?php the_post_thumbnail() ?>
                                                            </div>
                                                            <div class="ebook-excerpt mg-t-2"><?php the_excerpt() ?></div>
                                                        </a>
                                                    </div>
                                                <?php }
                                            }
                                        } else {
                                            $count++;
                                            if ($count < 3) { ?>
                                                <div class="ebook-item eff-third">
                                                    <a href="<?php the_permalink() ?>">
                                                        <h3 class="title">
                                                            <?php the_title() ?>
                                                        </h3>
                                                        <div class="ebook-wrap-thumb over-hidden bd-radius-5">
                                                            <?php the_post_thumbnail() ?>
                                                        </div>
                                                        <div class="ebook-excerpt mg-t-2"><?php the_excerpt() ?></div>
                                                    </a>
                                                </div>
                                        <?php }
                                        }
                                        ?>

                                <?php endwhile;
                                endif;
                                // Reset Post Data
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif;

                $cat_group_5 = get_field('category_group_5');

                if ($cat_group_5) :
                    $cate_data_tempt = array(
                        'cate'  => $cat_group_5
                    );
                    get_template_part('template-parts/home/category', 'posts', $cate_data_tempt);
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="obj-animate" style="display: none">
        <div class="for-section for-section-second container-large container bg-beige">
            <div class="wrap-section pd-bt-3">
                <h3 class="cl-green mb-4 title-type-fifth"><i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;&nbsp;For student</h3>
                <div class="">
                    <div class="row">
                        <div class="col-lg-5 col-sm-12 col-12">
                            <div class="for-section-ct mg-t-1">
                                <div class="title-for">
                                    <h2 class="title-type-one cl-black mb-2">
                                        <?php echo get_post_meta($post->ID, 'title_for_student', true); ?>
                                    </h2>
                                </div>
                                <div class="description-for text-type-one">
                                    <?php the_field('description_for_student') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-12 col-12">
                            <div class="image-for pd-l-4 mdp-flex malign-center h-100">
                                <div class="wrap-img-for">
                                    <?php $image_for_student = get_field('image_for_student'); ?>
                                    <img src="<?php echo esc_url($image_for_student['url']); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vector">
                <svg viewbox="0 0 500 500">

                    <path d="M0, 20 C250, -37 250, 60 500, 0 L500, 00 L0, 0 Z" style="stroke:none;">
                    </path>
                </svg>
            </div>
        </div>

        <div class="for-section-list">
            <div class="container-large container">
                <div class="wrap-section">
                    <div class="article-list">
                        <?php
                        $argsStudent  = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'cat' => 5,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'showposts' => 3
                        );
                        $articleStudent = new WP_Query($argsStudent);
                        if ($articleStudent->have_posts()) :
                            while ($articleStudent->have_posts()) : $articleStudent->the_post(); ?>
                                <div class="article-item pd-bt-1 mg-bt-1 eff-third">
                                    <article>
                                        <div class="article-thumb mg-bt-1">
                                            <a href="<?php the_permalink() ?>" class="over-hidden">
                                                <?php the_post_thumbnail() ?>
                                            </a>
                                        </div>
                                        <div class="article-cate mg-bt-1">
                                            <div class="mdp-flex"><i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                        </div>
                                        <h3>
                                            <a href="<?php the_permalink() ?>" class="title-type-four">
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
            </div>
        </div>
    </section>

    <section>
        <div class="container-large container">
            <div class="podcast-content mg-t-4">
                <div class="heading-podcast">
                    <h3 class="title-type-one"><?php echo the_field('podcasts_title') ?></h3>
                    <a href="<?php echo get_category_link(21) ?>" class="pd-l-3">See all&ensp;
                        <span>
                            <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
                                <polygon points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 
	                                405.606,308.713 476.213,238.106 " />
                            </svg>
                        </span>
                    </a>
                    <span class="line-bottom mg-bt-2"></span>
                </div>
                <div class="podcast-main">
                    <?php
                    $argsPodcast = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'cat' => 21,
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'showposts' => 1
                    );
                    $podcast = new WP_Query($argsPodcast);
                    if ($podcast->have_posts()) :
                        while ($podcast->have_posts()) : $podcast->the_post(); ?>
                            <?php the_content(); ?>
                    <?php endwhile;
                    endif;
                    // Reset Post Data
                    wp_reset_postdata();
                    ?>
                </div>
                <!-- < ?php echo the_field('podcasts_url') ?> -->
            </div>
        </div>
    </section>

    <section class="video obj-animate">
        <div class="container-large container">
            <div class="video-ctn">
                <div class="video-wrap">
                    <div class="video-title">
                        <h3>Video</h3>
                        <span class="line-bottom mg-bt-3"></span>
                        <?php
                        $link_all_video = get_field('link_all_video');
                        if ($link_all_video) :
                            $url_link_all = $link_all_video['url'];
                            $name_link_all = $link_all_video['title'];
                        ?>
                            <a href="<?php echo esc_url($url_link_all) ?>">
                                <?php echo esc_html($name_link_all) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="video-for col-lg-8 col-sm-12">
                            <div class="item-single-video">
                                <div class="video-main">
                                    <iframe src="" id="show-video" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                                </div>
                                <h3 class="single-video-title" style="display: none"></h3>
                                <p class="item-single-date" style="display: none"></p>
                            </div>
                        </div>
                        <div class="video-nav col-lg-4 col-sm-12">
                            <div class="tab-total mdp-flex mjustify-between">
                                <p>Explore our playlists &ensp;&darr;</p>
                                <p class="number" style="display: none"><span class="num-current"></span>/<span class="num-total"></span></p>
                            </div>
                            <div class="wrap-list-vd">
                                <div class="list-video">
                                    <?php
                                    $argsVideo  = array(
                                        'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'cat' => 8,
                                        'orderby' => 'id',
                                        'order' => 'DESC',
                                        'showposts' => -1
                                    );
                                    $video = new WP_Query($argsVideo);
                                    if ($video->have_posts()) : $number = 0;
                                        while ($video->have_posts()) : $video->the_post();
                                            if (!e2_language_vi()) {
                                                if (!e2post_is_vi()) {
                                                    $number++;
                                    ?>
                                                    <div class="item-video" data-img="<?php the_field('id_youtube', $post->ID); ?>" data-number="<?php echo $number; ?>">
                                                        <div class="number-order">
                                                            <?php echo $number; ?>
                                                        </div>
                                                        <div class="video-main">
                                                            <div class="video-thumb">
                                                                <?php
                                                                if (has_post_thumbnail()) {
                                                                    the_post_thumbnail();
                                                                } else { ?>
                                                                    <img src="https://img.youtube.com/vi/<?php the_field('id_youtube', $post->ID); ?>/0.jpg" alt="">
                                                                <?php } ?>
                                                            </div>
                                                            <div class="video-content">
                                                                <h3 class="cl-white"><?php the_title() ?></h3>
                                                                <p class="cl-white">
                                                                    <!-- <span class="video-meta-view">< ?php echo get_post_meta(get_the_ID(), 'post_views_count', true) . ' views'; ?></span> -->
                                                                    <span class="video-meta-date"><?php echo get_the_date('F j') ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                $number++;
                                                ?>
                                                <div class="item-video" data-img="<?php the_field('id_youtube', $post->ID); ?>" data-number="<?php echo $number; ?>">
                                                    <div class="number-order">
                                                        <?php echo $number; ?>
                                                    </div>
                                                    <div class="video-main">
                                                        <div class="video-thumb">
                                                            <?php
                                                            if (has_post_thumbnail()) {
                                                                the_post_thumbnail();
                                                            } else { ?>
                                                                <img src="https://img.youtube.com/vi/<?php the_field('id_youtube', $post->ID); ?>/0.jpg" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="video-content">
                                                            <h3 class="cl-white"><?php the_title() ?></h3>
                                                            <p class="cl-white">
                                                                <!-- <span class="video-meta-view">< ?php echo get_post_meta(get_the_ID(), 'post_views_count', true) . ' views'; ?></span> -->
                                                                <span class="video-meta-date"><?php echo get_the_date('F j') ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>

                                    <?php endwhile;
                                    endif;
                                    // Reset Post Data
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stories">
                    <?php
                    $cate_stories = $category = get_term_by('id', 19, 'category');
                    if ($cate_stories) :
                        $cate_data_tempt = array(
                            'cate'  => $cate_stories
                        );
                        get_template_part('template-parts/home/category', 'posts', $cate_data_tempt);
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- section is hidden -->
    <section class="obj-animate" style="display: none">
        <div class="container-large container">
            <div class="wrap-section">
                <?php dynamic_sidebar('signup'); ?>
            </div>
        </div>

        <div class="our-active">
            <div class="container-large container">
                <div class="wrap-section">
                    <h2 class="title-type-one cl-black text-center mg-bt-3">Our Activities</h2>
                    <div class="article-list">
                        <?php
                        $argsStudent  = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'cat' => 5,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'showposts' => 3
                        );
                        $articleStudent = new WP_Query($argsStudent);
                        if ($articleStudent->have_posts()) :
                            while ($articleStudent->have_posts()) : $articleStudent->the_post(); ?>
                                <div class="article-item pd-bt-1 mg-bt-1 eff-third">
                                    <article>
                                        <div class="article-thumb mg-bt-1">
                                            <a href="<?php the_permalink() ?>" class="over-hidden">
                                                <?php the_post_thumbnail() ?>
                                            </a>
                                        </div>
                                        <div class="article-cate mg-bt-1">
                                            <div class="mdp-flex"><i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                        </div>
                                        <h3>
                                            <a href="<?php the_permalink() ?>" class="title-type-four">
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
            </div>
        </div>
    </section>
</div>
<!-- / container -->
<?php get_footer() ?>