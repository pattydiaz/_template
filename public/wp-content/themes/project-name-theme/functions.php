<?php 
/** 
 * Theme functions
 * 
 * @package Project Name Theme
*/

define('CLI', 'pn.');
define('DIR', get_template_directory());
define('TD', get_template_directory_uri());
define('URL', get_bloginfo( 'url' ));
define('IMG', TD.'/assets/images');
define('TP', 'template-parts/');
define('COMP', 'template-parts/components/');
define('PIXEL', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');

define('Typekit', '');
define('GoogleFonts', '');
define('GoogleAnalytics', '');
define('GoogleTagManager', '');

require_once 'functions/acf.php';
require_once 'functions/actions.php';
require_once 'functions/admin.php';
require_once 'functions/filters.php';
require_once 'functions/helpers.php';
// require_once 'functions/register-post-types.php';
// require_once 'functions/register-taxonomies.php';
// require_once 'functions/register-taxonomy-filters.php';
// require_once 'functions/gravityforms.php';