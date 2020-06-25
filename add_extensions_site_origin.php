<?php

function register_style_and_scripts_AOS() {
    // false - header, true - footer
    wp_enqueue_style( 'aos_css', plugin_dir_url( __FILE__ ) . 'js_css_for_aos_effects/aos.css' );
    wp_enqueue_style( 'slider_css', plugin_dir_url( __FILE__ ) . 'css/slider_testimonials_siteorigin.css' );
    wp_enqueue_script( 'aos_js', plugin_dir_url( __FILE__ ) . 'js_css_for_aos_effects/aos.js', null, null, true );
    wp_enqueue_script( 'slider_js', plugin_dir_url( __FILE__ ) . 'js/slider_testimonials_siteorigin.js', null, null, true );
}
add_action( 'wp_enqueue_scripts', 'register_style_and_scripts_AOS' );

/* Create group */
function cvw_animation_group( $groups ) {

  $groups['cvw_animation'] = array(
    'name'    => __( 'AOS Animation', 'cvw-pb-animation' ),
    'priority'  => 40,
    );

  return $groups;
}
add_filter( 'siteorigin_panels_row_style_groups', 'cvw_animation_group', 10, 3 );
add_filter( 'siteorigin_panels_widget_style_groups', 'cvw_animation_group', 10, 3 );

