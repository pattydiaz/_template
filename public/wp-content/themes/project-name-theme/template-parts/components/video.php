<?php 
/** 
 * Components / Video
 * 
 * @package Makers Launchkit Theme
 * 
*/

$video = isset($args['video']) ? $args['video'] : '';
$class = isset($args['class']) ? $args['class'] : 'img-cover' ;
$lazy = isset($args['lazy']) ? $args['lazy'] : 'lazy';
$attr = isset($args['attr']) ? $args['attr'] : 'data';
$width = isset($args['width']) ? $args['width'] : 400;
$height = isset($args['height']) ? $args['height'] : 400;

if($attr !== '' || $attr !== false):
  $attr = $attr.'-'; 
endif;

$autoplay = isset($args['autoplay']) ? $args['autoplay'] : true;
$autoplay = $autoplay == true ? ' autoplay' : '';

$muted = isset($args['muted']) ? $args['muted'] : true;
$muted = $muted == true ? ' muted' : '';

$playsinline = isset($args['playsinline']) ? $args['playsinline'] : true;
$playsinline = $playsinline == true ? ' playsinline' : '';

$loop = isset($args['loop']) ? $args['loop'] : true;
$loop = $loop == true ? ' loop' : '';

$controls = isset($args['controls']) ? $args['controls'] : false;
$controls = $controls == true ? ' controls' : '';

?>

<video width="<?php echo $width; ?>" height="<?php echo $height;?>" class="<?php echo $class .' '. $lazy; ?>"<?php echo $autoplay.$muted.$playsinline.$loop.$controls;?> <?php echo $attr;?>src="<?php echo $video; ?>">
  <source <?php echo $attr;?>src="<?php echo $video; ?>" type="video/mp4">
</video>