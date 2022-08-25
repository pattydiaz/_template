<?php 
/** 
 * Home template
 * 
 * @package Project Name Theme
 * 
 * Template Name: Home Page Template
*/

get_header();

?>

<div id="wrapper" class="home-page">

  <?php
    get_template_part(TP.'hero','home');

    if( have_rows('home-blocks') ): 
      while( have_rows('home-blocks') ): the_row();
        get_template_part(TP.'block', get_row_layout(), array('index'=>get_row_index()));
      endwhile;
    endif;
  ?>

</div>

<?php 
get_footer();