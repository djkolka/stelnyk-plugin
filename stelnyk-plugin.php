<?php
/*
Plugin Name: Stelnyk plugin
Description: That plugin for Developers
Version: 1.0
Author: Mykola Stelnyk
Author URI: http://stelnyk.com/
Plugin URI: http://stelnyk.com/plugins/stelnyk-plugin
*/


require 'plugin-update-checker-3.1/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://stelnyk.com/plugins/stelnyk-plugin/metadata.json',
    __FILE__,
    'stelnyk-plugin'
);

//Enqueue Admin CSS on Job Board Settings page only
if ( isset( $_GET['page'] ) && $_GET['page'] == 'stelnyk_setting' ) {
    // Enqueue Core Admin Styles
    wp_enqueue_style ( 'admin_css', plugin_dir_url( __FILE__ ) . 'admin_css/style.css');
    wp_enqueue_style ( 'tabs_css', plugin_dir_url( __FILE__ ) . 'jquery-ui-1.12.1.tabs/jquery-ui.css' );
    wp_enqueue_script( 'jq', plugin_dir_url( __FILE__ ) .'jquery-ui-1.12.1.tabs/external/jquery/jquery.js', null, null, true );
    wp_enqueue_script( 'js_tabs', plugin_dir_url( __FILE__ ) .'jquery-ui-1.12.1.tabs/jquery-ui.js',null, null, true );
    wp_enqueue_script( 'my_tabs', plugin_dir_url( __FILE__ ) .'jquery-ui-1.12.1.tabs/tabs.js', null, null, true );
    }
  //***** add media uploads****
  add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
  function load_wp_media_files( $page ) {
    // change to the $page where you want to enqueue the script
    if ( isset( $_GET['page'] ) && $_GET['page'] == 'stelnyk_setting' ) {
      // Enqueue WordPress media scripts
      wp_enqueue_media();
      // Enqueue custom script that will interact with wp.media
      wp_enqueue_script( 'jq_img', plugin_dir_url( __FILE__ ) .'admin_js/admin_js.js', null, null, false );
      wp_enqueue_script( 'js_to_bottom', plugin_dir_url( __FILE__ ) .'admin_js/admin_js_bottom.js', null, null, true );
    }
  }
  //***** END add media uploads****


function sd_register_top_level_menu(){
      add_menu_page(
        'Settings for Stelnyk developers plugin',
        'Dev Settings',
        'manage_options',
        'stelnyk_setting',
        'stelnyk_display_page',
        '',
        99
      );
    }
    add_action( 'admin_menu', 'sd_register_top_level_menu' );

  


function stelnyk_display_page(){
  ?>
  <div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>
       


       <form action="options.php" method="POST">
           <?php //   settings_fields( 'vaajo_general' );
              settings_fields( 'option_group' );     // скрытые защитные поля
              // do_settings_sections( 'primer_page' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
              do_settings_sections_tabs( 'primer_page' );
              submit_button();
             ?>
        </form>
  
  </div>
  <?php
}

/** Replace the call to 'do_settings_sections()' with a call to this function */
function do_settings_sections_tabs($page){

    global $wp_settings_sections, $wp_settings_fields;

    if(!isset($wp_settings_sections[$page])) :
        return;
    endif;
     
    echo '<div id="tabs">';
    echo '<ul>';

    foreach((array)$wp_settings_sections[$page] as $section) :

        if(!isset($section['title']))
            continue;

        printf('<li><a href="#%1$s">%2$s</a></li>',
            $section['id'],     /** %1$s - The ID of the tab */
            $section['title']   /** %2$s - The Title of the section */
        );

    endforeach;

    echo '</ul>';

    foreach((array)$wp_settings_sections[$page] as $section) :

        printf('<div id="%1$s">',
            $section['id']      /** %1$s - The ID of the tab */
        );

        if(!isset($section['title']))
            continue;

        if($section['callback'])
            call_user_func($section['callback'], $section);

        if(!isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section['id']]))
            continue;

        echo '<table class="form-table">';
        do_settings_fields($page, $section['id']);
        echo '</table>';

        echo '</div>';

    endforeach;

    echo '</div>';


}

/**
 * Регистрируем настройки.
 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
 */

add_action('admin_init', 'plugin_settings');

