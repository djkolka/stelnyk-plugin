<?php
/**** Disable Default Dashboard Widgets*****/
function disable_default_dashboard_widgets() {
  global $wp_meta_boxes;
  // wp..
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
   // bbpress
  unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
  // yoast seo
  unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
  // gravity forms
  unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
  // gravity forms
  unset($wp_meta_boxes['dashboard']['normal']['core']['so-dashboard-news']);
  //semperplugins-rss-feed
  unset($wp_meta_boxes['dashboard']['normal']['core']['semperplugins-rss-feed']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);
/**** END Disable Default Dashboard Widgets*****/
 
 //welcome-panel
remove_action('welcome_panel', 'wp_welcome_panel');

/**** Add custom Dashboard Widgets*****/

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
    
function my_custom_dashboard_widgets() {
  global $wp_meta_boxes;
    $user = wp_get_current_user();
    $user = strtoupper ( $user->user_login );
    $bloginfo = get_bloginfo( 'name' );
  wp_add_dashboard_widget('custom_help_widget',  $user.', вітаємо у спільноті '.$bloginfo, 'custom_dashboard_widget');
  }

function custom_dashboard_widget($user) {
    $user = wp_get_current_user();
    $user = ucfirst ( $user->user_login );
    $bloginfo = get_bloginfo( 'name' );
  echo '<p><b>'.$user.'</b>, Welcome to <b>'.$bloginfo.'</b> ! <br>Need help? Contact with us  <a href="/contact">here</a>. Please read our agreement: <a href="/privacy-policy" target="_blank"><b>Privacy policy</b></a></p>';
  
  // **print content by ID of page**
    $post_id = 2;//  post id
    $post_content = get_post($post_id);
    $content = $post_content->post_content;
    echo do_shortcode( $content ); //executing shortcodes
  // **print content by name of page**
    $page_slug ='Privacy policy';// name of page
    $page_data = get_page_by_path($page_slug);
    $page_id = $page_data->ID;
    $post_content = get_post($page_id);
    $content = $post_content->post_content;
    echo '<h2>' . $page_data->post_title . '</h2>';
    echo do_shortcode( $content ); //executing shortcodes
  
}

/**** END Add custom Dashboard Widgets*****/

/**** Add custom Dashboard Widgets*****/

add_action('wp_dashboard_setup', 'title_dashboard_widgets');
    
function title_dashboard_widgets() {
  global $wp_meta_boxes;
    // **print content by name of page**
    $page_slug ='Privacy policy';// name of page
    $page_data = get_page_by_path($page_slug);
    $page_id = $page_data->ID;
    $post_content = get_post($page_id);
    $page_data->post_title;   
  wp_add_dashboard_widget('custom_privacy_widget',  $page_data->post_title , 'content_dashboard_widget');
  }

function content_dashboard_widget($user) {
    // **print content by name of page**
    $page_slug ='Privacy policy';// name of page
    $page_data = get_page_by_path($page_slug);
    $page_id = $page_data->ID;
    $post_content = get_post($page_id);
    $content = $post_content->post_content;
    echo do_shortcode( $content ); //executing shortcodes
  }

/**** END Add custom Dashboard Widgets*****/

?>