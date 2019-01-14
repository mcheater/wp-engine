<div class="connected">
	<h4 class="connectedtitle">Stay Connected</h4>
	<a href="http://www.facebook.com/WesternUniversity" target="_blank" title="Facebook"><img alt="Western on Facebook" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/facebook_16.png"/></a> <a href="itmss://deimos.apple.com/WebObjects/Core.woa/BrowsePrivately/uwo.ca" target="_blank" title="iTunes U"><img alt="Western on iTunes U" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/apple_16.png"/></a> <a href="http://www.flickr.com/groups/western/" target="_blank" title="Flickr"><img alt="Western on Flickr" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/flickr_16.png"/></a> <a href="http://twitter.com/westernu" target="_blank" title="Twitter"><img alt="Western on Twitter" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/twitter_16.png"/></a> <a href="http://www.youtube.com/user/westernuniversity" target="_blank" title="YouTube"><img alt="Western on YouTube" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/youtube_16.png"/></a> <a href="http://communications.uwo.ca/weblogs/directory.htm" target="_blank" title="Blogs"><img alt="Western Blogs" class="social-icon" src="http://www.uwo.ca/web_standards/img/social/purple-play.png"/></a> <br/><br/>
	<p><a href="http://www.uwo.ca/social_media.html">Comprehensive directory</a> of all Western social media</p>
	<?php $post_type = get_query_var('post_type');
		// print_r($post_type);
		if ($post_type == 'inthenews_post') {
			$link = '/newsmaker/feed';
		}
		else {
			$link = '/feed';
		}
	?>
	<a href="<?php print $link ?>">
	<img src="<?php echo get_template_directory_uri(); ?>/library/images/rss.png" alt="RSS feed icon"> Subscribe to our RSS Feed</a>
</div>
