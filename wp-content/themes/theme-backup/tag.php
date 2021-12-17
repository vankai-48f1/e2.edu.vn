<?php get_header() ?>
<!-- Page Content -->
<div class="container">

    <!-- Blog Entries Column -->

    <h1 class="my-2 mb-4 page-header">
        Thẻ:
        <small><?php single_tag_title() ?></small>
    </h1>

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', get_post_format()); ?>

        <?php endwhile; ?>

    <?php endif; ?>

    <!-- Pagination -->

</div>
<!-- /.container -->
<?php get_footer() ?>