<?php 
/** 
 * Components / Gravity Form
 * 
 * @package Project Name Theme
 *
 * 
*/

$id = $args['id'];

?>

<div class="container container-md">
  <?php echo do_shortcode('[gravityform id="'.$id.'" title="false" ajax="true"]'); ?>
</div>