<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-700', 700, 300, true );
add_image_size( 'bones-thumb-700-prop', 700);
add_image_size( 'bones-thumb-tall', 400, 600, true);
add_image_size( 'bones-thumb-square', 500, 500, true);
add_image_size( 'bones-thumb-490', 490, 300, true );
add_image_size( 'bones-thumb-340', 340, 220, true );
add_image_size( 'bones-thumb-220', 220, 150, true);
add_image_size( 'bones-thumb-125', 125, 160, true);
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Home Sidebar', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'searchbox',
		'name' => __( 'Search Area', 'bonestheme' ),
		'description' => __( 'Put Search in header.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footerlinksone',
		'name' => __( 'Footer Links 1', 'bonestheme' ),
		'description' => __( 'For Footer list of links 1', 'bonestheme' ),
		'before_widget' => '<div class="twocol">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footernavtitles">',
		'after_title' => '</p>',
	));
	register_sidebar(array(
		'id' => 'footerlinkstwo',
		'name' => __( 'Footer Links 2', 'bonestheme' ),
		'description' => __( 'For Footer list of links 2', 'bonestheme' ),
		'before_widget' => '<div class="twocol">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footernavtitles">',
		'after_title' => '</p>',
	));


	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
	<label class="obscure" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search '.get_bloginfo('name'), 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Go!' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!

add_shortcode( 'search', 'bones_wpsearch' );

/************* CUSTOM EXCERPT LENGTH *****************/


function custom_excerpt_length( $length ) {
	if ( is_home() ) {
		return 30;
	} else {
		return 30;
	}
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function old_style_name_like_wpse_123298($clauses) {
  remove_filter('term_clauses','old_style_name_like_wpse_123298');
  $pattern = '|(name LIKE )\'%(.+%)\'|';
  $clauses['where'] = preg_replace($pattern,'$1 \'$2\'',$clauses['where']);
  return $clauses;
}
add_filter('terms_clauses','old_style_name_like_wpse_123298');

/************* CUSTOM Masthead Nav Walker *****************/

class Custom_MastHead_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li class="up">|</li><li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}	
	
	
}


/************* CUSTOM Events Feed *****************/


function get_custom_feed() {
    if ( function_exists('fetch_feed')) {
    	include_once(ABSPATH . WPINC . '/feed.php');
	// Events RSS Feed URL
    	$feed = fetch_feed('http://www.events.westernu.ca/events/western/rss.xml');
    	if( ! is_wp_error( $feed ) ) {
    		$feed->enable_order_by_date(false);
	    	$limit = $feed->get_item_quantity(5);
	    	$items = $feed->get_items(0, $limit);
    	}
    	$markup = '';
    	if (!$items) {
    		$markup = 'problem getting feed';
    	} else {
    		foreach ($items as $item) {
    			$text = $item->get_title();
				// Changed RSS output to pull in full title as opposed to only content after a " - " | Aug 19, 2014 - Jamieson Roberts
    			//$title = strstr_after($text, " - ");
    			//$markup .= '<li><a href="' . $item->get_permalink() . '">' . $title . '</a><br/>';
				$markup .= '<li><a href="' . $item->get_permalink() . '">' . $text . '</a><br/>';
    			$markup .= $item->get_date('F j, Y') . '</li>';
    		}
    	}
    }
    return $markup;
}

/**** Related posts WIDGET ****/

class related_posts_widget extends WP_Widget {

