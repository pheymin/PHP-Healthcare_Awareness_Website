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

function getSchedule(date) {
    $("#date").val(date);
    $("#doc-id").val(doc_id);

    //add active class on selected date
    $(".days li").removeClass("active");
    selected_date = date.split("-")[2];
    selected_date = selected_date.replace(/^0+/, '');
    $(`.days li:contains('${selected_date}'):eq(0)`).addClass("active");

    $.ajax({
        type: "GET",
        url: "php/online_consult.php",
        dataType: "json",
        data: { date: date, doctor_id: doc_id },
        success: function (response) {
            if (response) {
                renderSlots(response);
            } else {
                console.error("Get schedule failed");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
}

function renderSlots(bookedSlots) {
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

    const bookedSlotNumbers = bookedSlots.map(slot => slot.slot);

    // Filter available slots
    const availableSlots = slots.filter(slot => !bookedSlotNumbers.includes(slot.slot));

    if(availableSlots.length > 0){
        $(".empty").hide();
        $(".available-slot").show();
        $(".slot-container").html("");
        availableSlots.forEach(slot => {
            $(".slot-container").append(`
                <div class="slot">
                    <input type="radio" name="slot" value="${slot.slot}" id="slot-${slot.slot}">
                    <label for="slot-${slot.slot}">${slot.time}</label>
                </div>
            `);
        });
    }else{
        $(".empty").show();
        $(".available-slot").hide();
    }
}