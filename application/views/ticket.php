<?php
$status = $out['status'];
$refrence_id = $out['refrence_id'];
?>
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
        <link href="<?php echo base_url(); ?>assets/css/autocomplete.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/persian-datepicker.css" rel="stylesheet">
    </head>
    <body>
        <style>
            *{
                direction: rtl;
                font-family: yekan;
                font-size: 15px;
            }

            .loading {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0;
                background-color: #717171;
                z-index: 9999;
                text-align: center;
            }

            .loading img {
                max-width: 100%;
                margin: 350px 0;
            }

            @font-face {
                font-family: yekan;
                src: url(../..//assets/fonts/Yekan.woff);
            }

            .ticket {
                border-spacing: 2px;
                border: 1px solid #000000;
                width: 980px;
                text-align: center;
                margin-bottom: 30px;
            }

            .ticket thead {
                background-color: #eeeeee;
            }

            .ticket th {
                padding: 5px 20px;
            }

            .passenger {
                border-spacing: 2px;
                border: 1px solid #000000;
                width: 980px;
                text-align: center;
            }

            .passenger thead {
                background-color: #eeeeee;
            }

        </style>
        <div class="loading"><img src="<?php echo base_url(); ?>/assets/images/loadbar.gif"></div>
        <div style="width: 980px; padding: 10px; border: 1px solid #000000; margin: 10px auto;">
            <img style="float: left; margin: 10px 0;" src="<?php echo base_url(); ?>assets/images/iranair-ticket.jpg">
            <table class="ticket">
                <header></header>
                <thead class="flight-title"></thead>
                <tbody class="flight-content"><tr></tr></tbody>
            </table>

            <table class="passenger">
                <thead class="passenger-title"></thead>
                <tbody class="passenger-content"><tr></tr></tbody>
            </table>
            <header style="font-weight: 600;">
                مسافر گرامی رعایت موارد زیر در پروازهای داخلی و خارجی الزامی است : 
            </header>
            <ul>
                <li>
                    حضور مسافر در فرودگاه جهت مسیرهای داخلی 1 تا 1.5 ساعت و برای مسیرهای خارجی تا 3 ساعت قبل از زمان پرواز
                </li>
                <li>
                    ارائه کارت شناسایی عکس دار و معتبر
                </li>
                <li>
                    قرار دادن دوربین، موبایل، نوت بوک، اشیاء گرانبها و مدارک مهم در بسته های تحویلی به هواپیما  (در صورت مفقود شدن هواپیمایی هیچ مسئولیتی ندارد)
                </li>
            </ul>
        </div>
        <p style="width: 980px; margin: 0 auto;">
            <span style="margin-left: 20px;">
                مهاجری خراسان
            </span>
            <span style="margin-left: 20px;">
                تلفن : 05132222982
            </span>
            <span style="margin-left: 20px;">
                فکس: 05132217100
            </span>
            <span style="margin-left: 20px;">
                نشانی : مشهد ، خیابان خسروی ، نرسیده به چهارراه خسروی ، جنب هتل سخاوت 
            </span>
        </p>
        <?php
        if ($status) {
            ?>
            <script>
                var refrence_id = <?php echo $refrence_id; ?>;
                function check_confirm()
                {
                    var p = {
                        "refrence_id": refrence_id
                    };
                    $.getJSON("<?php echo base_url(); ?>index.php/flight/confirm_etebari_result", p, function (result) {
                        //                        console.log(result);
                        var not_ready = false;
                        var error_happend = false;
                        for (var i = 0; i < result.stat.length; i++)
                        {
                            if (result.stat[i].result == 0 || (result.stat[i].result == 1 && result.data.tickets[0].ticket_number2 == ''))
                            {
                                not_ready = true;
                            }
                            else if (result.stat[i].result != 0 && result.stat[i].result != 1) {
                                error_happend = true;
                            }
                        }
                        if (error_happend)
                        {
                            ///ERROR Happened
                        }
                        else
                        {
                            if (result.stat.length === 0)
                            {
                                not_ready = true;
                            }
                            if (not_ready)
                            {
                                console.log('Not Ready');
                                setTimeout(function () {
                                    check_confirm();
                                }, 500);
                            }
                            else
                            {
                                $(".loading").hide();
                                var data = result.data;
                                //                            console.log('Ready',data);
                                var voucher_ids = data.voucher_id;
                                var tickets = data.tickets;
                                var flight_infos = data.flight_info;
                                var ticket, flight_info, voucher_id;
                                // Flights
                                console.log('FLIGHTS : ');
                                for (var i = 0; i < flight_infos.length; i++)
                                {
                                    flight_info = flight_infos[i];
                                    voucher_id = voucher_ids[i];
                                    console.log(flight_info, voucher_id);


                                    // Tickets
                                    console.log('TICKETS : ');
                                    for (var i = 0; i < tickets.length; i++)
                                    {
                                        voucher_id = voucher_ids[i];
                                        ticket = tickets[i];
                                        console.log(ticket);
                                        $(".flight-content tr").append('<th>' + voucher_id + '</th><th>' + tickets[i].ticket_number2 + '</th>');
                                        $(".passenger-title").append('<tr><th>جنسیت</th><th>نام مسافر</th><th>شماره ملی</th><th>تاریخ تولد</th></tr>');
                                        if (tickets[i].gender == 1) {
                                            var gender = 'Mr';
                                        } else {
                                            var gender = 'Miss';
                                        }
                                        $(".passenger-content").append('<tr><td>' + gender + '</td><td>' + tickets[i].lname_en + ' - ' + tickets[i].fname_en + '</td><td>' + tickets[i].shomare_melli + '</td><td>' + tickets[i].birthday + '</td></tr>');
                                    }


                                    $(".flight-title").append('<tr><th>وچر</th><th>شماره بلیط</th><th>مبدا</th><th>مقصد</th><th>نام خط هوایی</th><th>شماره پرواز</th><th>تاریخ شمسی</th><th>تاریخ میلادی</th><th>ساعت پرواز</th></tr>');
                                    $(".flight-content tr").append('<td>' + flight_info[i].from_city + '</td><td>' + flight_info[i].to_city + '</td><td>' + flight_info[i].airline + '</td><td>' + flight_info[i].flight_number + '</td><td>' + gregorian_to_jalali2(flight_info[i].fdate) + '</td><td>' + flight_info[i].fdate + '</td><td>' + flight_info[i].ftime + '</td>');
                                }
                            }
                        }
                    });
                }
                $(document).ready(function () {
                    check_confirm();
                });
            </script>
            <?php
        } else {
            ?>
            ERROR
            <?php
        }
        ?>
    </body>
</html>
