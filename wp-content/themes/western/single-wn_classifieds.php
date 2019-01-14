<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="ninecol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="h2" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php

										$other_author = types_render_field("other-author",array('output'=>'html'));
											if ($other_author) {
												$author = strip_tags($other_author);
											}
											else {
												$author = bones_get_the_author_posts_link();
											}
										printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time> <span class="author">By %3$s</span>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F j, Y', 'bonestheme' ) ), $author, get_the_category_list(', ') );
									?></p>

									<?php
									if ( function_exists( 'sharing_display' ) ) {
									    sharing_display( '', true );
									}
									 
									if ( class_exists( 'Jetpack_Likes' ) ) {
									    $custom_likes = new Jetpack_Likes;
									    echo $custom_likes->post_likes( '' );
									}
									?>
								    </div>
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">

                  <?php
	 								$images = types_child_posts('images');
									if ($images) {
										print '<div class="flexslider"><ul class="slides">';
										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
										if ($thumb) {
											if (get_post(get_post_thumbnail_id($post->ID))->post_excerpt) {
												$caption = '<span class="photo-caption">' .get_post(get_post_thumbnail_id($post->ID))->post_excerpt . '</span>';
											} else {
												$caption = '';
											}
											if (get_post_meta(get_post_thumbnail_id(), 'photo_credit', true)) {
												$credit = '<span class="photo-credit"><span class="cred">Photo credit:</span> ' . get_post_meta(get_post_thumbnail_id(), 'photo_credit', true) . '</span>';
											}
											else {
												$credit = '';
											}
											print '<li><img src="' . $thumb[0] . '"/><p class="flex-caption">' . $caption . $credit . '</p></li>';
										}
										foreach ($images as $image) {
											if ($image->fields['photo_caption']) {
												$caption = '<span class="photo-caption">' . $image->fields['photo_caption'] . '</span>';
											} else {
												$caption = '';
											}
											if ($image->fields['photo_credit']) {
												$credit = '<span class="photo-credit"><span class="cred">Photo credit:</span> ' . $image->fields['photo_credit'] . '</span>';
											}
											else {
												$credit = '';
											}
											print '<li><img src="' . $image->fields['photo_gallery'] . '"/><p class="flex-caption">' . $caption . $credit . '</p></li>';
										}
										print '</ul></div>';
									} else if (!$images) {
										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
										if ($thumb) {
											if (get_post(get_post_thumbnail_id($post->ID))->post_excerpt) {
												$caption = '<span class="photo-caption">' .get_post(get_post_thumbnail_id($post->ID))->post_excerpt . '</span>';
											} else {
												$caption = '';
											}
											if (get_post_meta(get_post_thumbnail_id(), 'photo_credit', true)) {
												$credit = '<span class="photo-credit"><span class="cred">Photo credit:</span> ' . get_post_meta(get_post_thumbnail_id(), 'photo_credit', true) . '</span>';
											}
											else {
												$credit = '';
											}
											print '<div class="single-wrapper"><div class="single-feature"><img src="' . $thumb[0] . '"/><p class="flex-caption">' . $caption . $credit . '</p></div></div>';
										} else {
											print '';
										}
									} else {
										print '';
									}
								?>

									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

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

					<?php get_sidebar('sidebar6'); ?>

				</div>

			</div>

<?php get_footer(); ?>
