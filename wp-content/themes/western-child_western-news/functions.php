<?php

//
//
//		Functions File for Western News
//
//

// Register Extra Widget Areas

function bones_added_register_sidebars() {
register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'News Sidebar', 'bonestheme' ),
		'description' => __( 'The second sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar3',
		'name' => __( 'Categories Sidebar', 'bonestheme' ),
		'description' => __( 'The third sidebar.', 'bonestheme' ),
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
		'name' => __( 'PDF Sidebar', 'bonestheme' ),
		'description' => __( 'Sidebar for PDFs.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar6',
		'name' => __( 'Classifieds Sidebar', 'bonestheme' ),
		'description' => __( 'Sidebar for Classifieds.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar7',
		'name' => __( 'Multimedia Sidebar', 'bonestheme' ),
		'description' => __( 'Sidebar for Multimedia.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}
add_action( 'widgets_init', 'bones_added_register_sidebars' );



add_filter('wp_handle_upload_prefilter', 'back_issues_handle_upload_prefilter');
add_filter('wp_handle_upload', 'back_issues_handle_upload');

function back_issues_handle_upload_prefilter( $file )
{
    add_filter('upload_dir', 'back_issues_custom_upload_dir');
    return $file;
}

function back_issues_handle_upload( $fileinfo )
{
    remove_filter('upload_dir', 'back_issues_custom_upload_dir');
    return $fileinfo;
}

function back_issues_custom_upload_dir( $path )
{
    // Check if uploading from inside a post/page/cpt - if not, default Upload folder is used
    $use_default_dir = ( isset($_REQUEST['post_id'] ) && $_REQUEST['post_id'] == 0 ) ? true : false;
    if( !empty( $path['error'] ) || $use_default_dir )
        return $path;

    // Check if correct post type
    $the_post_type = get_post_type( $_REQUEST['post_id'] );
    if( 'wn_back_issues' != $the_post_type )
        return $path;

    $customdir = '/' . date( 'Y/m' );

    //remove default subdir (year/month) and add custom dir INSIDE THE DEFAULT UPLOAD DIR
    $path['path']    = str_replace( $path['subdir'], '/back_issues' . $customdir, $path['path']);
    $path['url']     = str_replace( $path['subdir'], '/back_issues' . $customdir, $path['url']);

    $path['subdir']  = $customdir;

    return $path;
}

add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {
  global $wp_the_query;

  if ( is_post_type_archive('wn_back_issues') && !is_admin() ) {
    set_query_var('posts_per_page', 12);
	}
  return $query;
}

// Custom folers for classifieds post type

add_filter('wp_handle_upload_prefilter', 'classifieds_handle_upload_prefilter');
add_filter('wp_handle_upload', 'classifieds_handle_upload');

function classifieds_handle_upload_prefilter( $file )
{
    add_filter('upload_dir', 'classifieds_custom_upload_dir');
    return $file;
}

function classifieds_handle_upload( $fileinfo )
{
    remove_filter('upload_dir', 'classifieds_custom_upload_dir');
    return $fileinfo;
}

function classifieds_custom_upload_dir( $path )
{
    // Check if uploading from inside a post/page/cpt - if not, default Upload folder is used
    $use_default_dir = ( isset($_REQUEST['post_id'] ) && $_REQUEST['post_id'] == 0 ) ? true : false;
    if( !empty( $path['error'] ) || $use_default_dir )
        return $path;

    // Check if correct post type
    $the_post_type = get_post_type( $_REQUEST['post_id'] );
    if( 'wn_classifieds' != $the_post_type )
        return $path;

    $customdir = '/' . date( 'Y/m' );

    //remove default subdir (year/month) and add custom dir INSIDE THE DEFAULT UPLOAD DIR
    $path['path']    = str_replace( $path['subdir'], '/classifieds' . $customdir, $path['path']);
    $path['url']     = str_replace( $path['subdir'], '/classifieds' . $customdir, $path['url']);

    $path['subdir']  = $customdir;

    return $path;
}

/**** PDF WIDGET ****/

class classifieds_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function classifieds_widget() {
        parent::WP_Widget(false, $name = 'Classified Categories');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
								<?php

									$args = array(
										'hide_empty' => 0,
										'pad_counts' => 1,
										'taxonomy' => 'classified_category',
										'parent' => 0,
									);
									$top_cats = get_categories($args);
									print '<div id="accordion">';
									foreach ($top_cats as $title) {
										print '<h3>' . $title->name .'</h3>';
										print '<div><ul><li><a href="' . site_url() . '/' . $title->taxonomy . '/' . $title->slug . '">All</a> (<span class="class-number">' . $title->count . '</span>)</li>';
										$args2 = array (
											'hide_empty' => 0,
											'parent' => $title->term_id,
											'pad_counts' => 1,
											'taxonomy' => 'classified_category',
										);
										$cats = get_categories($args2);
										foreach ($cats as $cat) {
											print '<li><a href="' . site_url() . '/' . $cat->taxonomy . '/' . $cat->slug . '">' . $cat->name . '</a> (<span class="class-number">' . $cat->count . '</span>)</li>';
										}
										print '</ul></div>';
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
add_action('widgets_init', create_function('', 'return register_widget("classifieds_widget");'));


/**** PDF WIDGET ****/

class back_issue_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function back_issue_widget() {
        parent::WP_Widget(false, $name = 'Western News PDF');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        // $message 	= get_recent_pdf();
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
								<?php
								$args = array( 'post_type' => 'wn_back_issues', 'posts_per_page' => 1 );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
							        the_post_thumbnail( 'bones-thumb-125' );
									$pattern = "/<a?.*>(.*)<\/a>/";
									preg_match($pattern, $loop->posts[0]->post_content, $matches);
							        echo '<p>' . $matches[0] . '</p><a class="pdf-archive" href="back-issues">Back Issues</a>';
								endwhile;

								wp_reset_query();
								if ( !$loop->have_posts() ) {
									echo '<p>Currently no Western News Back Issues have been added.</p>';
								} ?>
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

} // end class pdf_widget
add_action('widgets_init', create_function('', 'return register_widget("back_issue_widget");'));

function my_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['wn_multimedia'] = array(
		0 => '',
		1 => sprintf( __('Multimedia updated. <a href="%s">View multimedia</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Multimedia updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Multimedia restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Multimedia published. <a href="%s">View multimedia</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Multimedia saved.'),
		8 => sprintf( __('Multimedia submitted. <a target="_blank" href="%s">Preview multimedia</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Multimedia scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview multimedia</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Multimedia draft updated. <a target="_blank" href="%s">Preview multimedia</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	$messages['wn_back_issues'] = array(
		0 => '',
		1 => sprintf( __('Back Issue updated. <a href="%s">View Back Issue</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Back Issue updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Back Issue restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Back Issue published. <a href="%s">View back issue</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Back Issue saved.'),
		8 => sprintf( __('Back Issue submitted. <a target="_blank" href="%s">Preview back issue</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Back Issue scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview back issue</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Back Issue draft updated. <a target="_blank" href="%s">Preview back issue</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	$messages['wn_classifieds'] = array(
		0 => '',
		1 => sprintf( __('Classified updated. <a href="%s">View classified</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Classified updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Classified restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Classified published. <a href="%s">View classified</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Classified saved.'),
		8 => sprintf( __('Classified submitted. <a target="_blank" href="%s">Preview classified</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Classified scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview classified</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Classified draft updated. <a target="_blank" href="%s">Preview classified</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

function my_taxonomies_classified() {
	$labels = array(
		'name'              => _x( 'Classified Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Classified Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Classified Categories' ),
		'all_items'         => __( 'All Classified Categories' ),
		'parent_item'       => __( 'Parent Classified Category' ),
		'parent_item_colon' => __( 'Parent Classified Category:' ),
		'edit_item'         => __( 'Edit Classified Category' ),
		'update_item'       => __( 'Update Classified Category' ),
		'add_new_item'      => __( 'Add New Classified Category' ),
		'new_item_name'     => __( 'New Classified Category' ),
		'menu_name'         => __( 'Classified Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'classified_category')
	);
	register_taxonomy( 'classified_category', 'wn_classifieds', $args );
}
add_action( 'init', 'my_taxonomies_classified', 0 );

/************* CUSTOM post type *****************/

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'wn_multimedia',
		array(
			'labels' => array(
				'name' => __( 'Multimedia' ),
				'singular_name' => __( 'Multimedia' ),
				'add_new'            => __( 'Add New'),
				'add_new_item'       => __( 'Add New Multimedia' ),
				'edit_item'          => __( 'Edit Multimedia' ),
				'new_item'           => __( 'New Multimedian' ),
				'all_items'          => __( 'All Multimedia' ),
				'view_item'          => __( 'View Multimedia' ),
				'search_items'       => __( 'Search Multimedia' ),
				'not_found'          => __( 'No multimedia found' ),
				'not_found_in_trash' => __( 'No multimedia found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Multimedia'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'multimedia'),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky','post-formats')
		)
	);
	register_post_type( 'wn_back_issues',
		array(
			'labels' => array(
				'name' => __( 'Back Issues' ),
				'singular_name' => __( 'Back Issue' ),
				'add_new'            => __( 'Add New'),
				'add_new_item'       => __( 'Add New Back Issue' ),
				'edit_item'          => __( 'Edit Back Issue' ),
				'new_item'           => __( 'New Back Issue' ),
				'all_items'          => __( 'All Back Issue' ),
				'view_item'          => __( 'View Back Issue' ),
				'search_items'       => __( 'Search Back Issue' ),
				'not_found'          => __( 'No back issues found' ),
				'not_found_in_trash' => __( 'No back_issues found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Back Issues'
			),
			'description' => 'Holds our back issues and back issue specific data',
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'back-issues'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'sticky','post-formats', 'author')
		)
	);
	register_post_type( 'wn_classifieds',
		array(
			'labels' => array(
				'name' => __( 'Classifieds' ),
				'singular_name' => __( 'Classifieds' ),
				'add_new'            => __( 'Add New'),
				'add_new_item'       => __( 'Add New Classified' ),
				'edit_item'          => __( 'Edit Classified' ),
				'new_item'           => __( 'New Classified' ),
				'all_items'          => __( 'All Classifieds' ),
				'view_item'          => __( 'View Classified' ),
				'search_items'       => __( 'Search Classifieds' ),
				'not_found'          => __( 'No classifieds found' ),
				'not_found_in_trash' => __( 'No classifieds found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Classifieds'
			),
			'description' => 'Holds our classifieds and classified specific data',
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'classifieds'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
		)
	);
	flush_rewrite_rules();
}

function register_child_theme_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri(), array( 'bones-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'register_child_theme_styles' );

add_filter('wp_feed_cache_transient_lifetime', 'my_rss_refresh' );
function my_rss_refresh( $seconds ) {
	return 300;
}

function add_featured_column($columns) {
    return array_merge( $columns,
              array('featured' => __('Featured')) );
}
add_filter('manage_post_posts_columns' , 'add_featured_column');

function add_featured_column_content($column_name, $post_ID){
	$featuredPost = get_post_meta($post_ID, 'wpcf-uwo-post-order', true);
	$featuredFaculty = get_post_meta($post_ID, 'wpcf-featured-post-in-rss', true);
	if ($column_name = 'featured' && $featuredPost!=null ) {
		switch ($featuredPost){
			case 0:
				echo 'Not shown'. ($featuredFaculty ? '<br/><strong>Featured on Faculty/Staff Page</strong>' : '');
				break;
			case 1:
				echo 'Featured Post with image' . ($featuredFaculty ? '<br/><strong>Featured on Faculty/Staff Page</strong>' : '');
				break;
			case in_array($featuredPost, array(2,3,4,5,6)):
				$featuredPost = $featuredPost-1;
				echo 'Story shown - Position: '.$featuredPost .($featuredFaculty ? '<br/><strong>Featured on Faculty/Staff Page</strong>' : '');
				break;
		}
	}
}
add_action('manage_post_posts_custom_column', 'add_featured_column_content', 10, 2);

// Modify post query to create exclusive Faculty/Staff to enable an isolated RSS feed
add_filter('pre_get_posts', 'remove_staff_exclusive');
function remove_staff_exclusive( $query ) {

	if ( is_admin() || ( is_feed() && is_category( 'faculty-staff-exclusive' ) ) || is_category( 'faculty-staff-exclusive' ) )
		return;
	// Remove Category
	$query->set( 'cat', '-'.gimme_an_id('Faculty / Staff Exclusive') );
}

add_action('rss2_head','current_archive');
add_action('rss_head','current_archive');
add_action('commentsrss2_head','current_archive');

function current_archive() {
	$pdfArchive = new WP_query( array (
	    'post_type' => 'wn_back_issues',
	    'showposts' => 1
	) );
	if ( $pdfArchive->have_posts() ):
		while ( $pdfArchive->have_posts() ): $pdfArchive->the_post();
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id);
			$thumb_url = $thumb_url_array[0];
			$media = get_attached_media('application/pdf');
			foreach($media as $pdfLinks) {
				$pdfFileLink = array( wp_get_attachment_url( $pdfLinks->ID ) );
				$pdfServerLink = array( get_attached_file( $pdfLinks->ID ) );
			}
			$pdfFileSize = number_format( filesize( $pdfServerLink[0] ) / 1048576 , 2 );

		?>
			<archivepdf>
				<currentpdf><?php echo $pdfFileLink[0];  ?></currentpdf>
				<pdfCover><?php echo $thumb_url; ?></pdfCover>
				<pdfSize><?php echo $pdfFileSize; ?>MB</pdfSize>
			</archivepdf>
		<?php

		endwhile;
	endif;
	wp_reset_postdata();

}



?>
