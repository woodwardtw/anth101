<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array());
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.0', true );
    wp_enqueue_script( 'anth-scripts', get_stylesheet_directory_uri() . '/js/anth.js', array(), '0.1.0', true );

}

/*
function custom_post_type_personal() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Your Portfolio', 'Post Type General Name', 'anth' ),
		'singular_name'       => _x( 'Your Portfolio', 'Post Type Singular Name', 'anth' ),
		'menu_name'           => __( 'Your Portfolio', 'anth' ),
		'all_items'           => __( 'All Portfolios', 'blackout' ),
		'view_item'           => __( 'View Portfolio', 'blackout' ),
		'add_new_item'        => __( 'Add New Portfolio', 'blackout' ),
		'add_new'             => __( 'Add New', 'blackout' ),
		'edit_item'           => __( 'Edit Portfolio', 'blackout' ),
		'update_item'         => __( 'Update Portfolio', 'blackout' ),
		'search_items'        => __( 'Search Portfolio', 'blackout' ),
		'not_found'           => __( 'Portfolio Not Found', 'blackout' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'blackout' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Portfolio', 'blackout' ),
		'description'         => __( 'Portfolio info', 'blackout' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'scene' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
/*		
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'       => true,
  		'rest_base'          => 'personal-api',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
  		'menu_icon' => 'dashicons-admin-users',

	);
// Registering your Custom Post Type
	register_post_type( 'Personals', $args );

}	
add_action( 'init', 'custom_post_type_personal', 0 );
*/

function custom_post_type_tribe() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Tribe', 'Post Type General Name', 'anth' ),
		'singular_name'       => _x( 'Tribe', 'Post Type Singular Name', 'anth' ),
		'menu_name'           => __( 'Tribes', 'anth' ),
		'all_items'           => __( 'All Tribes', 'blackout' ),
		'view_item'           => __( 'View Tribe', 'blackout' ),
		'add_new_item'        => __( 'Add New Tribe', 'blackout' ),
		'add_new'             => __( 'Add New', 'blackout' ),
		'edit_item'           => __( 'Edit Tribe', 'blackout' ),
		'update_item'         => __( 'Update Tribe', 'blackout' ),
		'search_items'        => __( 'Search Tribes', 'blackout' ),
		'not_found'           => __( 'Tribe Not Found', 'blackout' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'blackout' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Tribes', 'blackout' ),
		'description'         => __( 'Tribe info', 'blackout' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'tribe' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'       => true,
  		'rest_base'          => 'personal-api',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
  		'menu_icon' => 'dashicons-groups',
	);
// Registering your Custom Post Type
	register_post_type( 'Tribe', $args );

}	
add_action( 'init', 'custom_post_type_tribe', 0 );

/**  set custom field stu_id if empty **/

function setField(){

}


/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );


/**
*******************THE LAND OF PURIFICATION -----------------------------------------------------------------------------**********************************
HIDE Posts from ppl who aren't the author or greater
**/

function posts_for_current_author($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'manage_options' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

/** HIDE MORE ADMIN STUFF from AUTHORS **/

/* Clean up the admin sidebar navigation *************************************************/
function remove_admin_menu_items() {
if( current_user_can( 'manage_options' ) ) { }
	else {	
  $remove_menu_items = array(__('Media'),__('Tools'),__('Episodes'),__('Contact'), __('Comments'));
  global $menu;
  end ($menu);
  while (prev($menu)){
    $item = explode(' ',$menu[key($menu)][0]);
    if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
      unset($menu[key($menu)]);
    }
  }
}
}
add_action('admin_menu', 'remove_admin_menu_items');

function remove_menus(){
if( current_user_can( 'manage_options' ) ) { }
	else {		
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'vc-welcome' );        //Settings
  remove_menu_page( 'profile' );        //profile
  //remove_menu_page('profile.php');

}
}
add_action( 'admin_menu', 'remove_menus', 999 );


//redirects from dashboard to edit post list 
function remove_the_dashboard () {
if (current_user_can('level_10')) {
	return;
	}else {
	global $menu, $submenu, $user_ID;
	$the_user = new WP_User($user_ID);
	reset($menu); $page = key($menu);
	while ((__('Dashboard') != $menu[$page][0]) && next($menu))
	$page = key($menu);
	if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
	reset($menu); $page = key($menu);
	while (!$the_user->has_cap($menu[$page][1]) && next($menu))
	$page = key($menu);
	if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
	wp_redirect(get_option('siteurl') . '/wp-admin/edit.php');}
}
add_action('admin_menu', 'remove_the_dashboard');

