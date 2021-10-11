<?php

/**
 * Template Name: RSS Template
 */

$args_latest  = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'showposts' => 5
);
$articleLatest = new WP_Query($args_latest);

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . '>';
?>
<rss version="2.0" xmlns:content="https://purl.org/rss/1.0/modules/content/" xmlns:wfw="https://wellformedweb.org/CommentAPI/" xmlns:dc="https://purl.org/dc/elements/1.1/" xmlns:atom="https://www.w3.org/2005/Atom" xmlns:sy="https://purl.org/rss/1.0/modules/syndication/" xmlns:slash="https://purl.org/rss/1.0/modules/slash/" <?php do_action('rss2_ns'); ?>>
    <channel>
        <title><?php bloginfo_rss('name'); ?> - Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters('rss_update_period', 'hourly'); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters('rss_update_frequency', '1'); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while ($articleLatest->have_posts()) : $articleLatest->the_post();
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $featured_image = '<figure class="wp-block-image size-large">' . get_the_post_thumbnail() . '</figure>';

            if (get_locale() == 'vi') {
                $title_vi   = $wpdb->get_row("SELECT * from wp_e2blogtrp_dictionary_en_us_vi WHERE original = '{$title}'")->translated;
                $excerpt_vi = $wpdb->get_row("SELECT * from wp_e2blogtrp_dictionary_en_us_vi WHERE original = '{$excerpt}'")->translated;

                $categories = get_the_category();
                $category_name = '';
                foreach ($categories as $category) :
                    if ($category->term_id != 1) :
                        $cate_vi = $wpdb->get_row("SELECT * from wp_e2blogtrp_dictionary_en_us_vi WHERE original = '{$category->name}'")->translated;
                        $category_name .=  '<li><a href="' . get_category_link($category->term_id) . '">' . $cate_vi . '</a></li>';
                    endif;
                endforeach;
        ?>

                <item>
                    <title><?php echo $title_vi; ?></title>
                    <link><?php the_permalink_rss(); ?></link>
                    <pubDate><?php echo get_the_date('F j, Y'); ?></pubDate>
                    <dc:creator><?php the_author(); ?></dc:creator>
                    <guid isPermaLink="false"><?php the_guid(); ?></guid>
                    <category>
                        <![CDATA[<?php echo '<ul>' . $category_name . '</ul>' ?>]]>
                    </category>
                    <description>
                        <![CDATA[<?php echo $featured_image ?>]]>
                        <![CDATA[<?php echo $excerpt_vi ?>]]>
                    </description>
                    <content:encoded>
                        <![CDATA[<?php echo $featured_image ?>]]>
                        <![CDATA[<?php echo $excerpt_vi ?>]]>
                    </content:encoded>
                    <?php rss_enclosure(); ?>
                    <?php do_action('rss2_item'); ?>
                </item>

            <?php
            } else { ?>

                <item>
                    <title><?php echo $title; ?></title>
                    <link><?php the_permalink_rss(); ?></link>
                    <pubDate><?php echo get_the_date('F j, Y'); ?></pubDate>
                    <dc:creator><?php the_author(); ?></dc:creator>
                    <guid isPermaLink="false"><?php the_guid(); ?></guid>
                    <category>
                        <![CDATA[<?php the_category() ?>]]>
                    </category>
                    <description>
                        <![CDATA[<?php echo $featured_image ?>]]>
                        <![CDATA[<?php echo $excerpt ?>]]>
                    </description>
                    <content:encoded>
                        <![CDATA[<?php echo $featured_image ?>]]>
                        <![CDATA[<?php echo $excerpt ?>]]>
                    </content:encoded>
                    <?php rss_enclosure(); ?>
                    <?php do_action('rss2_item'); ?>
                </item>
        <?php }
        endwhile; ?>
    </channel>
</rss>