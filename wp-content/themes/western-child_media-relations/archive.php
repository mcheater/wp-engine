<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">

							<?php if (is_category()) { ?>
								<h1 class="archive-title h2">
									<?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
								<h1 class="archive-title h2">

									<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Media Releases Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Media Releases Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

							<?php if (have_posts()) : while (have_posts()) : the_post();  ?>

                           		<div class="feature-mini mediaarchive clearfix <?php user_the_categories(); ?>">
									<div class="home-thumb">
									   
								    	<?php 
								    	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
								    	if ($thumb) { ?>
								    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								    		<?php
								    		the_post_thumbnail( 'bones-thumb-220' );
								    		echo '</a>';
								    	} else {      
								
								    	} ?>
								    	<?php
								    	if (!$thumb) {
										    $thumbtrue = 'thumbfalse';
									    }
								    	?>
									    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									    <?php 
									    $category = get_the_category(); 
									    foreach ($category as $key => $value) {
									    	if (strpos($value->slug, 'front') !== false) {
									            unset($category[$key]);
									        } else {
									            $name = $value->name;
									        } 
									    }
									    // echo '<div class="category-overlay '. $thumbtrue .'">' . $name . '</div></a>';
									    ?>
									</div>
		                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<p><?php echo get_the_date(); ?>
                                    <?php if ( get_post_type($post) == 'inthenews_post' ) { ?>
										via <a href="<?php echo get_post_meta($post->ID, 'pf_source_link', true); ?>" rel="source" title="<?php echo get_post_meta($post->ID, 'pf_feed_item_source', true); ?>" target="_blank"><?php echo get_post_meta($post->ID, 'pf_feed_item_source', true); ?></a>	 			
									<?php } ?>
                                    </p>
									<p><?php the_excerpt(); ?></p>
								</div>

							<?php endwhile; ?>
						
						
									<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
											<?php bones_page_navi(); ?>
									<?php } else { ?>
											<nav class="wp-prev-next">
													<ul class="clearfix">
														<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
														<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
													</ul>
											</nav>
									<?php } ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'If the problem persists, please contact us for assistance.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
						</div>
						<?php get_sidebar('sidebar2'); ?>
						</div>

			</div>

<?php get_footer(); ?>
