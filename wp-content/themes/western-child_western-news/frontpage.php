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
                            <div class="twelvecol first feature clearfix">
                            	<?php query_posts(array( 'category__in' => array(gimme_an_id('Front Main')), 'posts_per_page' => 1)); the_post();?>
                                <div class="eightcol first feature-image clearfix">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-490' ); ?></a>
                                </div>
                            	<div class="fourcol feature-excerpt last">
                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                           	 	<?php
                           	 		if ( !empty( $post->post_excerpt ) ) {
                           	 			the_excerpt();
                           	 		} else {
		                                $strings = preg_split('/(\.|!|\?)\s/', strip_tags($post->post_content), 2, PREG_SPLIT_DELIM_CAPTURE);
		                                echo apply_filters('the_content', $strings[0] .  $strings[1]);
		                            } 
                                ?>
                            	<?php wp_reset_query(); ?>
                                </div>
                            </div>
                            <div class="twelvecol first clearfix">
                            <!-- NEXT THREE -->
							<?php
							query_posts(array( 'category__in' => array(gimme_an_id('Front 1')), 'posts_per_page' => 1));
							if ( have_posts() ) : while ( have_posts() ) : the_post(); $post_count++;
							?>
                            <div class="fourcol feature-mini first">
                            <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
                                if ($thumb) {
                                    the_post_thumbnail( 'bones-thumb-220' );
                                } else {
                                    print '<img width="220" height="150" src="' . get_template_directory_uri() . '/library/images/crest.png" class="attachment-bones-thumb-220 wp-post-image" alt="Western Crest">';
                                } ?>

                            <?php
                            $category = get_the_category();
                            foreach ($category as $key => $value) {
                                if ($value->slug == 'front1') {
                                    unset($category[$key]);
                                } else {
                                    $name = $value->name;
                                }
                            }
                            echo '<div class="category-overlay">' . $name . '</div></a>';
                            ?>
                            </div>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                            </div>
                            <?php endwhile; ?>
                            <?php wp_reset_query(); ?>
                            <?php endif; ?>

                            <?php
                            query_posts(array( 'category__in' => array(gimme_an_id('Front 2')), 'posts_per_page' => 1));
                            if ( have_posts() ) : while ( have_posts() ) : the_post(); $post_count++;
                            ?>
                            <div class="fourcol feature-mini">
                            <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
                                if ($thumb) {
                                    the_post_thumbnail( 'bones-thumb-220' );
                                } else {
                                    print '<img width="220" height="150" src="' . get_template_directory_uri() . '/library/images/crest.png" class="attachment-bones-thumb-220 wp-post-image" alt="Western Crest">';
                                } ?>
                            <?php
                            $category = get_the_category();
                            foreach ($category as $key => $value) {
                                if ($value->slug == 'front2') {
                                    unset($category[$key]);
                                } else {
                                    $name = $value->name;
                                }
                            }
                            echo '<div class="category-overlay">' . $name . '</div></a>';
                            ?>
                            </div>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                            </div>
                            <?php endwhile; ?>
                            <?php wp_reset_query(); ?>
                            <?php endif; ?>

                            <?php
                            query_posts(array( 'category__in' => array(gimme_an_id('Front 3')), 'posts_per_page' => 1));
                            if ( have_posts() ) : while ( have_posts() ) : the_post(); $post_count++;
                            ?>
                            <div class="fourcol feature-mini last">
                            <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bones-thumb-700' );
                                if ($thumb) {
                                    the_post_thumbnail( 'bones-thumb-220' );
                                } else {
                                    print '<img width="220" height="150" src="' . get_template_directory_uri() . '/library/images/crest.png" class="attachment-bones-thumb-220 wp-post-image" alt="Western Crest">';
                                } ?>
                            <?php
                            $category = get_the_category();
                            foreach ($category as $key => $value) {
                                if ($value->slug == 'front3') {
                                    unset($category[$key]);
                                } else {
                                    $name = $value->name;
                                }
                            }
                            echo '<div class="category-overlay">' . $name . '</div></a>';
                            ?>
                            </div>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                            </div>
                            <?php endwhile; ?>
                            <?php wp_reset_query(); ?>
                            <?php endif; ?>

                            </div>

                            <div class="twelvecol first clearfix">

							<div class="sixcol first front-news"><h4 class="morenewstitle">More news</h4><a class="morerss" href="feed"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rss.png"></a><ul>
								<?php
                                query_posts(array( 'category__not_in' => array(gimme_an_id('Front Main'), gimme_an_id('Front 1'), gimme_an_id('Front 2'), gimme_an_id('Front 3'), gimme_an_id('Faculty / Staff Exclusive')), 'posts_per_page' => 7));
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                ?>
                                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?></a></li>

                             <?php endwhile; ?>
                             <?php wp_reset_query(); ?>
                             <?php endif; ?>
                             </ul>
                             <a class="alllink" href="all-news">All News »</a>
</div>
<div class="sixcol event-list last">

                    <h4 class="eventstitle">Events</h4><a class="morerss" href="http://westernadvance.ca/calendar/western.xml"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rss.png"></a>
                    <?php
                    $message = get_custom_feed();
                    echo '<ul>' . $message . '</ul>';
                    ?>
                    <a class="alllink" href="http://www.events.westernu.ca/">All Events »</a>
                        </div>
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