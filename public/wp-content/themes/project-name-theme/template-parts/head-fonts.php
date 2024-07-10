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