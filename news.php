<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/news.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>

    <!-- Add news modal -->
    <div id="news-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="mb-12"><span>Add News</span></h2>
            <form action="php/news.php" method="POST" enctype="multipart/form-data">
                <div class="grid grid-container mb-12">
                    <div class="col">
                        <label for="title">Title</label>
                        <div class="mt-2">
                            <input id="title" name="title" type="text" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="description">Content</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="col">
                        <label for="upload-img">Upload News Image</label>
                        <input id="upload-img" name="images[]" type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg" required>
                        <output id="preview" class="flex flex-wrap space-x-4"></output>
                    </div>
                </div>

                <div class="flex">
                    <button id="add-news-btn" name="add-news" class="btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Read more modal -->
    <div id="read-more-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="grid grid-container mb-12">
                <div class="col">
                    <div class="carousel"></div>
                    <div class="flex space-x-4">
                        <div>
                            <h5>Published By</h5>
                            <p id="read-more-created-by"></p>
                        </div>
                        <div>
                            <h5>Published At</h5>
                            <p id="read-more-created-at"></p>
                        </div>
                    </div>
                    <h2 id="read-more-title"></h2>
                    <p id="read-more-content"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">News</h1>
        </div>
    </div>

    <!-- Search Bar -->
    <form action="news.php" method="GET">
        <div class="center container flex mb-3">
            <input type="text" name="search" id="search" class="me-3" placeholder="Search...">
            <button id="search-btn" name="search-btn" class="btn-secondary" type="submit">Search</button>
        </div>
    </form>

    <!-- Filter -->
    <form id="filter-form" action="news.php" method="GET">
        <div class="container flex mb-6 justify-between">
            <div>
                <button id="sort-btn" class="space-x-2 bg-white"><span>A-Z</span><i class="fas fa-sort"></i></button>
                <input name="sort" id="sort" type="hidden" value="false">
            </div>

            <div>
                <input id="date-filter" type="date" name="date">
            </div>
        </div>
    </form>

    <!-- News List -->
    <div class="container">
        <?php
        $sql = "SELECT * FROM news WHERE 1";

        if (isset($_GET['search']) && $_GET['search'] != "") {
            $search = $_GET['search'];
            $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
        }

        if (isset($_GET['date']) && $_GET['date'] != "") {
            $date = $_GET['date'];
            $sql .= " AND created_at LIKE '%$date%'";
        }

        if (isset($_GET['sort']) && $_GET['sort'] == "true") {
            $sql .= " ORDER BY title ASC";
        }

        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) {
            $images = explode(', ', $row['images']);
            $image = $images[0];
            $created_by = $row['created_by'];
            $sql2 = "SELECT * FROM admin WHERE admin_id = '$created_by'";
            $result2 = $db->query($sql2);
            $row2 = $result2->fetch_assoc();
        ?>
            <div class="list">
                <div class="flex p-2 center">
                    <img src="<?php echo $image ?>" alt="thumbnail" class="rounded-md">
                </div>
                <div>
                    <h2><?php echo $row['title']; ?></h2>
                    <p class="preview-des"><?php echo $row['description']; ?></p>
                    <div class="mb-12">
                        <buttton class="read-more-btn" data-id="<?php echo $row['news_id']; ?>">Read More</button>
                    </div>
                    <div class="flex space-x-4">
                        <div>
                            <h5>Published By</h5>
                            <p><?php echo $row2['first_name'] . " " . $row2['last_name']; ?></p>
                        </div>
                        <div>
                            <h5>Published At</h5>
                            <p><?php echo $row['created_at']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($result->num_rows == 0) { ?>
            <div class="flex flex-col center">
                <img src="images/empty.png" alt="" style="width: 20%;">
                <h2 class="mt-4">No news found</h2>
            </div>
        <?php } ?>

    </div>

    <!-- Add news button -->
    <?php if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'admin') { ?>
        <div class="container flex mb-6">
            <button id="news-btn" class="btn-secondary ml-auto">Upload News</button>
        </div>
    <?php } ?>
    <?php include "footer.php"; ?>
    <script src="js/news.js"></script>
</body>

</html>