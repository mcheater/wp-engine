<?php
/*
Template Name: About Page Layout
*/
?>


<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="h2" itemprop="headline"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
                                    
                                    
                                    <?php
									// WP_Query arguments
									$args = array (
										'post_type'              => 'staff_information',
										//'post_status'            => 'published',
										'order'                  => 'ASC',
										'orderby'                => 'menu_order',
									);
									
									// The Query
									$staffQuery = new WP_Query( $args );
									
									// The Loop
									if ( $staffQuery->have_posts() ) {
										while ( $staffQuery->have_posts() ) {
											$staffQuery->the_post();
											?>
                                            <div class="twocol"><?php the_post_thumbnail(array(115,150));?></div>
                                            <div class="sixcol">
                                            <h2><?php echo get_the_title(); ?></h2>
											<?php the_content(); ?>                                            
                                            </div>
                                            <p class="threecol staff-contact"><?php echo types_render_field("extension",array('output'=>'raw'));?><br />
                                            <a href="mailto:<?php echo types_render_field("email-address",array('output'=>'raw'));?>">Email</a><br />	
                                            <?php $twitter = types_render_field("twitter-name",array('output'=>'raw')); ?>
                                            <?php if ( $twitter ) { ?>
                                            <a href="//twitter.com/<?php echo $twitter ?>" target="_blank"><?php echo $twitter ?> on Twitter</a>
                                            <?php } ?>
                                            </p>
                                            <hr />
                                            <?php
										}
									} else {
										// no posts found
									}
									
									// Restore original Post Data
									wp_reset_postdata();
									?>
                                    
								</section>

								<footer class="article-footer">

								</footer>

							</article>
							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
