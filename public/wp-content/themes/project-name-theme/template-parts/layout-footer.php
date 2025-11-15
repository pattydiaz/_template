<?php 
/** 
 * Global Footer template
 * 
 * @package Project Name Theme
*/

$footer_legal = wp_nav_menu( array(
  'theme_location' => 'footer',
  'container_class' => 'footer-legal',
  'menu_id' => 'footer-legal',
  'menu_class' => 'footer-legal-menu ls-none',
  'add_li_class' => 'footer-legal-item d-ib-middle',
  'add_a_class' => 'footer-legal-anchor button-opacity',
  'echo' => false,
  'fallback_cb' => '__return_false',
));

?>

<footer id="footer" class="footer">
  <div class="footer-wrapper">

    <div class="footer-main">
      <div class="footer-main-newsletter">
        <?php get_template_part(COMP.'form','mailchimp'); ?>
      </div>
    </div>

    <div class="footer-social">
      <?php get_template_part(COMP.'social','',array('class'=>'footer-social-list'));?>
    </div>

    <div class="footer-sub container">
      <div class="footer-sub-item d-ib-middle">&copy; <?php echo date('Y') .' '.get_option('company_name');?>. All rights reserved.</div>
      <div class="footer-sub-item d-ib-middle"><?php if(!empty($footer_legal)): echo $footer_legal; endif;?></div>
    </div>

  </div>
</footer>