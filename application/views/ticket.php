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
        <script src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datepicker.en.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/autocomplete.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/persian-datepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/datepicker.min.css" rel="stylesheet">
    </head>
    <body>
        <style>
            @font-face {
                font-family: Yekan;
                src: url(../fonts/Yekan.woff);
            }
            .ticket {
                width: 980px;
                height: 300px;
                margin: 10px auto;
                border: 1px solid #c7c7c7;
                border-spacing: 0;
                font-family: Yekan;
                direction: rtl;
            }
            .ticket tr td {
                text-align: center;
            }
            .ticket tr:nth-of-type(even){
                background-color: #c7c7c7;
            }
        </style>
        <table class="ticket"></table>

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
                        for (var i = 0; i < result.stat.length; i++)
                        {
                            if (result.stat[i].result == 0)
                            {
                                not_ready = true;
                            }
                        }
                        if(result.stat.length===0)
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
                            //                            $(".loading").hide();
                            var data = result.data;
                            //                            console.log('Ready',data);
                            var tickets = data.tickets;
                            var flight_infos = data.flight_info;
                            var ticket, flight_info;
                            // Tickets
                            console.log('TICKETS : ');
                            for (var i = 0; i < tickets.length; i++)
                            {
                                $(".ticket").append('<tr><td>نام : </td><td>' + tickets[i].fname + '</td><td>نام خانوادگی  : </td><td>' + tickets[i].lname + '</td><td>نام (با حروف انگلیسی) : </td><td>' + tickets[i].fname_en + '</td><td>نام خانوادگی  (با حروف انگلیسی) : </td><td>' + tickets[i].lname_en + '</td></tr>');
                                ticket = tickets[i];
                                console.log(ticket);
                            }
                            // Flights
                            console.log('FLIGHTS : ');
                            for (var i = 0; i < flight_infos.length; i++)
                            {
                                flight_info = flight_infos[i];
                                console.log(flight_info);
                            }
                        }
                    });
                }
                $(document).ready(function () {
                    //                $(".loading").show();
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
