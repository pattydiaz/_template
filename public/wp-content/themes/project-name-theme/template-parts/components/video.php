<?php 
/** 
 * Components / Video
 * 
 * @package Project Name Theme
 * 
*/

$video = isset($args['video']) ? $args['video'] : '';
$class = isset($args['class']) ? $args['class'] : 'img-cover' ;
$lazy = isset($args['lazy']) ? $args['lazy'] : 'lazy';
$attr = isset($args['attr']) ? $args['attr'] : 'data';
$width = isset($args['width']) ? $args['width'] : 400;
$height = isset($args['height']) ? $args['height'] : 400;
$poster = isset($args['poster']) ? $args['poster'] : '';

if (!empty($attr)) {
  $attr .= '-';
}

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

$mobile = isset($args['mobile']) ? $args['mobile'] : false;
$mobile = $mobile == true ? ' media="(min-width: 992px)"' : '';

?>

<video width="<?php echo $width; ?>" height="<?php echo $height;?>" class="<?php echo $class .' '. $lazy; ?>"<?php echo $autoplay.$muted.$playsinline.$loop.$controls;?> <?php echo $attr;?>src="<?php echo $video; ?>" <?php echo $attr;?>poster="<?php echo $poster; ?>" preload="none">
  <source <?php echo $attr;?>src="<?php echo $video; ?>" type="video/mp4"<?php echo $mobile;?>>
</video>