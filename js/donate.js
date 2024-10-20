$(document).ready(function () {
    //init
    $("#monthly-donate").addClass("active");
    $("#50").addClass("active");
    $("#card").addClass("active");

    $("#type").val("Monthly donate");
    $("#amount").val(50);
    $("#payment").val("Card");

    let url = new URL(window.location.href);
    let amount = url.searchParams.get("amount");
    if (amount) {
        $(".amount-btn").removeClass("active");
        $("#" + amount).addClass("active");
        $("#amount").val(amount);
    }

    $.ajax({
        type: "GET",
        url: "php/event.php",
        dataType: "json",
        data: { get_all: 1 },
        success: function (response) {
            if (response) {
                renderEvent(response);
            } else {
                console.error("Get event failed");
            }
        },
        error: function () {
            console.error("AJAX request failed");
        }
    });

    //change type
    $(".type-btn").click(function () {
        $(".type-btn").removeClass("active");
        $(this).addClass("active");

        if ($(this).attr("id") == "monthly-donate") {
            $("#type").val("Monthly donate");
        }else {
            $("#type").val("One-time donate");
        }
    });

    //change amount
    $(".amount-btn").click(function () {
        $(".amount-btn").removeClass("active");
        $(this).addClass("active");
        $("#amount").val($(this).attr("id"));
    });

    //change payment
    $(".payment").click(function () {
        $("#other-amount").val("");
        $(".payment").removeClass("active");
        $(this).addClass("active");
        $("#payment").val($(this).attr("id").charAt(0).toUpperCase());
    });

    //change other amount
    $("#other-amount").on("input", function () {
        $(".amount-btn").removeClass("active");
        if ($(this).val() == "") {
            $("#50").addClass("active");
            $("#amount").val(50);
        }
    });

    //form submit
    $("#donate-form").submit(function (event) {
        event.preventDefault();
        if ($("#display-name").val() == "") {
            alert("Please enter your name");
            return;
        }

        // Use "this" to refer to the form
        this.submit();
    });

});

function renderEvent(data) {
    let html = "";
    for (let i = 0; i < data.length; i++) {
        html += `<option value="${data[i].event_id}">${data[i].title}</option>`;
    }
    $("#event").html(html);

}