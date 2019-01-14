<?php

// 
//
//		Functions File for Media Relations
//
//

// Register Extra Widget Areas

function bones_added_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Media Releases Sidebar', 'bonestheme' ),
		'description' => __( 'The second sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));


	register_sidebar(array(
		'id' => 'sidebar4',
		'name' => __( 'Singles', 'bonestheme' ),
		'description' => __( 'Sidebar for single pages.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar5',
		'name' => __( 'In the News Sidebar', 'bonestheme' ),
		'description' => __( 'Sidebar for Western In the News.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));


}
add_action( 'widgets_init', 'bones_added_register_sidebars' );

// Register Script
function child_theme_custom_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri(), array( 'bones-stylesheet' ) );	
	wp_enqueue_script( 'child-style' );
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'child_theme_custom_scripts' );

function remove_menus(){

  remove_menu_page( 'edit-comments.php' );          //Comments
  
}
add_action( 'admin_menu', 'remove_menus' );


if ( ! function_exists('inthenews_post_type') ) {

// Register Custom Post Type
function inthenews_post_type() {

	$labels = array(
		'name'                => _x( 'Western in the News', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'News Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Western in the News', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'newsmaker',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'inthenews_post', 'text_domain' ),
		'description'         => __( 'Western In the News', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'revisions', 'post-formats', ),
		'hierarchical'        => false,
		'public' 			  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 25,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'inthenews_post', $args );
	flush_rewrite_rules();
}

// Hook into the 'init' action
add_action( 'init', 'inthenews_post_type', 0 );

}


if ( ! function_exists('staff_members') ) {

// Register Custom Post Type
function staff_members() {

	$labels = array(
		'name'                => _x( 'Staff', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Staff Members', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Staff:', 'text_domain' ),
		'all_items'           => __( 'All Staff', 'text_domain' ),
		'view_item'           => __( 'View Staff', 'text_domain' ),
		'add_new_item'        => __( 'Add New Staff', 'text_domain' ),
		'add_new'             => __( 'Add Staff', 'text_domain' ),
		'edit_item'           => __( 'Edit Staff', 'text_domain' ),
		'update_item'         => __( 'Update Staff', 'text_domain' ),
		'search_items'        => __( 'Search Staff', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'staff_information', 'text_domain' ),
		'description'         => __( 'Staff Members', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail','page-attributes',  ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-admin-users',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'staff_information', $args );
	flush_rewrite_rules();
}

// Hook into the 'init' action
add_action( 'init', 'staff_members', 0 );

}


function add_custom_post_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post','nav_menu_item', 'inthenews_post'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'add_custom_post_types' );

class post_author_widget extends WP_Widget {
        public function __construct() {
			// widget actual processes
			parent::WP_Widget(false,'Post Author Information','description=Displays the posts author contact information');
        }

        public function form( $instance ) {
			// outputs the options form on admin
			echo '<p>Outputs the Post author information in a preformated layout.</p>';
        }

        public function widget( $args, $instance ) {
			global $post;
			$this_post_author = get_the_author_meta('user_email', $post->post_author); 
			$args = array(
				'post_type'		=>	'staff_information',
				'meta_query'	=>	array(
					array(
						'key' => 'wpcf-email-address',
						'value' =>	$this_post_author,
					)
				)
			);
			$my_author_query = new WP_Query( $args );               
			if ( get_post_type( $post)  != 'inthenews_post' ) {
				?>
				<div id="media-contact-widget" class="widget"><h4 class="widgettitle">Media Contact</h4>
					
				<?php
					if( $my_author_query->have_posts() ) {
					  while( $my_author_query->have_posts() ) {
						$my_author_query->the_post();
						echo '<p><strong>'. get_the_title() .'</strong></br>';
						echo get_the_content();
						echo '</br>';
						 echo '519 661-2111 ' .  types_render_field("extension",array('output'=>'raw'));
						 $email_address = types_render_field("email-address",array('output'=>'raw'));
						echo '</br><a href="mailto:'. $email_address .'" title="'. $email_address.'">'. $email_address .'</a>';
					  } // end while
					} // end if
					wp_reset_postdata();
				
				echo '</p></div>';
			}
        }

}
register_widget( 'post_author_widget' );


class media_relations_staff extends WP_Widget {
        public function __construct() {
			// widget actual processes
			parent::WP_Widget(false,'Media Relations Staff List','description=Lists the Media Relations staff, but is hidden on the about page.');
        }

        public function form( $instance ) {
			// outputs the options form on admin
			echo '<p>Outputs the Post author information in a preformated layout.</p>';
        }

        public function widget( $args, $instance ) {
			global $post;
			$args = array (
				'post_type'              => 'staff_information',
				'order'                  => 'ASC',
				'orderby'                => 'menu_order',
				'meta_query'	=>	array(
					array(
						'key' => 'wpcf-widget-show',
						'value' =>	1,
					)
				)
				
			);
			$contact_query = new WP_Query( $args );               
			if ( !is_page('about') ) {
				?>
				<div id="media-contact-widget" class="widget"><h4 class="widgettitle">Contact us</h4>
					
				<?php
					if( $contact_query->have_posts() ) {
					  while( $contact_query->have_posts() ) {
						$contact_query->the_post();
						$email_address = types_render_field("email-address",array('output'=>'raw'));
						echo '<p><a href="mailto:'. $email_address .'" title="'. $email_address.'"><strong>'. get_the_title() .'</strong></a></br>';
						echo get_the_content();
						echo '</br>';
						 echo '519 661-2111 ' .  types_render_field("extension",array('output'=>'raw'));
						 
						echo '</p>';
					  } // end while
					} // end if
					wp_reset_postdata();
				
				echo '</p></div>';
			}
        }

}
register_widget( 'media_relations_staff' );

class archives_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function archives_widget() {
        parent::WP_Widget(false, $name = 'Archives Accordion');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
					<?php if ( $title )
					    echo $before_title . $title . $after_title; ?>
								
					<?php global $wpdb;
					$post_type_for_query = get_post_type();
					$results = $wpdb->get_results("SELECT ID, post_date FROM {$wpdb->prefix}posts WHERE post_type = '". $post_type_for_query ."' AND post_status = 'publish' ORDER BY post_date DESC");
										
					print '<div class="posts_accordion">';
					
					$archiveArr = array();
					foreach($results as $result) {
					    $year = date('Y', strtotime($result->post_date)); // get post year
					    $month = date('m', strtotime($result->post_date)); // get post month
					    $archiveArr[$year][$month][$result->ID] = $result; // set the array
					}
					
					foreach($archiveArr as $year=>$months) {
					    $total_year = 0;

					        $total_year = $total_year + count($posts); // set the total posts for this year
						
					    ?>
					    <h3><a href="<?php echo get_year_link($year) . '?post_type=' . $post_type_for_query; ?>"><?php echo $year; ?></a></h3>					    					    
					        <div class="posts_accordion-content"><ul class="archive-sub-menu">
					            <?php  foreach( array_reverse($months, true) as $month=>$posts) { ?>
					            <li><a href="<?php echo get_month_link($year, $month) . '?post_type=' . $post_type_for_query; ?>">
					                <?php echo date( 'F', mktime(0, 0, 0, $month) ); ?></a>
					            </li>
					            <?php } ?>
					        </ul></div>
					    
					    <?php
					}
					print '</div>';
					?>													
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

} // end class classifieds_widget
register_widget( 'archives_widget' );

function user_the_categories() {
    // get all categories for this post
    global $cats;
    $cats = get_the_category();
    // echo the first category
    echo $cats[0]->slug;
    // echo the remaining categories, appending separator
    for ($i = 1; $i < count($cats); $i++) {echo ' ' . $cats[$i]->slug ;}
}

add_action('rss2_item', 'customfields_rss2_item');
function customfields_rss2_item() {
  if (get_post_type() == 'inthenews_post') {
    $fields = array( 'wpcf-link', 'wpcf-source-url', 'wpcf-source' );
    $post_id = get_the_ID();
    foreach($fields as $field) {
      	if ($value = get_post_meta($post_id,$field,true)) {
        	echo "<{$field}>{$value}</{$field}>\n";
    	}
    }
  }
}

add_filter('the_permalink_rss', 'western_permalink');
function western_permalink($permalink) {

    $link = get_post_meta(get_the_id(), 'wpcf-link', true);

    if (!empty($link))
        return $link;

    return $permalink;
}


?>