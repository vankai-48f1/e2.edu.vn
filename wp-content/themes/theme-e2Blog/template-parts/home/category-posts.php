<?php
// template part category posts of homepage

$cate_obj = $args['cate'];
?>

<div class="cate-pre-item">
    <div class="article-item pd-bt-1 mg-bt-1">
        <div class="cate-heading">
            <h2><?php echo esc_html($cate_obj->name); ?></h2>
            <a href="<?php echo esc_url(get_term_link($cate_obj)); ?>">See all&ensp;
                <span>
                    <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
                        <polygon points="405.606,167.5 384.394,188.713 418.787,223.106 0,223.106 0,253.106 418.787,253.106 384.394,287.5 
	                                405.606,308.713 476.213,238.106 " />
                    </svg>
                </span>
            </a>
        </div>
        <span class="line-bottom mg-bt-3"></span>
        <?php
        $argsStudent_1  = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'cat' => $cate_obj->term_id,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $j = 0;
        $articleStudent_1 = new WP_Query($argsStudent_1);
        if ($articleStudent_1->have_posts()) :
            while ($articleStudent_1->have_posts()) : $articleStudent_1->the_post();
                $j++;

                if (!e2_language_vi()) {
                    if (!e2post_is_vi()) {
                        $count++;

                        if ($count < 4) { ?>
                            <article class="eff-third">
                                <?php if ($count === 1) : ?>
                                    <div class="article-thumb mg-bt-1">
                                        <a href="<?php the_permalink() ?>" class="over-hidden">
                                            <?php the_post_thumbnail() ?>
                                        </a>
                                    </div>
                                    <div class="article-cate mg-bt-1">
                                        <div class="mdp-flex"><i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                    </div>
                                    <h3 class="first-title">
                                        <a href="<?php the_permalink() ?>" class="title-type-four">
                                            <?php the_title() ?>
                                        </a>
                                    </h3>
                                <?php else : ?>
                                    <h3 class="title">
                                        <a href="<?php the_permalink() ?>" class="title-type-four">
                                            <?php the_title() ?>
                                        </a>
                                    </h3>
                                <?php endif; ?>
                            </article>
                        <?php
                        }
                    }
                } else {
                    $count++;
                    if ($count < 4) { ?>
                        <article class="eff-third">
                            <?php if ($count === 1) : ?>
                                <div class="article-thumb mg-bt-1">
                                    <a href="<?php the_permalink() ?>" class="over-hidden">
                                        <?php the_post_thumbnail() ?>
                                    </a>
                                </div>
                                <div class="article-cate mg-bt-1">
                                    <div class="mdp-flex"><i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;<?php echo the_category(); ?></div>
                                </div>
                                <h3 class="first-title">
                                    <a href="<?php the_permalink() ?>" class="title-type-four">
                                        <?php the_title() ?>
                                    </a>
                                </h3>
                            <?php else : ?>
                                <h3 class="title">
                                    <a href="<?php the_permalink() ?>" class="title-type-four">
                                        <?php the_title() ?>
                                    </a>
                                </h3>
                            <?php endif; ?>
                        </article>
                <?php
                    }
                }
                ?>

        <?php endwhile;
        endif;
        // Reset Post Data
        wp_reset_postdata();
        ?>
    </div>
</div>