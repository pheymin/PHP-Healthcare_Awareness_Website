let doc_id = null;
$(document).ready(function () {
    $(".book-btn").click(function () {
        $("#appointment-modal").css("display", "block");
        doc_id = $(this).attr("doc-id");
    });
    $(".close").click(function () {
        $("#appointment-modal").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target.id == "event-modal") {
            $("#appointment-modal").css("display", "none");
        }
    });

    $("#sort-btn").click(function () {
        $("#sort").val(true);
        $("#filter-form").submit();
    });

    $("#specialist-filter, #language-filter").on("change", function () {
        $("#filter-form").submit();
    });

    //get data from url and set the value of filter
    let url = new URL(window.location.href);
    let specialist = url.searchParams.get("specialist");
    let language = url.searchParams.get("language");
    let sort = url.searchParams.get("sort");

    if (specialist) {
        $("#specialist-filter").val(specialist);
    }

    if (language) {
        $("#language-filter").val(language);
    }

    if (sort) {
        $("#sort-btn").addClass("active");
    }
});