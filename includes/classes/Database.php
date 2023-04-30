<?php

class Database {        

    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3;
        
    public $pdo;
        
        public function __construct(){
            $dsn = "mysql:host=".'localhost'.";dbname=".'restaurant';
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $this->pdo = new PDO($dsn, 'admin', 'hidepass', $options);
        }
    
        public function recordExists($table, $column, $value) {
            $sql = "SELECT COUNT(*) FROM $table WHERE $column = :value";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

        public function getRecord($table, $column, $value) {
            $sql = "SELECT * FROM $table WHERE $column = :value";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public function insertRecord($table, $values) {
            $sql = "INSERT INTO $table (".implode(',',array_keys($values)).") VALUES (:".implode(',:',array_keys($values)).")";
            $stmt = $this->pdo->prepare($sql);
            foreach($values as $key=>$value) {
                $stmt->bindValue(':'.$key, $value);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
        
        

    //Add queryDB() here
    public function queryDB($sql, $mode, $values = array()){
        
        $stmt = $this->pdo->prepare($sql);
        
        foreach($values as $valueToBind){
            $stmt->bindValue($valueToBind[0], $valueToBind[1]);
        }
        
        $stmt->execute();
        
        if ($mode != Database::SELECTSINGLE && $mode != Database::SELECTALL && $mode != Database::EXECUTE){
            throw new Exception('Invalid Mode');
        }else if ($mode == Database::SELECTSINGLE){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else if ($mode == Database::SELECTALL){
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }
        
    }
    
}