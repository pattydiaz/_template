<?php 
/** 
 * Scripts / Wordpress
 * 
 * @package Project Name Theme
 * 
*/

?>

<script type="text/javascript">
  var WP_URL = '<?php global $wp; echo home_url( $wp->request ); ?>';
  var WP_TD = '<?php echo TD; ?>';
  var WP_IMG = '<?php echo IMG; ?>';
  var WP_ID = '<?php global $post; echo $post->ID; ?>';
</script>