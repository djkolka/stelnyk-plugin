<?php

add_action('admin_init', 'bootstrap_settings');

function bootstrap_settings(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id(id of tab), $title, $callback, $page
  add_settings_section( 'bootsrap__tab_id', 'Add bootsrap to your pages', 'bootstrap_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('bootstrap__id', 'Add Bootstrap', 'add_bootstrap', 'primer_page', 'bootsrap__tab_id' );
    
}
## Заполняем опцию bootsrap
function add_bootstrap(){
  $val = get_option('option_name');
  $val = $val ? $val['bootstrap_version'] : null;
  ?>

  <input type="radio" name="option_name[bootstrap_version]" id="bootstrap_version" value="0"<?php if ($val == 0)echo 'checked="checked"';?>>No Bootstrap<br>
  <input type="radio" name="option_name[bootstrap_version]" id="bootstrap_version" value="4"<?php if ($val == 4)echo 'checked="checked"';?>>Version-4.3.1<br>
  <input type="radio" name="option_name[bootstrap_version]" id="bootstrap_version" value="3"<?php if ($val == 3)echo 'checked="checked"';?>>Version-3.3.7<br>
  <?php
}

function bootstrap_callback() {
        echo ('<div class="description">Select version of bootstrap</div>');
    }

$val = get_option('option_name');
$val = $val ? $val['bootstrap_version'] : null;
if ($val == 4) {

// *** add bootstrap-4.3.1 ***
function register_style_and_scripts_bootstrap_431() {
    // false - header, true - footer
    wp_enqueue_style( 'bootstrap_431_css', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-4.3.1-dist/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap_431_jquery_js', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-4.3.1-dist/js/jquery-3.3.1.slim.min.js', null, null, false );
    wp_enqueue_script( 'bootstrap_431_popper_js', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-4.3.1-dist/js/popper.min.js', null, null, false );
    wp_enqueue_script( 'bootstrap_431_js', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-4.3.1-dist/js/bootstrap.min.js', null, null, false );
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');
  
}
add_action( 'wp_enqueue_scripts', 'register_style_and_scripts_bootstrap_431' );
// END *** add bootstrap-4.3.1 ***

} else if ($val == 3){

// *** add bootstrap-3.3.7 ***
function register_style_and_scripts_bootstrap_337() {
  
    wp_enqueue_style( 'bootstrap_337_css', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap_337_theme_css', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css' );
    wp_enqueue_script( 'bootstrap_337_js', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js', null, null, true );
}
add_action( 'wp_enqueue_scripts', 'register_style_and_scripts_bootstrap_337' );
// END *** add bootstrap-3.3.7 ***

} 

?>