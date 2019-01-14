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

	$argsFeature = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'category__in' => array( gimme_an_id('Faculty / Staff'), gimme_an_id('Faculty / Staff Exclusive') ),
		'meta_key' => 'wpcf-featured-post-in-rss',
		//'meta_value' => true,
	);
	$query = new WP_Query( $argsFeature );	
	if ( $query->have_posts() ) : while ($query->have_posts()) : $query->the_post(); ?>
		<?php $featuredPostID = get_the_ID(); ?>
		<item>
			<title><?php the_title_rss() ?></title>
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
			?>
			<excerpt><![CDATA[<?php the_excerpt_rss()?> ]]></excerpt>
			<content><![CDATA[<?php the_content()?> ]]></content>
			<featuredimage><?php echo $thumbnail ?></featuredimage>
		</item>
	<?php endwhile; endif; ?>
	
	<?php wp_reset_query(); ?>
<?php 
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 10,
		'category__in' => gimme_an_id('Faculty / Staff'), gimme_an_id('Faculty / Staff Exclusive'),
		'post__not_in' => array( $featuredPostID ),
	);
	$query = new WP_Query( $args );
	
	if ( $query->have_posts() ) : while ($query->have_posts()) : $query->the_post(); ?>
		<?php $featuredPostID = get_the_ID(); ?>
		<item>
			<title><?php the_title_rss() ?></title>
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
			?>
			<excerpt><![CDATA[<?php the_excerpt_rss()?> ]]></excerpt>
			<content><![CDATA[<?php the_content()?> ]]></content>
			<featuredimage><?php echo $thumbnail ?></featuredimage>
		</item>
	<?php endwhile; endif; ?>
	
	<?php wp_reset_query(); ?>

?>
</channel>
</rss>