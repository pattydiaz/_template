<?php 
/** 
 * Global Navigation template
 * 
 * @package Project Name Theme
 * 
*/

$nav_main = wp_nav_menu( array(
  'theme_location' => 'header',
  'container_class' => 'nav-main',
  'menu_id' => 'nav-menu',
  'menu_class' => 'nav-main-menu ls-none',
  'add_li_class' => 'nav-main-item',
  'add_a_class' => 'nav-main-anchor button-opacity',
  'echo' => false,
  'fallback_cb' => '__return_false',
));

?>

<nav id="nav" class="header-nav nav">
  <div class="nav-wrapper">

    <div class="nav-container">
      <?php if(!empty($nav_main)): echo $nav_main; endif;?>
    </div>

  </div>

</nav>