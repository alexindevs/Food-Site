<?php 

require "Database.php";


class OrderItem {
    
    public $name;
    public $category;
    public $price;
    public $quantity;
    private $db;

    public function __construct($name, $category, $price, $quantity) {
        $this->db = new Database();
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }


    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

  
}
  