<?php
session_start();
include "../../include_all.php";

// Handle user signup
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create new User object
    $newUser = new User($email, password_hash($password, PASSWORD_DEFAULT), $name);

    // Save user to database
    $newUser->registerUser();

    // Redirect to login
    header("Location: ../../login.php");
    exit();
}


