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
  
  <?php

    if (!post_password_required($post)) :

      get_template_part(TP . 'default', 'hero');

      if(is_page(['design-guide','style-guide'])):
        get_template_part(TP.'block','design');
      else: 
        get_template_part(TP . 'default', 'content');
      endif;
    else :
      get_template_part(TP . 'default', 'password');
    endif;   
  ?>

</div>

<?php 
get_footer();