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
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=fa"></script>
        <link href="<?php echo base_url(); ?>assets/css/website.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/autocomplete.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/persian-datepicker.css" rel="stylesheet">
    </head>
    <body class="admin-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="admin-header">
                    <div class="admin-menu">
                        <ul>
                            <li>پرواز چارتری</li>
                            <li>تور</li>
                            <li><a href="<?php echo base_url(); ?>">خروج</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="admin-charter-box">
                    <header>تعریف شهر</header>
                    <form class="city-record">
                        <div class="form-group-fourth">
                            <label>نام فارسی</label>
                            <input type="text">
                        </div>
                        <div class="form-group-fourth">
                            <label>نام انگلیسی</label>
                            <input type="text">
                        </div>
                        <div class="form-group-fourth">
                            <label>یاتا</label>
                            <input type="text">
                        </div>
                        <div class="form-group-fourth">
                            <label>نام فرودگاه</label>
                            <input type="text">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect">ثبت</a>
                        </div>
                    </form>
                    <header>تعریف مسیر</header>
                    <form class="path-record">
                        <div class="form-group-half">
                            <label>مبداء</label>
                            <input type="text">
                        </div>
                        <div class="form-group-half">
                            <label>مقصد</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>شماره پرواز</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>ایرلاین</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>تاریخ پرواز</label>
                            <input type="text" class="pdatepicker" readonly>
                        </div>
                         <div class="form-group">
                            <a href="#" class="transition-effect">ثبت</a>
                        </div>
                    </form>
                    <header>تعریف پرواز</header>
                    <form class="flight-record">
                        <div class="form-group-half">
                            <label>ساعت حرکت</label>
                            <input type="text">
                        </div>
                        <div class="form-group-half">
                            <label>ساعت فرود</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>ظرفیت</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>کلاس قیمت</label>
                            <input type="text">
                        </div>
                        <div class="form-group-third">
                            <label>قیمت</label>
                            <input type="text">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect">ثبت</a>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <script>
            //persian datepicker 
            $(".pdatepicker").persianDatepicker({
                cellWidth: 35,
                cellHeight: 28,
                fontSize: 15
            });
        </script>
    </body>
</html>
