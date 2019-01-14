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
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							
							<?php } else { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Western Multimedia', 'bonestheme' ); ?></span>
									</h1>
							<?php } ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); $post_count++; ?>
							<?php if($post_count % 3 === 0) { ?>
                            	<div class="fourcol feature-mini last">
                            <?php } elseif($post_count % 3 === 1) { ?>
                            	<?php if ($post_count != 1) { ?>
                               	 <hr></hr>
                               	</div>
                                <?php } ?>
                                <div class="twelvecol first clearfix">
                                <div class="fourcol feature-mini first">
                            <?php } else { ?>
                            	<div class="fourcol feature-mini">
                           	<?php } ?>
                            <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            	<?php 
                            	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
                            	if ($thumb) {
                            		the_post_thumbnail( 'bones-thumb-220' );
                            	} else {      
                            		print '<img width="220" height="150" src="' . get_template_directory_uri() . '/library/images/crest.png" class="attachment-bones-thumb-220 wp-post-image" alt="Western Crest">';
                            	} ?>
                            	
                            <?php if (is_tag() ) { ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php
                            $category = get_the_category(); 
							echo '<div class="category-overlay">' . $category[0]->cat_name . '</div></a>';
							}
							?>
                            </div>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo get_the_date(); ?></p>
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

									</div>
									</div>
									<?php get_sidebar('sidebar7'); ?>
							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<h1><?php _e( 'No posts currently.', 'bonestheme' ); ?></h1>
									</article>
									</div>
									</div>
							<?php endif; ?>

			</div>

<?php get_footer(); ?>
