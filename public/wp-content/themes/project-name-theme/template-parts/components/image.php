<?php 
/** 
 * Components / Image
 * 
 * @package Project Name Theme
 * 
*/

$id = isset($args['id']) ? $args['id'] : '';
$image = isset($args['img']) ? $args['img'] : get_post_thumbnail_id($id);
$size = isset($args['size']) ? $args['size'] : 'full';
$class = isset($args['class']) ? $args['class'] : 'img-cover';
$lazy = isset($args['lazy']) ? $args['lazy'] : true;
$critical = isset($args['critical']) ? $args['critical'] : false;
$attr = isset($args['attr']) ? $args['attr'] : 'data';

if($critical == true):
  $lazy = ' lazy-ignore';
  $attr = '';
  $loading_attr = 'loading="eager" fetchpriority="high"';
elseif($lazy == true):
  $lazy = ' lazy';
  $attr = $attr . '-';
  $loading_attr = 'loading="lazy"';
else:
  if($lazy == false):
    $lazy = ' lazy-ignore';
    $attr = '';
    $loading_attr = 'loading="eager"';
  else:
    $lazy = $args['lazy'];
    $attr = $attr . '-';
    $loading_attr = 'loading="lazy"';
  endif;
endif;

echo wp_get_attachment_image($image, $size, false, array(
  'src' => $critical ? wp_get_attachment_image_url($image, $size) : PIXEL,
  'srcset' => $critical ? wp_get_attachment_image_srcset($image, $size) : '',
  $attr.'src' => wp_get_attachment_image_url($image, $size),
  $attr.'srcset' => wp_get_attachment_image_srcset($image, $size),
  'class' => $class . $lazy,
  'decoding' => 'async',
  'loading' => $critical ? 'eager' : 'lazy',
  'fetchpriority' => $critical ? 'high' : 'auto'
));

?>