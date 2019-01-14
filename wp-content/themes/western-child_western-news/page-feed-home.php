<?php
/**
 * RSS 0.92 Feed Template for displaying RSS 0.92 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="0.92">
<channel>
	<title><?php bloginfo_rss('name'); ?></title>
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss('description') ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>

	<?php
	/**
	 * Fires at the end of the RSS Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss_head' );
	?>


<?php


for($i = 1; $i <= 6; ++$i){
	// Custom feed for featured posts
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'meta_key' => 'wpcf-uwo-post-order',
		'meta_value' => $i,
		'orderby' => array (
			'meta_value_num' => 'asc',
			'date' => 'desc',
		),
	);
	$query = new WP_Query( $args );

    if ( $query->have_posts() ) : while ($query->have_posts()) : $query->the_post(); ?>
    		<item>
    			<title><?php the_title_rss() ?></title>
    			<postorderCUSTOM><?php echo get_post_meta( get_the_id(), 'wpcf-uwo-post-order', true); ?></postorderCUSTOM>
    			<date><?php the_date_xml() ?></date>
    			<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
    			<link><?php the_permalink_rss() ?></link>
    			<?php
    			/**
    			 * Fires at the end of each RSS feed item.
    			 *
    			 * @since 2.0.0
    			 */
    			do_action( 'rss_item' );
    			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) , 'bones-thumb-340' ) ;
    			if($thumb != null) {
    				$thumbnail = $thumb[0];
    			} else {
    				$thumbnail = get_template_directory_uri() . '/library/images/crest.png';
    			}

                $thumbAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                if(empty($thumbAlt)) {
                    $thumbAlt = 'Western News Featured Image for ' . get_the_title();
                }
    			?>
    			<excerpt><![CDATA[<?php the_excerpt_rss()?> ]]></excerpt>
    			<content><![CDATA[<?php the_content()?> ]]></content>
    			<featuredimage><?php echo $thumbnail ?></featuredimage>
                <featuredImageAlt><?php echo $thumbAlt ?> </featuredImageAlt>
    		</item>
    	<?php endwhile; endif; ?>

	<?php wp_reset_query(); ?>
<?php } ?>

</channel>
</rss>
