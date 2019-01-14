<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="ninecol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header clearfix">

									<h1 class="h2" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										
										printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F j, Y', 'bonestheme' ) ), get_the_category_list(', ') );
									?> via <a href="<?php echo types_render_field("source-url",array('output'=>'raw'));?>" rel="source" title="<?php echo types_render_field("source",array('output'=>'raw'));?>" target="_blank"><?php echo types_render_field("source",array('output'=>'raw'));?></a></p>

									
									<?php
									if ( function_exists( 'sharing_display' ) ) {
									    sharing_display( '', true );
									}
									 
									if ( class_exists( 'Jetpack_Likes' ) ) {
									    $custom_likes = new Jetpack_Likes;
									    echo $custom_likes->post_likes( '' );
									}
									?>
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
												$credit = '<span class="photo-credit">' . get_post_meta(get_post_thumbnail_id(), 'photo_credit', true) . '</span>';
											}
											else {
												$credit = '';
											}
											print '<li><img src="' . $thumb[0] . '"/><p class="flex-caption">' . $credit . $caption . '</p></li>';
										}
										foreach ($images as $image) {
											if ($image->fields['photo_caption']) {
												$caption = '<span class="photo-caption">' . $image->fields['photo_caption'] . '</span>';
											} else {
												$caption = '';
											}
											if ($image->fields['photo_credit']) {
												$credit = '<span class="photo-credit">' . $image->fields['photo_credit'] . '</span>';
											}
											else {
												$credit = '';
											}
											print '<li><img src="' . $image->fields['photo_gallery'] . '"/><p class="flex-caption">' . $credit . $caption . '</p></li>';
										}
										print '</ul></div>';
									} else if (!$images) {
										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
										$hideFeature = get_post_meta($post->ID, 'wpcf-featured-image-hidden', true);
										if ($thumb && $hideFeature==null) {
											if (get_post(get_post_thumbnail_id($post->ID))->post_excerpt) {
												$caption = '<p class="flex-caption"><span class="photo-caption">' .get_post(get_post_thumbnail_id($post->ID))->post_excerpt . '</span>';
											} else {
												$caption = '';
											}
											if (get_post_meta(get_post_thumbnail_id(), 'photo_credit', true)) {
												$credit = '<span class="photo-credit">' . get_post_meta(get_post_thumbnail_id(), 'photo_credit', true) . '</span>';
											}
											else {
												$credit = '';
											}
											if (!empty($credit) || !empty($caption)) {
												print '<div class="single-feature"><img src="' . $thumb[0] . '"/><p class="flex-caption">' . $credit . $caption . '</p></div>';
											}
											else {
												print '<div class="single-wrapper"><div class="single-feature"><img src="' . $thumb[0] . '"/></div></div>';
											}
										} else {
											print '';
										}
									} else {
										print '';
									}
								?>


								<p><a href="<?php echo types_render_field("link",array('output'=>'raw'));?>">Link</a> via <a href="<?php echo types_render_field("source-url",array('output'=>'raw'));?>" rel="source" title="<?php echo types_render_field("source",array('output'=>'raw'));?>" target="_blank"><?php echo types_render_field("source",array('output'=>'raw'));?></a></p>
									
										
									

								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

								<?php // comments_template(); ?>

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

					<?php get_sidebar('sidebar5'); ?>

				</div>

			</div>

<?php get_footer(); ?>
