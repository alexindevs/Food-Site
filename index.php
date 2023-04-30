<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant App</title>
    <link rel="stylesheet" href="public/css/landing.scss">
</head>
<body>
<?php include("includes/templates/navbar.php"); ?>
<?php 
include "include_all.php";
include INC_DIR . "process/p-landing.php";

?>
<section id="featured">
    <?php foreach($featuredItems as $item): ?>
        <div class="item">
            <img class="image" src="<?php echo "public/images/" . $item['image']; ?>" alt="">
            <div class="details">
                <h2 class="name">Welcome To CRAVINGS N' MORE!</h2>
                <!-- <p class="category"><?php #  echo $item['category']; ?></p> -->
                <p class="description">Here you'll find the most delectable meals! They smell SO nice, taste SO good, and we're sure you'll always want more. We're located at 60, Idimu Road, Egbeda Lagos AND this website! Now, you can order food from the comfort of your home. Sign up now to get started!</p>
                <button class="btn btn-secondary" onclick="window.location.href='signup.php'">Sign Up Now</button>
            </div>
        </div>
    <?php endforeach; ?>

</div>
    </section>
<!-- 
<h2 class="title">Nigeria's Most Common Dish</h2>
<div class="menu-ctg" id="rice">
    <?php # foreach($RiceMeals as $item): ?>
        <div class="item">
            <img class="image" src="<?php # echo "public/images/" . $item['image']; ?>" alt="">
            <div class="details">
                <h2 class="name"><?php # echo $item['name']; ?></h2>
                <p class="category"><?php # echo $item['category']; ?></p>
                <p class="description"><?php # echo $item['description']; ?></p>
                <p class="price"><b><?php # echo $item['price']; ?></b></p>
                <button class="add">+</button>
            </div>
        </div>
    <?php # endforeach; ?>

</div>
<h2 class="title">Energy To Start The Day</h2>
<div class="menu-ctg" id="breakfast">
    <?php # foreach($BreakfastMeals as $item): ?>
        <div class="item">
            <img class="image" src="<?php # echo "public/images/" . $item['image']; ?>" alt="">
            <div class="details">
                <h2 class="name"><?php # echo $item['name']; ?></h2>
                <p class="category"><?php # echo $item['category']; ?></p>
                <p class="description"><?php # echo $item['description']; ?></p>
                <p class="price"><b><?php # echo $item['price']; ?></b></p>
                <button class="add">+</button>
            </div>
        </div>
    <?php # endforeach; ?>

</div> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentSlide = 0;
const slides = document.querySelectorAll('.item');
slides[currentSlide].classList.add('active');

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

setInterval(nextSlide, 8000); // advance to next slide every 9 seconds

  


});
    </script>

</body>
</html>

