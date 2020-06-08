<?php
            session_start();
            echo('
            <div class="tab-pane fade in {$extra.attr.class}" id="extra-'.'$extraKey3'.'" role ="tabpanel">
                <div class="send_message">
                <form onsubmit="" id="message_form" action="" method="post" class="contact-form-box message_form" enctype="multipart/form-data">
                    <input form="message_form" type="hidden" name="id_contact" value="2">
                    <fieldset>
                        <div class="clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="message">Message</label>
                              <textarea form="message_form" style="min-height:100px;" class="form-control" id="message" name="message">Question about '.'$product'.'</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group selector1">
                                    <label for="email">Email address</label>
                                    <input form="message_form" class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" placeholder="your@email.com" value="'.'$email'.'">
                                </div>
                                <div class="submit col-md-6">
                                    <input form="message_form" type="hidden" id="subject" name="subject" value="Question about '.'$product'.'">
                                    <input form="message_form" type="hidden" id="from_name" name="from_name" value="'.'$from_name'.'">
                                    <input form="message_form" type="text" id="captcha" name="captcha" placeholder="enter symbols from picture" value="">
                                    <button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-default button-medium send_message"><span>Send<i class="icon-chevron-right right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>
            ');
            include("simple-php-captcha.php");
            $_SESSION['captcha'] = simple_php_captcha();

            echo "<img src=".$_SESSION['captcha']['image_src']." title ='enter this symbols'>";
            var_dump($_SESSION['captcha']['code']);
            