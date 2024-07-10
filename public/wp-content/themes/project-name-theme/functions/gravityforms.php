<?php
/** 
 * Theme functions / Gravity Forms
 * 
 * @package Stanislaus Theme
 */


// Remove from wysiwyg
add_filter( 'gform_display_add_form_button', function(){return false;} );