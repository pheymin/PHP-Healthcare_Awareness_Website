<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/calender.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <?php
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
    }
    if ($_SESSION['acc_type'] == 'member') {
        $sql = "SELECT * FROM visitor WHERE visitor_id = '" . $_SESSION['id'] . "'";
    } else if ($_SESSION['acc_type'] == 'doctor') {
        $sql = "SELECT * FROM doctor WHERE doctor_id = '" . $_SESSION['id'] . "'";
    } else if ($_SESSION['acc_type'] == 'admin') {
        $sql = "SELECT * FROM admin WHERE admin_id = '" . $_SESSION['id'] . "'";
    }

    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
    ?>
        <div class="container-lg mt-3">
            <div class="row">
                <div class="col-lg-2 border p-2">
                    <div class="center w-full">
                        <div>
                            <img src="<?php echo $row['avatar'] ?>" alt="avatar" class="avatar">
                        </div>
                        <div class="mb-12">
                            <h3><?php echo $row['first_name'] . " " . $row['last_name'] ?></h3>
                            <p><?php echo $row['email'] ?></p>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <button id="update-btn" class="btn-secondary">Update Profile</button>
                            <?php if ($_SESSION['acc_type'] == 'admin') { ?>
                                <button class="btn-secondary" onclick="window.location.href='report.php'">View Report</button>
                            <?php } ?>
                            <?php if ($_SESSION['acc_type'] == 'member') { ?>
                                <button class="btn-secondary" onclick="window.location.href='reward.php'">Reward</button>
                            <?php } ?>
                            <button id="logout-btn">Logout</button>
                        </div>
                    </div>
                </div>
                <div class="border px-4">
                    <form id="profile-form" action="php/profile.php" method="POST">
                        <h2>User Information</h2>
                        <div class="grid grid-container mb-6">
                            <div class="col-span-6">
                                <label htmlFor="first-name">
                                    First Name
                                </label>
                                <div class="mt-2">
                                    <input id="first-name" name="first-name" type="first-name" value="<?php echo $row['first_name'] ?>" required disabled />
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label htmlFor="last-name">
                                    Last Name
                                </label>
                                <div class="mt-2">
                                    <input id="last-name" name="last-name" type="last-name" value="<?php echo $row['last_name'] ?>" required disabled />
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label htmlFor="email">
                                    Email address
                                </label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" required disabled />
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label htmlFor="phone">
                                    Phone Number
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="phone" id="phone" value="<?php echo $row['phone_number'] ?>" required pattern="\d{10,11}" title='Phone number must have 10-11 digits (without "-")' disabled />
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label htmlFor="password">
                                    Password
                                </label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password" value="<?php echo $row['password'] ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character" required disabled />
                                    <span id="toggle-password">
                                        <i class="fa-regular fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col">
                                <label htmlFor="street">
                                    Street address
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="street" id="street" value="<?php echo $row['street'] ?>" required disabled />
                                </div>
                            </div>

                            <div class="col-span-4">
                                <label htmlFor="city">
                                    City
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" value="<?php echo $row['city'] ?>" required disabled />
                                </div>
                            </div>

                            <div class="col-span-4">
                                <label htmlFor="state">
                                    State / Province
                                </label>
                                <div class="mt-2">
                                    <select id="state" name="state" required disabled>
                                        <option value="<?php echo $row['state'] ?>"><?php echo $row['state'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-4">
                                <label htmlFor="postal-code">
                                    ZIP / Postal code
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="postal-code" id="postal-code" value="<?php echo $row['postcode'] ?>" required pattern="\d{5}" title="ZIP/Postal code must have 5 digits" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <button id="submit-btn" name="update-profile" class="btn-secondary mb-6 ml-auto hidden" type="submit">Update</button>
                        </div>
                    <?php } ?>
                    </form>
                </div>
                <?php if ($_SESSION['acc_type'] == 'member') { ?>
                    <?php include "event_calender.php"; ?>
                <?php } ?>
                <?php if ($_SESSION['acc_type'] == 'doctor') { ?>
                    <?php include "appointment_calender.php"; ?>
                <?php } ?>
            </div>

        </div>
        <script src="js/profile.js"></script>
        
</body>

</html>