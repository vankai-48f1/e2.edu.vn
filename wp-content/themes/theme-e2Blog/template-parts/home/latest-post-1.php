<article class="top-post-item">
    <div class="top-post-thumb">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail() ?>
        </a>
    </div>
    <div class="top-content">
        <div class="top-date">
            <div class="mdp-flex">
                <p>&ensp;<i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;</p>
                <?php echo the_category(); ?>
            </div>
        </div>

        <h2 class="title-type-one">
            <a href="<?php the_permalink(); ?>" class="cl-black eff-cl-green" title="<?php the_title() ?>">
                <?php the_title() ?>
            </a>
        </h2>
        <div class="description">
            <?php the_excerpt();  ?>
        </div>
    </div>
</article>