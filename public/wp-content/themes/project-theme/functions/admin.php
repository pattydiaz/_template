<?php
/** 
 * Theme functions / admin
 * 
 * @package Project Name Theme
 */

add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});


add_action('admin_bar_menu',function($wp_admin_bar) {
  $wp_admin_bar->remove_menu( 'comments' );
}, 999);


add_action('wp_dashboard_setup',function(){
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}, 999);


add_action('customize_register', function($wp_customize){
  $wp_customize->remove_section('static_front_page');
  $wp_customize->remove_panel( 'nav_menus');
  $wp_customize->remove_section('custom_css');
}, 999);


add_action('init',function() {
  // disable tags on posts
  register_taxonomy('post_tag', []);
  //disable categories on posts
  register_taxonomy( 'category', []);
  // disable html editor
  define('DISALLOW_FILE_EDIT', TRUE);
});


// Redirect any user trying to access comments page
add_action('admin_init', function () {
  global $pagenow;
  
  if ($pagenow === 'edit-comments.php') {
    wp_safe_redirect(admin_url());
    exit;
  }

  // Disable support for comments and trackbacks in post types
  foreach (get_post_types() as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
});