//adds author email to user_id meta field on save

function add_user_id_metafield( $post_id ) {
        $metaEmail = get_post_meta( get_the_ID(), 'stu_id', true );
        // Check if the custom field has a value.
        if (isset($post->post_status) && 'auto-draft' == $post->post_status) {
    return;
  }
        if ( ! empty( $metaEmail) ) {
        } else {
        	global $current_user;
			wp_get_current_user(); 
            $user_email = $current_user->user_email;           
            update_post_meta(get_the_ID($post_id),'stu_id', $user_email);
    
         }
}
add_action( 'save_post', 'add_user_id_metafield' );

//make pagination work for tribes

add_filter( 'redirect_canonical','custom_disable_redirect_canonical' ); 
function custom_disable_redirect_canonical( $redirect_url ){
    if ( is_singular('tribes') ) $redirect_url = false;
    return $redirect_url;
}


//set posts to single column display from http://wordpress.stackexchange.com/questions/4552/how-do-i-force-a-single-column-layout-in-screen-layout
function so_screen_layout_columns( $columns ) {
	 if(!current_user_can('administrator')) {
	    $columns['post'] = 1;
	    return $columns;
	}
}
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );

function so_screen_layout_post() {
	 if(!current_user_can('administrator')) {

    	return 1;
    }	
}
add_filter( 'get_user_option_screen_layout_post', 'so_screen_layout_post' );


//re-title some of the meta boxes

add_action('add_meta_boxes', function() {
	 if(!current_user_can('administrator')) {
	  remove_meta_box('post-settings', 'post', 'normal'); //seems to work up here but not below 
	  add_meta_box('postimagediv', __('Featured Image (Sets header image)'), 'post_thumbnail_meta_box', 'post', 'advanced', 'high');
	  add_meta_box('categorydiv', __('What challenge is this?'), 'post_categories_meta_box', 'post', 'advanced', 'high');
	  add_meta_box('submitdiv', __('Make it public'), 'post_submit_meta_box', 'post', 'advanced', 'low');
	 
	}
});


