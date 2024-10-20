<?php
require_once "dbConfig.php";
session_start();

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $other_amount = $_POST['other-amount'];
    $display_name = $_POST['display-name'];
    $event = $_POST['event'];
    $payment = $_POST['payment'];

    if ($amount == null) {
        $amount = $other_amount;
    }

    if ($_SESSION['id']) {
        $visitor_id = $_SESSION['id'];
        $sql = "INSERT INTO donation (donation_type, amount, donator, event_id, payment_method, visitor_id) 
                VALUES ('$type', '$amount', '$display_name', '$event', '$payment', '$visitor_id')";

        //update visitor point, ps: RM1 = 10 point
        $sql2 = "UPDATE visitor SET point = point + '$amount' * 10 WHERE visitor_id = '$visitor_id'";
        $db->query($sql2);
    } else {
        $sql = "INSERT INTO donation (donation_type, amount, donator, event_id, payment_method) 
                VALUES ('$type', '$amount', '$display_name', '$event', '$payment')";
    }

    if ($db->query($sql)) {
        echo "<script>alert('Donation created successfully'); window.location.href='../donate.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "');</script>";
    }    
}