function plugin_settings(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id, $title, $callback, $page
  add_settings_section( 'section_id', 'Basic settings', '', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  // add_settings_field(
  //   'primer_field1', // ID
  //   'Название опции', // Title
  //   'fill_primer_field1',  // Callback * array( $this, 'fb_url_callback' ), *
  //   'primer_page', // Page
  //   'section_id' ); // Section 
   

  add_settings_field('primer_field2', 'Add custom Dashboard Widgets', 'fill_primer_field2', 'primer_page', 'section_id' );
  add_settings_field('primer_field3', 'Add custom login Logo', 'fill_primer_field3', 'primer_page', 'section_id' );
  add_settings_field('primer_field4', 'Change email address to info@yourdomain.com', 'fill_primer_field4', 'primer_page', 'section_id' );
  add_settings_field('primer_field5', 'Add bootstrap to your site', 'bootstrap_field', 'primer_page', 'section_id' );
  add_settings_field('primer_field6', 'Add Google Analytics', 'google_anal_field', 'primer_page', 'section_id' );
  add_settings_field('primer_field7', 'Add Color to Tab’s in Bowser', 'add_color_browser_field', 'primer_page', 'section_id' );
  add_settings_field('primer_field8', 'Add contact button', 'contact_button', 'primer_page', 'section_id' );
}

## Заполняем опцию 1
function fill_primer_field1(){
  $val = get_option('option_name');
  $val = $val ? $val['input'] : null;
  ?>
  <input type="text" name="option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
  <?php
}


## Заполняем опцию 2
function fill_primer_field2(){
    $val = get_option('option_name');
    $val = $val ? $val['add_dash_widg'] : null;
    ?>
    <div class="checkbox-switch">
      <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_dash_widg]" class="input-checkbox" id="toolbar-active">
      <div class="checkbox-animate">
        <span class="checkbox-off">OFF</span>
        <span class="checkbox-on">ON</span>
      </div>
    </div>
    <?php
  }
function fill_primer_field3(){
    $val = get_option('option_name');
    $val = $val ? $val['add_login_logo'] : null;
    ?>
    <div class="checkbox-switch">
      <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_login_logo]" class="input-checkbox" id="toolbar-active">
      <div class="checkbox-animate">
        <span class="checkbox-off">OFF</span>
        <span class="checkbox-on">ON</span>
      </div>
    </div>
    <?php
  }
function fill_primer_field4(){
    $val = get_option('option_name');
    $val = $val ? $val['add_change_email'] : null;
    ?>
    <div class="checkbox-switch">
      <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_change_email]" class="input-checkbox" id="toolbar-active">
      <div class="checkbox-animate">
        <span class="checkbox-off">OFF</span>
        <span class="checkbox-on">ON</span>
      </div>
    </div>
    <?php
  }
function bootstrap_field(){
  $val = get_option('option_name');
  $val = $val ? $val['add_bootstrap'] : null;
  ?>
  <div class="checkbox-switch">
    <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_bootstrap]" class="input-checkbox" id="toolbar-active">
    <div class="checkbox-animate">
      <span class="checkbox-off">OFF</span>
      <span class="checkbox-on">ON</span>
    </div>
  </div>
  <?php
}
function contact_button(){
  $val = get_option('option_name');
  $val = $val ? $val['add_contact_button'] : null;
  ?>
  <div class="checkbox-switch">
    <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_contact_button]" class="input-checkbox" id="toolbar-active">
    <div class="checkbox-animate">
      <span class="checkbox-off">OFF</span>
      <span class="checkbox-on">ON</span>
    </div>
  </div>
  <?php
}
function google_anal_field(){
  $val = get_option('option_name');
  $val = $val ? $val['add_google_anal'] : null;
  ?>
  <div class="checkbox-switch">
    <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_google_anal]" class="input-checkbox" id="toolbar-active">
    <div class="checkbox-animate">
      <span class="checkbox-off">OFF</span>
      <span class="checkbox-on">ON</span>
    </div>
  </div>
  <?php
}
function add_color_browser_field(){
  $val = get_option('option_name');
  $val = $val ? $val['add_color_browser'] : null;
  ?>
  <div class="checkbox-switch">
    <input type="checkbox" <?php checked( 1, $val ) ?> onchange="T.toggleToobarStatus()" value="1" name="option_name[add_color_browser]" class="input-checkbox" id="toolbar-active">
    <div class="checkbox-animate">
      <span class="checkbox-off">OFF</span>
      <span class="checkbox-on">ON</span>
    </div>
  </div>
  <?php
}
## Очистка данных
function sanitize_callback( $options ){ 
  // очищаем
  foreach( $options as $name => & $val ){
    if( $name == 'input' )
      $val = strip_tags( $val );

    if( $name == 'checkbox' )
      $val = intval( $val );
  }

   // die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )

  return $options;
}

  $variable_value = get_option('option_name');
  
  if ($variable_value['add_dash_widg'] == '1')
  include_once 'add_custom_dashboard_widgets.php';

  if ($variable_value['add_login_logo'] == '1')
  include_once 'add_login_logo.php';
  
  if ($variable_value['add_change_email'] == '1')
  include_once 'add_change_email_address.php';

  if ($variable_value['add_bootstrap'] == '1')
  include_once 'add_bootstrap.php';


  if ($variable_value['add_google_anal'] == '1')
  include_once 'add_google_analytics.php';

  if ($variable_value['add_color_browser'] == '1')
  include_once 'add_color_browser.php';
  
  if ($variable_value['add_contact_button'] == '1')
  include_once 'add_contact_button.php';
  
  include_once 'pagetemplater.php';
  
  include_once 'add_custom_css.php'; 

  include_once 'add_extensions_site_origin.php';
  
  
  include_once 'required_plugins/example.php';
  
  include_once 'add_disable_admin_bar_subscriber.php';
  
  include_once 'add_reset_password_message.php';
  
  include_once 'add_send_test_email.php';

  include_once 'add_other_functions.php';