    /** constructor -- name this the same as the class above */
    function related_posts_widget() {
        parent::WP_Widget(false, $name = 'Related Posts');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 	= apply_filters('widget_title', $instance['title']);
        ?>
            <?php echo $before_widget; ?>
                <?php if ( $title ) {
                    echo $before_title . $title . $after_title;
                } ?>
				<?php bones_related_posts(); ?>
            <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {
        $title 		= esc_attr($instance['title']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
} // end class rss_widget
add_action('widgets_init', create_function('', 'return register_widget("related_posts_widget");'));

if (class_exists('WMP_Widget')) {
class CustomWMP_Widget extends WMP_Widget {
	private function default_options( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$options['title'] = esc_attr( $instance[ 'title' ] );
		else
			$options['title'] = 'Popular posts';

		if ( isset( $instance[ 'number' ] ) )
			$options['number'] = (int) $instance[ 'number' ];
		else
			$options['number'] = 5;

		if ( isset( $instance[ 'post_type' ] ) )
			$options['post_type'] = esc_attr( $instance[ 'post_type' ] );
		else
			$options['post_type'] = 'all';

		if ( isset( $instance[ 'timeline' ] ) )
			$options['timeline'] = esc_attr( $instance[ 'timeline' ] );
		else
			$options['timeline'] = 'all_time';

		return $options;
	}

	public function widget( $args, $instance ) {
		// Find default args
		extract( $args );

		// Get our posts
		$defaults			= $this->default_options( $instance );
		$options['limit']	= (int) $defaults[ 'number' ];
		$options['range']	= $defaults['timeline'];

		if ( $defaults['post_type'] != 'all' ) {
			$options['post_type'] = $defaults['post_type'];
		}

		$posts = custom_wmp_get_popular( $options );

		// Display the widget
		echo $before_widget;
		if ( $defaults['title'] ) echo $before_title . $defaults['title'] . $after_title;
		echo '<ul>';
		global $post;
		foreach ( $posts as $post ):
			setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				<?php
				if ( is_front_page() ) { ?>
				<span class="post-date"><?php echo get_the_date(); ?></span></li>
				<?php } ?>
			<?php
		endforeach;
		echo '</ul>';
		echo $after_widget;

		// Reset post data
		wp_reset_postdata();
	}
}
add_action('widgets_init', create_function('', 'return register_widget("CustomWMP_Widget");'));
}

function custom_wmp_get_popular( $args = array() ) {
	global $wpdb;

	// Default arguments
	$limit = 5;
	$post_type = array( 'post' );
	$range = 'all_time';

	if ( isset( $args['limit'] ) ) {
		$limit = $args['limit'];
	}

	if ( isset( $args['post_type'] ) ) {
		if ( is_array( $args['post_type'] ) ) {
			$post_type = $args['post_type'];
		} else {
			$post_type = array( $args['post_type'] );
		}
	}

	if ( isset( $args['range'] ) ) {
		$range = $args['range'];
	}

	switch( $range ) {
		CASE 'all_time':
			$order = "ORDER BY all_time_stats DESC";
			break;
		CASE 'monthly':
			$order = "ORDER BY 30_day_stats DESC";
			break;
		CASE 'weekly':
			$order = "ORDER BY 7_day_stats DESC";
			break;
		CASE 'daily':
			$order = "ORDER BY 1_day_stats DESC";
			break;
		DEFAULT:
			$order = "ORDER BY all_time_stats DESC";
			break;
	}

	$holder = implode( ',', array_fill( 0, count( $post_type ), '%s') );

	$sql = "
		SELECT
			p.*
		FROM
			{$wpdb->prefix}most_popular mp
			INNER JOIN $wpdb->posts p ON mp.post_id = p.ID
		WHERE
			p.post_type IN ( $holder ) AND
			p.post_status = 'publish'
		{$order}
		LIMIT %d
	";

	$result = $wpdb->get_results( $wpdb->prepare( $sql, array_merge( $post_type, array( $limit ) ) ), OBJECT );

	if ( ! $result) {
		return array();
	}

	return $result;
}

function strstr_after($haystack, $needle, $case_insensitive = false) {
    $strpos = ($case_insensitive) ? 'stripos' : 'strpos';
    $pos = $strpos($haystack, $needle);
    if (is_int($pos)) {
        return substr($haystack, $pos + strlen($needle));
    }
    return $pos;
}





add_filter("attachment_fields_to_edit", "add_photo_credit", 10, 2);
function add_photo_credit($form_fields, $post) {
        $form_fields["photo_credit"] = array(
                'label' => 'Photo Credit',
				'input' => 'text',
				'value' => get_post_meta( $post->ID, 'photo_credit', true ),
				'helps' => 'If provided, photo credit will be displayed',
        );
        return $form_fields;
}

add_filter("attachment_fields_to_save", "save_photo_credit", 10 , 2);
function save_photo_credit($post, $attachment) {
        if (isset($attachment['photo_credit']))
                update_post_meta($post['ID'], 'photo_credit', trim($attachment['photo_credit']));
        return $post;
}

add_filter('img_caption_shortcode', 'caption_shortcode_with_credits', 10, 3);
function caption_shortcode_with_credits($empty, $attr, $content) {
        extract(shortcode_atts(array(
                'id'    => '',
                'align' => 'alignnone',
                'width' => '',
                'caption' => ''
        ), $attr));

        // Extract attachment $post->ID
        preg_match('/\d+/', $id, $att_id);
        if (is_numeric($att_id[0]) && $photo_credit = get_post_meta($att_id[0], 'photo_credit', true)) {
                $credit = $photo_credit;
        }

        if ( 1 > (int) $width || empty($caption) )
                return $content;

        if ( $id )
                $id = 'id="' . esc_attr($id) . '" ';

 		if ($credit) {
 			$credit = '<span class="photo-credit">' . $credit . '</span>';
 		}
		else {
			$credit = '';
		}

        return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
        . do_shortcode( $content ) . '<p class="flex-caption"><span>' . $credit . '</span><span class="photo-caption">' . $caption . '</span></p></div>';
}

// Add Featured Image to RSS feeds for Cascade Server integration
add_filter('rss2_item', 'add_featured_image_to_feed');
add_filter('atom_entry', 'add_featured_image_to_feed');
add_filter('rdf_item', 'add_featured_image_to_feed');
function add_featured_image_to_feed () {
	global $post;
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , 'bones-thumb-220' );
	if($thumb != null) {
		$thumbnail = $thumb[0];
		echo("<image>{$thumbnail}</image>");
	} else {
		$blankthumb = get_template_directory_uri() . '/library/images/crest.png';
		echo("<image>{$blankthumb}</image>");
	}
}

add_filter('rss2_item', 'featured_post_for_homepage');
add_filter('atom_entry', 'featured_post_for_homepage');
add_filter('rdf_item', 'featured_post_for_homepage');
function featured_post_for_homepage () {
	global $post;
	$featuredPost = get_post_meta($post->ID, 'wpcf-featured-post-in-rss', true);
	if( is_feed() && $featuredPost!=null ) {
		echo("<featuredpost>true</featuredpost>");
	} else {
		echo("<featuredpost>false</featuredpost>");
	}
}



add_filter('the_author', 'rss_author_adjust');
function rss_author_adjust() {
	global $post;
	$otherAuthor = get_post_meta($post->ID, 'wpcf-other-author', true);
	if (is_feed() && $otherAuthor!=null)
		return $otherAuthor;

	return get_the_author_meta('display_name',$post->post_author);
}
// Return Category ID from human readable slug
function gimme_an_id($slug) {
	
	$mytermID = get_term_by( 'name', $slug, 'category' );	
	return (int)$mytermID->term_id;
}

// Remove shortcodes from search
add_filter( 'get_the_excerpt', 'shortcodetext_in_excerpt' );
function shortcodetext_in_excerpt( $excerpt ) {
    return preg_replace( '/\[[^\]]+\]/', '', $excerpt );
}


function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
} 
add_action( 'loop_start', 'jptweak_remove_share' );

function font_awesome_enqueue() {
    wp_enqueue_style( 'font-awesome-min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' ); 
    wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/css/sharing.css');
}
add_action( 'wp_enqueue_scripts', 'font_awesome_enqueue' );


/**
 * WTI Custom Navigation Menu widget class
 *
 * @since 3.0.0
 */

class western_Custom_Nav_Menu_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'description' => __('Use this widget to add one of your custom menus as a widget.') );
        parent::__construct( 'custom_nav_menu', __('Western Custom Menu'), $widget_ops );
    }

    function widget($args, $instance) {
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( !$nav_menu )
            return;

        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( !empty($instance['title']) )
            echo $args['before_title'] . $instance['title'] . $args['after_title'];

        wp_nav_menu(
                array(
                    'fallback_cb' 		=> '',
					'container'     	=> 'nav',
					'container_class'	=> '',
					'container_id'  	=> '',
					'menu_class'    	=> 'menu',
					'menu_id'       	=> '',
					'depth'				=> 1,
					'items_wrap' 		=> '<ul class="nav footer-nav clearfix">%3$s</ul>',
                    'menu_class' 		=> $instance['menu_class'],
                    'menu' 				=> $nav_menu
                )
            );

        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags ( stripslashes ( $new_instance['title'] ) );
        $instance['menu_class'] = strip_tags ( stripslashes ( trim ( $new_instance['menu_class'] ) ) );
        $instance['nav_menu'] = (int) $new_instance['nav_menu'];

        return $instance;
    }

    function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $menu_class = isset( $instance['menu_class'] ) ? $instance['menu_class'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

        // Get menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

        // If no menus exists, direct the user to go and create some.
        if ( !$menus ) {
            echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
            return;
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('menu_class'); ?>"><?php _e('Menu Class:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('menu_class'); ?>" name="<?php echo $this->get_field_name('menu_class'); ?>" value="<?php echo $menu_class; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
            <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
        <?php
            foreach ( $menus as $menu ) {
                echo '<option value="' . $menu->term_id . '"'
                    . selected( $nav_menu, $menu->term_id, false )
                    . '>'. $menu->name . '</option>';
            }
        ?>
            </select>
        </p>
        <?php
    }
}

