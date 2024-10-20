$(document).ready(function () {
    const daysTag = $(".days"),
        currentDate = $(".current-date"),
        prevNextIcon = $(".icons span");

    let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();

    const months = ["January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"];

    const renderCalendar = (bookmarkedDates) => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
            lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
            lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
            lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();

        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) {
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) {
            let isBookmarked = false;
            let event_id = null;

            for (const bookmarkedDate of bookmarkedDates) {
                if (bookmarkedDate.date === `${currYear}-${String(currMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`) {
                    isBookmarked = true;
                    event_id = bookmarkedDate.event_id;
                    break;
                }
            }

            let isBookmark = isBookmarked ? "active" : "";
            liTag += `<li class="${isBookmark}" onclick = "getEvent(${event_id});">${i}</li>`;
        }

        for (let i = lastDayofMonth; i < 6; i++) {
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
        }

        currentDate.text(`${months[currMonth]} ${currYear}`);
        daysTag.html(liTag);
    };


    getUserBookmark();

    prevNextIcon.on("click", function () {
        currMonth = this.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }

        getUserBookmark();
    });

    function getUserBookmark() {
        $.ajax({
            type: "GET",
            url: "php/event.php",
            dataType: "json",
            data: { get_bookmark: 1 },
            success: function (response) {
                if (response) {
                    renderCalendar(response);
                } else {
                    console.error("Get bookmark failed");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", error);
            }
        });
    }
    
});

function getEvent(event_id){
    if (event_id === null) {
        $("#event-detail").hide();
        return;
    }

    $("#event-detail").show();
    $.ajax({
        type: "GET",
        url: "php/event.php",
        dataType: "json",
        data: { event_id: event_id },
        success: function (response) {
            if (response) {
                let event = response[0];
                $("#event-title").text(event.title);
                $("#event-description").text(event.description);
                $("#event-type").text(event.event_type);
                $("#start-date").text(event.start_date);
                $("#end-date").text(event.end_date);
                $("#location").text(event.city);
            } else {
                console.error("Get event failed");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
}