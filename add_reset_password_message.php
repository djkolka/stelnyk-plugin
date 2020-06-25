<?php

function set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','set_content_type' );

function reset_password_message_filter($message, $key, $user_login, $user_data) {
	$reset_link = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
	$message = __('Someone has asked to reset the password for the following username on this site:') . "<br>";
    $message .= site_url('') . "<br>";
    $message .= sprintf(__('Username: %s'), $user_login) . "<br>";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "<br>";
    $message .= __('To reset your password, visit the following address , copy this link to your browser or press button below:') . "<br>";
    $message .= '<a href="'. $reset_link .'">'.$reset_link.'</a><br><br>';
    $message .= '<a href="'. $reset_link .'" target="_blank" style="padding: 8px 12px; text-align:center; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #fff;text-decoration: none;font-weight:bold;display: inline-block; background-color:red; ">Reset Password</a>';
    return $message;
}
add_filter ( 'retrieve_password_message', 'reset_password_message_filter', 10 ,4);
?>