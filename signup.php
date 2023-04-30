<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Restaurant App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="public/css/signup.css">
</head>
<body>
<?php include("includes/templates/navbar.php"); ?>

    <form action="includes/process/p-signup.php" class="register" method="post">
        <h1>Sign Up</h1>
        <div class="input-group">
            <label for="name">What's your name?</label>
            <input type="text" name="Name" id="name">
            <p class="error name-error"></p>
            <label for="email">What's your email?</label>
            <input type="email" name="email" id="email">
            <p class="error email-error">Are you sure that's an email?</p>
            <label for="password">Enter Your Password:</label>
            <input type="password" name="password" id="password"><i class="far fa-eye" id="togglePassword"></i>
            <p class="error password-error">Remember, passwords must be at least 8 characters with a letter, special symbol and number!</p>
            <label for="confPassword">Confirm your password: </label>
            <input type="password" name="confPassword" id="confPassword"><i class="far fa-eye" id="toggleConfPassword"></i>
            <p class="error confirm-error">Passwords must match!</p>
        </div>
        <div class="button">
        <input type="submit" role="submit" name="signup" class="submit" value="Sign In">
</div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="public/js/validate.js"></script>
</body>
</html>

