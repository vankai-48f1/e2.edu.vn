<article class="post-featured">
    <div class="post-featured-thumb">
        <a href="<?php the_permalink(); ?>" class="eff-scale">
            <?php the_post_thumbnail() ?>
        </a>
    </div>
    <div class="post-featured-content">
        <div class="featured-date mdp-flex">
            <p>&ensp;<i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;</p>
            <?php echo the_category(); ?>
        </div>
        <h3 class="title-type-second">
            <a href="<?php the_permalink(); ?>" class="cl-black eff-cl-green" title="<?php the_title() ?>">
                <?php the_title() ?>
            </a>
        </h3>
    </div>
</article> 