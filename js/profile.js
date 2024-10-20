$(document).ready(function () {

    fetch("js/data.json")
        .then(response => response.json())
        .then(data => {
            data.states.forEach(state => {
                //if option already exists, don't add it again
                if ($("#state").find(`option[value="${state.value}"]`).length) return;
                $("#state").append(`<option value="${state.value}">${state.label}</option>`);
            });
        }
        );

    $("#update-btn").click(function () {
        $("#profile-form input").prop("disabled", false);
        $("#profile-form select").prop("disabled", false);
        $("#email").prop("disabled", true);
        $("#update-btn").hide();
        $("#submit-btn").show();
    }
    );

    $("#logout-btn").click(function () {
        // Make an AJAX request to logout.php
        $.ajax({
            type: "POST",
            url: "php/logout.php",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = "login.php";
                } else {
                    console.error("Logout failed");
                }
            },
            error: function () {
                console.error("AJAX request failed");
            }
        });
    });

    handleToggleIcon();
});

function handleToggleIcon(){
    const icon = $('#toggle-password i')
    const input = $('#password')

    icon.on('click', () => {
        icon.toggleClass('fa-eye fa-eye-slash');
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
    });
}