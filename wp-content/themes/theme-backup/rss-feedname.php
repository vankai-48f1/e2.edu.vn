<?php

/**
 * Template Name: Custom RSS Template - Feedname
 */

?>
<?php
$args_latest  = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'showposts' => 1
);

$articleLatest = new WP_Query($args_latest);
while ($articleLatest->have_posts()) : $articleLatest->the_post(); ?>
<?php $a = get_the_title(); $b = get_the_excerpt();

if(get_locale()=='vi'){

$title = $wpdb->get_row("SELECT * from wp_e2blogtrp_dictionary_en_us_vi WHERE original = '{$a}'")->translated;
$desctiption = $wpdb->get_row("SELECT * from wp_e2blogtrp_dictionary_en_us_vi WHERE original = '{$b}'")->translated;
}
else {
    $title = $a;
    $desctiption = $b;
}
?>
    <item>
        <title><?php echo $title;  ?></title>
        <link><?php the_permalink(); ?></link>
        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
        <dc:creator><?php the_author(); ?></dc:creator>
        <guid isPermaLink="false"><?php the_guid(); ?></guid>
        <description>
            <![CDATA[<?php echo $desctiption; ?>]]>
        </description>
        <content:encoded>
            <![CDATA[<?php the_excerpt() ?>]]>
        </content:encoded>
        <?php rss_enclosure(); ?>
        <?php do_action('rss2_item'); ?>
    </item>
<?php endwhile;

?>