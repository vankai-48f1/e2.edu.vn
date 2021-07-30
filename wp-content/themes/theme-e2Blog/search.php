<?php get_header() ?>
<!-- Page Content -->
<div class="container-large container">
    <div class="search-page category-page">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1 class="my-2 mb-4 page-header">
                    Tìm kiếm:
                    <small><?php the_search_query(); ?></small>
                </h1>
                <?php
                $key         = isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : '';
                $args = array(
                    'showposts'		=> -1,
                    'post_type'        => 'post',
                    's'                => $key,
                );
                $result_search = new WP_Query($args);
                ?>
               <?php if( $result_search->have_posts() ): ?>
                    <div class="article-list">
                    <?php while( $result_search->have_posts() ) : $result_search->the_post(); ?>

                            <?php get_template_part('template-parts/content', get_post_format()); ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="invalid-search">
                        <p class="mg-bt-1">
                            Không có bài viết nào phù hợp với từ khóa: <strong><?php the_search_query(); ?></strong>
                        </p>
                        <form method="GET" action="<?php bloginfo('url'); ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit">Go!</button>
                                </span>
                            </div>
                        </form>
                    </div>

                <?php endif; ?>

                <!-- Pagination -->

            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>