<?php
class Database {
    // Vars
    private $pdo;
    
    // Properties
    public function getPdo() {
        return $this->pdo;
    }
    
    // Functions public
    public function __construct($config) {
        $connectionFields = $config->getDatabaseConnectionFields();
        
        if ($connectionFields[0] != "" && $connectionFields[1] != "" && $connectionFields[2] != "")
            $this->pdo = new PDO($connectionFields[0], $connectionFields[1], $connectionFields[2], $connectionFields[3]);
    }
    
    public function close() {
        unset($this->pdo);
    }
    
    // Functions private
}
