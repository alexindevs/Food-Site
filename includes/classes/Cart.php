<?php 

class Cart {
  public $id;
  private $userId;
  private $db;
  private $items = array();
  private $totalPrice = 0;

  public function __construct($userId) {
    $this->db = new Database();
    $this->userId = $userId;
    $this->createCartInDatabase();
  }

  private function createCartInDatabase() {
    $sql = "SELECT * FROM carts WHERE user_id = :userId";
    $values = array(
        array(':userId', $this->userId)
    );
    $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

    if ($result !== false) {
        // a cart already exists for the user, set the cart's properties
        $this->id = $result['cart_id'];
        $this->userId = $result['user_id'];
        $this->items = $this->getOrderItems();
        $this->totalPrice = $result['total_price'];
        return;
    } else {
        // create a new cart record and set the cart ID property
        $cartId = uniqid(); // generate a unique cart ID
        $sql = "INSERT INTO carts (cart_id, user_id, created_at) VALUES (:cartId, :userId, NOW())";
        $values = array(
            array(':cartId', $cartId),
            array(':userId', $this->userId)
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        $this->id = $cartId;
    }
  }

  public function getOrderItems() {
    $sql = "SELECT * FROM order_items WHERE cart_id = :cart_id";
    $values = array(
        array(':cart_id', $this->id)
    );
    $result = $this->db->queryDB($sql, Database::SELECTALL, $values);

    $this->items = array();
    foreach ($result as $row) {
        $item = new OrderItem($row['name'], $row['category'], $row['price'], $row['quantity']);
        $this->items[] = $item;
    }

    return $this->items;

  }


  public function saveOrderItem(OrderItem $orderItem) {
        $sql = "INSERT INTO order_items (cart_id, name, price, quantity) VALUES (:cart_id, :item_name, :item_price, :quantity)";
        $values = array(
            array(':cart_id', $this->id),
            array(':item_name', $orderItem->getName()),
            array(':item_price', $orderItem->getPrice()),
            array(':quantity', $orderItem->getQuantity())
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
  }


  public function addItem(OrderItem $orderItem) {
    if ($this->db->recordExists('order_items', 'name', $orderItem->getName()) && $this->db->recordExists('carts', 'cart_id', $this->id)) { 
        throw new Error("This item is already in your cart!");
        return false;
    } else {
        // Save the order item to the cart
        $this->saveOrderItem($orderItem);

        // Add the order to the items array
        array_push($this->items, $orderItem);

        $sql = "UPDATE carts SET total_price = (SELECT SUM(price * quantity) FROM order_items WHERE cart_id = :cart_id) WHERE cart_id = :cart_id";
        $values = [[':cart_id', $this->id]];
        $this->db->queryDB($sql, Database::EXECUTE, $values);
    }
}



  public function removeItem($index) {
    if (isset($this->items[$index])) {
        $orderItem = $this->items[$index];
        $sql = "DELETE FROM order_items WHERE cart_id = :cart_id AND item_name = :item_name AND item_price = :item_price AND quantity = :quantity";
        $values = array(
            array(':cart_id', $this->id),
            array(':item_name', $orderItem->getItemName()),
            array(':item_price', $orderItem->getItemPrice()),
            array(':quantity', $orderItem->getQuantity())
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        unset($this->items[$index]);
    }
}

public function getItems() {
    return $this->items;
}

public function getTotal() {
    $sql = "SELECT total_price FROM carts WHERE cart_id = :id";
    $values = array(
        array(':id', $this->id)
    ); 
    $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);
    return $result['total_price'];
}


public function clearCart() {
    $sql = "DELETE FROM order_items WHERE cart_id = :cart_id";
    $values = array(
        array(':cart_id', $this->id)
    );
    $this->db->queryDB($sql, Database::EXECUTE, $values);
    $this->items = array();
    $sql = "DELETE FROM carts WHERE cart_id = :cart_id";
    $this->db->queryDB($sql, Database::EXECUTE, $values);
} }

