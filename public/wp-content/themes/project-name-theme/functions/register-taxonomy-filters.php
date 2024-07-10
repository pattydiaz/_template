<?php 
/** 
 * Theme functions / register taxonomy filters
 * 
 * @package Project Name Theme
*/

add_action('restrict_manage_posts', function(){
  global $typenow;

  $tax = array(
    "product-type" => 'product',
    "event-type" => 'events',
    "post-type" => 'post',
  );

  foreach ($tax as $k => $v) {
    $taxonomies = array($k);
    
    if ($typenow == $v) :
      foreach ($taxonomies as $tax_slug) :
        $tax_obj = get_taxonomy($tax_slug);
        $tax_name = $tax_obj->labels->name;
        $terms = get_terms($tax_slug);
    
        if (count($terms) > 0) :
          echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
          echo "<option value=''>Show All $tax_name</option>";
    
          foreach ( $terms as $term ) :
            $selected = '';

            if ( isset( $_GET[$tax_slug] ) ) {
              if ( $_GET[$tax_slug] == $term->slug ) $selected = ' selected="selected"';
            }
    
            echo '<option value='. $term->slug, $selected,'>' . $term->name .' (' . $term->count .')</option>';
          endforeach;
    
          echo "</select>";
        endif;
      endforeach;
    endif;
  }
  
});