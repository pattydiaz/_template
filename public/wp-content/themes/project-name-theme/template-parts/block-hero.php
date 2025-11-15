<?php 
/** 
 * Block / Hero
 * 
 * @package Project Name Theme
 * 
*/

$index = isset($args['index']) ? $args['index'] : 0;
$id = get_sub_field('id');

$section_size = get_sub_field('section-size');

$hero_title = get_sub_field('hero-title') ? get_sub_field('hero-title') : get_the_title();

?>

<section <?php if($id): echo 'id="'.str_id($id).'" ' ; endif;?>class="hero hero-custom section<?php echo ' section-'.$section_size.' index-'.$index; ?>">
  <div class="hero-wrapper bg-black">

    <?php get_template_part(COMP.'background','',array('class'=>'hero-bg','critical'=>true)); ?>
        
    <div class="hero-container container">  
      <div class="hero-text middle text-center">
        <h1 class="heading-1 color-white"><?php echo $hero_title; ?></h1>
      </div>
    </div>

  </div>
</section>