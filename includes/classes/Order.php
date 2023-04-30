<?php



class Order {
    private $id;
    private $customer_id;
    private $shipping_address;
    private $phone_number;
    private $instructions;
    private $status;
    private $total_price;
    private $created_at;
    private $updated_at;
    private $cart_id;
    protected $db;

    public function __construct($cart, $shipping_address, $phone_number, $instructions = "N/A") {
        $this->customer_id = $_SESSION['userId'];
        $this->cart_id = $cart->id;
        $this->shipping_address = $shipping_address;
        $this->phone_number = $phone_number;
        $this->instructions = $instructions;
        $this->status = 'Pending';
        $this->total_price = $cart->getTotal();
        $this->db = new Database();
        
        // Check if order already exists in database
        $existingOrder = $this->db->queryDB("SELECT * FROM orders WHERE customer_id = :customer_id AND cart_id = :cart_id", Database::SELECTSINGLE, array(array(':customer_id', $this->customer_id), array(':cart_id', $this->cart_id)));
    
        if ($existingOrder) {
            // If order already exists, set the ID to the existing order ID
            $this->id = $existingOrder['id'];
        } else {
            // If order doesn't exist, create a new ID and save the order to the database
            $this->id = uniqid();
            $this->saveOrder();
        }
    }
     


    private function saveOrder() {
            $sql = "INSERT INTO orders (id, customer_id, cart_id, shipping_address, phone_number, instructions, status, total_price) VALUES (:id, :customer_id, :cart_id, :shipping_address, :phone_number, :instructions, :status, :total_price)";
            $values = array (
                array(':id', $this->id), 
                array(':customer_id', $this->customer_id),
                array(':cart_id', $this->cart_id),
                array(':shipping_address', $this->shipping_address),
                array(':phone_number', $this->phone_number),
                array(':instructions', $this->instructions),
                array(':status', $this->status),
                array(':total_price', $this->total_price)
            );
            $this->db->queryDB($sql, Database::EXECUTE, $values);
            
            $sql = "SELECT 1 FROM orders WHERE id = :id";
            $values = array(
                array(':id', $this->id)
            );
            $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

            if($result) {
                return true;
            }
            return false;
        }

    public function payForOrder() {
       $orderDetails = $this->getOrderDetails();
       $email = $orderDetails['email'];
       $totalPrice = $orderDetails['total_price'];
       $_SESSION['userEmail'] = $email;
       $_SESSION['totalPrice'] = $totalPrice;
       header('Location: ../process/initialize.php');
    }

    public function getOrderDetails() {
        $order = $this->db->queryDB("SELECT * FROM orders WHERE id = :id", Database::SELECTSINGLE, array(array(':id', $this->id)));
        if ($order) {
            $user = $this->db->queryDB("SELECT name, email FROM users WHERE id = :id", Database::SELECTSINGLE, array(array(':id', $this->customer_id)));
            $cart = new Cart($order['customer_id']);
            $items = $cart->getOrderItems();
            $total_price = $cart->getTotal();
            $order_details = array(
                'customer_name' => $_SESSION['userName'],
                'email' => $user['email'],
                'customer_phone_number' => $order['phone_number'],
                'shipping_address' => $order['shipping_address'],
                'total_price' => $total_price,
                'instructions' => $order['instructions']
            );
            return $order_details;
        } else {
            return false;
        }
    }
    
}