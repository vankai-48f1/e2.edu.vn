<?php get_header() ?>
<!-- Page Content -->

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>
        <div class="container-large container">
            <div class="about-us-top">
                <div class="heading-page mg-bt-3">
                    <h1 class="mg-bt-1"><?php the_title() ?></h1>
                    <p> <?php echo get_post_meta($post->ID, 'excerpt_about_us', true); ?></p>
                </div>
            </div>
        </div>
        <div class="full-image-about mg-bt-4">
            <?php $about_image_full =  get_field('image_full_about_us'); ?>
            <img src="<?php echo esc_url($about_image_full['url']) ?>" alt="">
        </div>
        <div class="container">
            <div class="about-us-main">
                <?php if (have_rows('content_repeater_about')) : ?>
                    <?php while (have_rows('content_repeater_about')) : the_row();
                                    $title_for = get_sub_field('title_for_us');
                                    $office_for = get_sub_field('office_for_us');
                                    $content_for = get_sub_field('content_for_us');
                                    $image_for = get_sub_field('image_for_us');
                                    ?>
                        <div class="about-us-repeat mg-bt-5">
                            <div class="img-for-us">
                                <img src="<?php echo esc_url($image_for['url']) ?>" alt="">
                            </div>
                            <div class="content-for-us">
                                <div class="heading mg-bt-3 pd-t-2">
                                    <h3><?php echo $title_for ?></h3>
                                    <p><?php echo $office_for ?></p>
                                </div>
                                <div class="about-us-show">
                                    <?php echo $content_for; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>

<?php endif; ?>

<!-- /.container -->
<?php get_footer() ?>