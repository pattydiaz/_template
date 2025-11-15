<?php
/** 
 * Theme functions / navigation
 * 
 * @package Project Name Theme
 * 
 */


register_nav_menus(array(
  'header' => 'Header menu',
  'footer' => 'Footer menu',
));


// Add class to <li> elements
add_filter('nav_menu_css_class', function($classes, $item, $args){
  if (isset($args->add_li_class)) { $classes[] = $args->add_li_class; }
  return $classes;
}, 1, 3);


// Add class to <a> elements
add_filter('nav_menu_link_attributes', function($atts, $item, $args){
  if (isset($args->add_a_class)) {
    $atts['class'] = isset($atts['class']) 
      ? $atts['class'] . ' ' . $args->add_a_class 
      : $args->add_a_class;
  }
  return $atts;
}, 1, 3);