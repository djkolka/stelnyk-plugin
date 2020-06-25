<?php  


// function add_theme_scripts() {
//     wp_enqueue_script( 'script', plugins_url() . '/stelnyk-plugin/resume-style/scripts/scriptik.js', array ( 'jquery' ), 1.1, true);
//  }
// add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

//************ stelnyk extension for admin logo ***************

// if custom logo  not available un commen below code  and add logo in admin bar
  
  // add_theme_support( 'custom-logo' );

  // function themename_custom_logo_setup() {
  //     $defaults = array(
  //         'height'      => 100,
  //         'width'       => 400,
  //         'flex-height' => true,
  //         'flex-width'  => true,
  //         'header-text' => array( 'site-title', 'site-description' ),
  //     );
  //     add_theme_support( 'custom-logo', $defaults );
  // }
  // add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

// Displaying the custom logo in your theme #Displaying the custom logo in your theme

  // if ( function_exists( 'the_custom_logo' ) ) {
  //     the_custom_logo();
  // }

// If you want to get your current logo URL (or use your own markup) instead of the default markup, you can use the following code:

  // $custom_logo_id = get_theme_mod( 'custom_logo' );
  // $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  // if ( has_custom_logo() ) {
  //         echo '<img src="'. esc_url( $logo[0] ) .'">';
  // } else {
  //         echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
  // }



/////////////////////////////////////



// stelnyk signature
function my_signature_script() {
  // wp_enqueue_style ( 'custom-login1', get_stylesheet_directory_uri() . '/login/hover/css/normalize.css' );
  wp_enqueue_style ( 'custom-login2', plugins_url( '/login/hover/css/demo.css', __FILE__ ));
  wp_enqueue_style ( 'custom-login3', plugins_url( '/login/hover/css/component.css', __FILE__ ));
    // wp_enqueue_script( 'custom-login4', get_stylesheet_directory_uri() . '/login/hover/modernizr.custom.js','','1.1', false );
    wp_enqueue_script( 'jQuery', 'https://code.jquery.com/jquery-1.10.2.js', null, null, false );
    wp_enqueue_script( 'custom-login5', plugins_url( '/login/hover/js/togle.js', __FILE__ ), null, null, false );
}
add_action( 'login_enqueue_scripts', 'my_signature_script' );



add_action('login_footer', 'my_addition_to_login_footer');
function my_addition_to_login_footer() {
     echo ' <div class="secret" title="press for more information">*</div>
        <div class="js csstransforms3d">
        <div class="container">
          <!-- Top Navigation -->
          <section class="color-4">
            <nav class="cl-effect-2">
              <a  title="made by Mykola Stelnyk" href="//stelnyk.com"><span data-hover="by Mykola Stelnyk">  Made with love  </span></a>
            </nav>
          </section>
        </div><!-- /container -->
      </div>
       ';
}
// end of login page code









function register_js_for_load_img() {
  wp_enqueue_script( 'my_jquery', get_stylesheet_directory_uri() . '/resume-style/js/load_img.js', null, null, true );
 }
add_action( 'admin_enqueue_scripts', 'register_js_for_load_img' );

//get custom field titled "Post Image"

add_action('add_meta_boxes', 'create_image_box');

function create_image_box() {
add_meta_box( 
    'meta-box-id', 
    'Image Field',
    'display_image_box', 
    'page', 
    'normal', 
    'high' 
    );
}

//Display the image_box
function display_image_box() {
 global $post;
 echo htmlspecialchars("<?php echo get_post_meta(\$post->ID, 'resume', true); ?>");
// Get WordPress' media upload URL
$upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

// See if there's a media id already saved as post meta
$your_img_id = get_post_meta( $post->ID, '_your_img_id', true );

// Get the image src
$your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );

// For convenience, see if the array is valid
$you_have_img = is_array( $your_img_src );




// <!-- Your image container, which can be manipulated with js -->
?>
<div class="custom-img-container">
    <?php if ( $you_have_img ) : ?>
        <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:50%;" />
    <?php endif; ?>
</div>

<!-- Your add & remove image links -->
<p class="hide-if-no-js">
    <a class="upload-custom-img <?php if ( $you_have_img  ) { echo 'hidden'; } ?>" 
       href="<?php echo $upload_link ?>">
        <?php _e('Set custom image') ?>
    </a>
    <a class="delete-custom-img <?php if ( ! $you_have_img  ) { echo 'hidden'; } ?>" 
      href="#">
        <?php _e('Remove this image') ?>
    </a>
</p>

<!-- A hidden input to set and post the chosen image id -->
<select class="Image">
            <option></option> 
            <option>bg_in_header</option>
            <option>bg_in_footer</option>
            <option>bg</option>
</select>

<input class="name_of_img" name="name_of_img" type="hidden" id="name_of_img" value="" />


<input class="custom-img-id" name="custom-img-id" type="hidden" id="custom-img-id" value="<?php echo $your_img_src[0] ?>" />

<?php


if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}


}

 function save_image_data($post_id){
  global $post;
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
  return $post_id;
  update_post_meta($post->ID, $_POST["name_of_img"], $_POST["custom-img-id"] );
}
add_action('save_post', 'save_image_data');


/*** Hide email from Spam Bots using a shortcode. */
function wpcodex_hide_email_shortcode( $atts , $content = null ) {
  if ( ! is_email( $content ) ) {
    return;
  }

  $content = antispambot( $content );

  $email_link = sprintf( 'mailto:%s', $content );

  return sprintf( '<a href="%s">%s</a>', esc_url( $email_link, array( 'mailto' ) ), esc_html( $content ) );
}
add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );