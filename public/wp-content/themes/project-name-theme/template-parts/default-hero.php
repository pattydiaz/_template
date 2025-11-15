<?php 
/** 
 * Hero / Default
 * 
 * @package Project Name Theme
 * 
*/

$hidden = isset($args['hidden']) ? $args['hidden'] : false;
$hero_title = !empty(get_field('hero-title')) ? get_field('hero-title') : get_the_title();

?>

<section class="hero hero-default section<?php if($hidden == false): echo ' gap-tm--md gap-bm--sm'; endif;?>">
  <div class="hero-wrapper">
    <div class="container">

      <div class="hero-text middle text-center">
        <h1 class="<?php if($hidden == true): echo 'sr-only'; else: echo 'heading-1'; endif;?>"><?php echo $hero_title; ?></h1>
      </div>

    </div>
  </div>
</section>