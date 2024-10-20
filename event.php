<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/event.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>

    <!-- Add event modal -->
    <div id="event-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="mb-12"><span>Host Event</span></h2>
            <form action="php/event.php" method="POST" enctype="multipart/form-data">
                <div class="grid grid-container mb-12">
                    <div class="col">
                        <label for="title">Title</label>
                        <div class="mt-2">
                            <input id="title" name="title" type="text" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="description">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <label for="event-type">Event Type</label>
                        <div class="mt-2">
                            <select id="event-type" name="event-type" required></select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="start-date">Start Date</label>
                        <div class="mt-2">
                            <input id="start-date" name="start-date" type="date" required>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="end-date">End Date</label>
                        <div class="mt-2">
                            <input id="end-date" name="end-date" type="date" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="street">Street</label>
                        <div class="mt-2">
                            <input id="street" name="street" type="text" required>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="city">City</label>
                        <div class="mt-2">
                            <input id="city" name="city" type="text" required>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="state">State</label>
                        <div class="mt-2">
                            <select id="state" name="state" required></select>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="postcode">Postcode</label>
                        <div class="mt-2">
                            <input id="postcode" name="postcode" type="text" required pattern="\d{5}" title="ZIP/Postal code must have 5 digits">
                        </div>
                    </div>

                    <div class="col">
                        <label for="upload-img">Upload Event Image</label>
                        <input id="upload-img" name="images[]" type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg" required>
                        <output id="preview" class="flex flex-wrap space-x-4"></output>
                    </div>

                    <div class="col">
                        <label for="upload-file">Upload Additional File</label>
                        <input id="upload-file" name="files[]" type="file" multiple="multiple" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                </div>

                <div class="flex">
                    <button id="add-event-btn" name="add-event" class="btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Header -->
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Event</h1>
        </div>
    </div>

    <!-- Search Bar -->
    <form action="event.php" method="GET">
        <div class="center container flex mb-3">
            <input type="text" name="search" id="search" class="me-3">
            <button id="search-btn" name="search-btn" class="btn-secondary" type="submit">Search</button>
        </div>
    </form>

    <!-- Filter -->
    <form id="filter-form" action="event.php" method="GET">
        <div class="container grid grid-container mb-6">
            <button id="sort-btn" class="space-x-2 col-span-3 bg-white"><span>A-Z</span><i class="fas fa-sort"></i></button>
            <input name="sort" id="sort" type="hidden" value="false">
            <select id="event-type-filter" class="col-span-3" name="event">
                <option value="" disabled selected>Select Event Type</option>
            </select>

            <select id="location-filter" class="col-span-3" name="location">
                <option value="" disabled selected>Select Location</option>
            </select>

            <div class="col-span-3">
                <input id="date-filter" type="date" name="date">
            </div>
        </div>
    </form>

    <!-- Event List -->
    <div class="container">
        <?php
        $sql = "SELECT * FROM event WHERE 1";

        if (!isset($_SESSION['acc_type']) || ($_SESSION['acc_type'] == 'member' || $_SESSION['acc_type'] == 'doctor')) {
            $sql .= " AND status = 'Approved'";
        }

        if (isset($_GET['search']) && $_GET['search'] != "") {
            $search = $_GET['search'];
            $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%' OR event_type LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%' OR street LIKE '%$search%' OR city LIKE '%$search%' OR state LIKE '%$search%' OR postcode LIKE '%$search%')";
        }

        if (isset($_GET['event']) && $_GET['event'] != "") {
            $event = $_GET['event'];
            $sql .= " AND event_type = '$event'";
        }

        if (isset($_GET['location']) && $_GET['location'] != "") {
            $location = $_GET['location'];
            $sql .= " AND state = '$location'";
        }

        if (isset($_GET['date']) && $_GET['date'] != "") {
            $date = $_GET['date'];
            $sql .= " AND (start_date = '$date' OR end_date = '$date')";
        }

        if (isset($_GET['sort']) && $_GET['sort'] == "true") {
            $sql .= " ORDER BY title ASC";
        }

        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) {
            $images = explode(', ', $row['images']);
            $image = $images[0];
        ?>
            <div class="list">
                <div class="flex p-2 center">
                    <img src="<?php echo $image ?>" alt="thumbnail" class="rounded-md">
                </div>
                <div>
                    <h2><?php echo $row['title']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <div class="flex space-x-4">
                        <div>
                            <h5>Event Type</h5>
                            <p><?php echo $row['event_type']; ?></p>
                        </div>
                        <div>
                            <h5>Start Date</h5>
                            <p><?php echo $row['start_date']; ?></p>
                        </div>
                        <div>
                            <h5>End Date</h5>
                            <p><?php echo $row['end_date']; ?></p>
                        </div>
                    </div>
                    <div>
                        <h5>Event Location</h5>
                        <p><?php echo $row['street'] . ", " . $row['postcode']; ?><br>
                            <?php echo $row['city'] . ", " . $row['state']; ?></p>
                    </div>
                    <?php if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'member') {
                        $eventId = $row['event_id'];

                        $sql2 = "SELECT * FROM visitor_event WHERE visitor_id = '$_SESSION[id]' AND event_id = '$eventId'";
                        $result2 = $db->query($sql2);
                        $isEventSaved = $result2->num_rows > 0;
                    ?>
                        <span>
                            <i id="save-btn" class="<?php echo $isEventSaved ? 'fas' : 'far'; ?> fa-bookmark" onclick="updateBookmark(<?php echo json_encode($isEventSaved) ?>, <?php echo $eventId; ?>)"></i>
                        </span>
                    <?php } else if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'admin') { ?>
                        <p class="status inline-block rounded-pill py-1 px-4"><?php echo $row['status'] ?></p>
                        <?php if ($row['status'] == "Pending") { ?>
                            <span>
                                <button id="Approved" class="event-status btn btn-square" data-id="<?php echo $row['event_id'] ?>"><i class="fas fa-check"></i></button>
                            </span>
                            <span>
                                <button id="Rejected" class="event-status btn btn-square" data-id="<?php echo $row['event_id'] ?>"><i class="fas fa-times"></i></button>
                            </span>
                    <?php }
                    } ?>
                </div>
            </div>
        <?php } ?>

        <?php if ($result->num_rows == 0) { ?>
            <div class="flex flex-col center">
                <img src="images/empty.png" alt="" style="width: 20%;">
                <h2 class="mt-4">No event found</h2>
            </div>
        <?php } ?>

    </div>

    <!-- Add event button -->
    <?php if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'member') { ?>
        <div class="container flex mb-6">
            <button id="event-btn" class="btn-secondary ml-auto">Host Event</button>
        </div>
    <?php } ?>
    <?php include "footer.php"; ?>
    <script src="js/event.js"></script>
</body>

</html>