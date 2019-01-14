<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">
							<h1 class="h2">All News</h1>
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
                            </a>
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
                            echo '<div class="category-overlay">' . $name . '</div></a>';
                            ?>
                            </div>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							 <p><?php echo get_the_date(); ?></p>
							</div>

							<?php endwhile; ?>
						</div>
						
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

			</div>

<?php get_footer(); ?>