if (is_admin()) :
function remove_post_meta_boxes() {
 if(!current_user_can('administrator')) {
  remove_meta_box('simplefavorites', 'post', 'low');		
  remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
  remove_meta_box('categorydiv', 'post', 'normal');
  remove_meta_box('submitdiv', 'post', 'normal');
  remove_meta_box('postimagediv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('postexcerpt', 'post', 'normal');
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('postcustom', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('commentsdiv', 'post', 'normal');
  remove_meta_box('revisionsdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('slugdiv', 'post', 'normal');
 }
}
add_action( 'admin_menu', 'remove_post_meta_boxes' );
endif;


//add text to add media button
function rename_media_button( $translation, $text ) {
    if( 'Add Media' === $text ) {
        return 'Add Media (use this to add photos to your text below)';
    }
    return $translation;
}
add_filter( 'gettext', 'rename_media_button', 10, 2 );

//hide additional post options from https://css-tricks.com/snippets/wordpress/apply-custom-css-to-admin-area/ including website on user profile

add_action('admin_head', 'hide_extra_pub_options');

function hide_extra_pub_options() {
	 if(!current_user_can('administrator')) {

	  echo '<style>
	    
	    #misc-publishing-actions {display:none;}
	    #minor-publishing {padding: 10px;}
	    .postbox {
	    	width: 30%;
	    	float:left;
	    	margin: 15px;
	    }
	    tr.user-url-wrap{ display: none; }
	    tr.user-capabilities-wrap, tr.user-rich-editing-wrap, tr.user-comment-shortcuts-wrap, tr.show-admin-bar, tr.user-admin-color-wrap, tr.user-description-wrap{display: none;}
	    h2:nth-of-type(1), h2:nth-of-type(6) {display: none;}

	  </style>';
    }
}


//cleaning up profile page
function modify_user_contact_methods( $user_contact ) {

	// Remove user contact methods
	unset( $user_contact['aim']    );
	unset( $user_contact['jabber'] );
	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );


// CHANGE POST TO CHALLENGE

function anth_change_post_object() {
    global $wp_post_types;
    $labels =$wp_post_types['post']->labels;
    $labels->name = 'Challenge';
    $labels->singular_name = 'Challenge';
    $labels->add_new = 'Complete a Challenge';
    $labels->add_new_item = 'Complete a Challenge';
    $labels->edit_item = 'Edit Challenge';
    $labels->new_item = 'Challenge';
    $labels->view_item = 'View Challenges';
    $labels->search_items = 'Search Challenges';
    $labels->not_found = 'No Challenges found';
    $labels->not_found_in_trash = 'No Challenges found in Trash';
    $labels->all_items = 'All Challenges';
    $labels->menu_name = 'Challenges';
    $labels->name_admin_bar = 'Challenges';
}
 
add_action( 'init', 'anth_change_post_object' );

//---------------------------------CUSTOM TOOL BAR STUFF************************************

//show admin bar to everyone
show_admin_bar( true );

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('site-name');
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('wp-rest-api-cache-empty');

}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

function wpdocs_enqueue_custom_admin_style() {
        wp_register_style( 'fa_wp_admin_css', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false, '1.0.0' );
        wp_enqueue_style( 'fa_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );

//TOOL BAR NEW PLUS
add_action( 'admin_bar_menu', 'toolbar_link_to_new', 949 );

function toolbar_link_to_new( $wp_admin_bar ) {
	$args = array(
		'id'    => 'my_new',
		'title' => '<i class="fa fa-plus fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Complete a Challenge</div>',
		'href'  => '/wp-admin/post-new.php',
		// press-this.php maybe 
		'meta'  => array( 'class' => 'my-toolbar-icon' )
	);
	$wp_admin_bar->add_node( $args );
}


//TOOL BAR FAVORITES HEART

add_action( 'admin_bar_menu', 'toolbar_link_to_fav', 959 );

function toolbar_link_to_fav( $wp_admin_bar ) {
	$args = array(
		'id'    => 'my_fav',
		'title' => '<i class="fa fa-heart fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Favorites</div>',
		'href'  => '/favorites/',
		'meta'  => array( 'class' => 'my-toolbar-icon' )
	);
	$wp_admin_bar->add_node( $args );
}


//TOOL BAR STAR
add_action( 'admin_bar_menu', 'toolbar_link_to_star', 969 );

function toolbar_link_to_star( $wp_admin_bar ) {
	$args = array(
		'id'    => 'my_star',
		'title' => '<i class="fa fa-star fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Best Of</div>',
		'href'  => '#',
		'meta'  => array( 'class' => 'my-toolbar-icon' )
	);
	$wp_admin_bar->add_node( $args );
}

//TOOL BAR RECENT
add_action( 'admin_bar_menu', 'toolbar_link_to_recent', 979 );

function toolbar_link_to_recent( $wp_admin_bar ) {
	$args = array(
		'id'    => 'my_recent',
		'title' => '<i class="fa fa-clock-o fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Recent</div>',
		'href'  => '/latest/',
		'meta'  => array( 'class' => 'my-toolbar-icon' )
	);
	$wp_admin_bar->add_node( $args );
}

 //TOOL BAR LESSON
 add_action( 'admin_bar_menu', 'add_top_link_to_admin_bar',999 );
 
function add_top_link_to_admin_bar($admin_bar) {
         // add a parent item
            $args = array(
                'id'    => 'the_lesson',
				'title' => '<i class="fa fa-book fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Lessons</div>',
                'href'   => '#', // Showing how to add an external link
                'meta'  => array( 'class' => 'my-toolbar-icon' )
            );
            $admin_bar->add_node( $args );
             
         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'different',
                'title'  => '1. People are Different',
                'href'   => 'http://anth101.com/lessons/lesson1/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );
             
         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'question',
                'title'  => '2. New Questions',
                'href'   => 'http://anth101.com/lessons/lesson2/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );     

         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'human',
                'title'  => '3. Being Human',
                'href'   => 'http://anth101.com/lessons/lesson3/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

          // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'assumptions',
                'title'  => '4. Hidden Assumptions',
                'href'   => 'http://anth101.com/lessons/lesson4/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

           // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'tools',
                'title'  => '5. Making & Living',
                'href'   => 'http://anth101.com/lessons/lesson5/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );   

           
           // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'reality',
                'title'  => '6. "Reality"',
                'href'   => 'http://anth101.com/lessons/lesson6/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

             // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'hate',
                'title'  => '7. Why We Hate',
                'href'   => 'http://anth101.com/lessons/lesson7/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );    

             // add a child item to our parent item 
            $args = array(
                'parent' => 'the_lesson',
                'id'     => 'tragedy',
                'title'  => '8. Tragedy of Our Times',
                'href'   => 'http://anth101.com/lessons/lesson8/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );   

             $args = array(
                'parent' => 'the_lesson',
                'id'     => 'hero',
                'title'  => '9. Becoming a Hero',
                'href'   => 'http://anth101.com/lessons/lesson9/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

             $args = array(
                'parent' => 'the_lesson',
                'id'     => 'we',
                'title'  => '10. We Make the World',
                'href'   => 'http://anth101.com/lessons/lesson10/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  
                                   
}


//TOOL BAR - CHALLENGES
add_action( 'admin_bar_menu', 'add_challenge_link_to_admin_bar',999 );
 
function add_challenge_link_to_admin_bar($admin_bar) {
         // add a parent item
            $args = array(
                'id'    => 'the_challenge',
				'title' => '<i class="fa fa-grav fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Challenges</div>',
                'href'   => '#', // Showing how to add an external link
                'meta'  => array( 'class' => 'my-toolbar-icon' )
            );
            $admin_bar->add_node( $args );
             
         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'stranger',
                'title'  => '1. Talk to Strangers',
                'href'   => 'http://anth101.com/challenge1/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );
             
         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'fieldwork',
                'title'  => '2. Fieldwork of the Familiar',
                'href'   => 'http://anth101.com/challenge2/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );     

         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'days',
                'title'  => '3. 28 Day Challenge',
                'href'   => 'http://anth101.com/challenge3/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

          // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'uncomfort',
                'title'  => '4. Get Uncomfortable',
                'href'   => 'http://anth101.com/challenge4/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

           // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'unthing',
                'title'  => '5. UnThing Experiment',
                'href'   => 'http://anth101.com/challenge5/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );   

           
           // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'realization',
                'title'  => '6. Realize a Real-ization',
                'href'   => 'http://anth101.com/challenge6/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

             // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'other',
                'title'  => '7. Other Encounter',
                'href'   => 'http://anth101.com/challenge7/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );    

             // add a child item to our parent item 
            $args = array(
                'parent' => 'the_challenge',
                'id'     => 'hustuff',
                'title'  => '8. Humans of My Stuff',
                'href'   => 'http://anth101.com/challenge8/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );   

             $args = array(
                'parent' => 'the_challenge',
                'id'     => 'uhero',
                'title'  => '9. Your Hero Story',
                'href'   => 'http://anth101.com/challenge9/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  

             $args = array(
                'parent' => 'the_challenge',
                'id'     => 'manifesto',
                'title'  => '10. Manifesto',
                'href'   => 'http://anth101.com/challenge10/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );  
                                   
}

 add_action( 'admin_bar_menu', 'add_top_link_to_admin_bar',999 );
 
function add_sandwich_to_admin_bar($admin_bar) {
         // add a parent item
            $args = array(
                'id'    => 'the_bars',
				'title' => '<i class="fa fa-bars fa-3x" style="font-family:FontAwesome; font-size:1.8em;"></i><div class="full-view-menu">Lessons</div>',
                'href'   => '#', // Showing how to add an external link
                'meta'  => array( 'class' => 'my-toolbar-icon' )
            );
            $admin_bar->add_node( $args );
             
         // add a child item to our parent item 
            $args = array(
                'parent' => 'the_bars',
                'id'     => 'test',
                'title'  => 'test',
                'href'   => 'http://anth101.com/lessons/lesson1/',
                'meta'   => false        
            );
            $admin_bar->add_node( $args );

}            

 add_action( 'admin_bar_menu', 'add_sandwich_to_admin_bar',999 );


//TOOL BAR - Prevent mobile hiding
function show_custom_admin_menu() {
    echo '
    <style type="text/css">
      i {
      	display: inline-block;
      }
      .full-view-menu {
      	color: #fff;
      	display: inline-block;
      	margin-left: 8px !important;
      	margin-right: 10px !important;
      }
    @media only screen and (min-device-width : 300px) and (max-device-width : 1024px) {

		#wpadminbar {
		  position: fixed;
		}
        .my-toolbar-icon {
            display: block!important;  
            margin: 3px 8px 0 8px !important;          
        }
       .full-view-menu {
       	display:none;
       }
        
    }

    </style>';
}
// on backend area
add_action( 'admin_head', 'show_custom_admin_menu' );
// on frontend area
add_action( 'wp_head', 'show_custom_admin_menu' );

//AUTHOR PAGE 

function get_assignment_category_number(){
	$cats = get_the_category();
	$name = $cats[0]->name;
	$findme   = '.';
	$pos = strpos($name, $findme);
	$number = substr($name,0,$pos);
	echo $number;
}
