<?php
/** 
 * Theme functions / filters
 * 
 * @package Project Name Theme
 */


add_filter('show_admin_bar', '__return_false');
add_filter('use_block_editor_for_post', '__return_false');
add_filter('wp_lazy_loading_enabled', '__return_false');
add_filter('unzip_file_use_ziparchive', '__return_false');
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
add_filter('auto_core_update_send_email', '__return_false');
add_filter('auto_plugin_update_send_email', '__return_false');
add_filter('auto_theme_update_send_email', '__return_false');


add_filter( 'body_class', function($classes){
  global $post;

  $slug = get_page_template_slug($post);
  $template = $slug ? $post->post_name : 'default';
  if($template == 'home') $template = '';

  $include = array(
    $template              => is_page(),
    get_post_type()        => is_single(),
    'is-iphone'            => $GLOBALS['is_iphone'],
    'is-chrome'            => $GLOBALS['is_chrome'],
    'is-safari'            => $GLOBALS['is_safari'],
    'is-ns4'               => $GLOBALS['is_NS4'],
    'is-opera'             => $GLOBALS['is_opera'],
    'is-mac-ie'            => $GLOBALS['is_macIE'],
    'is-win-ie'            => $GLOBALS['is_winIE'],
    'is-gecko'             => $GLOBALS['is_gecko'],
    'is-ie'                => $GLOBALS['is_IE'],
    'is-edge'              => $GLOBALS['is_edge'],
    'is-lynx'              => $GLOBALS['is_lynx'],
    'is-preview'           => is_preview(),
    'is-embed'             => is_embed(),
    'is-mobile'            => wp_is_mobile(),
    'is-desktop'           => !wp_is_mobile(),
  );

  foreach ( $include as $class => $do_include ) {
    $do_include ? $classes[ $class ] = $class : $classes[] = $post->post_type . '-' . $post->post_name;
  }

  return $classes;
});


add_filter('jpeg_quality', function ($quality) {
  return 90;
});


add_filter('big_image_size_threshold', function($threshold){
  return 2800;
}, 999, 1);


add_filter('login_headerurl', function () {
  return URL;
});


add_filter( 'protected_title_format', function() {
  return __('%s');
});


add_filter( 'private_title_format', function() {
  return __('%s');
});


add_filter('gettext', function ($text) {
  if ($text == 'Lost your password?')
    $text .= '<br /><a href="https://makersandallies.com" title="Made by Makers & Allies" target="_blank" rel="nofollow">Made by Makers & Allies</a>';
  return $text;
});


add_filter('admin_footer_text', function ($text) {
  $current_page_url = admin_url() . $_SERVER['REQUEST_URI'];

  if(!str_contains($current_page_url, 'acf-') || str_contains($text,'acf')) {
    $text = '<em>Made by <a href="https://makersandallies.com" title="Makers & Allies" target="_blank" rel="nofollow">Makers & Allies</a></em>';
    return $text;
  }
});


$editor_toolbar1 = ['bold','italic','bullist','numlist','alignleft','aligncenter','alignright','link','unlink','hr','pastetext','removeformat','blockquote','undo','redo','outdent','indent','wp_help'];
$editor_toolbar2 = ['formatselect','styleselect','forecolor'];

$basic_toolbar1 = ['bold','italic','bullist','numlist','alignleft','aligncenter','alignright','link','unlink','undo','redo','formatselect','styleselect','forecolor'];

add_filter('tiny_mce_before_init', function ($init) {
  global $editor_toolbar1, $editor_toolbar2;

  $init['wordpress_adv_hidden'] = false;
  $init['toolbar1'] = join(',', $editor_toolbar1);
  $init['toolbar2'] = join(',', $editor_toolbar2);
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

  $init['style_formats'] = json_encode([
    ['subheading' => 'Subheading', 'selector' => 'div', 'classes' => 'subheading'],
    ['caption' => 'Caption', 'selector' => 'div', 'classes' => 'caption'],
    ['title' => 'Button Primary', 'selector' => 'a', 'classes' => 'btn btn-primary'],
    ['title' => 'Button Secondary', 'selector' => 'a', 'classes' => 'btn btn-secondary'],
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


// Prevent users from adding custom colors
add_filter('tiny_mce_plugins', function ($plugins) {
  foreach ( $plugins as $key => $plugin_name ) {
    if ( 'colorpicker' === $plugin_name ) {
      unset( $plugins[ $key ] );
      return $plugins;            
    }
  }
  return $plugins; 
});


// Override password for logged in users
add_filter( 'post_password_required', function( $returned, $post ){
  if( $returned && is_user_logged_in() )
    $returned = false;
  return $returned;
}, 10, 2 );


// Limit image upload size
add_filter('wp_handle_upload_prefilter', function ($file) {
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  $is_image = strpos( $file['type'], 'image' ) !== false;

  // Set the desired file size limit
  $file_size_limit = 1024; // 1MB in KB

  $current_size = $file['size'];
  $current_size = $current_size / 1024; //get size in KB

  if ($user_role !== 'developer' && ($is_image && $current_size > $file_size_limit)) {
    $file['error'] = sprintf(__('ERROR: File size limit is %d KB.'), $file_size_limit);
  }

  return $file;
}, 10, 1);


// Add upload support for webp
add_filter('mime_types', function($existing_mimes){
  $existing_mimes['webp'] = 'image/webp';
  return $existing_mimes;
});


// Enable preview / thumbnail for webp
add_filter('file_is_displayable_image', function ($result, $path) {
  if ($result === false) {
    $displayable_image_types = array(IMAGETYPE_WEBP);
    $info = @getimagesize($path);

    if (empty($info)) {
      $result = false;
    } elseif (!in_array($info[2], $displayable_image_types)) {
      $result = false;
    } else {
      $result = true;
    }
  }

  return $result;
}, 10, 2);


// Move Yoast to bottom
add_filter( 'wpseo_metabox_prio', function(){
  return 'low';
});


// PPWP - Add CSS to Site Password Page
add_filter('ppw_custom_header_form_entire_site',function() {
  if(Typekit !== '') { echo '<link rel="stylesheet" href="'.Typekit.'">';}
  if(GoogleFonts !== '') {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="'.GoogleFonts.'" rel="stylesheet">';
  }
  echo '<link rel="stylesheet" href="'.TD.'/assets/main.css" type="text/css">';
});


// PPWP - Add Text to Site Password Page
add_filter( 'ppw_sitewide_above_password_form', function(){
  echo '<h2>This site requires a password.</h2>';
});


// Add wrapper to oEmbed content
add_filter('oembed_dataparse', function ($return, $data, $url) {
  $mod = ''; if(($data->type == 'video')) $mod = 'ratio-16x9';

  if ( false !== strpos( $url, "://youtube.com") || false !== strpos( $url, "://youtu.be" ) ) {
    $return = '<div class="embed-responsive ' . $mod . '">' . $return . '</div>';
  }
  return $return;
}, 99, 4);


//// Uncomment to clear oEmbed post-meta cache
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