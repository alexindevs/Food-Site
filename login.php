<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="public/css/signup.css">
</head>
<body>
<?php include("includes/templates/navbar.php"); ?>

    <form action="includes/process/p-login.php" class="register" method="post">
        <h1>Login</h1>
        <div class="input-group">
            <label for="email">Enter Email:</label>
            <input type="email" name="email" id="email">
            <label for="password">Enter Your Password:</label>
            <input type="password" name="password" id="password"><i class="far fa-eye" id="togglePassword"></i>
        
        </div>
        <div class="button">
        <input type="submit" role="submit" name="signup" class="submit" value="Sign In">
</div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const togglePassword = $('#togglePassword');
password = $('#password');

togglePassword.on('click', function(e) {

  const type = password.attr('type') === 'password' ? 'text' : 'password';
  password.attr('type', type);
  $(this).toggleClass('fa-eye-slash fa-eye');
});
    </script>
</body>
</html>

