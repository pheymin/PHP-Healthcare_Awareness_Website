<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Consult</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/online_consult.css" rel="stylesheet">
    <link href="css/calender.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>

    <!-- Appointment modal -->
    <div id="appointment-modal" class="modal">
        <div class="modal-content" style="width:700px;height:570px;">
            <span class="close">&times;</span>
            <h2 class="mb-12"><span>Book Appointment</span></h2>
            <form action="php/online_consult.php" method="POST" enctype="multipart/form-data" class="row">
                <div>
                    <?php include "calender.php"; ?>
                </div>
                <div class="available-slot-container">
                    <div class="available-slot" style="display:none;">
                        <h4>Available Slot</h4>
                        <div class="slot-container"></div>
                        <div class="flex align-self-end mt-3">
                            <button class="btn-secondary" type="submit" name="submit">Book</button>
                        </div>
                    </div>
                    <div class="empty flex flex-col center">
                        <img src="images/empty.png" alt="not-found" class="w-75">
                        <h2 class="mt-4">No empty slot</h2>
                    </div>
                </div>
                <input type="hidden" id="date" name="date">
                <input type="hidden" id="doc-id" name="doc_id">
            </form>
        </div>
    </div>

    <!-- Header -->
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Online Consultation</h1>
        </div>
    </div>

    <!-- Search Bar -->
    <form action="online_consult.php" method="GET">
        <div class="center container flex mb-3">
            <input type="text" name="search" id="search" class="me-3" placeholder="Search...">
            <button id="search-btn" name="search-btn" class="btn-secondary" type="submit">Search</button>
        </div>
    </form>

    <!-- Filter -->
    <form id="filter-form" action="online_consult.php" method="GET">
        <div class="container grid grid-container mb-6">
            <button id="sort-btn" class="space-x-2 col-span-3 bg-white"><span>A-Z</span><i class="fas fa-sort"></i></button>
            <input name="sort" id="sort" type="hidden" value="false">

            <select id="specialist-filter" class="col-span-6" name="specialist">
                <option value="" selected disabled>Select Specialist</option>
                <option value="General Practitioner">General Practitioner</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                <option value="Oncologist">Oncologist</option>
            </select>

            <select id="language-filter" class="col-span-3" name="language">
                <option value="" selected disabled>Select Language</option>
                <option value="Malay">Malay</option>
                <option value="English">English</option>
                <option value="Mandarin">Mandarin</option>
            </select>
        </div>
    </form>

    <!-- Doctor List -->
    <div class="container">
        <div class="grid grid-container py-6">
            <?php
            $sql = "SELECT * FROM doctor WHERE 1";

            if (isset($_GET['search']) && $_GET['search'] != "") {
                $search = $_GET['search'];
                $sql .= " AND first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR speciality LIKE '%$search%' OR language LIKE '%$search%'";
            }

            if (isset($_GET['specialist']) && $_GET['specialist'] != "") {
                $specialist = $_GET['specialist'];
                $sql .= " AND speciality = '$specialist'";
            }

            if (isset($_GET['language']) && $_GET['language'] != "") {
                $language = $_GET['language'];
                $sql .= " AND language = '$language'";
            }

            if (isset($_GET['sort']) && $_GET['sort'] == "true") {
                $sql .= " ORDER BY first_name ASC";
            }

            $result = $db->query($sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="card col-span-3">
                    <div class="flex center">
                        <img class="avatar" src="<?php echo $row['avatar'] ?>" alt="avatar">
                    </div>
                    <div>
                        <h3><?php echo $row['first_name'] . " " . $row['last_name']; ?></h3>
                        <h5>Speciality</h5>
                        <p><?php echo $row['speciality']; ?></p>
                        <h5>Language</h5>
                        <p><?php echo $row['language']; ?></p>
                        <h5>Medical Degree</h5>
                        <p><?php echo $row['medical_degree']; ?></p>
                    </div>
                    <?php if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'member') { ?>
                        <div>
                            <button class="book-btn btn-secondary w-full" doc-id="<?php echo $row['doctor_id']; ?>">Book Appointment</button>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php if ($result->num_rows == 0) { ?>
            <div class="flex flex-col center">
                <img src="images/empty.png" alt="" style="width: 20%;">
                <h2 class="mt-4">No doctor found</h2>
            </div>
        <?php } ?>
    </div>

    <script src="js/online_consult.js"></script>
    <script src="js/appointment.js"></script>
    <!-- <script type="module" src="js/online_consult.js"></script>
    <script type="module" src="js/appointment.js"></script> -->
</body>

</html>