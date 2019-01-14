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
