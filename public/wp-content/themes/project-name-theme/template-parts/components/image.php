<?php 
/** 
 * Components / Image
 * 
 * @package Makers Launchkit Theme
 * 
*/

$id = isset($args['id']) ? $args['id'] : '';
$image = isset($args['img']) ? $args['img'] : get_post_thumbnail_id($id);
$size = isset($args['size']) ? $args['size'] : 'full';
$class = isset($args['class']) ? $args['class'] : 'img-cover';
$lazy = isset($args['lazy']) ? $args['lazy'] : true;
$attr = isset($args['attr']) ? $args['attr'] : 'data';

if($lazy == true):
  $lazy = ' lazy';
  $attr = $attr . '-';
else:
  if($lazy == false):
    $lazy = ' lazy-ignore';
    $attr = '';
  else:
    $lazy = $args['lazy'];
    $attr = $attr . '-';
  endif;
endif;

echo wp_get_attachment_image($image, $size, false, array(
  'src' => PIXEL,
  'srcset' => '',
  $attr.'src' => wp_get_attachment_image_url($image, $size),
  $attr.'srcset' => wp_get_attachment_image_srcset($image, $size),
  'class' => $class . $lazy,
));

?>