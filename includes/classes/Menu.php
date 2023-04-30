<?php
require_once "Database.php";

class Menu {

    private $db;
    public function __construct() {
        $this->db = new Database();
    }

    public function addItem($item) {
        // Check if the item already exists in the database
        if ($this->db->recordExists('menu', 'name', $item->getName())) {
            return false;
        }
    
        // If the item doesn't exist, insert it into the database
        $sql = "INSERT INTO menu (name, description, category, price, featured, image_path, images) VALUES (:name, :description, :category, :price, :featured, :image, :images)";
        $values = array(
            array(':name', $item->getName()),
            array(':description', $item->getDescription()),
            array(':category', $item->getCategory()),
            array(':price', $item->getPrice()),
            array(':featured', $item->isFeatured()),
            array(':image', $item->getImage()),
            array(':images', json_encode($item->getImages()))
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        
        // Retrieve the last inserted id and set it on the item object
        $lastInsertedId = $this->db->queryDB("SELECT MAX(id) FROM menu", Database::SELECTSINGLE);
        $item->setId($lastInsertedId['MAX(id)']);
    
        return true;
    }
    
    
    

    public function getItemByID($id) { 
        $sql = "SELECT * FROM menu WHERE id = :id";
        $values = array(
            array(':id', $id)
        );
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);
        if ($result !== false) {
            $item = new Item($result['id'], $result['name'], $result['description'], $result['category'], $result['price'], $result['featured'], $result['image_path'], $result['images'], $result['created_at'], $result['updated_at']);
            return $item;
        } else {
            return false;
        }
     }


     public function searchDB($query) {
        $sql = "SELECT * FROM menu WHERE 
                name LIKE CONCAT('%', :query, '%') OR
                description LIKE CONCAT('%', :query, '%') OR
                category LIKE CONCAT('%', :query, '%')";
    
        $values = array(
            array(':query', $query)
        );
    
        $results = $this->db->queryDB($sql, Database::SELECTALL, $values);
    
        $items = array();
    
        foreach($results as $result){
            if (!is_array($result['images'])) {
                $images = json_decode($result['images'], true);
            }
                        $item = new Item($result['name'], $result['description'], $result['category'], $result['price'], $result['featured'], $images, $result['id']);
            array_push($items, $item);
        }
    
        return $items;
    }
    
    
    public function printMenu() {
        $sql = "SELECT * FROM menu";
        $menuItems = $this->db->queryDB($sql, Database::SELECTALL);
        for ($i=0; $i < count($menuItems); $i++) {
            $item = $menuItems[$i];
            foreach ($item as $key => $value) {
                echo $key . ': ' . $value . '<br>';
            }
        }
        }

    public function getFeaturedItems(){
        $sql = "SELECT * FROM menu WHERE featured = 1";
        $results = $this->db->queryDB($sql, Database::SELECTALL);
        $featured = array();

        foreach($results as $result){
            if (!is_array($result['images'])) {
                $images = json_decode($result['images'], true);
            }
                        $item = new Item($result['name'], $result['description'], $result['category'], $result['price'], $result['featured'], $images, $result['id']);
            array_push($featured, $item);
        }
        return $featured;
    }

    public function getItemsByCategory($query){
        $sql = "SELECT * FROM menu WHERE category = :query";
        $values = array(
            array(':query', $query)
        );
        $results = $this->db->queryDB($sql, Database::SELECTALL, $values);
    
        $items = array();
    
        foreach($results as $result){
            if (!is_array($result['images'])) {
                $images = json_decode($result['images'], true);
            }
                        $item = new Item($result['name'], $result['description'], $result['category'], $result['price'], $result['featured'], $images, $result['id']);
            array_push($items, $item);
        }
    
        return $items;

    }
  

    public function sortItemsByPrice(){
        $sql = "SELECT * FROM menu ORDER BY price ASC";
        $results = $this->db->queryDB($sql, Database::SELECTALL);
        $items = array();
    
        foreach($results as $result){
            if (!is_array($result['images'])) {
                $images = json_decode($result['images'], true);
            }
                        $item = new Item($result['name'], $result['description'], $result['category'], $result['price'], $result['featured'], $images, $result['id']);
            array_push($items, $item);
        }
    
        return $items;
    }

    
    
    
}    
