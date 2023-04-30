<?php 

class Item {
  private $id;
  private $name;
  private $description;
  private $category;
  private $price;
  private $featured;
  private $images;
  private $db;

  public function __construct($name, $description, $category, $price, $featured, $images, $id = null) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->category = $category;
    $this->price = $price;
    $this->featured = $featured;
    $this->images = $images;
    $this->db = new Database();
}




  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getPrice() {
    return $this->price;
  }

  public function isFeatured() {
    return $this->featured;
  }

  public function getImage() {
    return $this->images[0];
  }

  public function getImages() {
    return $this->images;
}


  public function getCreatedAt() {
    return $this->created_at;
  }

  public function getUpdatedAt() {
    return $this->updated_at;
  }




  public function updateItem($column, $value) {
    $this->{$column} = $value;
    $sql = "UPDATE menu SET $column = :value WHERE id = :id";
    $values = array(
        array(':value', $value),
        array(':id', $this->id)
    );
    $this->db->queryDB($sql, Database::EXECUTE, $values);

    // Update the corresponding property of the Item object
    switch ($column) {
        case 'name':
            $this->name = $value;
            break;
        case 'description':
            $this->description = $value;
            break;
        case 'category':
            $this->category = $value;
            break;
        case 'price':
            $this->price = $value;
            break;
        case 'featured':
            $this->featured = $value;
            break;
        case 'image_path':
            $this->image_path = $value;
            break;
        case 'images':
            $this->images = $value;
            break;
        default:
            // Do nothing
    }
}




  public function deleteItem(){
    global $db;
    $db = new Database();
    $sql = "DELETE FROM menu WHERE id = :id";
    $values = array(
        array(':id', $this->id)
    );
    $db->queryDB($sql, Database::EXECUTE, $values);
  }

  

}
 