function cvw_animation_fields( $fields ) {
  $animations = array(
  '' => __( 'No Animations', 'cvw-pb-animation' ),
    'fade' => 'Fade',
  'fade-up' => 'Fade Up',
    'fade-down' => 'Fade Down',
    'fade-left' => 'Fade Left',
    'fade-right' => 'Fade Right',
    'fade-up-right' => 'Fade Up Right',
    'fade-up-left' => 'Fade Up Left',
    'fade-down-right' => 'Fade Down Right',
    'fade-down-left' => 'Fade Down Left',
    'flip-up' => 'Flip Up',
    'flip-down' => 'Flip Down',
    'flip-left' => 'Flip Left',
    'flip-right' => 'Flip Right',
    'slide-up' => 'Slide Up',
    'slide-down' => 'Slide Down',
    'slide-left' => 'Slide Left',
    'slide-right' => 'Slide Right',
    'zoom-in' => 'Zoom In',
  'zoom-in-up' => 'Zoom In Up',
    'zoom-in-down' => 'Zoom In Down',
    'zoom-in-left' => 'Zoom In Left',
    'zoom-in-right' => 'Zoom In Right',
    'zoom-out' => 'Zoom Out',
  'zoom-out-up' => 'Zoom Out Up',
    'zoom-out-down' => 'Zoom Out Down',
    'zoom-out-left' => 'Zoom Out Left',
    'zoom-out-right' => 'Zoom Out Right',
  );
  $fields['cvw_type'] = array(
    'name' => __( 'Animation Type','cvw-pb-animation'),
    'type' => 'select',
    'options' => $animations,
    'group' => 'cvw_animation',
    'description' => __( 'Choose an animation style', 'cvw-pb-animation'),
    'priority' => 5,
  );
  $fields['cvw_duration'] = array(
    'name' => __( 'Duration','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      '300' => __( '300 Milliseconds','cvw-pb-animation'),
      '500' => __( '500 Milliseconds','cvw-pb-animation'),
      '600' => __( '600 Milliseconds','cvw-pb-animation'),
      '900' => __( '900 Milliseconds','cvw-pb-animation'),
            '1200' => __( '1200 Milliseconds','cvw-pb-animation'),
            '1500' => __( '1500 Milliseconds','cvw-pb-animation'),
            '1800' => __( '1800 Milliseconds','cvw-pb-animation'),
            '2100' => __( '2100 Milliseconds','cvw-pb-animation'),
            '2400' => __( '2400 Milliseconds','cvw-pb-animation'),
            '2700' => __( '2700 Milliseconds','cvw-pb-animation'),
            '3000' => __( '3000 Milliseconds','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation duration','cvw-pb-animation'),
    'priority' => 10,
  );
    $fields['cvw_delay'] = array(
    'name' => __( 'Delay','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      '0' => __( '0 Milliseconds','cvw-pb-animation'),
      '300' => __( '300 Milliseconds','cvw-pb-animation'),
      '500' => __( '500 Milliseconds','cvw-pb-animation'),
      '600' => __( '600 Milliseconds','cvw-pb-animation'),
      '900' => __( '900 Milliseconds','cvw-pb-animation'),
            '1200' => __( '1200 Milliseconds','cvw-pb-animation'),
            '1500' => __( '1500 Milliseconds','cvw-pb-animation'),
            '1800' => __( '1800 Milliseconds','cvw-pb-animation'),
            '2100' => __( '2100 Milliseconds','cvw-pb-animation'),
            '2400' => __( '2400 Milliseconds','cvw-pb-animation'),
            '2700' => __( '2700 Milliseconds','cvw-pb-animation'),
            '3000' => __( '3000 Milliseconds','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation delay','cvw-pb-animation'),
    'priority' => 10,
  );
    $fields['cvw_easing'] = array(
    'name' => __( 'Easing','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'linear' => 'Linear',
      'ease' => 'Ease',
            'ease-in' => 'Ease in',
            'ease-out' => 'Ease out',
            'ease-in-out' => 'Ease in out',
            'ease-in-back' => 'Ease in back',
            'ease-out-back' => 'Ease out back',
            'ease-in-out-back' => 'Ease in out back',
            'ease-in-sine' => 'Ease in sine',
            'ease-out-sine' => 'Ease out sine',
            'ease-in-out-sine' => 'Ease in out sine',
            'ease-in-quad' => 'Ease in quad',
            'ease-out-quad' => 'Ease out quad',
            'ease-in-out-quad' => 'Ease in out quad',
            'ease-in-cubic' => 'Ease in cubic',
            'ease-out-cubic' => 'Ease out cubic',
            'ease-in-out-cubic' => 'Ease in out cubic',
            'ease-in-quart' => 'Ease in quart',
            'ease-out-quart' => 'Ease out quart',
            'ease-in-out-quart' => 'Ease in out quart',
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation ease','cvw-pb-animation'),
    'priority' => 10,
  );
    
    $fields['cvw_anchor'] = array(
    'name' => __( 'Anchor','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'top-bottom' => __( 'Top bottom','cvw-pb-animation'),
      'top-center' => __( 'Top center','cvw-pb-animation'),
            'top-top' => __( 'Top top','cvw-pb-animation'),
            'center-bottom' => __( 'Center bottom','cvw-pb-animation'),
            'center-center' => __( 'Center center','cvw-pb-animation'),
            'center-top' => __( 'Center top','cvw-pb-animation'),
            'bottom-bottom' => __( 'Bottom bottom','cvw-pb-animation'),
            'bottom-center' => __( 'Bottom center','cvw-pb-animation'),
            'bottom-top' => __( 'Bottom top','cvw-pb-animation'),

    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation anchor','cvw-pb-animation'),
    'priority' => 10,
  );
    
    $fields['cvw_repeat'] = array(
    'name' => __( 'Repeat','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'false' => __( 'Repeat','cvw-pb-animation'),
            'true' => __( 'Once','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Repeat animation every time you scroll up / down','cvw-pb-animation'),
    'priority' => 10,
  );

  return $fields;

}

function cvw_animation_fields_row( $fields ) {
  $animations = array(
  '' => 'No Animations',
    'fade' => 'Fade',
  'fade-up' => 'Fade Up',
    'fade-down' => 'Fade Down',
    'slide-up' => 'Slide Up',
    'slide-down' => 'Slide Down',
  );
  $fields['cvw_type'] = array(
    'name' => __( 'Animation Type','cvw-pb-animation'),
    'type' => 'select',
    'options' => $animations,
    'group' => 'cvw_animation',
    'description' => __( 'Choose an animation style', 'cvw-pb-animation'),
    'priority' => 5,
  );
  $fields['cvw_duration'] = array(
    'name' => __( 'Duration','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      '300' => __( '300 Milliseconds','cvw-pb-animation'),
      '600' => __( '600 Milliseconds','cvw-pb-animation'),
      '900' => __( '900 Milliseconds','cvw-pb-animation'),
            '1200' => __( '1200 Milliseconds','cvw-pb-animation'),
            '1500' => __( '1500 Milliseconds','cvw-pb-animation'),
            '1800' => __( '1800 Milliseconds','cvw-pb-animation'),
            '2100' => __( '2100 Milliseconds','cvw-pb-animation'),
            '2400' => __( '2400 Milliseconds','cvw-pb-animation'),
            '2700' => __( '2700 Milliseconds','cvw-pb-animation'),
            '3000' => __( '3000 Milliseconds','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation duration','cvw-pb-animation'),
    'priority' => 10,
  );
    $fields['cvw_delay'] = array(
    'name' => __( 'Delay','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      '0' => __( '0 Milliseconds','cvw-pb-animation'),
      '300' => __( '300 Milliseconds','cvw-pb-animation'),
      '600' => __( '600 Milliseconds','cvw-pb-animation'),
      '900' => __( '900 Milliseconds','cvw-pb-animation'),
            '1200' => __( '1200 Milliseconds','cvw-pb-animation'),
            '1500' => __( '1500 Milliseconds','cvw-pb-animation'),
            '1800' => __( '1800 Milliseconds','cvw-pb-animation'),
            '2100' => __( '2100 Milliseconds','cvw-pb-animation'),
            '2400' => __( '2400 Milliseconds','cvw-pb-animation'),
            '2700' => __( '2700 Milliseconds','cvw-pb-animation'),
            '3000' => __( '3000 Milliseconds','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation delay','cvw-pb-animation'),
    'priority' => 10,
  );
    $fields['cvw_easing'] = array(
    'name' => __( 'Easing','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'linear' => 'Linear',
      'ease' => 'Ease',
            'ease-in' => 'Ease in',
            'ease-out' => 'Ease out',
            'ease-in-out' => 'Ease in out',
            'ease-in-back' => 'Ease in back',
            'ease-out-back' => 'Ease out back',
            'ease-in-out-back' => 'Ease in out back',
            'ease-in-sine' => 'Ease in sine',
            'ease-out-sine' => 'Ease out sine',
            'ease-in-out-sine' => 'Ease in out sine',
            'ease-in-quad' => 'Ease in quad',
            'ease-out-quad' => 'Ease out quad',
            'ease-in-out-quad' => 'Ease in out quad',
            'ease-in-cubic' => 'Ease in cubic',
            'ease-out-cubic' => 'Ease out cubic',
            'ease-in-out-cubic' => 'Ease in out cubic',
            'ease-in-quart' => 'Ease in quart',
            'ease-out-quart' => 'Ease out quart',
            'ease-in-out-quart' => 'Ease in out quart',
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation ease','cvw-pb-animation'),
    'priority' => 10,
  );
    
    $fields['cvw_anchor'] = array(
    'name' => __( 'Anchor','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'top-bottom' => __( 'Top bottom','cvw-pb-animation'),
      'top-center' => __( 'Top center','cvw-pb-animation'),
            'top-top' => __( 'Top top','cvw-pb-animation'),
            'center-bottom' => __( 'Center bottom','cvw-pb-animation'),
            'center-center' => __( 'Center center','cvw-pb-animation'),
            'center-top' => __( 'Center top','cvw-pb-animation'),
            'bottom-bottom' => __( 'Bottom bottom','cvw-pb-animation'),
            'bottom-center' => __( 'Bottom center','cvw-pb-animation'),
            'bottom-top' => __( 'Bottom top','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Choose the animation anchor','cvw-pb-animation'),
    'priority' => 10,
  );
    
    $fields['cvw_repeat'] = array(
    'name' => __( 'Repeat','cvw-pb-animation'),
    'type' => 'select',
    'options' => array(
      'false' => __( 'Repeat','cvw-pb-animation'),
            'true' => __( 'Once','cvw-pb-animation'),
    ),
    'group' => 'cvw_animation',
    'description' => __( 'Repeat animation every time you scroll up / down','cvw-pb-animation'),
    'priority' => 10,
  );

  return $fields;

}

add_filter( 'siteorigin_panels_row_style_fields', 'cvw_animation_fields_row', 1, 3 );
add_filter( 'siteorigin_panels_widget_style_fields', 'cvw_animation_fields', 1, 3 );

function cvw_animation_attributes( $atts, $value ) {

  if ( empty( $value['cvw_type'] ) ) {
    return $atts;
  }

  // Add the animate class to the class attribute.
  if ( ! empty( $value['cvw_type'] ) ) {
        
        $atts['data-aos'] = $value['cvw_type'];
        $atts['data-aos-duration'] = $value['cvw_duration'];
        $atts['data-aos-easing'] = $value['cvw_easing'];
        $atts['data-aos-delay'] = $value['cvw_delay'];
        $atts['data-aos-anchor-placement'] = $value['cvw_anchor'];
        $atts['data-aos-once'] = $value['cvw_repeat'];
        
        if(is_array($atts['class'])) {
      $atts['class'] = array_merge( array('aos-init'), $atts['class']);
    } else {
      $atts['class'] = array('aos-init');
    }
  }

  return $atts;
}

add_filter( 'siteorigin_panels_widget_style_attributes', 'cvw_animation_attributes', 10, 2 );
add_filter( 'siteorigin_panels_row_style_attributes', 'cvw_animation_attributes', 10, 2 );

// Adding a custom option under the Row Styles data-section-name for scrolling by ID
function custom_row_style_fields3($fields) {
  $fields['data-section-name'] = 'data-section-name';
  return $fields;
}
add_filter( 'siteorigin_panels_row_style_fields', 'custom_row_style_fields3' );
// Adding the new option to the row element
function custom_row_style_attributes3( $attributes, $args ) {
   if( !empty( $args['id'] ) ) {
        $attributes['data-section-name'] = $args['id'];
    }
    return $attributes;
}
add_filter('siteorigin_panels_row_style_attributes', 'custom_row_style_attributes3', 10, 2);

// Adding a custom gradient for background of Row
function custom_row_style_fields($fields) {
  $fields['gradient'] = array(
    'name'        => __('Gradient', 'siteorigin-panels'),
    'type'        => 'checkbox',
    'group'       => 'design',
    'description' => __('If enabled, the background image will have a gradient effect.', 'siteorigin-panels'),
    'priority'    => 8,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'custom_row_style_fields' );

function custom_row_style_attributes( $attributes, $args ) {
    if( !empty( $args['gradient'] ) ) {
        array_push($attributes['class'], 'gradient');
    }

    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'custom_row_style_attributes', 10, 2);

?>