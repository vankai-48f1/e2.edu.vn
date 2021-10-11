<?php get_header() ?>
<!-- Page Content -->
<div class="container">
    <?php
    $args = array(
        'post_status' => 'publish', // Chỉ lấy những bài viết được publish
        'post_type' => 'post', // Lấy những bài viết thuộc post, nếu lấy những bài trong 'trang' thì để là page 
        'showposts' => 12, // số lượng bài viết
    );
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) : ?>
        <div class="row">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="col-md-3 mg-bt-2">
                    <h2><?php the_title() ?></h2>
                    <div><?php the_excerpt() ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Reset Post Data
    wp_reset_postdata();

    ?>


    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content-page', get_post_format()); ?>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>