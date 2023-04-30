<?php 
$menu = new Menu();
$items = $menu->getFeaturedItems();

$featuredItems = array();
foreach($items as $item) {
    $featuredItems[] = array(
        'name' => $item->getName(),
        'category' => $item->getCategory(),
        'price' => $item->getPrice(),
        'description' => $item->getDescription(),
        'image' => $item->getImage()
    );
}


// $items = $menu->getItemsByCategory("Rice");
// $RiceMeals = array();

// foreach($items as $item) {
//     $RiceMeals[] = array(
//         'name' => $item->getName(),
//         'category' => $item->getCategory(),
//         'price' => $item->getPrice(),
//         'description' => $item->getDescription(),
//         'image' => $item->getImage()
//     );
// }

// $items = $menu->getItemsByCategory("Breakfast");
// $BreakfastMeals = array();

// foreach($items as $item) {
//     $BreakfastMeals[] = array(
//         'name' => $item->getName(),
//         'category' => $item->getCategory(),
//         'price' => $item->getPrice(),
//         'description' => $item->getDescription(),
//         'image' => $item->getImage()
//     );
// }