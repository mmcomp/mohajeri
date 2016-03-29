<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>آژانس مهاجری</title>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/website.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/persian-datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/autocomplete.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/date-set.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datepicker.en.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/website.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/autocomplete.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/persian-datepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/datepicker.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row image-cover">
                <div class="main-header-box">
                    <div class="main-header">
                        <a href="#"><img title="آژانس مهاجری" alt="آژانس مهاجری" class="mohajeri-logo" src="<?php echo base_url(); ?>assets/images/mohajeri-logo.png"></a>
                    </div>
                </div>
                <div class="reserve-summery">
                    <header>خلاصه رزرو</header>
                    <ul>
                        <?php
                        $i = count($flight_info) - 1;
                        foreach ($flight_info as $row) {
                            ?>
                            <li><?php echo $row[$i]['to_city']; ?> به <?php echo $row[$i]['from_city']; ?></li>
                            <li>در تاریخ : <?php echo $row[$i]['fdate']; ?></li>
                            <li>کلاس قیمتی : <?php echo $row[$i]['class_ghimat']; ?></li>
                            <li>قیمت (بزرگسال) : <?php echo $row[$i]['price']; ?> ریال</li>
                            <li>قیمت (کودک) : <?php echo $row[$i]['price'] * .5; ?> ریال</li>
                            <li>قیمت (نوزاد) : <?php echo $row[$i]['price'] * .1; ?> ریال</li>
                            <li>قیمت (کل) : <?php echo $row[$i]['price']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="passenger-info">
                    <header>مشخصات مسافر</header>
                    <form class="passenger-form" method="post">
                        <input type="hidden" id="refrence_id" name="refrence_id" value="<?php echo $refrence_id ?>">
                        <?php if ($adult > 0) { ?>
                            <ul class="passenger-number">
                                <header class="people-header">بزرگسال</header>
                                <?php for ($adult; $adult > 0; $adult--) { ?>
                                    <input type="hidden" name="age[]" value="adl">
                                    <input type="hidden" name="gender[]" value="1">
                                    <li>
                                        <div class="form-group-half">
                                            <label>نام</label>
                                            <input type="text" name="first-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی</label>
                                            <input type="text" name="last-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام (با حروف انگلیسی)</label>
                                            <input type="text" name="first-name-en[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی (با حروف انگلیسی)</label>
                                            <input type="text" name="last-name-en[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>جنسیت</label>
                                            <select name="nationality[]">
                                                <option value="1">مرد</option>
                                                <option value="0">زن</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>ملیت</label>
                                            <select name="nationality[]">
                                                <option value="1">ایران</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>شماره کارت ملی</label>
                                            <input type="text" name="nid-number[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>تاریخ تولد</label>
                                            <input class="pdatepicker" type="text" name="birthdate[]" readonly="">
                                        </div>
                                        <div class="form-group-third">
                                            <label>شماره پاسپورت</label>
                                            <input class="pdatepicker-en" type="text" name="passport-number[]">
                                        </div>
                                        <div class="form-group-third">
                                            <label>انقضای پاسپورت</label>
                                            <input type="text" name="passport-expire[]" readonly>
                                        </div>
                                        <div class="form-group-third">
                                            <label>محل صدور</label>
                                            <input type="text" name="passport-origin[]">
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <?php if ($child > 0) { ?>
                            <ul class="passenger-number">
                                <header class="people-header">کودک</header>
                                <?php for ($child; $child > 0; $child--) { ?>
                                    <input type="hidden" name="age[]" value="chd">
                                    <input type="hidden" name="gender[]" value="1">
                                    <li>
                                        <div class="form-group-half">
                                            <label>نام</label>
                                            <input type="text" name="first-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی</label>
                                            <input type="text" name="last-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام (با حروف انگلیسی)</label>
                                            <input type="text" name="first-name-en[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی (با حروف انگلیسی)</label>
                                            <input type="text" name="last-name-en[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>جنسیت</label>
                                            <select name="nationality[]">
                                                <option value="1">مرد</option>
                                                <option value="0">زن</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>ملیت</label>
                                            <select name="nationality[]">
                                                <option value="1">ایران</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>شماره کارت ملی</label>
                                            <input type="text" name="nid-number[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>تاریخ تولد</label>
                                            <input class="pdatepicker" type="text" name="birthdate[]" readonly="">
                                        </div>
                                        <div class="form-group-third">
                                            <label>شماره پاسپورت</label>
                                            <input class="pdatepicker-en" type="text" name="passport-number[]">
                                        </div>
                                        <div class="form-group-third">
                                            <label>انقضای پاسپورت</label>
                                            <input type="text" name="passport-expire[]" readonly>
                                        </div>
                                        <div class="form-group-third">
                                            <label>محل صدور</label>
                                            <input type="text" name="passport-origin[]">
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <?php if ($infant > 0) { ?>
                            <ul class="passenger-number">
                                <header class="people-header">نوزاد</header>
                                <?php for ($infant; $infant > 0; $infant--) { ?>
                                    <input type="hidden" name="age[]" value="inf">
                                    <input type="hidden" name="gender[]" value="1">
                                    <li>
                                        <div class="form-group-half">
                                            <label>نام</label>
                                            <input type="text" name="first-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی</label>
                                            <input type="text" name="last-name[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام (با حروف انگلیسی)</label>
                                            <input type="text" name="first-name-en[]">
                                        </div>
                                        <div class="form-group-half">
                                            <label>نام خانوادگی (با حروف انگلیسی)</label>
                                            <input type="text" name="last-name-en[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>جنسیت</label>
                                            <select name="nationality[]">
                                                <option value="1">مرد</option>
                                                <option value="0">زن</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>ملیت</label>
                                            <select name="nationality[]">
                                                <option value="1">ایران</option>
                                            </select>
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>شماره کارت ملی</label>
                                            <input type="text" name="nid-number[]">
                                        </div>
                                        <div class="form-group-fourth">
                                            <label>تاریخ تولد</label>
                                            <input class="pdatepicker" type="text" name="birthdate[]" readonly="">
                                        </div>
                                        <div class="form-group-third">
                                            <label>شماره پاسپورت</label>
                                            <input class="pdatepicker-en" type="text" name="passport-number[]">
                                        </div>
                                        <div class="form-group-third">
                                            <label>انقضای پاسپورت</label>
                                            <input type="text" name="passport-expire[]" readonly>
                                        </div>
                                        <div class="form-group-third">
                                            <label>محل صدور</label>
                                            <input type="text" name="passport-origin[]">
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <div class="passenger-extra-info">
                            <header class="people-header">اطلاعات تماس</header>
                            <div class="form-group-fourth">
                                <label>شماره موبایل</label>
                                <input id="cell-number" type="text" name="cell-number">
                            </div>
                            <div class="form-group-fourth">
                                <label>شماره تلفن ثابت</label>
                                <input type="text" name="phone-number">
                            </div>
                            <div class="form-group-fourth">
                                <label>ایمیل</label>
                                <input id="email" type="text" name="email">
                            </div>
                            <div class="form-group-fourth">
                                <label>آدرس</label>
                                <input type="text" name="address">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <a class="reserve-btn transition-effect" href="#" onclick="reserve_ajax();">ثبت</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="payment">
                    <header>پس از اطمینان از صحت اطلاعات وارد شده، با کلیک بر روی درگاه مربوطه نسبت به خرید بلیط خود اقدام فرمایید. و یا بصورت <a href="#" class="credit-payment">پرداخت اعتباری</a> بلیط را تهیه فرمایید. </header>
                    <form class="payment-bank" action="<?php echo base_url(); ?>index.php/flight/confirm_etebari_result">
                        <input type="hidden" name="refrence_id" value="<?php echo $refrence_id; ?>">
                        <ul>
                            <!--<li><a href="#"><img src="<?php echo base_url(); ?>assets/images/mellat.png"></a></li>-->
                            <li><a href="<?php echo base_url(); ?>index.php/payment" class="saman-bank"><img src="<?php echo base_url(); ?>assets/images/saman.png"></a></li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="main-footer">
                    تمامی حقوق سایت متعلق به آژانس مهاجری خراسان می باشد.
                </div>
            </div>
        </div>
    </div>
    <div class="loading"><img src="<?php echo base_url(); ?>/assets/images/loadbar.gif"></div>
    <div class="page-color"></div>
    <form class="credit-form" action="<?php echo base_url(); ?>index.php/flight/confirm_etebari">
        <header>ورود کاربران</header>
        <input type="hidden" name="refrence_id" value="<?php echo $refrence_id; ?>">
        <div class="form-group">
            <label>نام کاربری</label>
            <input type="text" name="user">
        </div>
        <div class="form-group">
            <label>رمز عبور</label>
            <input type="password" name="pass">
        </div>
        <div class="form-group">
            <input type="submit" value="ثبت">
        </div>
    </form>
    <script>
        $(".saman-bank").on("click", function (){
            $(".payment-bank").submit();
        });
        
        //persian datepicker 
        $(".pdatepicker").persianDatepicker({
            cellWidth: 35,
            cellHeight: 35,
            fontSize: 15
        });

        //reserve ajax
        function reserve_ajax() {
            var p = {
                'refrence_id': $("#refrence_id").val(),
                'cell-number': $("#cell-number").val(),
                'email': $("#email").val(),
                'gender': $("input[name='gender[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'age': $("input[name='age[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'first-name': $("input[name='first-name[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'last-name': $("input[name='last-name[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'first-name-en': $("input[name='first-name-en[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'last-name-en': $("input[name='last-name-en[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'nationality': $("select[name='nationality[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'nid-number': $("input[name='nid-number[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'birthdate': $("input[name='birthdate[]']")
                        .map(function () {
                            return jalali_to_gregorian($(this).val());
                        }).get(),
                'passport-number': $("input[name='passport-number[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'passport-expire': $("input[name='passport-expire[]']")
                        .map(function () {
                            return $(this).val();
                        }).get(),
                'passport-origin': $("input[name='passport-origin[]']")
                        .map(function () {
                            return $(this).val();
                        }).get()
            };
            console.log(p);
            $('.loading').show();
            $.post("<?php echo base_url(); ?>index.php/flight/ticket_info", p, function (result) {
                console.log(result);
                console.log(p);
                $('.loading').hide();
                reserve_check_info();
            });

            function reserve_check_info() {
                $(".passenger-form input").prop("disabled", true);
            }
        }
    </script>
</body>
</html>