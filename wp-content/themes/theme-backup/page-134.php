<?php get_header() ?>
<!-- Page Content -->
<div class="container-large container">
    <div class="contact-us">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <div class="heading-page mg-bt-3">
                    <h1 class="mg-bt-1"><?php the_title() ?></h1>
                    <p> <?php echo get_post_meta($post->ID, 'excerpt_contact_us', true); ?></p>
                </div>
                <div class="contact-ctn">
                    <div class="row">
                        <?php
                                $phone = get_theme_mod('Phone');
                                $email = get_theme_mod('Email');

                                $link_fb = get_theme_mod('Link_fb');
                                $link_yt = get_theme_mod('Link_yt');

                                $address_1 = get_theme_mod('Address_1');
                                $address_2 = get_theme_mod('Address_2');
                                $address_3 = get_theme_mod('Address_3');
                                $address_4 = get_theme_mod('Address_4');
                                $address_5 = get_theme_mod('Address_5');

                                ?>
                        <div class="col-lg-5">
                            <div class="contact-infor">
                                <div class="ct-icon">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/pin.png" alt="">
                                </div>
                                <ul>
                                    <?php if (!empty($address_1)) { ?>
                                        <li><?php echo $address_1 ?></li>
                                    <?php } ?>

                                    <?php if (!empty($address_2)) { ?>
                                        <li><?php echo $address_2 ?></li>
                                    <?php } ?>

                                    <?php if (!empty($address_3)) { ?>
                                        <li><?php echo $address_3 ?></li>
                                    <?php } ?>

                                    <?php if (!empty($address_4)) { ?>
                                        <li><?php echo $address_4 ?></li>
                                    <?php } ?>

                                    <?php if (!empty($address_5)) { ?>
                                        <li><?php echo $address_5 ?></li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="contact-infor">
                                <div class="ct-icon">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/call.png" alt="">
                                </div>
                                <?php if (!empty($phone)) { ?>
                                    <p>
                                        <a href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                        </a>
                                    </p>
                                <?php } ?>
                            </div>

                            <div class="contact-infor">
                                <div class="ct-icon">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/envelope.png" alt="">
                                </div>
                                <?php if (!empty($email)) { ?>
                                    <p>
                                        <a href="mailto:<?php echo $email ?>">
                                            <?php echo $email ?>
                                        </a>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form">
                                <?php the_content() ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

        <?php endif; ?>

    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>