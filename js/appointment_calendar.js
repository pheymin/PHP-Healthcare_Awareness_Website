$(document).ready(function () {
    const daysTag = $(".days"),
        currentDate = $(".current-date"),
        prevNextIcon = $(".icons span");

    let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();

    const months = ["January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"];

    const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
            lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
            lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
            lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();

        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) {
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) {
            let selectedDate = `${currYear}-${String(currMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            let inactiveClass = new Date(selectedDate) < new Date() ? "inactive" : "";
            liTag += `<li class="${inactiveClass}" onclick="getSchedule('${selectedDate}')">${i}</li>`;
        }

        for (let i = lastDayofMonth; i < 6; i++) {
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
        }

        currentDate.text(`${months[currMonth]} ${currYear}`);
        daysTag.html(liTag);
    };

    renderCalendar();

    prevNextIcon.on("click", function () {
        currMonth = this.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }

        renderCalendar();
    });

});

function getSchedule(selectedDate) {
    $("#appointment-detail").show();
    $.ajax({
        type: "GET",
        url: "php/online_consult.php",
        dataType: "json",
        data: { date: selectedDate },
        success: function (response) {
            if (response) {
                renderAppoinment(response);
            } else {
                console.error("Get event failed");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
}

function renderAppoinment(data){
    if(data.length === 0){
        $("#detail").html("No appointment");
        return;
    }
    const slots = [
        { "slot": "1", "time": "09:00 AM - 10:00 AM" },
        { "slot": "2", "time": "10:00 AM - 11:00 AM" },
        { "slot": "3", "time": "11:00 AM - 12:00 PM" },
        { "slot": "4", "time": "01:00 PM - 02:00 PM" },
        { "slot": "5", "time": "02:00 PM - 03:00 PM" },
        { "slot": "6", "time": "03:00 PM - 04:00 PM" },
        { "slot": "7", "time": "04:00 PM - 05:00 PM" },
        { "slot": "8", "time": "05:00 PM - 06:00 PM" }
    ]


    let html = "";
    data.forEach(element => {
        //match slot with time
        let slot = slots.find(slot => slot.slot === element.slot);
        element.time = slot.time;
        html += `<div class="appointment">
                    <h5 class="appointment-time">${element.time}</h5>
                    <div class="appointment-detail">
                        <h5>Patient Name</h5>
                        <p class="appointment-name">${element.first_name} ${element.last_name}</p>
                        <h5>Patient Contact</h5>
                        <p class="appointment-phone">${element.phone_number}</p>
                        <h5>Patient e-mail</h5>
                        <p class="appointment-email">${element.email}</p>
                    </div>
                </div>`;
    });
    
    $("#detail").html(html);
}