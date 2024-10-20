let imagesArray = [];

$(document).ready(function () {
    $("#event-btn").click(function () {
        $("#event-modal").css("display", "block");
    });

    $(".close").click(function () {
        $("#event-modal").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target.id == "event-modal") {
            $("#event-modal").css("display", "none");
        }
    });

    $("#upload-img").on('input', function () {
        const files = this.files;
        imagesArray = Array.from(files); // Reset the array with the current files
        displayImages();
    });

    //fetch json data
    fetch("js/data.json")
        .then(response => response.json())
        .then(data => {
            data.eventTypes.forEach(eventType => {
                $("#event-type").append(`<option value="${eventType.value}">${eventType.label}</option>`);
                $("#event-type-filter").append(`<option value="${eventType.value}">${eventType.label}</option>`);
            });

            data.states.forEach(state => {
                $("#state").append(`<option value="${state.value}">${state.label}</option>`);
                $("#location-filter").append(`<option value="${state.value}">${state.label}</option>`);
            });

            $("#sort-btn").click(function () {
                $("#sort").val(true);
                $("#filter-form").submit();
            });            

            $("#event-type-filter, #location-filter, #date-filter").on("change", function () {
                $("#filter-form").submit();
            });

            //get data from url and set the value of filter
            let url = new URL(window.location.href);
            let event_type = url.searchParams.get("event");
            let state = url.searchParams.get("location");
            let sort = url.searchParams.get("sort");
            let date = url.searchParams.get("date");

            if (event_type) {
                $("#event-type-filter").val(event_type);
            }

            if (state) {
                $("#location-filter").val(state);
            }

            if (sort) {
                $("#sort-btn").addClass("active");
            }

            if (date) {
                $("#date-filter").val(date);
            }
        });

    //update event status
    $(".event-status").click(function () {
        let status = $(this).attr("id");
        let event_id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: "php/event.php",
            data: {
                event_id: event_id,
                status: status
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = "event.php";
                } else {
                    console.error("Update failed");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed: " + error);
            }
        });
    });

});

function displayImages() {
    let images = "";
    imagesArray.forEach((image, index) => {
        images += `
        <div class="col-span-4">
            <img src="${URL.createObjectURL(image)}" alt="image" class="img-thumbnail">
            <span onclick="deleteImage(${index})" style="cursor: pointer;">&times;</span>
        </div>
    `;
    });
    $("#preview").html(images);
}

function deleteImage(index) {
    imagesArray.splice(index, 1);
    displayImages();

    // Update the file input with the new array of files
    const fileInput = document.getElementById('upload-img');
    const dataTransfer = new DataTransfer();
    imagesArray.forEach(file => {
        dataTransfer.items.add(file);
    });
    fileInput.files = dataTransfer.files;
}


function updateBookmark(saved, event_id) {
    console.log(saved);
    $.ajax({
        type: "POST",
        url: "php/event.php",
        data: {
            event_id: event_id,
            bookmark: saved
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                // console.log(response);
                window.location.href = "event.php";
            } else {
                console.error("Update failed");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed: " + error + status, xhr);
        }
    });
}