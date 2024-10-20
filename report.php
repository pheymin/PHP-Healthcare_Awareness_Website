<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/report.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php";
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
    if ($_SESSION['acc_type'] != 'admin') {
        header("Location: index.php");
        exit();
    } ?>

    <!-- Header -->
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Report</h1>
        </div>
    </div>

    <div class="container mt-5">
        <div class="flex mb-6 tab-group">
            <button id="donation-btn" class="tab active" onclick="openReport('donation')">Donation</button>
            <button id="feedback-btn" class="tab" onclick="openReport('feedback')">Feedback</button>
        </div>

        <!-- donation -->
        <div id="donation" class="table-wrap">
            <table class="sortable">
                <thead>
                    <tr>
                        <th><button>Donation ID<span aria-hidden="true"></span></button></th>
                        <th><button>Event<span aria-hidden="true"></span></button></th>
                        <th><button>Donator<span aria-hidden="true"></span></button></th>
                        <th aria-sort="ascending"><button>Donation Type<span aria-hidden="true"></span></button></th>
                        <th aria-sort="ascending"><button>Amount (RM)<span aria-hidden="true"></span></button></th>
                        <th aria-sort="ascending"><button>Payment Method<span aria-hidden="true"></span></button></th>
                        <th aria-sort="ascending"><button>Created at<span aria-hidden="true"></span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT d.donation_id, e.title, d.donation_type, d.amount, d.donator, d.payment_method, d.created_at FROM donation d INNER JOIN event e ON d.event_id = e.event_id";
                    $result = $db->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['donation_id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['donator'] ?></td>
                            <td><?php echo $row['donation_type'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['payment_method'] ?></td>
                            <td><?php echo $row['created_at'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- feedback -->
        <div id="feedback" class="table-wrap" style="display:none">
            <table class="sortable">
                <thead>
                    <tr>
                        <th><button>Feedback Id<span aria-hidden="true"></span></button></th>
                        <th><button>User Name<span aria-hidden="true"></span></button></th>
                        <th><button>User Type<span aria-hidden="true"></span></button></th>
                        <th><button>Title<span aria-hidden="true"></span></button></th>
                        <th><button>Description<span aria-hidden="true"></span></button></th>
                        <th aria-sort="ascending"><button>Created at<span aria-hidden="true"></span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM feedback";
                    $result = $db->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $user_id = $row['user_id'];
                        $user_type = $row['user_type'];

                        // Fetch user details based on user_type and user_id
                        if ($user_type == 'visitor') {
                            $sql2 = "SELECT first_name, last_name FROM visitor WHERE visitor_id = '$user_id'";
                        } elseif ($user_type == 'doctor') {
                            $sql2 = "SELECT first_name, last_name FROM doctor WHERE doctor_id = '$user_id'";
                        }

                        // Execute the user details query
                        $result2 = $db->query($sql2);
                        $userDetails = $result2->fetch_assoc();

                        // Output the table row with feedback and user details
                    ?>
                        <tr>
                            <td><?php echo $row['feedback_id'] ?></td>
                            <td><?php echo $userDetails['first_name'] . " " . $userDetails['last_name'] ?></td>
                            <td><?php echo $user_type ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['created_at'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="js/sort_table.js"></script>
    <script>
        function openReport(type) {
            $(".table-wrap").hide();
            $(".tab").removeClass("active");
            $("#" + type).show();
            $("#"+ type+"-btn").addClass("active");
        }
    </script>
</body>

</html>