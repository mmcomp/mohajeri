$(document).ready(function () {

    //google map
    var initLat = 36.2904484265274;
    var initLng = 59.6069342829287;
    var initZoom = 15;
    function initialize() {
        var latlng = new google.maps.LatLng(initLat, initLng);
        var myOptions = {zoom: initZoom, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP};
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        marker = new google.maps.Marker({position: latlng, map: map, draggable: false, scrollwheel: false});
    }
    window.onload = function () {
        initialize();
    };

    //address
    $(".address").hide();
    $(".location-icon").on("click", function () {
        $(".address").stop().toggle("slow");
    });

    //main header 
    setTimeout(function () {
        $(".main-header").slideDown("slow");
    }, 1000);

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
    $("#charter-result-show").hide();
    $("#charter-submit").on("click", function () {
        search_charter();
    });

    //liaison submit
    $(".liaison-result-submit").hide();
    $("#liaison-result-show").hide();
    $("#liaison-result-show-departure").hide();
    $("#liaison-submit").on("click", function () {
        search_liaison();
    });

    //amadeus submit
    $("#amadeus-submit").on("click", function () {
        search_amadeus();
    });

    //amadeus airlines
    $(".airline-box ul").hide();
    $(".airline-box").on("click", function () {
        $(".airline-box ul").fadeIn();
    });
    $(".airline-box ul input").change(function () {
        if (this.checked) {
            $("#amadeus-airline-iata").val($("#amadeus-airline-iata").val() + ' , ' + $(this).val());
        }
    });

    //result hide and show
    $("#charter-domestic-oneway-result").hide();
    $("#charter-domestic-departure-result").hide();
    $("#charter-domestic-return-result").hide();
    $("#liaison-result-show").hide();
    $("#amadeus-result-show").hide();

    //charter result submit
    $(".charter-result-submit").on("click", function () {
        $("#charter-domestic-oneway-result form").submit();
    });

    //liaison result submit
    $(".liaison-result-submit").on("click", function () {
        $("#liaison-result-show form").submit();
    });

    //accordion
    $(".accordion").on("click", function () {
        $(this).next("table").toggle();
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
