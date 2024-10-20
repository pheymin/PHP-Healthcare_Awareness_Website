<?php

require_once "dbConfig.php";

if(isset($_POST['submit'])) {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['region'];
    $postal_code = $_POST['postal-code'];

    if($_POST['acc-type'] == 'member'){
        if(!validateEmail($email, $db, 'visitor')){
            echo "<script>alert('Email already exists')</script>";
            return;
        }   
        $sql = "INSERT INTO visitor (first_name, last_name, email, phone_number, password, street, city, state, postcode) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password', '$street', '$city', '$state', '$postal_code')";
    } else if($_POST['acc-type'] == 'doctor'){
        if(!validateEmail($email, $db, 'doctor')){
            echo "<script>alert('Email already exists')</script>";
            return;
        }
        $speciality = $_POST['speciality'];
        $medical_degree = $_POST['medical-degree'];
        $language = $_POST['language'];
        $sql = "INSERT INTO doctor (first_name, last_name, email, phone_number, password, street, city, state, postcode, speciality, medical_degree, language) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password', '$street', '$city', '$state', '$postal_code', '$speciality', '$medical_degree', '$language')";
    }
    
    if ($db->query($sql)) {
        echo "<script>alert('Account created successfully')</script>";
        header("Location: ../login.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "')</script>";
    }
}

function validateEmail($email, $db, $table){
    $sql = "SELECT * FROM $table WHERE email = '$email'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}
?>