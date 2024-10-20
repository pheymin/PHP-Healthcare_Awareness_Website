let selectedAmount = null;

$(document).ready(function () {
    limitWords();
    createChart();
});

function selectAmount(amount) {
    $(".amount-btn").removeClass("active");
    $("#" + amount).addClass("active");
    selectedAmount = amount;
}

function donate() {
    if (selectedAmount !== null) {
        window.location.href = 'donate.php?amount=' + selectedAmount;
    } else {
        alert('Please select an amount before donating.');
    }
}

function limitWords() {
    let maxWords = 20;

    $(".preview-des").each(function () {
        let text = $(this).text();
        let words = text.split(" ");

        if (words.length > maxWords) {
            let truncatedText = words.slice(0, maxWords).join(" ") + "...";
            $(this).text(truncatedText);
        }
    });
}

function createChart() {
    const xValues = ["HATI", "MAKNA", "Mercy Malaysia", "MyCare"];
    const yValues = [2000, 1500, 1200, 800];
    const barColors = [
        "#A682FF",
        "#715AFF",
        "#5887FF",
        "#55C1FF"
    ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: false,
                text: "Monthly Expenses on Donations to Charities"
            }
        }
    });
}