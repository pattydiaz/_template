<?php 
/** 
 * Components / Background (Media)
 * 
 * @package Project Name Theme
 * 
*/

$bg_class = isset($args['class']) ? $args['class'].' ' : '';
$bg_critical = isset($args['critical']) ? $args['critical'] : false;
$bg_img = get_sub_field('background-img');
$bg_position = '--position: '.get_sub_field('background-x').'% '.get_sub_field('background-y').'%;';

$bg_overlay = get_sub_field('background-overlay') ?: 0;
$bg_overlay_opacity = '--opacity: '.get_sub_field('background-overlay').';';

$bg_options_raw = get_sub_field('background-options');
$bg_options = (is_array($bg_options_raw) && !empty($bg_options_raw)) ? $bg_options_raw : [];

$bg_mobile = get_sub_field('background-mobile');
$bg_position_mobile = '--position: '.get_sub_field('background-x-mobile').'% '.get_sub_field('background-y-mobile').'%;';

$bg_loop = get_sub_field('background-loop');
$bg_position_loop = '--position: '.get_sub_field('background-x-loop').'% '.get_sub_field('background-y-loop').'%;';

?>

<?php 
  if ($bg_img):
    echo '<div class="'.$bg_class.'bg-cover bg--overlay" style="'.$bg_overlay_opacity.'">';
      
      if ($bg_loop && in_array('video', $bg_options)):
        echo '<div class="video-cover d-none d-block-upd" style="'.$bg_position_loop.'">';
          get_template_part(COMP.'video','',array('video'=>$bg_loop['url'],'poster'=>$bg_img['url'],'mobile'=>true));
        echo '</div>';
      endif;

      if ($bg_mobile && in_array('mobile', $bg_options)):
        echo '<div class="img-cover d-none d-block-upd" style="'.$bg_position.'">';
          get_template_part(COMP.'image','',array('img'=>$bg_img['id'], 'critical'=>$bg_critical));
        echo '</div>';
        echo '<div class="img-cover d-block d-none-upd" style="'.$bg_position_mobile.'">';
          get_template_part(COMP.'image','',array('img'=>$bg_mobile['id'], 'critical'=>$bg_critical));
        echo '</div>';
      elseif (empty($bg_options)):
        echo '<div class="img-cover" style="'.$bg_position.'">';
          get_template_part(COMP.'image','',array('img'=>$bg_img['id'], 'critical'=>$bg_critical));
        echo '</div>';
      else:
        echo '<div class="img-cover" style="'.$bg_position.'">';
          get_template_part(COMP.'image','',array('img'=>$bg_img['id'], 'critical'=>$bg_critical));
        echo '</div>';
      endif;

    echo '</div>';
  endif; 
?>