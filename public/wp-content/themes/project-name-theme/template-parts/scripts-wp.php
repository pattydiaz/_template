<?php 
/** 
 * Scripts / Wordpress
 * 
 * @package Project Name Theme
 * 
*/

global $post, $wp;

$wp_id = isset($post->ID) ? $post->ID : 0;

if (!defined('TD')) define('TD', get_template_directory_uri());
if (!defined('IMG')) define('IMG', TD . '/assets/images');

?>

<script type="text/javascript">
  var WP_URL = '<?php echo home_url( $wp->request ); ?>';
  var WP_TD = '<?php echo TD; ?>';
  var WP_IMG = '<?php echo IMG; ?>';
  var WP_ID = '<?php echo $wp_id; ?>';
</script>