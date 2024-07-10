<?php 
/** 
 * Header template
 * 
 * @package Project Name Theme
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<?php get_template_part(TP.'head','tracking'); ?>

<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">

<?php
  // get_template_part(TP.'head','tracking');
  // get_template_part(TP.'head','fonts');
  get_template_part(TP.'scripts','wp');
  wp_head();
?>
  
</head>

<body <?php body_class();?>>

  <?php 
    // get_template_part(TP.'scripts','gtm');
    // get_template_part(TP.'consent');
    // get_template_part(TP.'modal');
  ?>

  <a href="#main" class="skip-to-content button">Skip to Content</a>

  <div id="page">

    <?php 
      get_template_part(TP.'header');
      // get_template_part(TP.'nav');
    ?>

    <main id="main" class="main" role="main" tabindex="-1">