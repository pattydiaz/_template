<?php 
/** 
 * Custom template
 * 
 * @package Project Name Theme
 * 
 * Template Name: Custom Template
*/

get_header();

$template_slug = !empty(get_field('template-slug')) ? get_field('template-slug') : 'custom';

?>

<div id="wrapper" class="<?php echo $template_slug; ?>-page">

  <?php

    if (!post_password_required($post)) :

      if( have_rows('custom-blocks') ):
        while( have_rows('custom-blocks') ): the_row();
          get_template_part(TP.'block', get_row_layout(), array('index'=>get_row_index()));
        endwhile;
      else: 
        get_template_part(TP.'default','hero');
        get_template_part(TP.'default','content');
      endif;
      
    else :
      get_template_part(TP . 'default', 'password');
    endif;
    
  ?>

</div>

<?php 
get_footer();