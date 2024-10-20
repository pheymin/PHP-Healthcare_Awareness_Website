<?php

require_once "dbConfig.php";
session_start();

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $visitor_id = $_SESSION['id'];

    $sql = "INSERT INTO visitor_coupon (coupon_id, visitor_id) VALUES ('$id', '$visitor_id')";

    //deduct visitor point
    $sql2 = "UPDATE visitor SET point = point - (SELECT point FROM coupon WHERE coupon_id = '$id') WHERE visitor_id = '$visitor_id'";

    if ($db->query($sql) && $db->query($sql2)) {
        echo "success";
    } else {
        echo "failed";
    }
}
?>