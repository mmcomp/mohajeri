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
                    <header>تعریف کشور</header>
                    <form class="country-record" method="post" action="<?php echo base_url(); ?>index.php/admin/add_country">
                        <div class="form-group-half">
                            <label>نام کشور به فارسی</label>
                            <input class="country-fa" type="text" name="country-fa">
                        </div>
                        <div class="form-group-half">
                            <label>نام کشور به انگلیسی</label>
                            <input class="country-en" type="text" name="country-en">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect add-country">ثبت</a>
                        </div>
                        <div class="admin-tbl-box">
                            <table class="admin-tbl">
                                <thead>
                                    <tr>
                                        <th>نام کشور - فارسی</th>
                                        <th>نام کشور - انگلیسی</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($country as $row) { ?>
                                        <tr><td><?php echo $row['fa_name'] ?></td><td><?php echo $row['en_name'] ?></td><td><a href="#" class="admin-change">بیشتر ...</a></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <header>تعریف شهر</header>
                    <form class="city-record" method="post" action="<?php echo base_url(); ?>index.php/admin/add_city">
                        <div class="form-group-third">
                            <label>نام کشور</label>
                            <select name="country-id">
                                <option>انتخاب</option>
                                <?php foreach ($country as $row) { ?>
                                    <option value=" <?php echo $row['id']; ?>">
                                        <?php echo $row['fa_name'] . ' , ' . $row['en_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group-third">
                            <label>نام شهر به فارسی</label>
                            <input type="text" name="city-fa">
                        </div>
                        <div class="form-group-third">
                            <label>نام شهر به انگلیسی</label>
                            <input type="text" name="city-en">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect add-city">ثبت</a>
                        </div>
                        <div class="admin-tbl-box">
                            <table class="admin-tbl">
                                <thead>
                                    <tr>
                                        <th>نام شهر - فارسی</th>
                                        <th>نام شهر - انگلیسی</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($city as $row) { ?>
                                        <tr><td><?php echo $row['fa_name'] ?></td><td><?php echo $row['en_name'] ?></td><td><a href="#" class="admin-change">بیشتر ...</a></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <header>تعریف فرودگاه</header>
                    <form class="iata-record" method="post" action="<?php echo base_url(); ?>index.php/admin/add_iata">
                        <div class="form-group-third">
                            <label>نام شهر</label>
                            <select name="city-id">
                                <option>انتخاب</option>
                                <?php foreach ($city as $row) { ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['fa_name'] . ' , ' . $row['en_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group-third">
                            <label>نام فرودگاه</label>
                            <input type="text" name="airport-name">
                        </div>
                        <div class="form-group-third">
                            <label>یاتا</label>
                            <input type="text" name="iata">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect add-iata">ثبت</a>
                        </div>
                        <div class="admin-tbl-box">
                            <table class="admin-tbl">
                                <thead>
                                    <tr>
                                        <th>نام فرودگاه</th>
                                        <th>یاتا</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($city as $row) { ?>
                                        <tr><td><?php echo $row['airport_name'] ?></td><td><?php echo $row['iata'] ?></td><td><a href="#" class="admin-change">بیشتر ...</a></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <header>تعریف پرواز</header>
                    <form class="flight-record" method="post" action="<?php echo base_url(); ?>index.php/admin/add_flight">
                        <div class="form-group-fourth">
                            <label>مبداء</label>
                            <input type="text" name="from-city-iata">
                        </div>
                        <div class="form-group-fourth">
                            <label>مقصد</label>
                            <input type="text" name="to-city-iata">
                        </div>
                        <div class="form-group-fourth">
                            <label>زمان عزیمت</label>
                            <input type="text" name="departure-time">
                        </div>
                        <div class="form-group-fourth">
                            <label>زمان برگشت</label>
                            <input type="text" name="return-time">
                        </div>
                        <div class="form-group-half">
                            <label>شماره پرواز</label>
                            <input type="text" name="flight-number">
                        </div>
                        <div class="form-group-half">
                            <label>ایرلاین</label>
                            <input type="text" name="airline-iata">
                        </div>
                        <div class="form-group">
                            <a href="#" class="transition-effect add-flight">ثبت</a>
                        </div>
                        <div class="admin-tbl-box">
                            <table class="admin-tbl">
                                <thead>
                                    <tr>
                                        <th>مبدا</th>
                                        <th>مقصد</th>
                                        <th>زمان عزیمت</th>
                                        <th>زمان برگشت</th>
                                        <th>شماره پرواز</th>
                                        <th>ایرلاین</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($flight as $row) { ?>
                                        <tr><td><?php echo $row['from_city_iata'] ?></td><td><?php echo $row['to_city_iata'] ?></td><td><?php echo $row['departure_time'] ?></td><td><?php echo $row['return_time'] ?></td><td><?php echo $row['flight_number'] ?></td><td><?php echo $row['airline_iata'] ?></td><td><a href="#" class="admin-change">بیشتر ...</a></td><td><input type="hidden" value="<?php echo $row['id']; ?>"><a class="fkey" href="#">مسیر</a></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <header>تعریف مسیر</header>
                    <form class="masir-record" method="post" action="<?php echo base_url(); ?>index.php/admin/add_masir">
                        <div class="masir-sh">
                            <input class="flight-id" name="flight-id" type="hidden" value="">
                            <div class="form-group-half">
                                <label>تاریخ عزیمت</label>
                                <input type="text" class="pdatepicker" name="departure-date">
                            </div>
                            <div class="form-group-half">
                                <label>تاریخ برگشت</label>
                                <input type="text" class="pdatepicker" name="return-date">
                            </div>
                            <div class="form-group-third">
                                <label>ظرفیت</label>
                                <input type="text" name="capacity">
                            </div>
                            <div class="form-group-third">
                                <label>کلاس قیمت</label>
                                <input type="text" name="class">
                            </div>
                            <div class="form-group-third">
                                <label>قیمت</label>
                                <input type="text" name="ghimat">
                            </div>
                            <div class="form-group">
                                <a href="#" class="transition-effect add-masir">ثبت</a>
                            </div>
                        </div>
                        <div class="admin-tbl-box">
                            <table class="admin-tbl">
                                <thead>
                                    <tr>
                                        <th>تاریخ عزیمت</th>
                                        <th>تاریخ برگشت</th>
                                        <th>ظرفیت</th>
                                        <th>کلاس قیمت</th>
                                        <th>قیمت</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($masir as $row) { ?>
                                        <tr><td><?php echo $row['departure_date'] ?></td><td><?php echo $row['return_date'] ?></td><td><?php echo $row['capacity'] ?></td><td><?php echo $row['class'] ?></td><td><?php echo $row['ghimat'] ?></td><td><a href="#" class="admin-change">بیشتر ...</a></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
            
            $(".masir-sh").hide();
            function selectParvaz(id) {
                $("#flight_id").val(id);
            }
            $(".fkey").on("click", function () {
                $(".masir-sh").show();
                $(".admin-charter-box header").next("form").hide();
                $(".masir-record").fadeIn();
                $(".flight-id").val($(this).prev("input").val());
            });
        </script>
    </body>
</html>
