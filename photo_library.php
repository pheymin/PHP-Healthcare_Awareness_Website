<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/photo_library.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Photo Library</h1>
        </div>
    </div>

    <div class="mb-12">
        <div class="carousel">
            <div class="carousel_item fade"><img src="images/photo_library/photo-1.jpg" alt="image" class="img-fluid"></div>
            <div class="carousel_item fade"><img src="images/photo_library/photo-2.jpg" alt="image" class="img-fluid"></div>
            <div class="carousel_item fade"><img src="images/photo_library/photo-3.jpg" alt="image" class="img-fluid"></div>
            <div class="carousel_item fade"><img src="images/photo_library/photo-4.jpg" alt="image" class="img-fluid"></div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="js/photo_library.js"></script>
</body>

</html>