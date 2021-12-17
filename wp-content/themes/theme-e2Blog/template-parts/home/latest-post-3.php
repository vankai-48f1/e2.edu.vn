<article class="popular-item">
    <div class="popular-thumb">
        <a href="<?php the_permalink(); ?>" class="eff-scale bd-radius-5">
            <?php the_post_thumbnail() ?>
        </a>
    </div>
    <div class="popular-title">
        <a href="<?php the_permalink(); ?>" class="title-type-third cl-black eff-cl-green">
            <?php the_title() ?>
        </a>
        <div class="date-post mdp-flex">
            <p>&ensp;<i class="fa fa-circle cl-light-orange" aria-hidden="true"></i>&ensp;</p>
            <?php echo the_category(); ?>
        </div>
    </div>
</article>