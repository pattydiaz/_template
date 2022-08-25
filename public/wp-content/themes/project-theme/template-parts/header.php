<?php 
/** 
 * Global Header template
 * 
 * @package Project Name Theme
*/
?>

<header id="header" class="header">
  
  <div class="header-main">

    <button id="hamburger" class="header-btn button-transparent p-q" aria-label="Menu">
      <span class="body text-semibold text-uppercase">Menu</span>
    </button>
    
    <?php get_template_part(TP.'nav');?>

  </div>

</header>