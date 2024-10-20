let imagesArray = [];

$(document).ready(function () {
    $("#article-btn").click(function () {
        $("#article-modal").css("display", "block");
    });

    $(".read-more-btn").click(function () {
        $("#read-more-modal").css("display", "block");
        let article_id = $(this).attr("data-id");

        $.ajax({
            type: "GET",
            url: "php/article.php",
            dataType: "json",
            data: { article_id: article_id },
            success: function (response) {
                if (response) {
                    renderReadMore(response);
                } else {
                    console.error("Get article failed");
                }
            },
            error: function () {
                console.error("AJAX request failed");
            }
        });
    });

    fetch("js/data.json")
        .then(response => response.json())
        .then(data => {
            data.articleCategory.forEach(category => {
                $("#category").append(`<option value="${category.value}">${category.label}</option>`);
                $("#category-filter").append(`<option value="${category.value}">${category.label}</option>`);
            });

            $("#sort-btn").click(function () {
                $("#sort").val(true);
                $("#filter-form").submit();
            });

            $("#category-filter, #date-filter").on("change", function () {
                $("#filter-form").submit();
            });

            //get data from url and set the value of filter
            let url = new URL(window.location.href);
            let sort = url.searchParams.get("sort");
            let date = url.searchParams.get("date");
            let category = url.searchParams.get("category");

            if (sort == "true") {
                $("#sort-btn").addClass("active");
            }

            if(category){
                $("#category-filter").val(category);
            }

            if (date) {
                $("#date-filter").val(date);
            }
        });

    $(".close").click(function () {
        $("#article-modal").css("display", "none");
        $("#read-more-modal").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target.id == "article-modal") {
            $("#article-modal").css("display", "none");
        } else if (event.target.id == "read-more-modal") {
            $("#read-more-modal").css("display", "none");
        }
    });

    $("#upload-img").on('input', function () {
        const files = this.files;
        imagesArray = Array.from(files);
        displayImages();
    });

    //update article status
    $(".article-status").click(function () {
        let status = $(this).attr("id");
        let article_id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: "php/article.php",
            data: {
                article_id: article_id,
                status: status,
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = "article.php";
                } else {
                    console.error("Update failed");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed: " + error);
            }
        });
    });

    limitWords();
    gallery();
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

function limitWords() {
    let maxWords = 40;

    $(".preview-des").each(function () {
        let text = $(this).text();
        let words = text.split(" ");

        if (words.length > maxWords) {
            let truncatedText = words.slice(0, maxWords).join(" ") + "...";
            $(this).text(truncatedText);
        }
    });
}

function renderReadMore(data) {
    let images = "";
    let imagesArray = data.images.split(",");

    imagesArray.forEach((image, index) => {
        images += `
            <div class="carousel_item fade">
                <img src="${image}" alt="image" class="img-fluid">
            </div>
        `;

    });

    $(".carousel").html(images);
    $(".carousel").append(`
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    `);
    $("#read-more-title").text(data.title);
    $("#read-more-category").text(data.category);
    $("#read-more-content").text(data.description);
    $("#read-more-created-at").text(data.created_at);
    $("#read-more-created-by").text(data.created_by);

    showSlides(1);
}

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("carousel_item");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}