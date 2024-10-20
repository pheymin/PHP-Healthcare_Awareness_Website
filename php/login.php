<?php
require_once "dbConfig.php";
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($_POST['acc-type'] == 'member') {
        $sql = "SELECT * FROM visitor WHERE email = '$email' AND password = '$password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['visitor_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['acc_type'] = 'member';
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }
    } else if ($_POST['acc-type'] == 'doctor') {
        $sql = "SELECT * FROM doctor WHERE email = '$email' AND password = '$password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['doctor_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['acc_type'] = 'doctor';
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }
    } else if ($_POST['acc-type'] == 'admin') {
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['admin_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['acc_type'] = 'admin';
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }
    }
}
?>