<?php

session_start();

if (isset($_SESSION['user_id'])) {

    header("Location: ./resources/views/content/index.php");
    exit();
} else {

    header("Location: ./resources/views/auth/login.php");
    exit();
}