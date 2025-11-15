<?php 
/** 
 * Global Header template
 * 
 * @package Project Name Theme
*/
?>

<header id="header" class="header">
  <div class="header-wrapper">

    <div class="header-container">
      <a href="<?php echo URL; ?>" class="header-logo" title="<?php echo get_option('company_name');?>">
        <img src="<?php echo IMG;?>/logo.png" alt="<?php echo get_option('company_name');?> logo">
      </a>
  
      <?php// get_template_part(TP.'nav');?>
  
      <button id="menu" class="header-btn button-transparent" aria-label="Menu">Menu</button>
    </div>

  </div>
</header>