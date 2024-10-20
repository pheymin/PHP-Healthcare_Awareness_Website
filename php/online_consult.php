<?php

require_once "dbConfig.php";
session_start();

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    if (isset($_GET['doctor_id'])) {
        $doctor_id = $_GET['doctor_id'];
        $sql = "SELECT * FROM consultation WHERE doctor_id = '$doctor_id' AND date = '$date'";
    } else {
        $doctor_id = $_SESSION['id'];
        $sql = "SELECT v.*, c.* FROM consultation c, visitor v WHERE c.doctor_id = '$doctor_id' AND c.date = '$date' AND c.visitor_id = v.visitor_id";
    }

    $result = $db->query($sql);

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $slot = $_POST['slot'];
    $doctor_id = $_POST['doc_id'];
    $visitor_id = $_SESSION['id'];

    $sql = "INSERT INTO consultation (date, slot, doctor_id, visitor_id) 
            VALUES ('$date', '$slot', '$doctor_id', '$visitor_id')";

    if ($db->query($sql)) {
        echo "<script>alert('Consultation created successfully');window.location.href='../online_consult.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "')</script>";
    }
}
