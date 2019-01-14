<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">
                            <!-- MAIN IMAGE -->
                            <div class="twelvecol first feature clearfix">
                            	<div class="flexslider"><ul class="slides">
                            	<?php query_posts(array( 'category__in' => array(gimme_an_id('Front')), 'posts_per_page' => 5));?>										
		                            <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                                <li class="slide">
		                                <div class="eightcol first feature-image clearfix">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-490' ); ?></a>
		                                </div>
		                            	<div class="feature-excerpt">
		                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		                                </div>
	                            	</li>
									<?php endwhile; ?>
									<?php wp_reset_query(); ?>
									<?php endif; ?>
									</ul></div>
                            </div>


                            <div class="twelvecol first clearfix">
							<h4 class="morenewstitle">All Media Releases</h4><a class="morerss" href="feed"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rss.png"></a>
                            </div>
                            <div class="twelvecol first clearfix releaselist" id="releaselistFront">
								<?php
                                query_posts(array( 'category__not_in' => array(gimme_an_id('Front')), 'posts_per_page' => 14));
                                $isOdd = true;
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                	
                                	if ( has_post_thumbnail() ) {
	                                	$this_post_thumbnail = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
										list($width, $height) = getimagesize( $this_post_thumbnail );
	                                	if ( $width > $height ) {
		                                	$ImgRatioCSS = 'horizontalImg';
		                                } elseif ( $width == $height ) {
		                                	$ImgRatioCSS = 'squareImg';
	                                	} else {
		                                	$ImgRatioCSS = 'verticalImg';
	                                	}
                                	} else {
	                                	$ImgRatioCSS = 'noimage';
                                	}
									
									$customImgSize = get_post_meta($post->ID, 'wpcf-release-front-page-size', true);
                                if ($isOdd) {
                                	print '<div class="row-wrapper clearfix">';
                                } 
                                ?>

								<div class="sixcolgrid <?php echo $ImgRatioCSS; ?> customSize<?php echo $customImgSize;?> <?php user_the_categories(); ?>">
									
									<?php
		                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
		                                if ($thumb) { ?> 
		                                	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> 
										<?php  
											if ( $ImgRatioCSS == 'verticalImg' ) {
												$thumb_urls = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) ,'bones-thumb-tall', true);
												echo '<img src="'.$thumb_urls[0].'" class="attachment-bones-thumb-tall wp-post-image">';
											} elseif ( $ImgRatioCSS == 'squareImg' ) {
												$thumb_urls = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) ,'bones-thumb-square', true);
												echo '<img src="'.$thumb_urls[0].'" class="attachment-bones-thumb-square wp-post-image">';
											
											} else {
												the_post_thumbnail( 'bones-thumb-340' );
											}
		                                ?>
		                                    </a>
		                                <?php
		                                }
		                            ?>

                                	
                                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a>
                                    <span class="releasedate"><?php echo get_the_date(); ?></span>
                                    <?php the_excerpt(); ?>
								</div>
                             <?php 
                             if (!$isOdd) {
                                print '</div>';
                              }
                             $isOdd = ! $isOdd;
                             endwhile; ?>
                             <?php wp_reset_query(); ?>
                             <?php endif; ?>
                             <a class="alllink" href="media-releases">All Media Releases »</a>
                        </div>

                            <?php if ( !have_posts() ) { ?>

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

							<?php } ?>

						</div>

						<?php get_sidebar('sidebar1'); ?>

				</div>

			</div>
<?php get_footer(); ?>