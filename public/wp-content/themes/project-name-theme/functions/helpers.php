<?php
/** 
 * Theme functions / helpers
 * 
 * @package Project Name Theme
 */


function empty_content($str) {
  return trim(str_replace('&nbsp;','',strip_tags($str,'<img>'))) == '';
}

function get_image_alt($image_id = null) {
  if (!$image_id) $image_id = get_post_thumbnail_id();
  return get_post_meta($image_id, '_wp_attachment_image_alt', true);
}

function get_image_src($size, $image_id = null) {
  if (!$image_id) $image_id = get_post_thumbnail_id();
  $image = wp_get_attachment_image_src($image_id, $size);
  return (is_array($image)) ? $image[0] : null;
}

function str_id($string) {
  $string = strtolower($string);
  $string = str_replace('&', 'and', html_entity_decode($string));
  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
  $string = preg_replace("/[\s-]+/", " ", $string);
  $string = preg_replace("/[\s_]/", "-", $string);
  return $string;
}

function check_url($url) {
  if (filter_var($url, FILTER_VALIDATE_URL)) : return 'URL';
  elseif (strpos($url, '#') === 0 && strlen($url) > 1) : return 'Anchor';
  endif;
}

function acf_video_fullscreen($field, $video_id, $data_attr = 'data-') {
  $iframe = $field;

  preg_match('/src="(.+?)"/', $iframe, $matches);
  $src = $matches[1];

  $params = array(
    'background'    => 1,
    'autoplay'    => 0,
    'loop'    => 1,
    'byline'    => 0,
    'title'    => 0,
    'muted' => 1,
    'controls' => 0
  );

  $data_attr != 'data-' ? $class = '' : $class = 'lazy';

  $new_src = add_query_arg($params, $src);
  $iframe = str_replace($src, $new_src, $iframe);
  $attr = 'id="'.$video_id.'" class="'.$class.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen';
  $iframe = preg_replace('~<iframe[^>]*\K(?=src)~i', $data_attr, $iframe);
  $iframe = str_replace('></iframe>', ' ' . $attr . '></iframe>', $iframe);

  return $iframe;
}

function current_user_has_role( $roles = [] ) {
  foreach ( $roles as $role ) {
    if ( current_user_can($role) ) return true;
  }
  return false;
}