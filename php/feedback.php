<?php
require_once "dbConfig.php";
session_start();

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $feedback = $_POST['feedback'];
    $user_id = $_SESSION['id'];
    $user_type = $_SESSION['acc_type'];
    if($user_type == 'member'){
        $user_type = 'visitor';
    }

    $sql = "INSERT INTO feedback (user_id, user_type, title, description) VALUES ('$user_id', '$user_type', '$title','$feedback')";
    $result = $db->query($sql);
    if($result){
        echo "<script>alert('Feedback sent successfully!'); window.location.href = '../index.php';</script>";
    }
    else{
        echo "<script>alert('Failed to send feedback!'); window.location.href = '../index.php';</script>";
    }
}
?>