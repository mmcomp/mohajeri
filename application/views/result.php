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
    <body>
        <div class="container-fluid">
            <div class="image-cover">
                <div class="row">
                    <div class="main-header-box">
                        <div class="main-header">
                            <a href="#"><img title="آژانس مهاجری" alt="آژانس مهاجری" class="mohajeri-logo" src="<?php echo base_url(); ?>assets/images/mohajeri-logo.png"></a>
                        </div>
                    </div>
                    <div class="search-box">
                        <ul>
                            <li id="tab2" class="active">پرواز سیستمی (داخلی)</li>
                            <li id="tab3">پرواز سیستمی (خارجی)</li>
                            <li id="tab1">پرواز چارتری</li>
                        </ul>
                        <!--charter-->
                        <div id="charter-flight">
                            <form method="post" class="search-form charter-form" style="padding-top: 60px;" action="">
                                <div class="form-group-half">
                                    <label>مبداء</label>
                                    <input type="text" id="charter-from-city" class="autocomplete">
                                </div>
                                <div class="form-group-half">
                                    <label>مقصد</label>
                                    <input type="text" id="charter-to-city" class="autocomplete">
                                </div>
                                <div class="form-group-half">
                                    <label>نوع پرواز</label>
                                    <select id="charter-flight-type" id="charter-flight-type">
                                        <option value="0">یک طرفه</option>
                                        <option value="1">دو طرفه</option>
                                    </select>
                                </div>
                                <div class="form-group-half">
                                    <label>تاریخ رفت</label>
                                    <input class="pdatepicker" type="text" id="charter-departure-date" readonly>
                                    <div id="charter-return">
                                        <label>تاریخ برگشت</label>
                                        <input class="pdatepicker" type="text" id="charter-return-date" readonly>
                                    </div>
                                </div>
                                <div class="form-group-third">
                                    <label>بزرگسال</label>
                                    <select id="charter-adult">
                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>کودک</label>
                                    <select id="charter-child">
                                        <?php for ($i = 0; $i < 6; $i++) { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>نوزاد</label>
                                    <select id="charter-infant">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <a id="charter-submit" href="#" class="transition-effect">جستجو</a>
                                </div>
                            </form>
                        </div>
                        <!--liaison-->
                        <div id="liaison-flight">
                            <form method="post" class="search-form" style="padding-top: 60px;" action="">
                                <div class="form-group-half">
                                    <label>مبداء</label>
                                    <input type="text" id="liaison-from-city" class="autocomplete">
                                </div>
                                <div class="form-group-half">
                                    <label>مقصد</label>
                                    <input type="text" id="liaison-to-city" class="autocomplete">
                                </div>
                                <div class="form-group-half">
                                    <label>نوع پرواز</label>
                                    <select id="liaison-flight-type">
                                        <option value="0">یک طرفه</option>
                                        <option value="1">دو طرفه</option>
                                    </select>
                                </div>
                                <div class="form-group-half">
                                    <label>تاریخ رفت</label>
                                    <input class="pdatepicker" type="text" id="liaison-departure-date" readonly>
                                    <div id="liaison-return">
                                        <label>تاریخ برگشت</label>
                                        <input class="pdatepicker" type="text" id="liaison-return-date" readonly>
                                    </div>
                                </div>
                                <div class="form-group-third">
                                    <label>بزرگسال</label>
                                    <select id="liaison-adult" name="liaison-adult">
                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>کودک</label>
                                    <select id="liaison-child" name="liaison-child">
                                        <?php for ($i = 0; $i < 6; $i++) { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>نوزاد</label>
                                    <select id="liaison-infant" name="liaison-infant">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="liaison-submit" class="transition-effect">جستجو</a>
                                </div>
                            </form>
                        </div>
                        <!--amadeus-->
                        <div id="amadeus-flight">
                            <form method="post" class="search-form" style="padding-top: 60px;">
                                <div class="form-group-half">
                                    <label>مبداء</label>
                                    <input type="text" id="amadeus-from-city" class="autocomplete">
                                </div>
                                <div class="form-group-half">
                                    <label>مقصد</label>
                                    <input type="text" id="amadeus-to-city" class="autocomplete">
                                </div>
                                <div class="form-group-third">
                                    <label>پرواز رفت</label>
                                    <input type="text" id="amadeus-departure-date" class="pdatepicker">
                                </div>
                                <div class="form-group-third">
                                    <label>پرواز برگشت</label>
                                    <input type="text" id="amadeus-return-date" class="pdatepicker"> 
                                </div>
                                <div class="form-group-third">
                                    <label>ایرلاین</label>
                                    <select name="amadeus-airline-iata[]">
                                        <option value="TK">ترکیش</option>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>بزرگسال</label>
                                    <select id="amadeus-adult">
                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>کودک</label>
                                    <select id="amadeus-child">
                                        <?php for ($i = 0; $i < 6; $i++) { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group-third">
                                    <label>نوزاد</label>
                                    <select id="amadeus-infant">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="amadeus-submit" class="transition-effect">جستجو</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--charter result-->
                <div class="row" id="charter-domestic-oneway-result">
                    <div class="result-show">
                        <form method="post" action="<?php echo base_url(); ?>index.php/charter/charter_reserve">
                            <header id="charter-domestic-oneway-header" class="accordion"></header>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ردیف</th>
                                        <th>مبداء</th>
                                        <th>مقصد</th>
                                        <th>ایرلاین</th>
                                        <th>شماره پرواز</th>
                                        <th>ساعت حرکت</th>
                                        <th>ساعت فرود</th>
                                        <th>ظرفیت</th>
                                        <th>کلاس قیمت</th>
                                        <th>قیمت (تومان)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="charter-domestic-oneway-content">
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="row" id="charter-domestic-departure-result">
                    <div class="result-show">
                        <header id="charter-domestic-departure-header" class="accordion"></header>
                        <table>
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>مبداء</th>
                                    <th>مقصد</th>
                                    <th>ایرلاین</th>
                                    <th>شماره پرواز</th>
                                    <th>ساعت حرکت</th>
                                    <th>ساعت فرود</th>
                                    <th>ظرفیت</th>
                                    <th>کلاس قیمت</th>
                                    <th>قیمت(تومان)</th>
                                </tr>
                            </thead>
                            <tbody id="charter-domestic-departure-content">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" id="charter-domestic-return-result">
                    <div class="result-show">
                        <header id="charter-domestic-return-header" class="accordion"></header>
                        <table>
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>مبداء</th>
                                    <th>مقصد</th>
                                    <th>ایرلاین</th>
                                    <th>شماره پرواز</th>
                                    <th>ساعت حرکت</th>
                                    <th>ساعت فرود</th>
                                    <th>ظرفیت</th>
                                    <th>کلاس قیمت</th>
                                    <th>قیمت (تومان)</th>
                                </tr>
                            </thead>
                            <tbody id="charter-domestic-return-content">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--liaison result-->
                <form id="liaison-result-show-form" method="post" action="<?php echo base_url(); ?>index.php/flight/start_reserve">
                    <div class="row" id="liaison-result-show">
                        <div class="result-show">
                            <header id="liaison-result-header" class="accordion"></header>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ردیف</th>
                                        <th>مبداء</th>
                                        <th>مقصد</th>
                                        <th>ایرلاین</th>
                                        <th>شماره پرواز</th>
                                        <th>ساعت حرکت</th>
                                        <th>ساعت فرود</th>
                                        <th>ظرفیت</th>
                                        <th>کلاس قیمت</th>
                                        <th>قیمت(تومان)</th>
                                    </tr>
                                </thead>
                                <tbody id="liaison-result-content">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="liaison-result-show-departure">
                        <div class="result-show">
                            <header id="liaison-result-header-departure" class="accordion"></header>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ردیف</th>
                                        <th>مبداء</th>
                                        <th>مقصد</th>
                                        <th>ایرلاین</th>
                                        <th>شماره پرواز</th>
                                        <th>ساعت حرکت</th>
                                        <th>ساعت فرود</th>
                                        <th>ظرفیت</th>
                                        <th>کلاس قیمت</th>
                                        <th>قیمت(تومان)</th>
                                    </tr>
                                </thead>
                                <tbody id="liaison-result-content-departure">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                <a href="#" class="liaison-result-submit transition-effect">ادامه</a>
                <!--amadeus result-->
                <form id="amadeus-result-show-form" method="post" action="<?php echo base_url(); ?>index.php/flight/start_reserve">
                    <div class="row" id="amadeus-result-show">
                        <div class="result-show">
                            <header id="amadeus-result-header"></header>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ردیف</th>
                                        <th>مبداء</th>
                                        <th>مقصد</th>
                                        <th>ایرلاین</th>
                                        <th>شماره پرواز</th>
                                        <th>ساعت حرکت</th>
                                        <th>ساعت فرود</th>
                                        <th>کلاس قیمت</th>  
                                    </tr>
                                </thead>
                                <tbody id="amadeus-result-content">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="amadeus-result-show-departure" style="display: none;">
                        <div class="result-show">
                            <header id="amadeus-result-header-departure"></header>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ردیف</th>
                                        <th>مبداء</th>
                                        <th>مقصد</th>
                                        <th>ایرلاین</th>
                                        <th>شماره پرواز</th>
                                        <th>ساعت حرکت</th>
                                        <th>ساعت فرود</th>
                                        <th>کلاس قیمت</th>  
                                    </tr>
                                </thead>
                                <tbody id="amadeus-result-content-departure">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                <a href="#" class="amadeus-result-submit transition-effect">ادامه</a>
                <!--tour-->
                <div class="row">
                    <div class="tour">
                        <ul>
                            <li><a href="#"><img src="<?php echo base_url(); ?>assets/images/china.jpg">تور چین</a></li>
                            <li><a href="#"><img src="<?php echo base_url(); ?>assets/images/malaysia.jpg">تور مالزی</a></li>
                            <li><a href="#"><img src="<?php echo base_url(); ?>assets/images/thailand.jpg">تور تایلند</a></li>
                            <li><a href="#"><img src="<?php echo base_url(); ?>assets/images/turkey.jpg">تور ترکیه</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="address-box">
                        <div id="map_canvas" class="google-map"></div>
                        <div class="full-address">
                            نشانی  : مشهد ، خیابان خسروی ، نرسیده به چهارراه خسروی ، جنب هتل سخاوت
                            <br>
                            تلفن : 32222982-051
                            <br>
                            فکس : 32217100-051
                            <br>
                            پشتیبانی رزرواسیون : 09151151960
                        </div>
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
    </body>
</html>

<script>
    //date
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var output = d.getFullYear() + '/' +
            (('' + month).length < 2 ? '0' : '') + month + '/' +
            (('' + day).length < 2 ? '0' : '') + day;
    var current_date = (gregorian_to_jalali(output));

    //persian datepicker 
    $(".pdatepicker").persianDatepicker({
        startDate: current_date,
        cellWidth: 35,
        cellHeight: 35,
        fontSize: 15
    });

    //cities     
    $('.autocomplete').autoComplete({minChars: 2,
        source: function (term, suggest) {
            term = term.toLowerCase();
            var cities = [<?php
                                        foreach ($cities as $city) {
                                            echo "'" . $city['iata'] . " | ";
                                            echo $city['fa_name'] . " | ";
                                            echo $city['en_name'] . " | ";
                                            echo $city['airport_name'] . "',";
                                        }
                                        ?>];
            var suggestions = [];
            for (i = 0; i < cities.length; i++)
                if (~cities[i].toLowerCase().indexOf(term))
                    suggestions.push(cities[i]);
            suggest(suggestions);
        }
    });

    //liaison ajax
    function check_result_liaison(ids) {
        var p = {
            "ids": ids
        };
        console.log('checking');
        $.getJSON("<?php echo base_url(); ?>index.php/liaison/show_liaison_result", p, function (result) {
            console.log('result:', result);
            if (result.result_ok !== true)
            {
                setTimeout(function () {
                    check_result_liaison(ids);
                }, 500);
            } else {
                show_liaison(result);
            }
        });
    }

    function show_liaison(result) {
        $('.loading').hide();
        var res = result.result;
        var obj;
        var j = 1;
        var k = 1;
        $('#liaison-result-content').html('');
        $('#liaison-result-header').html('');
        $('#liaison-result-content-departure').html('');
        $('#liaison-result-header-departure').html('');
        var liaison_flight_type = $("#liaison-flight-type").val();
        if (liaison_flight_type == 0) {
            $("#liaison-result-show-departure").hide();
        }
        var liaison_departure_date = $('#liaison-departure-date').val();
        var liaison_arrival_date = $('#liaison-return-date').val();
        var liaison_from_city = $('#liaison-from-city').val().split('|')[1].trim();
        var liaison_to_city = $('#liaison-to-city').val().split('|')[1].trim();
        var liaison_from_city_iata = $('#liaison-from-city').val().split('|')[0].trim();
        var liaison_to_city_iata = $('#liaison-to-city').val().split('|')[0].trim();
        var liaison_adult = $("#liaison-adult").val();
        var liaison_child = $("#liaison-child").val();
        var liaison_infant = $("#liaison-infant").val();
        if (res.length === 0 || result.result === undefined) {
            if (liaison_flight_type == 0) {
                $("#liaison-result-show").show();
                $('#liaison-result-content').append('<tr><th colspan="11" style="background-color:red; color:#fff !important;">نتیجه ای یافت نشد.</th></tr>');
                $('#liaison-result-header').append('پرواز چارتری (' + liaison_from_city + ' - ' + liaison_to_city + ')' + ' - ' + liaison_departure_date);
            } else if (liaison_flight_type == 1) {
                $("#liaison-result-show").show();
                $("#liaison-result-show-departure").show();
                $('#liaison-result-content').append('<tr><th colspan="11" style="background-color:red; color:#fff !important;">نتیجه ای یافت نشد.</th></tr>');
                $('#liaison-result-header').append('پرواز چارتری (' + liaison_from_city + ' - ' + liaison_to_city + ')' + ' - ' + liaison_departure_date);
                $('#liaison-result-content-departure').append('<tr><th colspan="11" style="background-color:red; color:#fff !important;">نتیجه ای یافت نشد.</th></tr>');
                $('#liaison-result-header-departure').append('پرواز چارتری (' + liaison_to_city + ' - ' + liaison_from_city + ')' + ' - ' + liaison_arrival_date);
            }
        } else {
            $(".liaison-result-submit").show();
            $('#liaison-result-header').append('پرواز سیستمی داخلی (' + liaison_from_city + ' - ' + liaison_to_city + ')' + ' - ' + liaison_departure_date);
            $('#liaison-result-header-departure').append('پرواز سیستمی داخلی (' + liaison_to_city + ' - ' + liaison_from_city + ')' + ' - ' + liaison_arrival_date);
            for (var i = 0; i < res.length; i++) {
                obj = res[i];
                if (obj.from_city_iata == liaison_from_city_iata) {
                    $('#liaison-result-show').fadeIn();
                    $('#liaison-result-content').append('<tr><td><input type="checkbox" name="flight_key[]" class="liaison-departure-result" value=' + obj.id + '><input type="hidden" name="flight_cat[]" value="1"><input type="hidden" name="adult" value="' + liaison_adult + '"><input type="hidden" name="child" value="' + liaison_child + '"><input type="hidden" name="infant" value="' + liaison_infant + '"></td><td>' + j + '</td><td>' + obj.from_city_iata + '</td><td>' + obj.to_city_iata + '</td><td>' + obj.airline_iata + '</td><td>' + obj.flight_number + '</td><td>' + obj.departure_time + '</td><td>' + obj.landing_time + '</td><td>' + obj.capacity + '</td><td>' + obj.class + '</td><td>' + obj.price + '</td></tr></tr>');
                    j++;
                }
                if (obj.from_city_iata == liaison_to_city_iata) {
                    $('#liaison-result-show-departure').fadeIn();
                    $('#liaison-result-content-departure').append('<tr><td><input type="checkbox" name="flight_key[]" class="liaison-return-result" value=' + obj.id + '><input type="hidden" name="flight_cat[]" value="1"><input type="hidden" name="adult" value="' + liaison_adult + '"><input type="hidden" name="child" value="' + liaison_child + '"><input type="hidden" name="infant" value="' + liaison_infant + '"></td><td>' + k + '</td><td>' + obj.from_city_iata + '</td><td>' + obj.to_city_iata + '</td><td>' + obj.airline_iata + '</td><td>' + obj.flight_number + '</td><td>' + obj.departure_time + '</td><td>' + obj.landing_time + '</td><td>' + obj.capacity + '</td><td>' + obj.class + '</td><td>' + obj.price + '</td></tr></tr>');
                    k++;
                }
            }
            setCheckBoxLimit("liaison-departure-result");
            setCheckBoxLimit("liaison-return-result");
        }
    }

    function setCheckBoxLimit(ClassName)
    {
        $("." + ClassName).on('change', function () {
            $("." + ClassName).not(this).prop('checked', false);
        });
    }

    function search_liaison() {
        $("#amadeus-result-show").hide();
        $(".amadeus-result-submit").hide();
        var p = {
            "liaison-flight-type": $("#liaison-flight-type").val(),
            "liaison-from-city": $("#liaison-from-city").val().split('|')[0],
            "liaison-to-city": $("#liaison-to-city").val().split('|')[0],
            "liaison-departure-date": $("#liaison-departure-date").val(),
            "liaison-return-date": $("#liaison-return-date").val(),
            "liaison-adult": $("#liaison-adult").val(),
            "liaison-child": $("#liaison-child").val(),
            "liaison-infant": $("#liaison-infant").val()
        };
        $('.loading').show();
        $.getJSON("<?php echo base_url(); ?>index.php/liaison/show_liaison_flight", p, function (result) {
            check_result_liaison(result);
        });
    }

    //amadeus ajax
    function show_amadeus_flight(result) {
        $('.loading').hide();
        var flight_info = result.result;
        console.log('flight_info', flight_info);
        var obj;
        var j = 1;
        var amadeus_departure_date = $('#amadeus-departure-date').val();
        var amadeus_from_city = $('#amadeus-from-city').val().split('|')[1].trim();
        var amadeus_to_city = $('#amadeus-to-city').val().split('|')[1].trim();
        var amadeus_adult = $("#amadeus-adult").val();
        var amadeus_child = $("#amadeus-child").val();
        var amadeus_infant = $("#amadeus-infant").val();
        $('#amadeus-result-content').html('');
        $('#amadeus-result-header').html('');
        $("#amadeus-result-show").fadeIn();
        if (flight_info.length === 0) {
            $('#amadeus-result-header').append('پرواز سیستمی خارجی (' + amadeus_from_city + ' - ' + amadeus_to_city + ')' + ' - ' + amadeus_departure_date);
            $('#amadeus-result-content').append('<tr><th colspan="11" style="background-color:red; color:#fff !important;">نتیجه ای یافت نشد.</th></tr>');
            $('#amadeus-result-header-departure').append('پرواز سیستمی خارجی (' + amadeus_from_city + ' - ' + amadeus_to_city + ')' + ' - ' + amadeus_departure_date);
            $('#amadeus-result-content-departure').append('<tr><th colspan="11" style="background-color:red; color:#fff !important;">نتیجه ای یافت نشد.</th></tr>');
        } else {
            $(".amadeus-result-submit").show();
            $('#amadeus-result-header').append('پرواز سیستمی خارجی (' + amadeus_from_city + ' - ' + amadeus_to_city + ')' + ' - ' + amadeus_departure_date);
            for (var i = 0; i < flight_info.length; i++, j++) {
                obj = flight_info[i];
                $('#amadeus-result-content').append('<tr><td><input type="hidden" name="flight_cat[]" value="2"><input type="hidden" name="adult" value="' + amadeus_adult + '"><input type="hidden" name="child" value="' + amadeus_child + '"><input type="hidden" name="infant" value="' + amadeus_infant + '"><input type="checkbox" name="flight_key[]" class="amadeus-return-result" value=' + obj.id + '></td><td>' + j + '</td><td>' + obj.from_city_iata + '</td><td>' + obj.to_city_iata + '</td><td>' + obj.airline_iata + '</td><td>' + obj.flight_number + '</td><td>' + obj.departure_time + '</td><td>' + obj.landing_time + '</td><td>' + obj.class + '</td></tr>');
            }
        }
    }

    function check_result_amadeus(ids) {
        var p = {
            "ids": ids
        };
        console.log('checking');
        $.getJSON("<?php echo base_url(); ?>index.php/amadeus/check_amadeus_result", p, function (result) {
            console.log('result:', result);
            if (result.result_ok !== true)
            {
                setTimeout(function () {
                    check_result_amadeus(ids);
                }, 500);
            } else {
                show_amadeus_flight(result);
            }

        });
    }

    function search_amadeus() {
        $("#liaison-result-show").hide();
        $("#liaison-result-show-departure").hide();
        $(".liaison-result-submit").hide();
        var p = {
            'amadeus-from-city': $('#amadeus-from-city').val().split('|')[0].trim(),
            'amadeus-to-city': $('#amadeus-to-city').val().split('|')[0].trim(),
            'amadeus-departure-date': jalali_to_gregorian($('#amadeus-departure-date').val()),
            'amadeus-return-date': jalali_to_gregorian($('#amadeus-return-date').val()),
            'amadeus-airline-iata': $("select[name='amadeus-airline-iata[]']")
                    .map(function () {
                        return $(this).val();
                    }).get(),
            'amadeus-adult': $('#amadeus-adult').val(),
            'amadeus-child': $('#amadeus-child').val(),
            'amadeus-infant': $('#amadeus-infant').val()
        };
        console.log('searching', p);
        $('.loading').show();
        $.getJSON("<?php echo base_url(); ?>index.php/amadeus/search_amadeus_flight", p, function (result) {
            console.log('result:', result);
            check_result_amadeus(result);
        });
    }
</script>
