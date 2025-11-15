<?php
/** 
 * Theme functions / messages
 * 
 * @package Project Name Theme
 */



// Add "Vendor" featured image instructions
add_filter('admin_post_thumbnail_html', function($html) {

  if(get_post_type() == 'product')
    $html .= 'This image will be used as the thumbnail for the Products page.';

  return $html;
});