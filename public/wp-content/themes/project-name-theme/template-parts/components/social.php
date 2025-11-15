<?php 
/** 
 * Components / Social Media
 * 
 * @package Project Name Theme
 * 
*/

$social_class = isset($args['class']) ? $args['class'].' ' : '';
$social_color = isset($args['color']) ? $args['color'] : 'black';
$social = get_field('social','option');

?>

<?php if($social): if(have_rows('social','option')):?>
  <ul class="<?php echo $social_class; ?>social ls-none mx-nh">

    <?php while(have_rows('social','option')): the_row();

      $social_channel = get_sub_field('social-channel');
      $social_url = get_sub_field('social-url'); ?>

      <?php if(!empty($social_url)):?>
        <li class="d-ib">
          <a href="<?php echo $social_url; ?>" class="button-opacity icon-sm color-<?php echo $social_color;?>" title="<?php echo $social_channel['label'];?>" target="_blank" rel="nofollow">
            <span><i class="social-icon <?php echo $social_channel['value'];?>"></i></span>
          </a>
        </li>
      <?php endif;?>

    <?php endwhile; ?>

  </ul>
<?php endif; endif;?>