<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="ninecol first clearfix" role="main">
						<h1 class="h2"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="article-header">

									<h3 class="search-title">
									<?php if ( get_post_type($post) == 'inthenews_post' ) { ?>
									<a href="<?php echo types_render_field("link",array('output'=>'raw'));?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<?php } else { ?>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									</h3>
									<p class="byline vcard"><?php
										printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time> <span class="author">%3$s</span>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F j, Y', 'bonestheme' ) ), bones_get_the_author_posts_link(), get_the_category_list(', ') );
										if ( get_post_type($post) == 'inthenews_post' ) { ?>
											via <a href="<?php echo types_render_field("source-url",array('output'=>'raw'));?>" rel="source" title="<?php echo types_render_field("source",array('output'=>'raw'));?>" target="_blank"><?php echo types_render_field("source",array('output'=>'raw'));?></a>
										<?php }
									?></p>

								</header>
								
								<?php if ( get_post_type($post) != 'inthenews_post' ) { ?>
									<section class="entry-content">
										<?php
										echo get_the_excerpt();
										
										?>
									</section>
								<?php } ?>
								
								<footer class="article-footer">

								</footer>

							</article>

						<?php endwhile; ?>

								<?php if (function_exists('bones_page_navi')) { ?>
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
										<header class="article-header no-search-result">
											<h1><?php _e( 'Your search - ', 'bonestheme')?><span class="search-excerpt"> <?php echo esc_attr(get_search_query()); ?></span> <?php _e(' - did not match any documents.', 'bonestheme' ); ?></h1>
										</header>
										<footer class="article-footer">
												<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
