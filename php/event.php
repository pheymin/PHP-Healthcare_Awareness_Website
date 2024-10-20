<?php
require_once "dbConfig.php";
session_start();

if (isset($_POST['add-event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_type = $_POST['event-type'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $images = uploadFiles($_FILES['images']);
    $images = implode(", ", $images);
    $files = uploadFiles($_FILES['files']);
    $files = implode(", ", $files);
    $created_by = $_SESSION['id'];

    $sql = "INSERT INTO event (title, description, event_type, start_date, end_date, street, city, state, postcode, images, additional_file, created_by) 
            VALUES ('$title', '$description', '$event_type', '$start_date', '$end_date', '$street', '$city', '$state', '$postcode', '$images', '$files', '$created_by')";

    if ($db->query($sql)) {
        echo "<script>alert('Event created successfully')</script>";
        header("Location: ../event.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "')</script>";
    }
}

if (isset($_POST['event_id']) && isset($_POST['status'])) {
    $event_id = $_POST['event_id'];
    $status = $_POST['status'];

    $sql = "UPDATE event SET status = '$status' WHERE event_id = '$event_id'";

    if ($db->query($sql)) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => $db->error);
        echo json_encode($response);
    }
    exit();
}

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM event WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR event_type LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%' OR street LIKE '%$search%' OR city LIKE '%$search%' OR state LIKE '%$search%' OR postcode LIKE '%$search%'";

    $result = $db->query($sql);
    return $result;
}

if (isset($_GET['get_all'])) {
    $sql = "SELECT * FROM event WHERE 1";

    $result = $db->query($sql);
    $response = array();
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    echo json_encode($response);
}

if (isset($_POST['event_id']) && isset($_POST['bookmark'])) {
    $user_id = $_SESSION['id'];
    $event_id = $_POST['event_id'];
    $bookmark = $_POST['bookmark'];

    if ($bookmark == 'true') {
        $sql = "DELETE FROM visitor_event WHERE visitor_id = '$user_id' AND event_id = '$event_id'";
    } else {
        $sql = "INSERT INTO visitor_event (visitor_id, event_id) VALUES ('$user_id', '$event_id')";
    }

    if ($db->query($sql)) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => $db->error);
        echo json_encode($response);
    }
    exit();
}

if(isset($_GET['get_bookmark'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM visitor_event JOIN event ON visitor_event.event_id = event.event_id WHERE visitor_id = '$user_id'";
    $result = $db->query($sql);
    $response = array();
    while ($row = $result->fetch_assoc()) {
        // $response[] = $row['start_date'];
        $response[] = array('date' => $row['start_date'], 'event_id' => $row['event_id']);
    }

    echo json_encode($response);
}

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "SELECT * FROM event WHERE event_id = '$event_id'";
    $result = $db->query($sql);
    $response = array();
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    echo json_encode($response);
}

function uploadFiles($files)
{
    $uploadedFiles = [];

    foreach ($files['name'] as $key => $name) {
        $target_dir = "../images/event/";
        $target_file = $target_dir . basename($name);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.')</script>";
            $uploadOk = 0;
        }

        // Check file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
        $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG, PDF, DOC, and DOCX files are allowed.')</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        } else {
            if (move_uploaded_file($files['tmp_name'][$key], $target_file)) {
                $uploadedFiles[] = "images/event/" . basename($name);
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
    }

    return $uploadedFiles;
}
