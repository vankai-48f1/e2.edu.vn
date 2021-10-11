<?php get_header() ?>
<!-- Page Content -->
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

        <div class="category-list">
            <?php if (have_posts()) : ?>
                <div class="category-ctn">
                    <div class="article-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="article-item pd-bt-1 mg-bt-3 eff-fourth obj-animate">
                                <article>
                                    <div class="article-thumb mg-bt-1">
                                        <a href="<?php the_permalink() ?>" class="">
                                            <?php the_post_thumbnail() ?>
                                        </a>
                                    </div>
                                    <div class="article-cate mg-bt-1">
                                        <div class="mdp-flex">
                                            <p>&ensp;<i class="fa fa-circle cl-green" aria-hidden="true"></i> <?php echo get_the_date('F j, Y') ?></p>
                                            <?php echo the_category(); ?>
                                        </div>
                                    </div>
                                    <h3>
                                        <a href="<?php the_permalink() ?>" class="title-type-four">
                                            <?php the_title() ?>
                                        </a>
                                    </h3>
                                    <div class="description">
                                        <?php the_excerpt() ?>
                                    </div>
                                    <div class="btn-read-more">
                                        <a href="<?php the_permalink() ?>" class="post-link eff-primary">
                                            read more
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (paginate_links() != '') { ?>
            <div class="pagination-post">
                <?php
                global $wp_query;
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'prev_text'    => __('🠔 Trang trước'),
                    'next_text'    => __('Trang tiếp theo 🠖'),
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages
                ));
                ?>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>