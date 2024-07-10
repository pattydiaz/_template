<?php 
/** 
 * Hero / Post
 * 
 * @package Project Name Theme
 * 
*/

$hidden = isset($args['hidden']) ? $args['hidden'] : false;
$hero_title = !empty(get_field('hero-title')) ? get_field('hero-title') : get_the_title();

?>

<section class="hero hero-default section<?php if($hidden == false): echo ' gap-tm--md gap-bm--sm'; endif;?>">
  <div class="hero-text container container-md text-center">
    <h1 class="heading-1<?php if($hidden == true): echo ' sr-only'; endif;?>"><?php echo $hero_title; ?></h1>
  </div>
</section>