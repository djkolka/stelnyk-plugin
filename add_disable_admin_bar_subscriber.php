<?php 
/**
 * Disable admin bar on the frontend of your website
 * for subscribers.
 */
function disable_admin_bar() { 
    if ( ! current_user_can('edit_posts') ) {
        add_filter('show_admin_bar', '__return_false'); 
    }
}
add_action( 'after_setup_theme', 'disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to 
 * WP admin for Subscribers.
 */
function redirect_admin(){
    if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
        wp_redirect( site_url() );
        exit;       
    }
}
add_action( 'admin_init', 'redirect_admin' );

/**
 * Disable admin bar on the frontend of your website
 * for WOOCOMERCE subscribers.
 */ 
function bbloomer_hide_admin_bar_if_non_admin( $show ) {
   if ( ! current_user_can( 'administrator' ) ) $show = false;
   return $show;
}
 
add_filter( 'show_admin_bar', 'bbloomer_hide_admin_bar_if_non_admin', 20, 1 );


?>