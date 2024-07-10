<?php 
/** 
 * Blog Post template
 * 
 * @package Project Name Theme
 * 
*/

get_header();

?>

<div id="wrapper" class="post-page">

  <?php
    if (!post_password_required($post)) :

      get_template_part(TP.'hero','post');

      if( have_rows('post-blocks') ): 
        while( have_rows('post-blocks') ): the_row();
          get_template_part(TP.'block', get_row_layout(), array('index'=>get_row_index()));
        endwhile;
      else: 
        get_template_part(TP.'default','content');
      endif;
      
    else :
      get_template_part(TP . 'default', 'password');
    endif;  
  ?>
  
</div>

<?php 
get_footer();