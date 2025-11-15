<?php 
/** 
 * Head / Tracking
 * 
 * @package Project Name Theme
 * 
*/

?>

<?php if(GoogleTagManager !== ''):?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo GoogleTagManager; ?>');</script>
<!-- End Google Tag Manager -->
<?php endif;?>

<?php if(GoogleAnalytics !== ''):?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GoogleAnalytics; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  // gtag("set","linker",{"domains":["agaveofsedona.com"]});
  gtag('js', new Date());
  // gtag("set", "developer_id.dZTNiMT", true);

  gtag('config', '<?php echo GoogleAnalytics; ?>');
</script>
<?php endif;?>

<?php if(FacebookPixel !== ''):?>
<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window,document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?php echo FacebookPixel; ?>'); 
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" src="https://www.facebook.com/tr?id=<?php echo FacebookPixel; ?>&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code --> 
<?php endif;?>