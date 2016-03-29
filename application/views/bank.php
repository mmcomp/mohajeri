<html>
    <head>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    </head>
    <body>
        Connecting to BANK .....
        <form id="frm" method="POST" action="https://sep.shaparak.ir/Payment.aspx">
            <input type="hidden" name="Amount" value="<?php echo $Amount; ?>" />
            <input type="hidden" name="MID" value="<?php echo $MID; ?>" />
            <input type="hidden" name="ResNum" value="<?php echo $ResNum; ?>" />
            <input type="hidden" name="RedirectURL" value="<?php echo base_url(); ?>index.php/payment/payment_done" />
        </form>
        <script>
            $(document).ready(function(){
                $("#frm").submit();
            });
        </script>
    </body>
</html>
