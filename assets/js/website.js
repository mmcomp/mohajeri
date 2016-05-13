$(document).ready(function () {

    //address
    $(".address").hide();
    $(".location-icon").on("click", function () {
        $(".address").stop().toggle("slow");
    });

    //set infant number
    $("#charter-adult").on("change", function () {
        $("#charter-infant").find("option").remove();
        var adult_choosen = $("#charter-adult").val();
        for ($i = 0; $i <= adult_choosen; $i++)
        {
            $("<option>").val($i).text($i).appendTo("#charter-infant");
        }
    });

    $("#liaison-adult").on("change", function () {
        $("#liaison-infant").find("option").remove();
        $adult_choosen = $("#liaison-adult").val();
        for ($i = 0; $i <= $adult_choosen; $i++)
        {
            $("<option>").val($i).text($i).appendTo("#liaison-infant");
        }
    });

    $("#amadeus-adult").on("change", function () {
        $("#amadeus-infant").find("option").remove();
        $adult_choosen = $("#amadeus-adult").val();
        for ($i = 0; $i <= $adult_choosen; $i++)
        {
            $("<option>").val($i).text($i).appendTo("#amadeus-infant");
        }
    });

    //submit entry form
    $("#public-login-btn").on("click", function () {
        $("#entry-login").submit();
    });

    //member login and submit
    $("#member-login").hide();
    $("#member-login-auth-btn").on("click", function () {
        $("#entry-login").hide();
        $("#member-login").fadeIn();
    });
    $("#public-login-auth-btn").on("click", function () {
        $("#member-login").hide();
        $("#entry-login").fadeIn();
    });

    //search box tab
    $("#charter-flight").hide();
    $("#amadeus-flight").hide();
    $("#tab2").on("click", function () {
        $("#charter-flight").hide();
        $("#amadeus-flight").hide();
        $("#liaison-flight").fadeIn();
        $("#tab1").removeClass("active");
        $("#tab3").removeClass("active");
        $(this).addClass("active");
    });
    $("#tab1").on("click", function () {
        $("#amadeus-flight").hide();
        $("#liaison-flight").hide();
        $("#charter-flight").fadeIn();
        $("#tab2").removeClass("active");
        $("#tab3").removeClass("active");
        $(this).addClass("active");
    });
    $("#tab3").on("click", function () {
        $("#charter-flight").hide();
        $("#liaison-flight").hide();
        $("#amadeus-flight").fadeIn();
        $("#tab2").removeClass("active");
        $("#tab1").removeClass("active");
        $(this).addClass("active");
    });

    //search box settings charter
    $("#charter-return").hide();
    $("#charter-flight-type").on("change", function () {
        var flight_type = $(this).val();
        if (flight_type == 1) {
            $("#charter-return").fadeIn();
        } else {
            $("#charter-return-date").val("");
            $("#charter-return").fadeOut();
        }
    });
    $("#charter-international").on("click", function () {
        $("#charter-flight-type").val("1");
        $("#charter-return").fadeIn();
    });
    $("#charter-domestic").on("click", function () {
        $("#charter-flight-type").val("0");
        $("#charter-return").fadeOut();
    });
    $("#charter-flight-type").on("change", function () {
        if ($(this).val() == 0) {
            $("#charter-domestic").prop("checked", true);
        }
    });

    //search box settings liaison
    $("#liaison-return").hide();
    $("#liaison-return-date").prop("disabled", true);
    $("#liaison-flight-type").on("change", function () {
        var flight_type = $(this).val();
        if (flight_type == 1) {
            $("#liaison-return").fadeIn();
            $("#liaison-return-date").prop("disabled", false);
        } else {
            $("#liaison-return").hide();
            $("#liaison-return-date").prop("disabled", true);
        }
    });

    //charter submit
    $("#charter-submit").on("click", function () {
        search_charter();
    });

    //liaison submit
    $("#liaison-submit").on("click", function () {
        search_liaison();
    });

    //amadeus submit
    $("#amadeus-submit").on("click", function () {
        search_amadeus();
    });

    //amadeus airlines
    $(".airline-box").on("click", function () {
        $(".airline-box ul").fadeIn();
    });
    $(".airline-box ul input").change(function () {
        if (this.checked) {
            $("#amadeus-airline-iata").val($("#amadeus-airline-iata").val() + ' , ' + $(this).val());
        }
    });

    //searching btn
    $(".searching-btn").hide();

    //result hide and show
    $("#charter-departure-result").hide();
    $("#charter-return-result").hide();
    $(".charter-result-submit").hide();
    $("#liaison-result-show").hide();
    $("#liaison-result-show-departure").hide();
    $(".liaison-result-submit").hide();
    $("#amadeus-result-show").hide();
    $(".amadeus-result-submit").hide();

    //pick flight error
    $(".pick-flight-error").hide();

    //amadeus result submit
    $(".amadeus-result-submit").on("click", function () {
        $("#amadeus-result-show-form").submit();
    });

    //accordion
    $(".accordion").on("click", function () {
        $(this).next("table").toggle("slow");
    });
    $(".admin-charter-box header").next("form").hide();
    $(".admin-charter-box header").on("click", function () {
        $(this).next("form").fadeIn();
        $(".admin-charter-box header").not(this).next("form").hide();
    });

    //credit form
    $(".credit-form").hide();
    $(".payment").hide();
    $(".page-color").hide();
    $(".credit-payment").on("click", function () {
        $(".page-color").fadeIn();
        $(".credit-form").fadeIn();
    });

});
