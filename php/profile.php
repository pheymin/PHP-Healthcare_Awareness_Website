<?php
require_once "dbConfig.php";
session_start();

if(isset($_POST['update-profile'])){
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['postal-code'];

    //base on user role, update different table
    if($_SESSION['acc_type'] == "member"){
        $sql = "UPDATE visitor SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', password = '$password', street = '$street', city = '$city', state = '$state', postcode = '$zip' WHERE visitor_id = '" . $_SESSION['id'] . "'";
    } else if ($_SESSION['acc_type'] == "doctor"){
        $sql = "UPDATE doctor SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', password = '$password', street = '$street', city = '$city', state = '$state', postcode = '$zip' WHERE doctor_id = '" . $_SESSION['id'] . "'";
    } else if ($_SESSION['acc_type'] == "admin"){
        $sql = "UPDATE admin SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', password = '$password', street = '$street', city = '$city', state = '$state', postcode = '$zip' WHERE admin_id = '" . $_SESSION['id'] . "'";
    }

    $result = $db->query($sql);
    if($result){
        echo "<script>alert('Profile updated successfully!')</script>";
    } else {
        echo "<script>alert('Profile updated failed!')</script>";
    }

    header("Location: ../profile.php");
}
?>