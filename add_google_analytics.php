<?php // *****add Google Analytics code in header****


add_action('admin_init', 'google_analytics');

function google_analytics(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id(id of tab), $title, $callback, $page
  add_settings_section( 'google_analytics__tab_id', 'Add Google Analytics', 'google_analytics_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('google_analytics__id', 'Add Google Analytics ID', 'add_google_analytics', 'primer_page', 'google_analytics__tab_id' );
    
}
## Заполняем опцию bootsrap
function add_google_analytics(){
  $val = get_option('option_name');
 ?>
  <input type='text' name='option_name[g_a_code]' value='<?php echo $val['g_a_code']; ?>'>
  <?php
}
function google_analytics_callback() {
        echo ('<div class="description">Input Google Analytics code (for example:UA-135809532-1) <a target=_blank href="https://support.google.com/analytics/answer/1008080">more...</a> </div>');
    }

$val = get_option('option_name');
$val = $val ? $val['g_a_code'] : null;
if (isset($val)){

	add_action('wp_head','my_analytics', 20);
 
function my_analytics() {
$val = get_option('option_name');
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $val['g_a_code']; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  
  gtag('config', '<?php echo $val['g_a_code']; ?>');
</script>
<?php
}

} 

























