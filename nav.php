<?php
require_once "php/dbConfig.php";

session_start();
?>

<nav>
    <div class="logo">
        <a href="index.php">
            <img src="images/logo.png" alt="Logo" />
        </a>
    </div>
    <div class="nav-links">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['email'])) { ?>
                <li><a href="news.php">News</a></li>
                <li><a href="article.php">Article</a></li>
                <li><a href="event.php">Event</a></li>
                <li><a href="online_consult.php">Online Consultation</a></li>
            <?php } ?>
            <?php if (!isset($_SESSION['acc_type']) || ($_SESSION['acc_type'] != 'doctor' && $_SESSION['acc_type'] != 'admin')) { ?>
                <li><a href="donate.php">Donate</a></li>
            <?php } ?>
            <li><a href="photo_library.php">Photo Library</a></li>
            <li><a href="about.php">About</a></li>
            <?php if (!isset($_SESSION['email'])) { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php } ?>
            <?php if (isset($_SESSION['email'])) { ?>
                <li><a class="btn btn-square" href="profile.php"><i class="fas fa-user"></i></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>