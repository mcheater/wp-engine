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
										<span><?php _e( 'Back Issues:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Back Issues:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>

							<?php } else { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Back Issues', 'bonestheme' ); ?></span>
									</h1>
							<?php } ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); $post_count++; ?>
							<?php if($post_count % 4 === 0) { ?>
                            	<div class="threecol last">
                            <?php } elseif($post_count % 4 === 1) { ?>
                            	<?php if ($post_count != 1) { ?>
                               	 <hr></hr>
                               	</div>
                                <?php } ?>
                                <div class="twelvecol first clearfix">
                                <div class="threecol first">
                            <?php } else { ?>
                            	<div class="threecol">
                           	<?php }
                           		$thumb_id = get_post_thumbnail_id();
								$thumb_url_array = wp_get_attachment_image_src($thumb_id);
								$thumb_url = $thumb_url_array[0];
								$media = get_attached_media('application/pdf');
								foreach($media as $pdfLinks) {
									$pdfFileLink = array( wp_get_attachment_url( $pdfLinks->ID ) );	
									$pdfServerLink = array( get_attached_file( $pdfLinks->ID ) );
								}
								$pdfFileSize = number_format( filesize( $pdfServerLink[0] ) / 1048576 , 2 );
								echo '<a href="'.$pdfFileLink[0].'">';
								the_post_thumbnail( 'bones-thumb-125' );
								echo '</a>';
								$pattern = "/<a?.*>(.*)<\/a>/";
								preg_match($pattern, get_the_content(), $matches);
							    echo '<p>' . $matches[0] . '<br/>PDF, '.$pdfFileSize.'MB</p></div>';
							    endwhile;
							?>
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

									<?php get_sidebar('sidebar5'); ?>
							<?php else : ?>
									<article id="post-not-found" class="hentry clearfix">
										<h1><?php _e( 'No posts currently.', 'bonestheme' ); ?></h1>
									</article>
									</div>
									</div>
							<?php endif; ?>
							</div>
			</div>

<?php get_footer(); ?>
