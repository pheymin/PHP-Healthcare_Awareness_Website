<?php
require_once "dbConfig.php";
session_start();

if (isset($_POST['add-news'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $images = uploadFiles($_FILES['images']);
    $images = implode(", ", $images);
    $created_by = $_SESSION['id'];

    $sql = "INSERT INTO news (title, description, images, created_by) 
            VALUES ('$title', '$description', '$images', '$created_by')";

    if ($db->query($sql)) {
        echo "<script>alert('News created successfully')</script>";
        header("Location: ../news.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "')</script>";
    }
}

if(isset($_GET['news_id'])){
    $news_id = $_GET['news_id'];
    $sql = "SELECT * FROM news WHERE news_id = '$news_id'";
    $result = $db->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $created_by = $row['created_by'];
        $sql2 = "SELECT * FROM admin WHERE admin_id = '$created_by'";
        $result2 = $db->query($sql2);
        $row2 = $result2->fetch_assoc();
        $data = [
            'success' => true,
            'title' => $row['title'],
            'description' => $row['description'],
            'images' => $row['images'],
            'created_by' => $row2['first_name'] . " " . $row2['last_name'],
            'created_at' => $row['created_at']
        ];
        echo json_encode($data);
    } else {
        $data = ['success' => false];
        echo json_encode($data);
    }
}

function uploadFiles($files)
{
    $uploadedFiles = [];

    foreach ($files['name'] as $key => $name) {
        $target_dir = "../images/news/";
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
                $uploadedFiles[] = "images/news/" . basename($name);
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
    }

    return $uploadedFiles;
}
