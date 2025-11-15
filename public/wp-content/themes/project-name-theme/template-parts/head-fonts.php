<?php 
/** 
 * Head / Tracking
 * 
 * @package Project Name Theme
 * 
*/

?>

<?php if(Typekit !== ''):?>
  <link href="<?php echo Typekit;?>" rel="preload" as="style" onload="this.rel='stylesheet'">
<?php endif; ?>

<?php if(GoogleFonts !== ''):?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="<?php echo GoogleFonts; ?>" rel="stylesheet">
<?php endif; ?>

<!-- 
<link href="<?php echo TD;?>/assets/fonts/font-name-1.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous"/>
<link href="<?php echo TD;?>/assets/fonts/font-name-2.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous"/>
<link href="<?php echo TD;?>/assets/fonts/font-name-1.woff" rel="preload" as="font" type="font/woff" crossorigin="anonymous"/>
<link href="<?php echo TD;?>/assets/fonts/font-name-2.woff" rel="preload" as="font" type="font/woff" crossorigin="anonymous"/> 
-->