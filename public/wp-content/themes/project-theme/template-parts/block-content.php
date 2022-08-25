<?php 
/** 
 * Block / Content Editor
 * 
 * @package Project Name Theme
 * 
*/

$spacing_top = get_sub_field('spacing-top');
$spacing_bottom = get_sub_field('spacing-bottom');
$content = get_sub_field('content');

?>

<section class="default-content section<?php if($spacing_top == true): echo ' gap-t'; endif; if($spacing_bottom == true): echo ' gap-b'; endif; ?>">
  <div class="container container-md">
    <?php if($content): ?>

      <div class="contents<?php if($spacing_top == false): echo ' pt-2'; endif; if($spacing_bottom == false): echo ' pb-2'; endif; ?>"><?php echo $content; ?></div>

    <?php else: ?>

      <div class="text-center">
        <h3 class="heading-6 mb-1">There is currently no content.</h3>
        <div class="contents">
        <?php global $post; if(is_user_logged_in()): ?>
          <p>Add content to <a href="<?php echo URL; ?>/wp-admin/post.php?post=<?php echo $post->ID; ?>&action=edit" title="this page">this page</a>.</p>
        <?php else:?>
          <p><a href="<?php echo URL; ?>/admin" title="Log in">Log in</a> to Wordpress to edit this page.</p>
        <?php endif;?>
        </div>
      </div>

    <?php endif; ?>
  </div>
</section>