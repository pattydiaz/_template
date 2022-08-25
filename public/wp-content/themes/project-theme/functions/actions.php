<?php 
/** 
 * Theme functions / actions
 * 
 * @package Project Name Theme
*/

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_image_size('sm', 150, 150, false);
add_image_size('xl', 2400, 2400, false);


add_action('wp_enqueue_scripts', function() {
  wp_deregister_script('wp-embed');
  wp_dequeue_style('wp-block-library');

  // wp_register_style('typekit', 'https://use.typekit.net/xju4jxy.css', '', null);
  wp_register_style('style', get_stylesheet_uri(), [], DIR.'/style.css');
  wp_register_style('main', TD.'/assets/main.css', ['style'], filemtime(DIR.'/assets/main.css'));
  wp_register_script('main', TD.'/assets/main.js', ['jquery'], filemtime(DIR.'/assets/main.js'), true);
  
  wp_enqueue_style('typekit');
  wp_enqueue_style('style');
  wp_enqueue_style('main');
  wp_enqueue_script('main');
});


add_action('login_head', function() {
  remove_action('login_head', 'wp_shake_js', 12);
  // echo '<link rel="stylesheet" href="https://use.typekit.net/xju4jxy.css?v='.filemtime(DIR.'/assets/admin.css').'">';
  echo '<link rel="stylesheet" href="'.TD.'/assets/admin.css?v='.filemtime(DIR.'/assets/admin.css').'">';
});


add_action('admin_init', function () {
  wp_register_style('admin', TD.'/assets/admin.css', [], filemtime(DIR.'/assets/admin.css'));
  wp_enqueue_style('admin');
  // add_editor_style(TD . '/admin.css');
  // add_theme_support('editor-styles');
  // add_theme_support('editor-color-palette');
  // add_theme_support('disable-custom-colors');
});


add_action('wp_print_scripts', function () {
  wp_deregister_script('autosave');
});


// remove unnecessary queries
add_action('widgets_init', function() {
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
});


// remove unnecessary header junk
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');