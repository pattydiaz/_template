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

<?php wp_head(); ?>

<script type="text/javascript">
  var WP_URL = '<?php global $wp; echo home_url( $wp->request ); ?>';
  var WP_TD = '<?php echo TD; ?>';
  var WP_IMG = '<?php echo IMG; ?>';
</script>
  
</head>

<body <?php body_class();?>>

  <?php //get_template_part(TP.'agegate'); ?>

  <a href="#main" class="skip-to-content button">Skip to Content</a>

  <div id="page">
    <?php get_template_part(TP.'header'); ?>

    <main id="main" class="main" role="main" tabindex="-1">