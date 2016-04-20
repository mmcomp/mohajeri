<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>آژانس مهاجری</title>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/website.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/persian-datepicker.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/website.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/persian-datepicker.css" rel="stylesheet">
    </head>
    <body class="entry-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="entry-box">
                    <header>
                        ورود به سامانه
                    </header>
                    <form method="post" action="" id="member-login">
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" placeholder="نام کاربری خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>رمز عبور</label>
                            <input type="text" name="username" placeholder="رمز عبور خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>کد امنیتی : </label>
                            <input type="text" name="captcha" placeholder="کد امنیتی زیر را وارد نمایید" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="captcha">
                                <img class="img-responsive" src="<?php echo base_url(); ?>index.php/entry/creat_captcha">  
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="#" id="member-login-btn" class="transition-effect">ورود کاربران</a>
                        </div>
                        <div class="form-group">
                            <a href="#" id="public-login-auth-btn">ورود عمومی</a>
                        </div>
                    </form>
                    <form method="post" action="<?php echo base_url(); ?>index.php/entry/ctrl_captcha_public_entry" id="entry-login">
                        <div class="form-group">
                            <label>کد امنیتی : </label>
                            <input type="text" name="captcha" placeholder="کد امنیتی را وارد نمایید" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="captcha">
                                <img class="img-responsive" src="<?php echo base_url(); ?>index.php/entry/creat_captcha">  
                            </div>
                        </div>
                        <div class="form-group">
                            <!--<div style="text-align: center;color: red;background: #eaeaea;" class="transition-effect">در دست بروزرسانی . . .</div>-->
                            <a href="#" class="transition-effect" id="public-login-btn">ورود عمومی</a>
                        </div>
                        <div class="form-group">
                            <a href="#" id="member-login-auth-btn">ورود کاربران</a>
                            <img class="location-icon" src="<?php echo base_url(); ?>assets/images/location-icon.png">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group address">
                            نشانی : مشهد ، خیابان خسروی ، نرسیده به چهارراه خسروی ، جنب هتل سخاوت
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
