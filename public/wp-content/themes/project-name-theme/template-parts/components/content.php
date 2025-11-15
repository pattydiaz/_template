<?php 
/** 
 * Components / the_content 
 * 
 * @package Project Name Theme
 * 
*/

if (have_posts()) : while (have_posts()) : the_post();
  if (empty_content($post->post_content)) :

    echo '<div class="text-center">';
      echo '<h3 class="heading-5 mb-1">There is currently no content.</h3>';
      echo '<div class="contents">';
        global $post; 
        if(is_user_logged_in()):
          echo '<p>Add content to <a href="'. URL .'/wp-admin/post.php?post='. $post->ID .'&action=edit" title="this page">this page</a>.</p>';
        else:
          echo '<p><a href="'. URL .'/admin" title="Log in">Log in</a> to Wordpress to edit this page.</p>';
        endif;
        echo '<a href="'. URL .'" class="btn btn-primary mt-2" title="Back Home">Back Home</a>';
      echo '</div>';
    echo '</div>';

  else:
    $content = apply_filters('the_content', $post->post_content);
    echo '<div class="contents">'.$content.'</div>';

  endif;
endwhile; endif;