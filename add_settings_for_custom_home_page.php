<?php 
function register_style_and_scripts_for_home_page() {
	if ( is_page_template( 'home_page.php' ) ) {
		wp_enqueue_style( 'home_page_css',  plugins_url( '/mystyle/styles/style_home.css', __FILE__ ));
// wp_enqueue_script( 'home_page_js', plugins_url( '/mystyle/styles/style_home.css', __FILE__ ), null, null, true );
	}
}
add_action( 'wp_enqueue_scripts', 'register_style_and_scripts_for_home_page' );

function select_window() {
	register_sidebar( array(
		'name'          => 'Select window in slider are on home page',
		'id'            => 'select_window',
		'before_widget' => '<div id="select_window">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'select_window' );

function header_text_on_homepage() {
	register_sidebar( array(
		'name'          => 'Header text on home page',
		'id'            => 'header_text_on_homepage',
		'before_widget' => '<div id="header_text_on_homepage">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="header_text_on_homepage">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'header_text_on_homepage' );

// ***** add menu to home_page.php *****
function register_icon_menu() {
	register_nav_menus(
		array(
			'icon_menu' => __( 'Icon Menu' )
		)
	);
}
add_action( 'init', 'register_icon_menu' );
// *****END add menu to home_page.php *****

//[phone_number_for_help]
function foobar_func( $atts ){
	return "777-777-7777";
}
add_shortcode( 'phone_number_for_help', 'foobar_func' );
?>