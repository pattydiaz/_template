<?php 
/** 
 * Block / Media
 * 
 * @package Project Name Theme
 * 
*/

$index = isset($args['index']) ? $args['index'] : 0;
$id = get_sub_field('id');

$spacing_top = get_sub_field('spacing-top') ?: 'none';
$spacing_bottom = get_sub_field('spacing-bottom') ?: 'none';
$spacing = ' gap-tm--'.$spacing_top.' gap-bm--'.$spacing_bottom;

$container_size = get_sub_field('container') ?: 'xx';

$media_img = get_sub_field('media-img');
$media_position = '--position: '.get_sub_field('media-position-x').'% '.get_sub_field('media-position-y').'%;';

$media_option_caption = get_sub_field('media-option-caption');
$media_caption = get_sub_field('media-caption');

$media_option_fullscreen = get_sub_field('media-option-fullscreen');

?>

<section <?php if($id): echo 'id="'.str_id($id).'" ' ; endif;?>class="media section<?php echo ' index-'.$index; ?>">
  <div class="media-wrapper<?php echo $spacing; ?> animated animated-item animate-up-in">

    <?php if($media_option_fullscreen == false):?>
    <div class="container container-<?php echo $container_size; ?>">
    <?php endif; ?>

      <?php if($media_option_caption == true && $media_caption):?>
        <div class="caption color-black-transparent mb-h w-max" style="--mw:740px;"><?php echo $media_caption; ?></div>
      <?php endif; ?>

      <div class="ratio-16x10 bg-black" style="<?php echo $media_position; ?>">
        <?php get_template_part(COMP.'media','',array('prefix'=>'media'));?>
      </div>

    <?php if($media_option_fullscreen == false):?>
    </div>
    <?php endif; ?>
    
  </div>
</section>