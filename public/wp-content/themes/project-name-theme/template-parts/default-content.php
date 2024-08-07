<?php
/** 
 * Global the_content template
 * 
 * @package Project Name Theme
 * 
*/
?>


<section class="default-content section gap-ym--sm">
  <div class="container container-md">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php if (empty_content($post->post_content)) : ?>

        <div class="text-center">
          <h3 class="heading-4 mb-1">There is currently no content.</h3>
          <div class="contents">
            <?php global $post; if(is_user_logged_in()): ?>
              <p>Add content to <a href="<?php echo URL; ?>/wp-admin/post.php?post=<?php echo $post->ID; ?>&action=edit" title="this page">this page</a>.</p>
            <?php else:?>
              <p><a href="<?php echo URL; ?>/admin" title="Log in">Log in</a> to Wordpress to edit this page.</p>
            <?php endif;?>
            <a href="<?php echo URL; ?>" class="btn btn-primary mt-4" title="Back to Home">Back to Home</a>
          </div>
        </div>

      <?php else: ?>
        <div class="contents"><?php the_content(); ?></div>
      <?php endif; ?>
    <?php endwhile;endif; ?>
  </div>
</section>