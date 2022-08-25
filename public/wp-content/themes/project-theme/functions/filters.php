<?php
/** 
 * Theme functions / filters
 * 
 * @package Project Name Theme
 */

add_filter('show_admin_bar', '__return_false');
add_filter('use_block_editor_for_post', '__return_false');

add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);


add_filter('jpeg_quality', function ($quality) {
  return 80;
});


add_filter('login_headerurl', function () {
  return URL;
});


add_filter('gettext', function ($text) {
  if ($text == 'Lost your password?')
    $text .= '<br /><a href="https://makersandallies.com" title="Made by Makers & Allies" target="_blank" rel="nofollow">Made by Makers & Allies</a>';
  return $text;
});


add_filter('admin_footer_text', function () {
  echo '<em>Made by <a href="https://makersandallies.com" title="Makers & Allies" target="_blank" rel="nofollow">Makers & Allies</a></em>';
});


$editor_toolbar1 = ['bold','italic','bullist','numlist','alignleft','aligncenter','alignright','link','unlink','hr','pastetext','removeformat','charmap','undo','redo','outdent','indent','wp_help'];
$editor_toolbar2 = ['formatselect,styleselect'];

add_filter('tiny_mce_before_init', function ($init) {
  global $editor_toolbar1, $editor_toolbar2;

  $init['wordpress_adv_hidden'] = false;
  $init['toolbar1'] = join(',', $editor_toolbar1);
  $init['toolbar2'] = join(',', $editor_toolbar2);
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

  $init['style_formats'] = json_encode([
    ['title' => 'Primary Button', 'selector' => 'a', 'classes' => 'btn btn-primary'],
    ['title' => 'Secondary Button', 'selector' => 'a', 'classes' => 'btn btn-secondary'],
  ]);

  $default_colours = '
    "000000", "Black",
    "FFFFFF", "White",
  ';

  $init['textcolor_map'] = '['.$default_colours.']';
  $init['textcolor_rows'] = 2;
  $init['textcolor_cols'] = 6;

  return $init;
});


// prevent users from adding custom colors
add_filter('tiny_mce_plugins', function ($plugins) {
  foreach ( $plugins as $key => $plugin_name ) {
    if ( 'colorpicker' === $plugin_name ) {
      unset( $plugins[ $key ] );
      return $plugins;            
    }
  }
  return $plugins; 
});


//override password for logged in users
add_filter( 'post_password_required', function( $returned, $post ){
  if( $returned && is_user_logged_in() )
    $returned = false;
  return $returned;
}, 10, 2 );


// limit image upload size
add_filter('wp_handle_upload_prefilter', function ($file) {

  // Set the desired file size limit
  $file_size_limit = 1024; // 1MB in KB

  $current_size = $file['size'];
  $current_size = $current_size / 1024; //get size in KB

  if ($current_size > $file_size_limit) {
    $file['error'] = sprintf(__('ERROR: File size limit is %d KB.'), $file_size_limit);
  }

  return $file;
}, 10, 1);


// Add wrapper to oEmbed content
add_filter('oembed_dataparse', function ($return, $data, $url) {
  $mod = ''; if(($data->type == 'video')) $mod = 'ratio-16x9';

  if ( false !== strpos( $url, "://youtube.com") || false !== strpos( $url, "://youtu.be" ) ) {
    $return = '<div class="embed-responsive ' . $mod . '">' . $return . '</div>';
  }
  return $return;
}, 99, 4);


// uncomment to clear oEmbed post-meta cache
// add_filter('oembed_ttl', function($ttl) {
// 	$GLOBALS['wp_embed']->usecache = 0;
// 	$ttl = 0;
// 	do_action('wpse_do_cleanup');
// 	return $ttl;
// });

// add_filter('embed_oembed_discover', function($discover){
// 	if(1 === did_action('wpse_do_cleanup'))
// 		$GLOBALS['wp_embed']->usecache = 1;
// 		return $discover;
// });