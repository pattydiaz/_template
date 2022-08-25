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

function acf_video_fullscreen($field, $video_id) {
  $video_frame = $field;

  preg_match('/src="(.+?)"/', $video_frame, $matches);
  $src = $matches[1];

  $params = array(
    'background'    => 1,
    'autoplay'    => 1,
    'loop'    => 1,
    'byline'    => 0,
    'title'    => 0,
    'muted' => 1,
    'controls' => 0
  );

  $new_src = add_query_arg($params,$src);
  $video_link = str_replace($src, $new_src, $video_frame);
  $attr = 'id="'.$video_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen';
  $video_link = str_replace('></iframe>', ' ' . $attr . '></iframe>', $video_link);

  return $video_link;
}