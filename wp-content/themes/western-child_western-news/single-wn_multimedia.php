<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link(), '<a href="' . site_url() . '/multimedia">Multimedia</a>');
									?></p>

									<div class="addthis-tools">
								    <!-- AddThis Button BEGIN -->
								    <div class="addthis_toolbox addthis_default_style addthis_16x16_style">
								    <a class="addthis_button_facebook at300b" title="Facebook" href="#"><span class=" at300bs at15nc at15t_facebook"><span class="at_a11y">Share on facebook</span></span></a>
								    <a class="addthis_button_twitter at300b" title="Tweet" href="#"><span class=" at300bs at15nc at15t_twitter"><span class="at_a11y">Share on twitter</span></span></a>
								    <a class="addthis_button_pinterest_share at300b" title="Send to Pinterest" target="_blank" href="#"><span class=" at300bs at15nc at15t_pinterest_share"><span class="at_a11y">Share on pinterest_share</span></span></a>
								    <a class="addthis_button_google_plusone_share at300b" href="#" target="_blank" title="Google+"><span class=" at300bs at15nc at15t_google_plusone_share"><span class="at_a11y">Share on google_plusone_share</span></span></a>
								    <a class="addthis_button_linkedin at300b" title="LinkedIn" href="#"><span class=" at300bs at15nc at15t_linkedin"><span class="at_a11y">Share on linkedIn</span></span></a>
								    <a class="addthis_button_email at300b" title="Email" href="#"><span class=" at300bs at15nc at15t_email"><span class="at_a11y">Email</span></span></a>
								    <a class="addthis_button_compact at300b" href="#"><span class=" at300bs at15nc at15t_compact"><span class="at_a11y">More Sharing Services</span></span></a>
								    </div>

								    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-529b5e5b2dc8cba3"></script>
								    <!-- AddThis Button END -->
								    </div>
								</header>

								<section class="entry-content clearfix">
								<?php
									$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
										if ($thumb) {
											print '<div class="single-wrapper"><div class="single-feature"><img src="' . $thumb[0] . '"/><p class="flex-caption"><span class="photo-credit">Photo credit: ' . get_post(get_post_thumbnail_id($post->ID))->post_excerpt . '</span><span class="photo-caption">' . get_post(get_post_thumbnail_id($post->ID))->post_content . '</span></p></div></div>';
										} else { ?>
	                                <div class="media-container">    
	                                   <?php the_content(); ?>
	                                </div>
	                               <?php } 
									?>

								</section>

								<footer class="article-footer">
									<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'custom_tag', '<span class="tags-title">' . __( 'Custom Tags:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

					<?php get_sidebar('sidebar4'); ?>

				</div>

			</div>

<?php get_footer(); ?>
