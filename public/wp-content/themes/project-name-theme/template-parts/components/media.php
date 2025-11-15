<?php 
/** 
 * Components / Media
 * 
 * @package Project Name Theme
 * 
*/

$media_prefix = isset($args['prefix']) ? $args['prefix'].'-' : 'media-';
$media_img = get_sub_field($media_prefix.'img');
$media_loop = get_sub_field($media_prefix.'loop');

?>

<?php if($media_img):?>
  <?php 
    if($media_loop):
      echo '<div class="video-cover">';
        get_template_part(COMP.'video','',array('video'=>$media_loop['url'],'poster'=>$media_img['url']));
      echo '</div>';
    endif;

    get_template_part(COMP.'image','',array('img'=>$media_img['id'])); 
  ?>
<?php endif; ?>