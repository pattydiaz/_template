<?php 
/** 
 * Components / Slider Pagination
 * 
 * @package Project Name Theme
 * 
*/

$position = isset($args['position']) ? $args['position'] : 'center';
$color = isset($args['color']) ? $args['color'] : 'black';

?>

<div class="slider-pagination swiper-pagination text-<?php echo $position; ?> color-<?php echo $color; ?>"></div>