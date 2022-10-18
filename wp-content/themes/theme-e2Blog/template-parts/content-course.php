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