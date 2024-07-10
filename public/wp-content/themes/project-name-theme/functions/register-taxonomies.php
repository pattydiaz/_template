<?php 
/** 
 * Theme functions / register taxonomies
 * 
 * @package Project Name Theme
*/

add_action('init', function() {

    register_taxonomy('product-type', ['product'], [
        'labels' => custom_taxonomy_labels('Product Type'),
        'show_admin_column' => true,
        'hierarchical' => true
    ]);

    register_taxonomy('event-type', ['events'], [
        'labels' => custom_taxonomy_labels('Event Type'),
        'show_admin_column' => true,
        'hierarchical' => true
    ]);

    register_taxonomy('post-type', ['post'], [
        'labels' => custom_taxonomy_labels('Post Type'),
        'show_admin_column' => true,
        'hierarchical' => true
    ]);

});

function custom_taxonomy_labels($singular, $plural = null, $labels = []) {

    if (!$plural) $plural = $singular.'s';

    return array_merge([
        'name'                       => $plural,
        'singular_name'              => $singular,
        'menu_name'                  => $plural,
        'all_items'                  => 'All '.$plural,
        'edit_item'                  => 'Edit '.$singular,
        'view_item'                  => 'View '.$singular,
        'update_item'                => 'Update '.$singular,
        'add_new_item'               => 'Add New '.$singular,
        'new_item_name'              => 'New '.$singular,
        'parent_item'                => 'Parent '.$singular,
        'parent_item_colon'          => 'Parent '.$singular.':',
        'search_items'               => 'Search '.$plural,
        'popular_items'              => 'Popular '.$plural,
        'separate_items_with_commas' => 'Separate '.strtolower($plural).' with commas',
        'add_or_remove_items'        => 'Add or remove '.strtolower($plural),
        'choose_from_most_used'      => 'Choose from the most used '.strtolower($plural),
        'not_found'                  => 'No '.$plural.' found'
    ], $labels);
}