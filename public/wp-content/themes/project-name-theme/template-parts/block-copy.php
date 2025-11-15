<?php 
/** 
 * Block / COPY THIS AND EDIT
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

?>

<section <?php if($id): echo 'id="'.str_id($id).'" ' ; endif;?>class="[EDIT] section<?php echo ' index-'.$index; ?>">
  <div class="[EDIT]-wrapper<?php echo $spacing; ?> animated animated-item animate-up-in">

    <div class="container container-<?php echo $container_size; ?>">



    </div>
    
  </div>
</section>