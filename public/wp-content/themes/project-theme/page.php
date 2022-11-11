<?php 
/** 
 * Main template
 * 
 * @package Project Name Theme
 * 
*/

get_header();

?>

<div id="wrapper" class="default-page">
  <?php if (!post_password_required($post)): ?>

  <?php 
    get_template_part(TP.'hero','default'); 

    if( have_rows('default-blocks') ): 
      while( have_rows('default-blocks') ): the_row();
        get_template_part(TP.'block', get_row_layout(), array('index'=>get_row_index()));
      endwhile;
    else:
      get_template_part(TP.'default','content');
    endif;
  ?>

  <?php else: get_template_part(TP.'default', 'password'); endif; ?>
</div>

<?php 
get_footer();