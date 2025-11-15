<?php
/** 
 * Theme functions / admin
 * 
 * @package Project Name Theme
 */


// Add slug class to body
add_filter('admin_body_class', function($classes) {
  global $pagenow, $post;

  // Add role- classes for each role the current user has
  $current_user = wp_get_current_user();

  if (!empty($current_user->roles)) {
    foreach ($current_user->roles as $role) {
      $classes .= ' role-' . sanitize_html_class($role);
    }
  }

  // For post edit or add new screens
  if (in_array($pagenow, ['post.php', 'post-new.php']) && isset($post)) {
    $classes .= ' page-slug-' . sanitize_html_class($post->post_name);
  }

  // For pages like Appearance > Menus, Settings, etc.
  if (!empty($_GET['page'])) {
    $classes .= ' admin-page-' . sanitize_html_class($_GET['page']);
  }

  return $classes;
});


add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
  remove_menu_page( 'edit.php' );
  remove_submenu_page('themes.php', 'site-editor.php?path=/patterns');
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
  $current_user = wp_get_current_user();

  // $wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
  // $wp_customize->get_section( 'static_front_page' )->active_callback = '__return_false';
  $wp_customize->get_section( 'custom_css' )->active_callback = '__return_false';

  if (!$current_user || empty($current_user->user_email)) {
    return;
  }

  $user_email = $current_user->user_email;
  
  if(strpos($user_email, '@makersandallies.com') === false) {
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
  $current_user = wp_get_current_user();

  // disable tags on posts
  register_taxonomy('post_tag', []);
  //disable categories on posts
  register_taxonomy( 'category', []);

  if (!$current_user || empty($current_user->user_email) || empty($current_user->roles)) {
    return;
  }

  $user_email = $current_user->user_email;
  $user_roles = $current_user->roles;

  // disable html editor
  if (!(in_array('developer', $user_roles, true))) {
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
add_action('admin_menu', function() {
  $current_user = wp_get_current_user();

  remove_submenu_page('themes.php', 'edit.php?post_type=wp_block');

  if (!$current_user || empty($current_user->user_email) || empty($current_user->roles)) {
    return;
  }

  $user_email  = $current_user->user_email;
  $user_roles  = $current_user->roles;

  if (!(in_array('developer', $user_roles, true))) {
    remove_menu_page('options-general.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_menu_page('ai1wm_export');
    remove_menu_page('wp_protect_password_options');
  }
}, 999);


// Hide plugins from plugins list
add_filter('all_plugins', function($plugins) {
  $current_user = wp_get_current_user();

  if (!$current_user || empty($current_user->user_email) || empty($current_user->roles)) {
    return $plugins;
  }

  $user_email = $current_user->user_email;
  $user_roles = $current_user->roles;

  if (in_array('developer', $user_roles, true)) {
    return $plugins;
  }

  unset($plugins['advanced-custom-fields-pro/acf.php']);
  unset($plugins['all-in-one-wp-migration/all-in-one-wp-migration.php']);
  unset($plugins['all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php']);
  unset($plugins['password-protect-page/wp-protect-password.php']);
  unset($plugins['svg-support/svg-support.php']);
  unset($plugins['simple-custom-post-order/simple-custom-post-order.php']);
  unset($plugins['duplicate-post/duplicate-post.php']);

  return $plugins;
});


// Hide CLI.admin user from the users list for all users except themselves
add_action('pre_user_query', function ($user_search) {
  $current_user = wp_get_current_user();
  $current_user_login = $current_user->user_login;
  $hidden_login = CLI . 'admin';

  // Only hide if current user is NOT CLI.admin
  if ($current_user_login !== $hidden_login) {
    global $wpdb;

    $user_search->query_where = str_replace(
      'WHERE 1=1',
      $wpdb->prepare("WHERE 1=1 AND {$wpdb->users}.user_login != %s", $hidden_login),
      $user_search->query_where
    );
  }
});


// Hide superuser account (CLI.admin) author archive
add_action('template_redirect', function() {
  $hidden_user = CLI . 'admin';

  if (is_author()) {
    $author_login = get_the_author_meta('user_login');

    if ($author_login && $author_login === $hidden_user) {
      wp_redirect( esc_url(home_url()), 301 );
      exit;
    }
  }
});


// Adjust user counts to hide internal user (CLI.admin or fallback) from the Users list
add_filter('views_users', function($views) {
  $current_user = wp_get_current_user();
  $hidden_user_login = null;

  // Detect CLI admin user login
  if (defined('CLI')) {
    $admin_login = CLI . 'admin';
    if (username_exists($admin_login)) {
      $hidden_user_login = $admin_login;
    }
  }

  // Fallback: use makersandallies user
  if (!$hidden_user_login) {
    $makers_users = get_users([
      'search' => '*@makersandallies.com',
      'search_columns' => ['user_email'],
      'number' => 1,
      'fields' => ['user_login'],
    ]);

    if (!empty($makers_users)) {
      $hidden_user_login = $makers_users[0]->user_login;
    }
  }

  // No hidden user or current user is hidden user — no change
  if (!$hidden_user_login || $current_user->user_login === $hidden_user_login) {
    return $views;
  }

  // Get counts for all users & roles
  $counts = count_users();
  $total_users = isset($counts['total_users']) ? $counts['total_users'] : 0;
  $roles_counts = isset($counts['avail_roles']) ? $counts['avail_roles'] : [];

  // Get the hidden user object
  $hidden_user = get_user_by('login', $hidden_user_login);
  if (!$hidden_user) {
    // User not found, return original
    return $views;
  }

  // Subtract 1 from total users
  $new_total = max(0, $total_users - 1);

  // Prepare updated role counts
  $new_roles_counts = $roles_counts;

  // For each role the hidden user has, subtract 1
  foreach ($hidden_user->roles as $role) {
    if (isset($new_roles_counts[$role])) {
      $new_roles_counts[$role] = max(0, $new_roles_counts[$role] - 1);
    }
  }

  // Now update the $views links with adjusted counts
  foreach ($views as $key => $view_html) {
    // Determine count for this view key
    if ($key === 'all') {
      $count = $new_total;
    } else {
      // Role-specific views: keys are role slugs
      $count = isset($new_roles_counts[$key]) ? $new_roles_counts[$key] : 0;
    }

    // Extract if this is the current view to keep "current" class
    $class = (strpos($view_html, 'current') !== false) ? 'current' : '';

    // Rebuild link with updated count
    // Find URL inside existing link (preserve URL if possible)
    preg_match('/href="([^"]+)"/', $view_html, $matches);
    $url = $matches[1] ?? 'users.php';

    // Translate role names to display names
    // You can adjust this map to match your roles
    $role_display_names = [
      'all' => __('All'),
      'administrator' => __('Administrator'),
      'developer' => __('Developer'),
      // Add more roles if needed
    ];
    $label = $role_display_names[$key] ?? ucfirst($key);

    $views[$key] = sprintf(
      '<a href="%s" class="%s">%s <span class="count">(%d)</span></a>',
      esc_url($url),
      esc_attr($class),
      esc_html($label),
      $count
    );
  }

  return $views;
});


// User viewing restrictions
add_action('template_redirect', function () {
  if (!is_author()) return;

  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  $current_user = wp_get_current_user();
  $author       = get_queried_object();

  if (!$author || !$current_user) {
    wp_redirect(home_url());
    exit;
  }

  // Allow if viewing own profile
  if ($author->ID === $current_user->ID) return;

  $current_email = $current_user->user_email;
  $author_email  = $author->user_email;

  $is_current_makers = strpos($current_email, '@makersandallies') !== false;
  $is_author_makers  = strpos($author_email, '@makersandallies') !== false;

  $cli_admin = CLI . 'admin';
  $cli_dev   = CLI . 'dev';

  $current_login = $current_user->user_login;
  $author_login  = $author->user_login;

  $current_is_cli_admin = $current_login === $cli_admin;
  $current_is_cli_dev   = $current_login === $cli_dev;
  $current_is_developer = in_array('developer', $current_user->roles);

  // Developers should have the same permissions as CLI.dev
  $current_is_dev_like = $current_is_cli_dev || $current_is_developer;

  // Block access to CLI.admin profile for everyone except CLI.admin
  if ($author_login === $cli_admin && !$current_is_cli_admin) {
    wp_redirect(home_url());
    exit;
  }

  // Block access to CLI.dev profile for everyone except CLI.admin and CLI.dev/developer
  if ($author_login === $cli_dev && !$current_is_cli_admin && !$current_is_dev_like) {
    wp_redirect(home_url());
    exit;
  }

  // If author is @makersandallies, only allow current user if also @makersandallies
  if ($is_author_makers && !$is_current_makers) {
    wp_redirect(home_url());
    exit;
  }

  // Otherwise allow access
});


// User editing restrictions
add_action('admin_init', function () {
  global $pagenow;

  if ($pagenow === 'user-edit.php' && isset($_GET['user_id'])) {
    $current_user     = wp_get_current_user();
    $editing_user_id  = intval($_GET['user_id']);
    $editing_user     = get_userdata($editing_user_id);

    if (!$editing_user || !$current_user) return;

    $current_email = $current_user->user_email;
    $target_email  = $editing_user->user_email;

    $is_current_makers = strpos($current_email, '@makersandallies') !== false;
    $is_target_makers  = strpos($target_email, '@makersandallies') !== false;

    $cli_admin = CLI . 'admin';
    $cli_dev   = CLI . 'dev';

    $current_login = $current_user->user_login;
    $target_login  = $editing_user->user_login;

    $current_is_cli_admin = $current_login === $cli_admin;
    $current_is_cli_dev   = $current_login === $cli_dev;
    $current_is_developer = in_array('developer', $current_user->roles);

    // Treat "developer" role same as CLI.dev
    $current_is_dev_like = $current_is_cli_dev || $current_is_developer;

    // Block editing @makersandallies user unless current user is also @makersandallies
    if ($is_target_makers && !$is_current_makers) {
      wp_die(__('You are not allowed to edit this user.', 'your-text-domain'), 403);
    }

    // Block editing CLI.admin unless current user is CLI.admin
    if ($target_login === $cli_admin && !$current_is_cli_admin) {
      wp_safe_redirect(admin_url());
      exit;
    }

    // Block editing CLI.dev unless current user is CLI.admin or CLI.dev/developer
    if ($target_login === $cli_dev && !$current_is_cli_admin && !$current_is_dev_like) {
      wp_safe_redirect(admin_url());
      exit;
    }
  }
});


// User delete option restrictions
add_action('admin_init', function () {
  $current_user = wp_get_current_user();
  $current_user_login = $current_user->user_login;
  $current_user_email = $current_user->user_email;
  $current_user_roles = $current_user->roles;

  $is_cli_admin = $current_user_login === CLI . 'admin';
  $is_cli_dev = $current_user_login === CLI . 'dev';
  $is_makers_user = strpos($current_user_email, '@makersandallies.com') !== false;
  $is_developer_role = in_array('developer', $current_user_roles);

  $protected_logins = [CLI . 'admin', CLI . 'dev'];

  function can_delete_user($target_user, $current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role) {
    $target_login = $target_user->user_login;
    $target_email = $target_user->user_email;

    $target_is_cli_admin = $target_login === CLI . 'admin';
    $target_is_cli_dev = $target_login === CLI . 'dev';
    $target_is_makers = strpos($target_email, '@makersandallies.com') !== false;

    if ($is_cli_admin) { return true;}
    if ($is_cli_dev) { return !$target_is_cli_admin;}
    if ($is_makers_user || $is_developer_role) { return !$target_is_cli_admin && !$target_is_cli_dev;}

    // Everyone else: can delete only if target is not CLI.admin, CLI.dev, or @makersandallies.com
    return !$target_is_cli_admin && !$target_is_cli_dev && !$target_is_makers;
  }

  // Remove "Delete" from user row actions
  add_filter('user_row_actions', function ($actions, $user) use ($current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role) {
    if (!isset($actions['delete'])) return $actions;

    if (!can_delete_user($user, $current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role)) {
      unset($actions['delete']);
    }

    return $actions;
  }, 10, 2);

  // Remove "Delete" from bulk actions if any selected users can't be deleted
  add_filter('bulk_actions-users', function ($actions) {
    // We allow the action, but actual permission check happens in admin_init below
    return $actions;
  });

  // Block deletion via direct URL or bulk delete
  add_action('admin_init', function () use ($current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role) {
    // Single user delete
    if (isset($_GET['action'], $_GET['user']) && $_GET['action'] === 'delete') {
      $user_id = intval($_GET['user']);
      $user = get_userdata($user_id);
      if (!$user) return;

      if (!can_delete_user($user, $current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role)) {
        wp_die('You are not allowed to delete this user.');
      }
    }

    // Bulk delete
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['users'])) {
      $user_ids = array_map('intval', (array) $_GET['users']);

      foreach ($user_ids as $user_id) {
        $user = get_userdata($user_id);
        if (!$user) continue;

        if (!can_delete_user($user, $current_user_login, $is_cli_admin, $is_cli_dev, $is_makers_user, $is_developer_role)) {
          wp_die('One or more selected users cannot be deleted.');
        }
      }
    }
  });
});


// Set branded default Gravatar 
add_filter( 'avatar_defaults', function($avatar_defaults){
  $brand_avatar = IMG . '/favicon.jpg';
  $avatar_defaults[$brand_avatar] = "Default Gravatar";
  return $avatar_defaults;
});


// Add "User ID" column to the Users table
add_filter('manage_users_columns', function($columns) {
  $current_user = wp_get_current_user();

  if (!$current_user || empty($current_user->user_email) || empty($current_user->roles)) {
    return $columns;
  }

  $user_email  = $current_user->user_email;
  $user_roles  = $current_user->roles;

  if (in_array('developer', $user_roles, true)) {
    $columns['uid'] = 'ID';
  }

  return $columns;
});


// Show the user ID in the "User ID" column if allowed
add_filter('manage_users_custom_column', function($empty, $column_name, $user_id) {
  if ($column_name !== 'uid') {
    return $empty;
  }

  $current_user = wp_get_current_user();

  // Safety check
  if (!$current_user || empty($current_user->user_email) || empty($current_user->roles)) {
    return $empty;
  }

  $user_email  = $current_user->user_email;
  $user_roles  = $current_user->roles;

  if (in_array('developer', $user_roles, true)) {
    return $user_id;
  }

  return $empty;
}, 10, 3);


// // Temporarily activate to apply "developer" user role
// add_action('init', function () {

//   if (!get_role('developer')) {
//     add_role('developer', 'Developer', get_role('administrator')->capabilities);
//   }

//   $emails = [
//     'dev@makersandallies.com',
//   ];

//   foreach ($emails as $email) {
//     $user = get_user_by('email', $email);
//     if ($user) {
//       $user->add_role('developer');
//       $user->add_role('administrator'); // Ensure they have administrator too
//     }
//   }
// });

// // Temporarily activate to remove "developer" user role
// add_action('init', function () {

//   // Remove roles from these users
//   $emails = [
//     'user@user.com',
//   ];

//   foreach ($emails as $email) {
//     $user = get_user_by('email', $email);
//     if ($user) {
//       $user->remove_role('developer');
//     }
//   }

// });