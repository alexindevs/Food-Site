<?php
include "../../include_all.php";

// Handle user login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Authenticate user
    $authenticatedUser = User::login($email, $password);

    if ($authenticatedUser) {
        
        header("Location: ../../dashboard.php");
    } else {
        // Invalid credentials, show error message
        $error = "Invalid email or password. You sure you have an account?";
        echo $error;
    }
}
