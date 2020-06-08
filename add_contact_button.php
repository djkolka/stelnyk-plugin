<?php  

add_action('admin_init', 'add_contact_button');

function add_contact_button(){
  // параметры: $option_group, $option_name, $sanitize_callback
  register_setting( 'option_group', 'option_name', 'sanitize_callback' );

  // параметры: $id(id of tab), $title, $callback, $page
  add_settings_section( 'add_contact_button_id', 'Add Contact Button', 'add_contact_button_callback', 'primer_page' ); 

  // параметры: $id, $title, $callback, $page, $section, $args
  add_settings_field('add_contact_button__id', 'Add Contact Button atributes', 'add_contact_button_input', 'primer_page', 'add_contact_button_id' );
    
}
## Заполняем опцию 
function add_contact_button_input(){
  $val = get_option('option_name');

 ?>
 <label>apple_link</label>
 <input type='text' class='cb' name='option_name[apple_href]' value='<?php echo $val['apple_href']; ?>'> <br>
 <label>facebook_href</label>
 <input type='text' class='cb' name='option_name[facebook_href]' value='<?php echo $val['facebook_href']; ?>'><br>
 <label>phone_number</label>
  <input type='text' class='cb' name='option_name[phone_number]' value='<?php echo $val['phone_number']; ?>'><br>
  
<div class='translation_text uk_text'>
  <label>Ukrainian text field 1</label>
  <input type='text' class='cb text' name='option_name[text_1_uk]' value='<?php if( isset($val['text_1_uk']) and !empty($val['text_1_uk'])){echo $val['text_1_uk'];}else{echo 'Виникли запитання?';}?>'><br>
  <label>Ukrainian text field 2</label>
  <input type='text' class='cb text' name='option_name[text_2_uk]' value='<?php if( isset($val['text_2_uk']) and !empty($val['text_2_uk'])){echo $val['text_2_uk'];}else{echo 'Напишіть нам!';}?>'><br>
  <label>Ukrainian text field 3</label>
  <input type='text' class='cb text' name='option_name[text_3_uk]' value='<?php if( isset($val['text_3_uk']) and !empty($val['text_3_uk'])){echo $val['text_3_uk'];}else{echo 'Ми доступні цілодобово 24/7';}?>'><br>
</div>

<div class='translation_text ru_text'>
  <label>Russian text field 1</label>
  <input type='text' class='cb text' name='option_name[text_1_ru]' value='<?php if( isset($val['text_1_ru']) and !empty($val['text_1_ru'])){echo $val['text_1_ru'];}else{echo 'Возникли вопросы?';}?>'><br>
  <label>Russian text field 2</label>
  <input type='text' class='cb text' name='option_name[text_2_ru]' value='<?php if( isset($val['text_2_ru']) and !empty($val['text_2_ru'])){echo $val['text_2_ru'];}else{echo 'Напишите нам!';}?>'><br>
  <label>Russian text field 3</label>
  <input type='text' class='cb text' name='option_name[text_3_ru]' value='<?php if( isset($val['text_3_ru']) and !empty($val['text_3_ru'])){echo $val['text_3_ru'];}else{echo 'Мы доступны круглосуточно 24/7';}?>'><br>
</div>

<div class='translation_text en_text'>
  <label>English text field 1</label>
  <input type='text' class='cb text' name='option_name[text_1_en]' value='<?php if( isset($val['text_1_en']) and !empty($val['text_1_en'])){echo $val['text_1_en'];}else{echo 'Do you have questions?';}?>'><br>
  <label>English text field 2</label>
  <input type='text' class='cb text' name='option_name[text_2_en]' value='<?php if( isset($val['text_2_en']) and !empty($val['text_2_en'])){echo $val['text_2_en'];}else{echo 'Contact us!';}?>'><br>
  <label>English text field 3</label>
  <input type='text' class='cb text' name='option_name[text_3_en]' value='<?php if( isset($val['text_3_en']) and !empty($val['text_3_en'])){echo $val['text_3_en'];}else{echo 'We are available 24/7';}?>'><br>
</div>

 

  <?php
}


function add_contact_button_callback() {
        echo ('<div class="description">
        <p>use shortcode: [contact_button]</p>
        <p>or use php code: 
        <pre>
        &lt;?php echo do_shortcode("[contact_button]"); ?&gt;
        </pre>
        </div>');
        echo ('<div class="description">Input data what you need below</div>');
    }


$val = get_option('option_name');

if (isset($val)){

	 /*** contact button shortcode. */
   function add_contact_button_to_page() {
  
    // $apple_href = "https://bcrw.apple.com/sms:open?service=iMessage&recipient=urn:biz:01bf02b2-8591-43ab-b46f-1551153ea99b";
    // $facebook_href = "http://m.me/wisenotary";
    // $phone_number = "7739996284";

    $val = get_option('option_name');
    $apple_href = $val ? $val['apple_href'] : null;
    $facebook_href = $val ? $val['facebook_href'] : null;
    $phone_number = $val ? $val['phone_number'] : null;
    
    // DO NOT CHANGE CODE BELOW
    $my_current_lang = apply_filters( 'wpml_current_language', NULL );
    if ( $my_current_lang and $my_current_lang == 'en' ){
      $lang="en";
    } 
    elseif (  $my_current_lang and $my_current_lang == 'uk' ){
      $lang='
      <span class="first align-middle"> '.$val['text_1_uk'].'</span><br>
      <span class="second align-middle">'.$val['text_2_uk'].'</span><br>
      <span class="third align-middle"> '.$val['text_3_uk'].'</span>
      ';
    }
    elseif (  $my_current_lang and $my_current_lang == 'ru' ){
      $lang='
      <span class="first align-middle"> '.$val['text_1_ru'].'</span><br>
      <span class="second align-middle">'.$val['text_2_ru'].'</span><br>
      <span class="third align-middle"> '.$val['text_3_ru'].'</span>
      ';
    }
    else {
      $lang='
      <span class="first align-middle"> '.$val['text_1_en'].'</span><br>
      <span class="second align-middle">'.$val['text_2_en'].'</span><br>
      <span class="third align-middle"> '.$val['text_3_en'].'</span>
      ';
    }
    
    include_once 'mobile_detect/Mobile_Detect.php';
    $detect = new Mobile_Detect;
  
    if ( $detect->isiPhone() Or $detect->isiOS() Or $detect->isIOS() Or preg_match("/Macintosh/", $_SERVER['HTTP_USER_AGENT']) ) {
      $link = $apple_href;
      $link2 = 'isiOS';
    } 
    elseif ( $detect->isAndroidOS() Or $detect->isMobile() ) {
      $link = $facebook_href;
      $link2 = "android or mobile";
    }
    else {
      $link = $facebook_href;
      $link2 = "PC or other";
    }
  
    $html = '
    <div class="contact_button">
      <div class="my_row">
        <div class="text_block">'.$lang.'</div>
        <div class="img_block">
          <a title="call us" href="tel:'.$phone_number.'">
            <img alt="call us" src="/wp-content/plugins/stelnyk-plugin/img/communications.svg">
          </a>
          <a title="text us" target=_blank href='.$link.'>
            <img alt="contact us" src="/wp-content/plugins/stelnyk-plugin/img/speech-bubble-message-3.svg">
          </a>
        </div>
      </div>
    </div>
    ';
    return sprintf($html);
  }
  add_shortcode( 'contact_button', 'add_contact_button_to_page' );
 

} 
