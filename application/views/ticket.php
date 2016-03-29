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
            .flight {
                list-style: none;
                width: 800px;
                margin: 0 auto;
                border: 1px dashed #333;
                border-bottom: none;
                box-sizing: border-box;
                padding: 5px;
            }

            .flight li {
                display: inline-block;
                margin: 0 25px;
            }

            .passenger {
                list-style: none;
                width: 800px;
                margin: 0 auto;
                border: 1px dashed #333;
                border-bottom: none;
                box-sizing: border-box;
                padding: 5px;
            }

            .passenger li {
                margin: 5px 25px;
            }

            .notice {
                list-style: none;
                width: 800px;
                margin: 0 auto;
                border: 1px dashed #333;
                box-sizing: border-box;
                padding: 5px;
                
            }

            .notice li {
                margin: 5px 25px;
                text-align: center;
            }

        </style>
        <ul class="flight">
            <li style="width: 100%; margin-bottom: 20px; text-align: center;">*** itinerary receipt ***</li>
        </ul>
        <div class="passenger-box">
            
        </div>
        <ul class="notice">
            <li>
                notice: carriage and other services provided by the carrier are subject to conditions of carriage, which are hereby incorporated by reference. these conditions my be obtained from the issuing carrier.
            </li>
        </ul>

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
                            if (result.stat[i].result == 0 || (result.stat[i].result != 0 && result.data.tickets[0].ticket_number2==''))
                            {
                                not_ready = true;
                            }
                        }
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
                                ticket = tickets[i];
                                console.log(ticket);
                                $(".passenger-box").append('<ul class="passenger"><li>ticket-Number : ' + tickets[i].ticket_number2 + '</li><li>name : ' + tickets[i].lname_en + ' / ' + tickets[i].fname_en + '</li><li>age : ' + tickets[i].age + '</li><li>birthdate : ' + tickets[i].birthday + '</li><li>nationality : iran</li></ul>');
                            }
                            // Flights
                            console.log('FLIGHTS : ');
                            for (var i = 0; i < flight_infos.length; i++)
                            {
                                flight_info = flight_infos[i];
                                console.log(flight_info);
                                $(".flight").append('<li>from : ' + flight_info[i].from_city + '</li><li>to : ' + flight_info[i].to_city + '</li><li>flight-date : ' + flight_info[i].fdate + '</li><li>flight-time : ' + flight_info[i].ftime + '</li>');
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
