<div class="article-item pd-bt-1 mg-bt-3 eff-fourth obj-animate">
    <article>
        <div class="article-thumb mg-bt-1">
            <a href="<?php the_permalink() ?>" class="">
                <?php the_post_thumbnail() ?>
            </a>
        </div>
        <div class="article-cate mg-bt-1">
            <div class="mdp-flex">
                <p>&ensp;<i class="fa fa-circle cl-green" aria-hidden="true"></i>&ensp;<?php echo get_the_date('F j, Y') ?>&nbsp;|&nbsp;</p>
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