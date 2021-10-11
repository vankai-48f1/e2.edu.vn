<?php get_header() ?>
<!-- Page Content Podcast -->
<div class="container-lager container">
    <div class="category-page">
        <div class="page-header">
            <h1 class="category-title">
                <?php single_cat_title() ?>
            </h1>
            <?php
            if (category_description()) : ?>
                <div class="category-description">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="category-ctn">
            <?php if (have_posts()) : ?>
                <div class="category-ctn">
                    <div class="podcast-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="podcast-item mg-bt-3 obj-animate">
                                <?php the_content(); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>