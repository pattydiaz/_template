<?php 
/** 
 * Theme functions / acf
 * 
 * @package Project Name Theme
*/

if( function_exists('acf_add_options_page') ) {
		
  acf_add_options_sub_page(array(
    'page_title' 	=> 'Global',
    'menu_title'	=> 'Global',
    'menu_slug'	    => 'global',
        'capability'	=> 'edit_posts',
        'parent_slug'   => 'themes.php',
        'position'      => false,
        'icon_url'      => false
  ));
  
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Menus',
	// 	'menu_title'	=> 'Menus',
	// 	'menu_slug'	    => 'menu',
  //       'capability'	=> 'edit_posts',
  //       'parent_slug'   => 'themes.php',
  //       'position'      => false,
  //       'icon_url'      => false
	// ));
  
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Content Blocks',
	// 	'menu_title'	=> 'Content Blocks',
	// 	'menu_slug'	    => 'blocks',
  //       'capability'	=> 'edit_posts',
  //       'parent_slug'   => 'themes.php',
  //       'position'      => false,
  //       'icon_url'      => false
	// ));

}


add_filter('acf/fields/wysiwyg/toolbars', function($toolbars) {
  global $editor_toolbar1, $editor_toolbar2, $basic_toolbar1;

  if (isset($toolbars['Full'][1])) $toolbars['Full'][1] = $editor_toolbar1;
  if (isset($toolbars['Full'][2])) $toolbars['Full'][2] = $editor_toolbar2;
  if (isset($toolbars['Basic'][1])) $toolbars['Basic'][1] = $basic_toolbar1;

  // add an empty toolbar with no buttons, see acompanying styles in admin_head below
  $toolbars['Empty'] = [];
  $toolbars['Empty'][1] = ['bold','italic','link','unlink','bullist','numlist'];
  return $toolbars;
});


// Only allow "published" posts in relationship field && sort by date added 
add_filter( 'acf/fields/relationship/query',function($options, $field, $the_post){
  $options['orderby'] = 'post_date';
  $options['order'] = 'DESC';
  $options['post_status'] = array('publish','public');

  return $options;
}, 10, 3);