<?php 
/** 
 * Theme functions / acf
 * 
 * @package Project Name Theme
*/


// Prevent fatal errors if ACF is not active
if ( ! function_exists('get_field') ) {
  function get_field($field_name = '', $post_id = false) {
    return null;
  }
}

if ( ! function_exists('the_field') ) {
  function the_field($field_name = '', $post_id = false) {
    echo '';
  }
}


// Customize WYSIWYG toolbars
add_filter('acf/fields/wysiwyg/toolbars', function($toolbars) {
  global $editor_toolbar1, $editor_toolbar2, $basic_toolbar1;

  if (isset($toolbars['Full'][1])) $toolbars['Full'][1] = $editor_toolbar1;
  if (isset($toolbars['Full'][2])) $toolbars['Full'][2] = $editor_toolbar2;
  if (isset($toolbars['Basic'][1])) $toolbars['Basic'][1] = $basic_toolbar1;

  // add an empty toolbar with no buttons, see acompanying styles in admin_head below
  $toolbars['Empty'] = [];
  $toolbars['Empty'][1] = ['bold','italic','link','unlink','bullist','numlist'];
  return $toolbars;
});


// Only allow "published" posts in relationship field && sort by date added 
add_filter( 'acf/fields/relationship/query',function($options, $field, $the_post){
  $options['orderby'] = 'post_date';
  $options['order'] = 'DESC';
  $options['post_status'] = array('publish','public');

  return $options;
}, 10, 3);


// Show field set on password protected pages
add_filter('acf/location/rule_types', function($choices){
  $choices['Post']['visibility'] = 'Post Visibility';
  return $choices;
});

add_filter('acf/location/rule_values/visibility', function($choices){
  //var_dump($choices);
  $choices['password'] = 'Password Protected';
  return $choices;
});

add_filter('acf/location/rule_match/visibility', function($match, $rule, $options){
  if ( is_object($options) && isset($options->post_id) ) { $post_id = $options->post_id;} 
  elseif ( is_array($options) && isset($options['post_id']) ) { $post_id = $options['post_id'];} 
  else { return false; }
  
  $the_post = get_post($post_id);
  
  if ( $the_post && !empty($the_post->post_password) ) { $match = true; } 
  else { $match = false; }
  
  return $match;

}, 10, 3);


// Extract Text Content from All ACF Flexible Blocks for Yoast
add_filter('wpseo_pre_analysis_post_content', function ($content) {
  if (!is_singular()) { return $content; }

  $post_id = get_the_ID();
  
  // Define the flexible content field names you want to include
  $acf_blocks = ['custom-blocks', 'post-blocks'];

  foreach ($acf_blocks as $acf_field) {
    $flexible_content = get_field($acf_field, $post_id);

    if ($flexible_content && is_array($flexible_content)) {
      $content .= extract_text_from_acf($flexible_content);
    }
  }

  return $content;
}, 10, 1);

// Recursive extractor for ACF fields
function extract_text_from_acf($fields) {
  $output = '';

  foreach ($fields as $field) {
    if (is_array($field)) {
      $output .= extract_text_from_acf($field); // Recurse deeper
    } elseif (is_string($field)) {
      $output .= ' ' . strip_tags($field); // Append text content
    }
  }

  return $output;
}