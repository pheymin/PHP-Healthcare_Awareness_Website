<?php
require_once "dbConfig.php";
session_start();

if (isset($_POST['add-article'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $images = uploadFiles($_FILES['images']);
    $images = implode(", ", $images);
    $created_by = $_SESSION['id'];

    $sql = "INSERT INTO article (title, category, description, images, created_by) 
            VALUES ('$title', '$category', '$description', '$images', '$created_by')";

    if ($db->query($sql)) {
        echo "<script>alert('Article created successfully');</script>";
        header("Location: ../article.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "')</script>";
    }
}

if(isset($_GET['article_id'])){
    $article_id = $_GET['article_id'];
    $sql = "SELECT * FROM article WHERE article_id = '$article_id'";
    $result = $db->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $created_by = $row['created_by'];
        $sql2 = "SELECT * FROM doctor WHERE doctor_id = '$created_by'";
        $result2 = $db->query($sql2);
        $row2 = $result2->fetch_assoc();
        $data = [
            'success' => true,
            'title' => $row['title'],
            'category' => $row['category'],
            'description' => $row['description'],
            'images' => $row['images'],
            'created_by' => $row2['first_name'] . " " . $row2['last_name'],
            'created_at' => $row['created_at'],
            'published_at' => $row['published_at'],
        ];
        echo json_encode($data);
    } else {
        $data = ['success' => false];
        echo json_encode($data);
    }
}

if (isset($_POST['article_id']) && isset($_POST['status'])) {
    $article_id = $_POST['article_id'];
    $status = $_POST['status'];
    $date = date('Y-m-d H:i:s');

    $sql = "UPDATE article SET status = '$status', published_at = '$date' WHERE article_id = '$article_id'";

    if ($db->query($sql)) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => $db->error);
        echo json_encode($response);
    }
    exit();
}

function uploadFiles($files)
{
    $uploadedFiles = [];

    foreach ($files['name'] as $key => $name) {
        $target_dir = "../images/article/";
        $target_file = $target_dir . basename($name);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.')</script>";
            $uploadOk = 0;
        }

        // Check file type
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "<script>alert('Sorry, only JPG, JPEG and PNG files are allowed.')</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        } else {
            if (move_uploaded_file($files['tmp_name'][$key], $target_file)) {
                $uploadedFiles[] = "images/article/" . basename($name);
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
    }

    return $uploadedFiles;
}
