<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare 4MYS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>

    <section class="h-screen">
        <img class="w-full" src="images/home_banner.png" alt="Banner">
    </section>

    <!-- news -->
    <section class="container-lg h-screen center-content">
        <div class="rounded bg-white">
            <div class="bg-primary px-4 py-1 rounded-top flex text-white justify-between">
                <h2>News</h2>
                <button class="section-btn" onclick="window.location.href='news.php'"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="grid grid-container px-4 py-6">
                <?php
                $sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4";
                $result = $db->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $images = explode(', ', $row['images']);
                    $image = $images[0];
                ?>
                    <div class="card col-span-3">
                        <div>
                            <img class="img-fluid rounded" src="<?php echo $image ?>" alt="News">
                        </div>
                        <div>
                            <h4><?php echo $row['title']; ?></h4>
                            <p class="preview-des"><?php echo $row['description']; ?></p>
                            <p class="m-0"><?php echo $row['created_at']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section>

    <!-- online consultation -->
    <section class="container-lg h-screen center-content text-white row" style="background-color: #4988ff;">
        <div class="flex">
            <div class="flex flex-col">
                <img class="img-fluid rounded w-75 align-self-end" src="images/appointment-1.jpg" alt="Appoinment">
                <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="images/appointment-2.jpg" alt="Appoinment" style="margin-top: -25%;">
            </div>
        </div>
        <div>
            <p class="pill inline-block border rounded-pill py-1 px-4">Online Consultation</p>
            <h2 class="mb-4">Make An Appointment For Online Consultation</h2>
            <p>At Healthcare4MYS, we are dedicated to providing convenient online consultations with qualified doctors. Take advantage of our virtual healthcare platform to connect with healthcare professionals from the comfort of your home.</p>
            <p>Whether you have health concerns, need medical advice, or seek a prescription renewal, our online consultation services are designed to meet your healthcare needs efficiently.</p>
            <p>Why choose Healthcare4MYS for online consultations?</p>
            <p><i class="far fa-check-circle me-3"></i> Quality health care at your fingertips</p>
            <p><i class="far fa-check-circle me-3"></i> Access to qualified and experienced doctors</p>
            <p><i class="far fa-check-circle me-3"></i> Collaboration with medical research professionals</p>
            <button class="mt-3" onclick="window.location.href='online_consult.php'">Book Online Consultation</button>
        </div>
    </section>

    <!-- event -->
    <section class="container-lg h-screen center-content">
        <div class="rounded bg-white">
            <div class="bg-primary px-4 py-1 rounded-top flex text-white justify-between">
                <h2>Event</h2>
                <button class="section-btn" onclick="window.location.href='event.php'"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="grid grid-container px-4 py-6">
                <?php
                $sql = "SELECT * FROM event WHERE status = 'Approved' ORDER BY created_at DESC LIMIT 4";
                $result = $db->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $images = explode(', ', $row['images']);
                    $image = $images[0];
                ?>
                    <div class="card col-span-3">
                        <div>
                            <img class="img-fluid rounded" src="<?php echo $image ?>" alt="News">
                        </div>
                        <div>
                            <h4><?php echo $row['title']; ?></h4>
                            <p class="preview-des"><?php echo $row['description']; ?></p>
                            <p class="m-0"><?php echo $row['created_at']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section>

    <!-- donation -->
    <section class="container-lg h-screen center-content row">
        <div>
            <p class="inline-block border rounded-pill py-1 px-4">Donation</p>
            <h2 class="mb-4">Supporting Communities through Your Generous Donations</h2>
            <p class="mb-12">At Healthcare4MYS, we appreciate your support in making a difference. Your generous donations help us empower communities by providing inclusive health education and accessible support. Together, we can transform lives and create a positive impact on individuals' well-being.</p>
            <h4>Amount</h4>
            <div class="grid grid-container amount">
                <a id="10" class="amount-btn" onclick="selectAmount(10)">RM10</a>
                <a id="20" class="amount-btn" onclick="selectAmount(20)">RM20</a>
                <a id="50" class="amount-btn" onclick="selectAmount(50)">RM50</a>
                <a id="100" class="amount-btn" onclick="selectAmount(100)">RM100</a>
            </div>
            <button class="mt-3 btn-secondary" onclick="donate()">Donate</button>
        </div>
        <div class="flex">
            <div class="flex flex-col">
                <img class="img-fluid rounded w-75 align-self-end" src="images/donate-2.jpg" alt="Donate">
                <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="images/donate-1.jpg" alt="Donate" style="margin-top: -25%;">
            </div>
        </div>
    </section>

    <section class="h-screen center-content row">
        <div class="bg-white py-6">
            <h3 class="mb-4 center">Monthly Expenses on Donations to Charities</h3>
            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="bg-primary px-4 py-12 text-white">
            <div>
                <p class="pill inline-block border rounded-pill py-1 px-4">Charities/ Organisations</p>
                <h2 class="mb-4">Recognized Charities and Organizations</h2>
                <p class="mb-12">Explore the list of esteemed charities and organizations that officially recognize Healthcare4MYS as a trusted partner. Our collaborations aim to foster positive impacts on community well-being, working hand-in-hand with these entities to make healthcare accessible to all.</p>
                <div class="space-y-4">
                    <div class="row">
                        <div class="flex">
                            <div class="charity me-3"><img src="images/charity-1.png" alt="Charity"></div>
                            <h4>HATI</h4>
                        </div>
                        <div class="flex">
                            <div class="charity me-3"><img src="images/charity-2.png" alt="Charity"></div>
                            <h4>Makna</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="flex">
                            <div class="charity me-3"><img src="images/charity-3.png" alt="Charity"></div>
                            <h4>Mercy Malaysia</h4>
                        </div>
                        <div class="flex">
                            <div class="charity me-3"><img src="images/charity-4.png" alt="Charity"></div>
                            <h4>MyCare</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($_SESSION['acc_type']) && ($_SESSION['acc_type'] == 'doctor' || $_SESSION['acc_type'] == 'member')) { ?>
        <section class="container-lg h-screen center-content text-white row" style="background-color: #4988ff;">
            <div class="flex">
                <div class="flex flex-col">
                    <img class="img-fluid rounded w-75 align-self-end" src="images/feedback-1.jpg" alt="Feedback">
                    <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="images/feedback-2.jpg" alt="Feedback" style="margin-top: -25%;">
                </div>
            </div>
            <div>
                <p class="pill inline-block border rounded-pill py-1 px-4">Feedback</p>
                <form action="php/feedback.php" method="POST">
                    <h2 class="mb-4">We'd Love to Hear From You</h2>
                    <p class="mb-6">At Healthcare4MYS, we value your feedback. We are committed to providing the best healthcare services and support to our community. Your feedback helps us improve our services and create a positive impact on the community's well-being.</p>
                    <div class="mb-3">
                        <label for="title" class="mb-3">Title</label>
                        <input class="input" type="text" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="feedback" class="mb-3">Feedback</label>
                        <textarea class="input" name="feedback" id="feedback" cols="30" rows="10" required></textarea>
                    </div>
                    <button class="mt-3" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </section>
    <?php } ?>

    <?php include "footer.php"; ?>

    <script src="js/index.js"></script>
</body>

</html>