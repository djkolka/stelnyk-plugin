<?php

add_action('admin_init', 'email_settings');
function email_settings(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id, $title, $callback, $page
  add_settings_section( 'section_id_2', 'E-mail settings', 'email_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('primer_field5', 'Email prefix', 'fill_primer_field5', 'primer_page', 'section_id_2' );
  
}
## Заполняем опцию 5
function fill_primer_field5(){
  $val = get_option('option_name');
  $url = get_option( 'siteurl' );
  ?>
  <input type='text' name='option_name[email_prefix]' value='<?php echo $val['email_prefix']; ?>'> enter only prefix (everething before @)
  <?php
}

function email_callback() {
         echo ('<div class="description">You can change default email "wordpress@yourdomain.com" to any other prefix like "info@yourdomain.com" <br> 
          the following email settings are now  <strong>'.wp_sender_email($original_email_address).'</strong>  .</div>');
          }

// Function to change email address
      function wp_sender_email( $original_email_address ) {
          $val = get_option('option_name');
          $val = $val['email_prefix'];
          if ($val){
            $prefix = $val;
          } else {
            $prefix = 'info';
          } 
          $url = get_option( 'siteurl' );
          $url = parse_url($url);
          $url = $url['host'];
          $url = $prefix.'@'.$url;
          return  $url ;
      }
       
      // Function to change sender name
      function wp_sender_name( $original_email_from ) {
          $name = get_option( 'blogname' );
          return htmlspecialchars_decode($name);
      }
       
      // Hooking up our functions to WordPress filters 
      add_filter( 'wp_mail_from', 'wp_sender_email' );
      add_filter( 'wp_mail_from_name', 'wp_sender_name' );

?>