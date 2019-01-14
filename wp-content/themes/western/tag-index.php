<?php
/*
Template Name: Tag Index
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol first clearfix" role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="h2"><?php the_title(); ?></h1>
		
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php
									// Make an array from A to Z.
    								$characters = range('a','z');
    								print '<div class="letter-menu twelvecol first"><ul>';
    								foreach( $characters as $character ) {
    									print '<li><a class="letter" href="#_' . $character .'">' . $character . '</a></li>';
    								}
    								print '</ul></div>';
								    // Check if $characters exists and ensure that it is an array.
								    if( $characters && is_array( $characters ) ) {
										array_unshift($characters,"");
										unset($characters[0]);
								        foreach( $characters as $index=>$character ) {
								            // Get the tag information for each characters in the array.
								            $tags = get_tags( array('name__like' => $character, 'order' => 'ASC') );
								            // Output a wrapper so that our arrays will be contained in 3 columns.
											if ($index != 0 && $index % 3 == 0)  {
								                $html = "<div class='post-tags fourcol last'>";
								            } else if ($index % 3 == 1 || $index == 0) {
								            	$html = '<div class="twelvecol first clearfix">';
								            	$html .= "<div class='post-tags first fourcol'>";
								            } else {
								                $html = "<div class='post-tags fourcol'>";
								            }

								            // Output the character and use it as the title.
								            $html .= "<a name='_{$character}'></a><h3 class='title'>{$character}</h3>";
								            // Output the markup for each tag found for each character.
								            if ($tags) {

								                $html .= "<ul>";
								                foreach ( (array) $tags as $tag ) {
								                    $tag_link = get_tag_link($tag->term_id);

								                    $html .= "<li class='tag-item'>";

								                    if ( $tag->count > 1 ) {
								                        $html .= "<p><a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
								                    } else {
								                        $html .= "<p><a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
								                    }
								                    $html .= "{$tag->name}</a> (<span>{$tag->count}</span>)</p>";
								                    $html .= "</li>";
								                }
								                $html .= '</ul>';
								            }
								            $html .= '</div>';
								            // Output the markup for the current character.
								            echo $html;
								            
								        }                    
								    }
									?>
								</section>

								<footer class="article-footer">

								</footer>

							</article>

						</div>

						<?php get_sidebar('sidebar3'); ?>

				</div>

			</div>

<?php get_footer(); ?>
