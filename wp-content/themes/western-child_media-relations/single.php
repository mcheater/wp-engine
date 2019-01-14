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
									?></p>

									<!--Add to Any Begin-->
										<div class="a2a_kit" style="display:inline-block; height: auto; float:right;">
										<ul id="ata-list" class="social-icons icon-circle">

										    <li><a class="a2a_button_facebook">
										        <i class="fa fa-facebook"></i>
										    </a></li>
										    <li><a class="a2a_button_twitter">
										        <i class="fa fa-twitter"></i>
										    </a></li>
										    <li><a class="a2a_button_google_plus">
										        <i class="fa fa-google-plus"></i>
										    </a></li>
										    <li><a class="a2a_button_linkedin">
										        <i class="fa fa-linkedin"></i>
										    </a></li>
										    <li><a class="a2a_dd" href="http://www.addtoany.com/share_save">
										        <i class="fa fa-plus"></i>
										    </a></li>
										    
										</ul>    
										</div>
										<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
										<!--Add to Any End-->

									<?php
									// if ( function_exists( 'sharing_display' ) ) {
									//     sharing_display( '', true );
									// }
									 
									// if ( class_exists( 'Jetpack_Likes' ) ) {
									//     $custom_likes = new Jetpack_Likes;
									//     echo $custom_likes->post_likes( '' );
									// }
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
										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bones-thumb-700-prop');
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

									<?php the_content(); ?>
									<?php 
										$post = get_post();
										$metadata = get_post_meta($post->ID);
										if (!empty($metadata['wpcf-high-res-image-downloads'][0])) {
											$dlimages = $metadata['wpcf-high-res-image-downloads'];
										}
										if (!empty($metadata['wpcf-downloadable-files'][0])) {
											$dlfiles = $metadata['wpcf-downloadable-files'];
										}
										
										$dllinks = types_render_field("external-links",array('output' => 'html', 'target' => '_blank', 'separator'=>'<br/>'));
										if ( $dlfiles!=null || $dlimages!=null || $dllinks!=null ) {
										?>	

											<h3 class="title-bar-grey">Downloadable Media</h3>
											<?php if ( $dlimages ) {
												echo '<h3>Images</h3>';
												print '<div class="twelvecol first clearfix">';
												$count = 1;
												foreach ($dlimages as $image) {
													$attachment_id = wp_get_attachment_id_from_url($image);
													if($count % 3 === 0) { 
                            							print '<div class="fourcol multimedia-image last">';
                            						} elseif($count % 3 === 1) { 
					                            		if ($count != 1) { 
					                               	 		print '<hr></hr></div>';
					                                	} 
					                                	print '<div class="twelvecol first clearfix"><div class="fourcol multimedia-image first">';
					                            	} else { 
					                            		print '<div class="fourcol multimedia-image">';
					                           		}
					                           		print '<a href="' . $image . '">';
					                           		echo wp_get_attachment_image( $attachment_id, 'bones-thumb-220' );

					                           		print '</a><div class="image-caption">' . get_post($attachment_id)->post_excerpt . '</div>';
					                           		print '</div>';
					                           		$count++;
												}
												print '</div>';
												
												
											} ?>
											<?php if ( $dlfiles ) {
												echo '<h3>Downloadable Files</h3>';
												foreach ($dlfiles as $file) {
													$attachment_id = wp_get_attachment_id_from_url($file);
													$post = get_post($attachment_id);
													$ext = pathinfo($file, PATHINFO_EXTENSION);
													print '<a href="' . $file . '">' . get_post($attachment_id)->post_title . '</a> (.' . $ext . ')<br/><br/>';
												}
												
											} ?>

											<?php if ( $dllinks ) {
												echo '<h3>External Links</h3>';
												echo $dllinks;
												} ?>
										<?php	
										}
									
									
									?>
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

					<?php get_sidebar('sidebar4'); ?>

				</div>

			</div>

<?php get_footer(); ?>
