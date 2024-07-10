<?php 
/** 
 * Theme functions / register post types
 * 
 * @package Project Name Theme
*/

add_action('init', function() {

    register_post_type('product', [
        'labels' => custom_post_type_labels('Product'),
        'public' => true,
        'supports' => ['title', 'thumbnail'],
        'taxonomies' => ['product-type'],
        'show_ui' => true,
        'menu_icon' => 'dashicons-cart',
        'menu_position' => 5,
        'rewrite' => array( 
          'slug' => 'product',
          'with_front' => false
        ),
    ]);

    register_post_type('events', [
        'labels' => custom_post_type_labels('Event'),
        'public' => false,
        'supports' => ['title', 'thumbnail'],
        'taxonomies' => ['event-type'],
        'show_ui' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'menu_position' => 5
    ]);
    
});

function custom_post_type_labels($singular, $plural = null, $labels = []) {

    if (!$plural) $plural = $singular.'s';

    return array_merge([
        'name'               => $plural,
        'singular_name'      => $singular,
        'menu_name'          => $plural,
        'name_admin_bar'     => $singular,
        'all_items'          => 'All '.$plural,
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit '.$singular,
        'new_item'           => 'New '.$singular,
        'view_item'          => 'View '.$singular,
        'search_items'       => 'Search '.$plural,
        'not_found'          => 'No '.$plural.' found',
        'not_found_in_trash' => 'No '.$plural.' found in Trash',
        'parent_item_colon'  => 'Parent '.$plural.':'
    ], $labels);
}