function western_custom_nav_menu_widget() {
    register_widget('western_Custom_Nav_Menu_Widget');
}

add_action ( 'widgets_init', 'western_custom_nav_menu_widget', 1 );

function import_strip($x) {
	$data = str_replace( '<div> </div>', ' ', $x);
	$data = str_replace( '<div>','<p>', $data);
	$data = str_replace( '</div>','</p>', $data);	
    $newx = strip_tags($data, '<p><a><strong><em><i><b><br><br/>' );
    return $newx;
}

function video_embed_filter( $html, $data ) {

 // Verify oembed data (as done in the oEmbed data2html code)
 if ( ! is_object( $data ) || empty( $data->type ) )
 return $html;
 
 // Verify that it is a video
 if ( !($data->type == 'video') )
 return $html;

 // Calculate aspect ratio
 $ar = $data->width / $data->height;

 // Set the aspect ratio modifier
 $ar_mod = ( abs($ar-(4/3)) < abs($ar-(16/9)) ? 'embed-responsive-4by3' : 'embed-responsive-16by9');

 // Strip width and height from html
 $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

 // Return code
 return '<div class="video-container '.$ar_mod.'" data-aspectratio="'.number_format($ar, 5, '.').'">'.$html.'</div>';

}
add_filter('oembed_dataparse', 'video_embed_filter', 10, 2 );


?>
