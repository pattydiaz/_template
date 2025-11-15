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

<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=3">

<?php
  // get_template_part(TP.'head','tracking');
  // get_template_part(TP.'head','fonts');
  get_template_part(TP.'scripts','wp');
  wp_head();
?>
  
</head>

<body <?php body_class();?>>

  <a href="#main" class="skip-to-content">Skip to Content</a>

  <?php 
    // get_template_part(TP.'scripts','gtm');
    // get_template_part(TP.'layout','modal');
  ?>

  <div id="page">

    <?php 
      get_template_part(TP.'layout','header');
      // get_template_part(TP.'layout','nav');
    ?>

    <main id="main" class="main" role="main" tabindex="-1">