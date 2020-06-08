<?php // *****add Google Analytics code in header****


add_action('admin_init', 'add_color_tab');

function add_color_tab(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id(id of tab), $title, $callback, $page
  add_settings_section( 'add_color_tab_id', 'Add Color Tab', 'add_color_tab_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('add_color_tab__id', 'Add Google Analytics ID', 'add_color_tab_input', 'primer_page', 'add_color_tab_id' );
    
}
## Заполняем опцию 
function add_color_tab_input(){
  $val = get_option('option_name');

/* Подключаем Iris Color Picker 
----------------------------------------------------------------- */
function add_admin_iris_scripts( $hook ){
  // подключаем IRIS
  wp_enqueue_script( 'wp-color-picker' );
  wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'add_admin_iris_scripts' );

 ?>
  <input class='color-field' name="color1" type="text" value="" />
  <input class='iris_color' name="color2" type="text" value="#f19" />
  <input type='text' class='color-field' name='option_name[tab_color]' value='<?php echo $val['tab_color']; ?>'>
  <img class='img_in_tools' src='<?php echo plugin_dir_url( __FILE__ ); ?>/img/theme-color-ss.png'> 

  <?php
}


add_action( 'admin_enqueue_scripts', 'wptuts_add_color_picker' );
function wptuts_add_color_picker( $hook ) {
 
    if( is_admin() ) { 
     
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}



function add_color_tab_callback() {
        echo ('<div class="description">Input color code (for example: #378C3F)</div>');
    }

$val = get_option('option_name');
$val = $val ? $val['tab_color'] : null;
if (isset($val)){

	add_action('wp_head','color_tab', 20);
 
function color_tab() {
$val = get_option('option_name');
?>
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#378C3F">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#378C3F">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#378C3F">
<?php
}

} 

























