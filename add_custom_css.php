<?php

function register_custom_style_and_scripts() {
    // false - header, true - footer
    wp_enqueue_style( 'custom_css', plugin_dir_url( __FILE__ ) . 'css/custom.css' );
    // wp_enqueue_style( 'slider_css', plugin_dir_url( __FILE__ ) . 'css/slider_testimonials_siteorigin.css' );
    // wp_enqueue_script( 'aos_js', plugin_dir_url( __FILE__ ) . 'js_css_for_aos_effects/aos.js', null, null, true );
    // wp_enqueue_script( 'slider_js', plugin_dir_url( __FILE__ ) . 'js/slider_testimonials_siteorigin.js', null, null, true );
}
add_action( 'wp_enqueue_scripts', 'register_custom_style_and_scripts' ); 

?>