<?php

session_start();
 
require "Database.php";
require "Helper.php";

class User {
    private $id;
    private $name;
    private $password;
    private $email;
    private $savedToDB;
    protected $db;

    //Creates a new instance of the User class. To be used when creating a user from the signup form.
    public function __construct($email, $password, $name = '') {
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
        $this->savedToDB = false;
        $this->db = new Database();
    }

    //Inserts the new User's information into the Database
    public function registerUser() {
        if (!$this->db->recordExists('users', 'email', $this->email)) {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $values = array(
                array(':name', $this->name),
                array(':email', $this->email),
                array(':password', $this->password)
            );
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        }
        return true;
    }
    

    // //Gets records associated with foods the user previously liked
    // public function getFavorites() {
    //     $userId = $this->id;
    //     $sql = "SELECT * FROM favorites WHERE user_id = :userId";
    //     $values = array(
    //         array(':userId' => $userId)
    //     );
    //     $favorites = $this->db->queryDB($sql, Database::SELECTALL, $values);
    //     return $favorites;
    // }
    //Gets the User's name, because it's private asf.

    public function getName() {
        return $this->name;
    }
    

    //Settings - updates the user's name
    public function updateName($newName){
        if (!$this->db->recordExists('users', 'name', $newName)) {
        $userId = $this->id;
        $sql = "UPDATE users SET name = :name WHERE id = :id";
        $values = array(
            array(':name', $newName),
            array(':id', $userId)
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        $this->name = $newName;
    }
    }
     //Gets the User's name, because it's private asf.
     public function getEmail() {
        return $this->email;
    }
    
    //Settings - updates the user's email
    public function updateEmail($newEmail){
        if (!$this->db->recordExists('users', 'email', $newEmail)) {
        $userId = $this->id;

        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $values = array(
            array(':email', $newEmail),
            array(':id', $userId)
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        $this->email = $newEmail;
    }}

     //Gets the User's name, because it's private asf.
     public function getPassword() {
        return $this->passwordHash;
    }
    
    //Settings - updates the user's password
    public function updatePassword($newPassword){
        $userId = $this->id;
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $values = array(
            array(':password', $newPasswordHash),
            array(':id', $userId)
        );
        $this->db->queryDB($sql, Database::EXECUTE, $values);
    }

    public function getId() {
        $email = $this->email;
        $sql = "SELECT id FROM users WHERE email = :email";
        $values = array(
            array(':email', $email),
        );
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);
        return $result['id'];
    }

    public function deleteUser($id) {
        
        $sql = "DELETE FROM users WHERE id = :id";
        $values = array(
            array(':id', $id)
        );
        
        $this->db->queryDB($sql, Database::EXECUTE, $values);
        unset($_SESSION['user']);
    }

    // Check if user with given email exists
// Check if user with given email exists
public function login($email, $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $values = array(
        array(':email', $email)
    );

    $user = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);
    if (!$user) {
        echo "No account associated with these details.";
        return false;
     
    } else {
    // Check if password is correct
return password_verify($password, $user['password']);

    }
}

      
// Check if user is logged in
public static function isLoggedIn() {
// Check if session variable is set
if (isset($_SESSION['user'])) {
    // Check if User object exists with that ID
    $user = $_SESSION['user'];
    if (is_object($user) && get_class($user) == 'User') {
        return true;
    }
}
return false;
}

public static function getUserById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $values = array(
        array(':id', $id)
    );

    $user = $db->queryDB($sql, Database::SELECTSINGLE, $values);
    return $user;
}

// Log out user
public static function logout() {
// Unset session variable
unset($_SESSION['user']);
}
}
