<?php

add_action('admin_init', 'login_logo_settings');
function login_logo_settings(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id, $title, $callback, $page
  add_settings_section( 'section_id_3', 'Custom login page settings', 'login_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('primer_field6', 'Background image', 'fill_primer_field6', 'primer_page', 'section_id_3' );
 
  add_settings_field('logo_usif_id', 'Logo above Log In form', 'callback_html_logo', 'primer_page', 'section_id_3' );

  add_settings_field('logo_dashboard_id', 'Logo in left corner of Dashboard ', 'callback_html_logo_dash', 'primer_page', 'section_id_3' );
  
}
## Заполняем опцию 6
function fill_primer_field6(){
  $val = get_option('option_name');
  $val = $val ? $val['login_prefix'] : null;
  ?>
  <input type="text" name="option_name[login_prefix]" id="logo_image" value="<?php echo esc_attr( $val ) ?>"> 
  <a href="#" id="logo_image_url" class="button" > Select </a>
  <img class="logo_image" src="<?php echo esc_attr( $val ) ?>" alt="Background image" title="Background image">
  <?php
}

function login_callback() {
        echo ('<div class="description">You can add custom image</div>');
    }



function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', plugins_url( '/login/style-login.css', __FILE__ ));
    // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/login/hover_link.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// ******add background_image***
function my_login_logo_background() {
  $val = get_option('option_name');
  $val = $val ? $val['login_prefix'] : null;
  if ( $val  ) :  
        ?>
        <style type="text/css">
            body.login  {
                background-image: url(<?php echo esc_attr( $val ); ?>);
               /* -webkit-background-size: <?php echo absint( $image[1] )?>px;
                background-size: <?php echo absint( $image[1] ) ?>px;
                height: <?php echo absint( $image[2] ) ?>px;
                width: <?php echo absint( $image[1] ) ?>px;*/
            }
        </style>
        <?php
   endif;
}
add_action( 'login_form', 'my_login_logo_background', 100 );
add_action( 'lostpassword_form', 'my_login_logo_background', 100 );
// ****** END add background_image*** 

// ******Input panel add url and image***
function callback_html_logo(){
  $val = get_option('option_name');
  $val = $val ? $val['logo_usif_id'] : null;
  ?>
  <input type="text" name="option_name[logo_usif_id]" id="logo_image_1" value="<?php echo esc_attr( $val ) ?>"> 
  <a href="#" id="logo_image_url_1" class="button" > Select </a>
  <img class="logo_image" src="<?php echo esc_attr( $val ) ?>" alt="Logo above Log In form" title="Logo above Log In form">
  <?php
}
// ****** END Input panel add url and image*** 


// ***** login url and image ****
function my_login_logo() {
  $val = get_option('option_name');
  $val = $val ? $val['logo_usif_id'] : null;

 if ( $val !== null ) {
  echo ' <style type="text/css">
            #login h1 a, .login h1 a  {
                background-image: url("'.$val.'");
                }
        </style>';
  
 }   else if ( has_custom_logo() ) :
 
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a  {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                }
        </style>
        <?php
    endif;
}

add_action( 'login_head', 'my_login_logo', 100 );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo();
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// ***** END login url and image ****

// ******Input panel add dashboard_image***
function callback_html_logo_dash() {
  $val = get_option('option_name');
  $val = $val ? $val['dash_logo_id'] : null;
   
  ?>
  <!-- <input type="text" name="option_name[logo_usif_id]" id="logo_image_1" value="<?php echo esc_attr( $val ) ?>"> 
  <a href="#" id="logo_image_url_1" class="button" > Select </a>
  <img class="logo_image" src="<?php echo esc_attr( $val ) ?>" alt="Logo above Log In form" title="Logo above Log In form">
 --> 
  <input type="hidden" name="option_name[dash_logo_id]" id="heading_picture" value="<?php echo esc_attr( $val ) ?>" />
  <img id="heading_picture_preview" class="heading-picture" src="<?php echo esc_attr( $val ) ?>" />
  <button id="btn_heading_picture" name="btn_heading_picture" class="button default">Choose Picture</button>
  <?php

}
// ****** END Input panel add dashboard_image*** 

//Add dasshboard logo
function wp_dashboard_custom_logo() {
  $val = get_option('option_name');
  $val = $val ? $val['dash_logo_id'] : null;

if ($val !== null) {
  echo '<style type="text/css">
           #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before  {
                background-image: url("'.$val.'");
                background-position: 0 0;
                background-color: #fff;
                color:rgba(0, 0, 0, 0);
                background-size: 20px 20px;
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
              background-position: 0 0;
            }
        </style>
   ';
}
else if  ( has_custom_logo() ) :
 
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        ?>
        <style type="text/css">
           #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before  {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                -webkit-background-size: <?php echo absint( $image[1] )?>px;
               background-position: 0 0;
               background-color: #fff;
               color:rgba(0, 0, 0, 0);
               background-size: 20px 20px;
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
              background-position: 0 0;
            }
        </style>
        <?php
    endif;
}

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wp_dashboard_custom_logo');



?>